<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'selling_price' => 'float',
        'discount_price' => 'float',
    ];

    public function getSellingPriceAttribute($value)
    {
        return (float)($value ?? 0);
    }

    public function getDiscountPriceAttribute($value)
    {
        return ($value !== null && $value !== '') ? (float)$value : null;
    }

    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id','id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id','id');
    }

    public function attributes(){
        return $this->hasMany(ProductAttribute::class);
    }

    public static function get_attribute($product_id, $size){
        $trimmed = trim((string)$size);
        $product_attribute = ProductAttribute::where('product_id', $product_id)
            ->where(function($q) use ($trimmed, $size) {
                $q->where('size', $trimmed)->orWhere('size', $size);
            })->first();

        if (!$product_attribute) {
            $product_attribute = ProductAttribute::where('product_id', $product_id)->first();
        }

        if (!$product_attribute) {
            return array('product_stock' => 0, 'selling_price' => 0, 'final_price' => 0, 'discount' => 0, 'discount_percent' => 0);
        }

        $attrArray = $product_attribute->toArray();
        $product_attribute_stock = $attrArray['stock'];
        $attrPrice = (float)$attrArray['price'];

        $productDetails = Product::select('discount_price', 'category_id')->where('id', $product_id)->first();
        $discount_price = (float)($productDetails->discount_price ?? 0);

        if($discount_price > 0){
            $discount_percent = $discount_price;
            $value = (100 - $discount_price)/100; 
            $final_price = $value * $attrPrice;
            $discount = $attrPrice - $final_price;
        }else{
            $discount_percent = 0;
            $final_price = $attrPrice;
            $discount = 0;
        }

        return array(
            'product_stock' => $product_attribute_stock,
            'selling_price' => $attrPrice,
            'final_price' => $final_price,
            'discount' => $discount,
            'discount_percent' => $discount_percent
        );
    }

    public function getProductThumbnailAttribute($value)
    {
        if (empty($value) || !file_exists(public_path($value))) {
            return 'back/assets/images/admin/no_image.jpg';
        }
        return $value;
    }

    public function totalStock()
    {
        $attributeSum = $this->attributes()->sum('stock');
        if ($attributeSum > 0) {
            return (int)$attributeSum;
        }
        return (int)$this->product_qty;
    }

    public function checkStockAndAlert()
    {
        $totalStock = $this->totalStock();
        
        if ($totalStock <= 10) {
            if (!$this->low_stock_alert_sent) {
                // Send alert
                $this->sendLowStockAlert($totalStock);
                
                // Set flag and save quietly to avoid triggering saved event again
                $this->low_stock_alert_sent = true;
                $this->saveQuietly();
            }
        } else {
            if ($this->low_stock_alert_sent) {
                $this->low_stock_alert_sent = false;
                $this->saveQuietly();
            }
        }
    }

    protected function sendLowStockAlert($totalStock)
    {
        $admins = User::where('role', 'admin')->get();
        
        foreach ($admins as $admin) {
            // Send Database Notification
            $admin->notify(new \App\Notifications\LowStockAlertNotification($this, $totalStock));
            
            // Send Email Alert
            try {
                \Illuminate\Support\Facades\Mail::to($admin->email)->send(new \App\Mail\LowStockAlertMail($this, $totalStock));
            } catch (\Exception $e) {
                // Fail silently in case mail server is not configured in local environment
                \Illuminate\Support\Facades\Log::error("Failed to send low stock email: " . $e->getMessage());
            }
        }
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($product) {
            $product->checkStockAndAlert();
            \Illuminate\Support\Facades\Cache::forget('home_new_products');
            \Illuminate\Support\Facades\Cache::forget('home_catwise_products_'.$product->category_id);
        });

        static::deleted(function ($product) {
            \Illuminate\Support\Facades\Cache::forget('home_new_products');
            \Illuminate\Support\Facades\Cache::forget('home_catwise_products_'.$product->category_id);
        });
    }
}
