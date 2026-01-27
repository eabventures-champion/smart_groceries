<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function get_product_stock ($product_id, $size){
        $get_product_stock = ProductAttribute::select('stock')->where(['product_id'=> $product_id, 'size' => $size])->first();
        return $get_product_stock->stock;
    }
}
