<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\WishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function add_to_wish_list(Request $request, $product_id){

        if (Auth::check()) {
            $exists = WishList::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exists) {
               WishList::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),

               ]);
               return response()->json(['success' => 'Successfully added to your WishList' ]);
            } else{
                return response()->json(['error' => 'This product is already in your WishList' ]);
            } 

        }else{
            return response()->json(['error' => 'Kindly login your account' ]);
        }
    }

    public function all_wish_list(){
        return view('front.wishlist.view_wishlist');
    }

    public function get_wish_list_product(){
        $wishlist = WishList::with('product')->where('user_id', Auth::id())->latest()->get();
        $wishQty = $wishlist->count(); 
        // echo "<pre>"; print_r($wishlist); die;

        return response()->json(['wishlist'=> $wishlist, 'wishQty' => $wishQty]);
    }

    public function wish_list_remove($id){
        WishList::where('user_id', Auth::id())->where('id', $id)->delete();

        return response()->json(['success' => 'Product Successfully Removed']);
    }
}
