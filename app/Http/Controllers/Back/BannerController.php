<?php

namespace App\Http\Controllers\Back;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class BannerController extends Controller
{
    public function all_banner(){
        $banner = Banner::latest()->get();
        return view('back.admin.banner.all_banner', compact('banner'));
    }

    public function add_banner(){
        return view('back.admin.banner.add_banner');
    }

    public function store_banner(Request $request){

        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('back/assets/images/products/banners/'.$name_gen);
        $save_url = 'back/assets/images/products/banners/'.$name_gen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url, 
        ]);

       $notification = array(
            'message' => 'Banner Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification); 
    }

    public function edit_banner($id){
        $banner = Banner::findOrFail($id);
        return view('back.admin.banner.edit_banner', compact('banner'));
    }// End Method 

    public function update_banner(Request $request){
        $banner_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('banner_image')) {

        $image = $request->file('banner_image');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('back/assets/images/products/banners/'.$name_gen);
        $save_url = 'back/assets/images/products/banners/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Banner::findOrFail($banner_id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url, 
        ]);

       $notification = array(
            'message' => 'Banner Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification); 

        } else {

            Banner::findOrFail($banner_id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url, 
        ]);

       $notification = array(
            'message' => 'Banner Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification); 

        } // end else
    }// End Method 

    public function delete_banner($id){
        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        unlink($img); 

        Banner::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }  
}
