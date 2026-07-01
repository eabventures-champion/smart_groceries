<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ExpertBooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Notifications\OrderReturnRequestNotification;

class UserController extends Controller
{
    public function dashboard(){
        $id = Auth::user()->id;
        $user = User::find($id);

        // Auto-refresh student ID prefix if status changed (STU ↔ ALM)
        $user->refreshStudentId();

        // Get order stats for dashboard
        $totalOrders = Order::where('user_id', $id)->count();
        $pendingOrders = Order::where('user_id', $id)->where('status', 'pending')->count();
        $completedOrders = Order::where('user_id', $id)->where('status', 'delivered')->count();

        return view('index', compact('user', 'totalOrders', 'pendingOrders', 'completedOrders'));
    }

    public function user_profile_update(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('front/assets/imgs/users/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('front/assets/imgs/users'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function user_logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function user_password_update(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){
            $notification = array(
                'message' => 'Old Password does not match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password changed successfully',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    // Users Dashboard details

    public function user_order_page(){
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id','DESC')->get();

        return view('front.user.user_order_page', compact('orders'));
    }

    public function user_bookings(){
        $email = Auth::user()->email;
        $bookings = ExpertBooking::where('user_email', $email)->orderBy('id', 'DESC')->get();

        return view('front.user.expert_bookings', compact('bookings'));
    }

    public function return_order_page(){
        $orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', NULL)->orderBy('id', 'DESC')->get();        
        return view('front.user.return_order_view', compact('orders'));
    }

    public function user_track_order(){
        return view('front.user.user_track_order');
    }

    public function order_tracking(Request $request){

        $invoice = $request->code;

        $track = Order::where('invoice_no', $invoice)->first();

        if($track) {
           return view('front.user.user_tracking_order', compact('track'));

        } else{

            $notification = array(
            'message' => 'Invoice Code Is Invalid',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification); 

        }
    }

    public function user_account(){
        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('front.user.account_details', compact('userData'));
    }

    public function user_change_password(){
        return view('front.user.user_change_password' );
    }

    public function user_order_details($order_id){
        $order = Order::with('region', 'district', 'city', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('front.user.order_details', compact('order', 'orderItem'));
    }

    public function user_order_invoice($order_id){

        $order = Order::with('region', 'district', 'city', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('front.user.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function return_order(Request $request, $order_id){
        $order = Order::findOrFail($order_id);
        $order->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1, 
        ]);

        // Notify admin about the return request
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $order->refresh();
            $admin->notify(new OrderReturnRequestNotification($order));
        }

        $notification = array(
            'message' => 'Return Request Sent Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.order.page')->with($notification); 
    }

    public function confirm_order_delivery($order_id){
        $order = Order::where('id', $order_id)
            ->where('user_id', Auth::id())
            ->where('status', 'delivering')
            ->firstOrFail();

        // Decrement product inventory quantities
        $productItems = OrderItem::where('order_id', $order_id)->get();
        foreach($productItems as $item){
            Product::where('id', $item->product_id)
                ->update(['product_qty' => DB::raw('product_qty-'.$item->qty) ]);
        }

        // Update order status
        $order->update([
            'status' => 'delivered',
            'delivered_date' => Carbon::now()
        ]);

        // Mark database notifications as read for this order
        $user = Auth::user();
        if ($user) {
            foreach ($user->unreadNotifications as $notification) {
                if (isset($notification->data['order_id']) && $notification->data['order_id'] == $order_id) {
                    $notification->markAsRead();
                }
            }
        }

        $notification = array(
            'message' => 'Delivery Confirmed Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('user.order.page')->with($notification); 
    }

    public function markNotificationAsRead($id) {
        $notification = Auth::user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return response()->json(['success' => true]);
    }
}
