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
        $totalOrders = Order::where('user_id', $id)->where('email', $user->email)->count();
        $pendingOrders = Order::where('user_id', $id)->where('email', $user->email)->where('status', 'pending')->count();
        $completedOrders = Order::where('user_id', $id)->where('email', $user->email)->where('status', 'delivered')->count();

        // Fetch halls if needed for the setup prompt
        $halls = [];
        if ($user->status_identity === 'student' && empty($user->hall) && $user->institution) {
            $district = \App\Models\DeliveryDistrict::where('district_name', $user->institution)->first();
            if ($district) {
                $halls = \App\Models\DeliveryCity::where('district_id', $district->id)->orderBy('city', 'ASC')->get();
            }
        }

        return view('index', compact('user', 'totalOrders', 'pendingOrders', 'completedOrders', 'halls'));
    }

    public function setup_residence(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        if ($user->resident_type === 'resident') {
            $request->validate([
                'hall' => 'required|string',
            ]);
            $user->hall = $request->hall;
        } else {
            $request->validate([
                'residence_name' => 'required|string|max:255',
            ]);
            $user->hall = $request->residence_name;
        }

        $user->save();

        $notification = [
            'message' => 'Residence details saved successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function user_profile_update(Request $request){
        $id = Auth::user()->id;

        if ($request->has('phone') && !empty($request->phone)) {
            $existingUser = User::where('phone', $request->phone)->where('id', '!=', $id)->first();
            if ($existingUser) {
                $notification = array(
                    'message' => 'This phone number is already registered by another user.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification)->withInput();
            }
        }

        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->has('institution')) {
            $data->institution = $request->institution;
        }
        if ($request->has('resident_type')) {
            $data->resident_type = $request->resident_type;
        }
        if ($request->has('hall')) {
            $data->hall = $request->hall;
        } elseif ($request->has('residence_name')) {
            $data->hall = $request->residence_name;
        }

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

        if ($request->is_modal == 1) {
            session()->flash('welcome_notice', true);
            $notification = array(
                'message' => 'Welcome to your Dashboard!',
                'alert-type' => 'success'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function check_phone_unique(Request $request) {
        $phone = $request->phone;
        $id = Auth::check() ? Auth::user()->id : null;
        
        $exists = User::where('phone', $phone);
        if ($id) {
            $exists->where('id', '!=', $id);
        }
        $exists = $exists->exists();
        return response()->json(['unique' => !$exists]);
    }

    public function update_chat_analytics(Request $request) {
        $type = $request->input('type');
        $sessionId = session()->getId();
        
        if ($type === 'started') {
            \Illuminate\Support\Facades\DB::table('chat_visitor_logs')
                ->where('session_id', $sessionId)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->update([
                    'chat_started' => true,
                    'updated_at' => now()
                ]);
        } elseif ($type === 'answered') {
            $visitorIp = $request->input('ip');
            \Illuminate\Support\Facades\DB::table('chat_visitor_logs')
                ->where('chat_started', true)
                ->where('chat_answered', false)
                ->where(function($query) use ($visitorIp) {
                    if ($visitorIp) {
                        $query->where('ip_address', $visitorIp);
                    }
                })
                ->orderBy('id', 'desc')
                ->limit(1)
                ->update([
                    'chat_answered' => true,
                    'updated_at' => now()
                ]);
        }
        
        return response()->json(['success' => true]);
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
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->where('email', $user->email)
            ->orderBy('id','DESC')
            ->get();

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

        $institutions = \App\Models\DeliveryDistrict::where('district_name', '!=', '.select institution')->orderBy('district_name', 'ASC')->get();
        $halls = [];
        if ($userData->institution) {
            $district = \App\Models\DeliveryDistrict::where('district_name', $userData->institution)->first();
            if ($district) {
                $halls = \App\Models\DeliveryCity::where('district_id', $district->id)->orderBy('city', 'ASC')->get();
            }
        }

        return view('front.user.account_details', compact('userData', 'institutions', 'halls'));
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
