<?php

namespace App\Http\Controllers\Back;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function pending_review(){
        $review = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('back.admin.review.pending_review', compact('review'));
    }

    public function review_approve($id){
        Review::where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Review Approved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    public function publish_review(){
        $review = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('back.admin.review.publish_review', compact('review'));

    }// End Method 


    public function review_delete($id){
        Review::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
}
