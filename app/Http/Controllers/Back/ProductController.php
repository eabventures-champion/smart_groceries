<?php

namespace App\Http\Controllers\Back;

use Image;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function all_products(){
        $products = Product::latest()->get();
        return view('back.admin.product.all_products', compact('products'));
    } 

    public function add_product(){
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('back.admin.product.add_product', compact('activeVendor', 'brands', 'categories'));
    }

    public function store_product(Request $request){
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('back/assets/images/products/thumbnails/'.$name_gen);
        $save_url = 'back/assets/images/products/thumbnails/'.$name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => 'none',
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp, 

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals, 

            'product_thumbnail' => $save_url,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(), 
        ]);

        /// Multiple Image Upload From her //////
        $images = $request->file('multi_img');
        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(800,800)->save('back/assets/images/products/multi-image/'.$make_name);
        $uploadPath = 'back/assets/images/products/multi-image/'.$make_name;

        MultiImage::insert([
            'product_id' => $product_id,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(), 
        ]); 
        } // end foreach

        /// End Multiple Image Upload From her //////

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification); 
    }

    public function edit_product($id){
         $multiImgs = MultiImage::where('product_id', $id)->get();
         $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
         $brands = Brand::latest()->get();
         $categories = Category::latest()->get();
         $subcategory = SubCategory::latest()->get();
         $products = Product::findOrFail($id);
         return view('back.admin.product.edit_product', compact('brands', 'categories', 'activeVendor', 'products', 'subcategory', 'multiImgs'));
    }

     public function update_product(Request $request){
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
       'brand_id' => $request->brand_id,
       'category_id' => $request->category_id,
       'subcategory_id' => $request->subcategory_id,
       'product_name' => $request->product_name,
       'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

       'product_code' => $request->product_code,
       'product_qty' => $request->product_qty,
       'product_tags' => $request->product_tags,
       'product_size' => $request->product_size,
       'product_color' => $request->product_color,

       'selling_price' => $request->selling_price,
       'discount_price' => $request->discount_price,
       'short_descp' => $request->short_descp,
       'long_descp' => $request->long_descp, 

       'hot_deals' => $request->hot_deals,
       'featured' => $request->featured,
       'special_offer' => $request->special_offer,
       'special_deals' => $request->special_deals, 

       'vendor_id' => $request->vendor_id,
       'status' => 1,
       'created_at' => Carbon::now(), 

        ]);

        $notification = array(
        'message' => 'Product Updated Without Image Successfully',
        'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification); 
    }

    public function update_product_thumbnail(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_image;

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('back/assets/images/products/thumbnails/'.$name_gen);
        $save_url = 'back/assets/images/products/thumbnails/'.$name_gen;

         if (file_exists($oldImage)) {
           unlink($oldImage);
        }

        Product::findOrFail($pro_id)->update([

            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Product Image Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    public function update_multi_image(Request $request){

        if($request->multi_img == null){
            echo "choose image to update first, after that you can now update image"; die;
        }
        
        $imgs = $request->multi_img;
        // dd($imgs);

        foreach($imgs as $id => $img ){
            $imgDel = MultiImage::findOrFail($id);
            if ($imgDel->photo_name && file_exists($imgDel->photo_name)) {
                unlink($imgDel->photo_name);
            }

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(800,800)->save('back/assets/images/products/multi-image/'.$make_name);
            $uploadPath = 'back/assets/images/products/multi-image/'.$make_name;

            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]); 
        }

         $notification = array(
            'message' => 'Product Multi-Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    public function delete_multi_image($id){
        $oldImg = MultiImage::findOrFail($id);
        if ($oldImg->photo_name && file_exists($oldImg->photo_name)) {
            unlink($oldImg->photo_name);
        }

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Store new additional multi images for an existing product.
     */
    public function store_new_multi_image(Request $request){
        $product_id = $request->id;
        $images = $request->file('multi_img');

        if($images){
            foreach($images as $img){
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(800,800)->save('back/assets/images/products/multi-image/'.$make_name);
                $uploadPath = 'back/assets/images/products/multi-image/'.$make_name;

                MultiImage::insert([
                    'product_id' => $product_id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(), 
                ]); 
            }
            
            $notification = array(
                'message' => 'New Multi Images Added Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Please select at least one image to upload.',
                'alert-type' => 'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function product_inactive($id){
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function product_active($id){
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function delete_product($id){
        $product = Product::findOrFail($id);
        if ($product->product_thumbnail && file_exists($product->product_thumbnail)) {
            unlink($product->product_thumbnail);
        }
        Product::findOrFail($id)->delete();

        $imges = MultiImage::where('product_id', $id)->get();
        foreach($imges as $img){
            if ($img->photo_name && file_exists($img->photo_name)) {
                unlink($img->photo_name);
            }
            MultiImage::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function product_stock(){
        $products = Product::latest()->get();
        return view('back.admin.product.product_stock', compact('products'));
    }

    public function add_edit_attributes(Request $request, $id){
        $product = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_thumbnail', 'selling_price')->with('attributes')->find($id);

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            foreach($data['sku'] as $key => $value){
                if(!empty($value)){
                    
                    // sku duplicate check
                    $sku_count = ProductAttribute::where('sku', $value)->count();
                    if($sku_count > 0){

                        $notification = array(
                            'message' => 'SKU already exists! Please use a unique SKU.',
                            'alert-type' => 'error'
                        );
                        return back()->with($notification);
                    }

                    // size duplicate check
                    $size_count = ProductAttribute::where(['product_id' => $id, 'size'=> $data['size'][$key]])->count();
                    if($size_count > 0){

                        $notification = array(
                            'message' => 'Size already exists! Please add another Size.',
                            'alert-type' => 'error'
                        );
                        return back()->with($notification);
                    }

                    $attribute = New ProductAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }

            $notification = array(
                'message' => 'Product attribute added successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        return view('back.admin.product.add_edit_attributes', compact('product'));
    }

    // public function update_attribute_status(Request $request){
    //     if($request->ajax()){
    //         $data = $request->all();
    //         if($data['status'] == "Active"){
    //             $status = 0;
    //         }else{
    //             $status = 1;
    //         }
    //         ProductAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
    //         return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
    //     }
    // }

    public function product_attribute_inactive($id){
        ProductAttribute::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Attribute Inactive',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function product_attribute_active($id){
        ProductAttribute::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Attribute Active',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function delete_product_attribute($id){
        ProductAttribute::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Attribute deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function edit_attritube(Request $request){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach($data['attribute_id'] as $key => $attribute){
                if(!empty($attribute)){
                    ProductAttribute::where([
                        'id' => $data['attribute_id'][$key]
                    ])->update([
                        'price' => $data['price'][$key],
                        'stock' => $data['stock'][$key]
                    ]);
                }
            }
            
            $notification = array(
                'message' => 'Product Attribute has been updated successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
    }

    /**
     * Download a single product's thumbnail image.
     */
    public function download_product_image($id){
        $product = Product::findOrFail($id);
        $filePath = public_path($product->product_thumbnail);

        if (!file_exists($filePath)) {
            $notification = array(
                'message' => 'Image file not found on server. The product image may have been lost.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $fileName = str_replace(' ', '_', $product->product_name) . '_' . basename($product->product_thumbnail);
        return response()->download($filePath, $fileName);
    }

    /**
     * Download all product images (thumbnails + multi-images) as a ZIP file.
     */
    public function download_all_product_images(){
        $products = Product::all();

        $zipFileName = 'product_images_backup_' . date('Y-m-d_His') . '.zip';
        $zipPath = public_path($zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            $notification = array(
                'message' => 'Could not create ZIP file. Check server permissions.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $filesAdded = 0;

        foreach ($products as $product) {
            // Add thumbnail
            $thumbPath = public_path($product->product_thumbnail);
            if (file_exists($thumbPath)) {
                $safeName = str_replace(' ', '_', $product->product_name);
                $zip->addFile($thumbPath, 'thumbnails/' . $safeName . '_' . basename($product->product_thumbnail));
                $filesAdded++;
            }

            // Add multi-images
            $multiImages = MultiImage::where('product_id', $product->id)->get();
            foreach ($multiImages as $index => $img) {
                $imgPath = public_path($img->photo_name);
                if (file_exists($imgPath)) {
                    $safeName = str_replace(' ', '_', $product->product_name);
                    $zip->addFile($imgPath, 'multi-images/' . $safeName . '_' . ($index + 1) . '_' . basename($img->photo_name));
                    $filesAdded++;
                }
            }
        }

        $zip->close();

        if ($filesAdded === 0) {
            // Clean up the empty zip
            if (file_exists($zipPath)) {
                unlink($zipPath);
            }
            $notification = array(
                'message' => 'No image files found on the server to download.',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
