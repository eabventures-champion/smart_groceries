<?php

namespace App\Http\Controllers\Back;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnController extends Controller
{
    public function return_request(){
        $orders = Order::where('return_order', 1)->orderBy('id', 'DESC')->get();
        return view('back.admin.return_order.return_request', compact('orders'));
    }

    public function return_request_approved($order_id){
        Order::where('id', $order_id)->update(['return_order' => 2]);
        $notification = array(
            'message' => 'Return Order Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('complete.return.request')->with($notification); 
    }

    public function complete_return_request(){
        $orders = Order::where('return_order', 2)->orderBy('id', 'DESC')->get();
        return view('back.admin.return_order.complete_return_request', compact('orders'));
    }

    public function return_request_unapproved($order_id){
        Order::where('id', $order_id)->update(['return_order' => 3]);
        $notification = array(
            'message' => 'Return Order Un-Approved',
            'alert-type' => 'info'
        );
        return redirect()->route('uncomplete.return.request')->with($notification); 
    }

    public function uncomplete_return_request(){
        $orders = Order::where('return_order', 3)->orderBy('id', 'DESC')->get();
        return view('back.admin.return_order.uncomplete_return_request', compact('orders'));
    }
}
