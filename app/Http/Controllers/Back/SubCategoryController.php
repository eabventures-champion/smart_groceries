<?php

namespace App\Http\Controllers\Back;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function all_subcategories(){
        $subcategories = SubCategory::latest()->get();
        return view('back.admin.subcategory.all_subcategories', compact('subcategories'));
    }

    public function add_subcategory(){
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('back.admin.subcategory.add_subcategory', compact('categories'));
    }

    public function store_subcategory(Request $request){
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace('','-', $request->subcategory_name)),
        ]);

        $notification = array(
            'message' => 'Sub Category inserted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('all.subcategories')->with($notification);
    }

    public function edit_subcategory($id){
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('back.admin.subcategory.edit_subcategory', compact('categories','subcategory'));
    }

    public function update_subcategory(Request $request){
        $subcategory_id = $request->id;
        SubCategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace('','-', $request->subcategory_name)),
        ]);

        $notification = array(
            'message' => 'SubCategory updated successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('all.subcategories')->with($notification);
    }

    public function delete_subcategory($id){
         SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function get_sub_category($category_id){
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);

    }
}
