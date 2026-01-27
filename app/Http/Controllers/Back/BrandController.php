<?php

namespace App\Http\Controllers\Back;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class BrandController extends Controller
{
    public function all_brands(){
        $brands = Brand::latest()->get();
        return view('back.admin.brand.all_brands', compact('brands'));
    }

    public function add_brand(){
        return view('back.admin.brand.add_brand');
    }

    public function store_brand(Request $request){
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('back/assets/images/brand/'.$name_gen);
        $save_url = 'back/assets/images/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace('','-', $request->brand_name)),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand inserted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('all.brands')->with($notification);
    }

    public function edit_brand($id){
        $brand = Brand::findOrFail($id);
        return view('back.admin.brand.brand_edit', compact('brand'));
    }

    public function update_brand(Request $request){
        $brand_id = $request->id;
        $old_image = $request->old_image;

        if($request->file('brand_image')){
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('back/assets/images/brand/'.$name_gen);
            $save_url = 'back/assets/images/brand/'.$name_gen;

            if(file_exists($old_image)){
                unlink($old_image);
            }

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace('','-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Brand updated with image successfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.brands')->with($notification);

        }else{
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace('','-', $request->brand_name)),
            ]);

            $notification = array(
                'message' => 'Brand updated without image successfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.brands')->with($notification);
        }
    }

    public function delete_brand($id){
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img); 

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
