<?php

namespace App\Http\Controllers\Back;

use DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Notifications\OrderDeliveringNotification;

class OrderController extends Controller
{
    public function pending_order(){
        $orders = Order::where('status', 'pending')->orderBy('id','DESC')->get();
        return view('back.admin.orders.pending_orders', compact('orders'));
    }

    public function admin_order_details($order_id){
        $order = Order::with('region', 'district', 'city', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('back.admin.orders.admin_order_details', compact('order', 'orderItem'));
    }

    public function admin_confirmed_order(){
        $orders = Order::where('status', 'confirmed')->orderBy('id', 'DESC')->get();
        return view('back.admin.orders.confirmed_orders', compact('orders'));
    } // End Method 


    public function admin_processing_order(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('back.admin.orders.processing_orders', compact('orders'));
    } // End Method 


    public function admin_delivered_order(){
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
        return view('back.admin.orders.delivered_orders', compact('orders'));
    }

    public function pending_to_confirm($order_id){
        Order::findOrFail($order_id)->update(['status' => 'confirmed', 'confirmed_date' => Carbon::now()]);
        $notification = array(
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.confirmed.order')->with($notification); 
    }

    public function confirm_to_process($order_id){
        Order::findOrFail($order_id)->update(['status' => 'processing', 'processing_date' => Carbon::now()]);
        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.processing.order')->with($notification); 
    }


    public function admin_delivering_order(){
        $orders = Order::where('status','delivering')->orderBy('id','DESC')->get();
        return view('back.admin.orders.delivering_orders', compact('orders'));
    }

    public function process_to_deliver($order_id){
        $order = Order::findOrFail($order_id);
        $order->update([
            'status' => 'delivering',
            'shipped_date' => Carbon::now()
        ]);

        // Send database notification to the user
        $user = $order->user;
        if ($user) {
            $user->notify(new OrderDeliveringNotification($order));
        }

        $notification = array(
            'message' => 'Delivery Initiated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.delivering.order')->with($notification); 
    }

    public function admin_invoice_download($order_id){
        $order = Order::with('region','district','city','user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('back.admin.orders.admin_order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
}
