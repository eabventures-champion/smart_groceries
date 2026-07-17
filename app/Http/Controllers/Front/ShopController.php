<?php

namespace App\Http\Controllers\Front;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function shop_page(Request $request){
        $products = Product::where('status', 1);

        if(!empty($request->category)){
            $slugs = explode(',', $request->category);
            $catIds = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();
            $products->whereIn('category_id', $catIds);
        }

        if(!empty($request->brand)){
            $slugs = explode(',', $request->brand);
            $brandIds = Brand::select('id')->whereIn('brand_slug', $slugs)->pluck('id')->toArray();
            $products->whereIn('brand_id', $brandIds);
        }

        if(!empty($request->price)){
            $price = explode('-', $request->price);
            $products->whereBetween('selling_price', $price);
        }

        $products = $products->orderBy('id', 'DESC')->paginate(20)->withQueryString();

        $categories = Category::orderBy('category_name', 'ASC')->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->get();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

        if ($request->ajax() || $request->has('ajax') || $request->wantsJson()) {
            return view('front.product.shop_grid_partial', compact('products'))->render();
        }

        return view('front.product.shop_page', compact('products', 'categories', 'brands', 'newProduct'));
    }

    public function shop_filter(Request $request){
        $data = $request->all();

        // By Category
        $catUrl = "";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catUrl)){
                    $catUrl .= '&category='.$category;
                }else{
                    $catUrl .= ','.$category; 
                }
            }
        }

        // By Brand
        $brandUrl = "";
        if(!empty($data['brand'])){
            foreach($data['brand'] as $brand){
                if(empty($brandUrl)){
                    $brandUrl .= '&brand='.$brand;
                }else{
                    $brandUrl .= ','.$brand; 
                }
            }
        }

        // Price
        $price_range_url = "";
        if(!empty($data['price_range'])){
            $price_range_url .= '&price='.$data['price_range'];
        }

        return redirect()->route('shop.page', $catUrl.$brandUrl.$price_range_url);
    }
}
