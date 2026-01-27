<?php

namespace App\Http\Controllers\Back;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class CategoryController extends Controller
{
    public function all_categories(){
        $categories = Category::latest()->get();
        return view('back.admin.category.all_categories', compact('categories'));
    }

    public function add_category(){
        return view('back.admin.category.add_category');
    }

    public function store_category(Request $request){
        $image = $request->file('category_photo');
        $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(120, 120)->save('back/assets/images/category/'.$name_gen);
        $save_url = 'back/assets/images/category/'.$name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace('','-', $request->category_name)),
            'category_photo' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category inserted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('all.categories')->with($notification);
    }

    public function edit_category($id){
        $category = Category::findOrFail($id);
        return view('back.admin.category.edit_category', compact('category'));
    }

    public function update_category(Request $request){
        $category_id = $request->id;
        $old_image = $request->old_image;

        if($request->file('category_photo')){
            $image = $request->file('category_photo');
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(120, 120)->save('back/assets/images/category/'.$name_gen);
            $save_url = 'back/assets/images/category/'.$name_gen;

            if(file_exists($old_image)){
                unlink($old_image);
            }

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace('','-', $request->category_name)),
                'category_photo' => $save_url,
            ]);

            $notification = array(
                'message' => 'Category updated with image successfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.categories')->with($notification);

        }else{
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace('','-', $request->category_name)),
            ]);

            $notification = array(
                'message' => 'Category updated without image successfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.categories')->with($notification);
        }
    }

    public function delete_category($id){
        $category = Category::findOrFail($id);
        $img = $category->category_photo;
        unlink($img); 

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}

