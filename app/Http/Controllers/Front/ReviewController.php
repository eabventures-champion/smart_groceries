<?php

namespace App\Http\Controllers\Front;

use Auth;
use Carbon\Carbon;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function store_review(Request $request){
        $product = $request->product_id;
        $vendor = $request->hvendor_id;

        $request->validate([
            'comment' => 'required',
        ]);

        Review::insert([

            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->quality,
            'vendor_id' => $vendor,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Review sent successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
    
    // public function vendor_all_review(){
    //     $id = Auth::user()->id;
    //     $review = Review::where('vendor_id',$id)->where('status',1)->orderBy('id','DESC')->get();
    //     return view('vendor.backend.review.approve_review',compact('review'));
    // }
}
