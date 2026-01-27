<?php

namespace App\Http\Controllers\Back;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class SliderController extends Controller
{
    public function all_slider(){
        $sliders = Slider::latest()->get();
        return view('back.admin.slider.all_slider', compact('sliders'));
    }

    public function add_slider(){
        return view('back.admin.slider.add_slider');
    }

    public function store_slider(Request $request){
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('back/assets/images/products/sliders/'.$name_gen);
        $save_url = 'back/assets/images/products/sliders/'.$name_gen;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url, 
        ]);

       $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification); 
    }

    public function edit_slider($id){
        $sliders = Slider::findOrFail($id);
        return view('back.admin.slider.edit_slider', compact('sliders'));
    }// End Method 


    public function update_slider(Request $request){
        $slider_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('slider_image')) {

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('back/assets/images/products/sliders/'.$name_gen);
        $save_url = 'back/assets/images/products/sliders/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Slider::findOrFail($slider_id)->update([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url, 
        ]);

       $notification = array(
            'message' => 'Slider Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification); 

        } else {

             Slider::findOrFail($slider_id)->update([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title, 
        ]);

       $notification = array(
            'message' => 'Slider Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification); 
        } // end else

    }// End Method 

    public function delete_slider($id){

        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img); 

        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
}
