<?php

namespace App\Http\Controllers\Back;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function all_coupon(){
        $coupon = Coupon::latest()->get();
        return view('back.admin.coupon.all_coupon', compact('coupon'));
    }

    public function add_coupon(){
        return view('back.admin.coupon.add_coupon');
    }

    public function store_coupon(Request $request){
        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),            
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon added successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('all.coupon')->with($notification);
    }

    public function edit_coupon($id){
        $coupon = Coupon::findOrFail($id);

        return view('back.admin.coupon.edit_coupon', compact('coupon'));
    }// End Method 


    public function update_coupon(Request $request){
        $coupon_id = $request->id;
         Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification); 
    }// End Method 

     public function delete_coupon($id){
        Coupon::findOrFail($id)->delete();
         $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
}
