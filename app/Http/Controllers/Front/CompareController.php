<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Compare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function add_to_compare($product_id){

        if (Auth::check()) {
            $exists = Compare::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exists) {
               Compare::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),

               ]);
               return response()->json(['success' => 'Successfully Added On Your Compare' ]);
            } else{
                return response()->json(['error' => 'This product is already in your Compare List' ]);
            } 

        }else{
            return response()->json(['error' => 'Kindly login your account' ]);
        }
    }

    public function all_compare(){
        return view('front.compare.view_compare');
    }

    public function get_compare_product(){
        $compare = Compare::with('product')->where('user_id', Auth::id())->latest()->get(); 

        return response()->json($compare);
    }

    public function compare_remove($id){
        Compare::where('user_id', Auth::id())->where('id', $id)->delete();

        return response()->json(['success' => 'Successfully Product Removed' ]);
    }
}
