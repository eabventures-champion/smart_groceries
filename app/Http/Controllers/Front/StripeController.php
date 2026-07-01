<?php

namespace App\Http\Controllers\Front;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Notification;
use Unicodeveloper\Paystack\Paystack;

class StripeController extends Controller
{

    public $paystack;

    public function __construct()
    {
        $this->paystack = new Paystack();
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = $this->paystack->getPaymentData();
        // dd($paymentDetails);

        if ($paymentDetails['status']) {
            $user = User::where('role', 'admin')->get();

            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'];
            } else {
                $total_amount = round((float)str_replace(',', '', Cart::total()), 2);
            }

            $isStudent = false;
            $orderUser = User::find(Auth::id());
            if ($orderUser) {
                $isStudent = $orderUser->status_identity === 'student';
            }
            $deliveryFee = \App\Models\SiteSetting::calculateDeliveryFee($total_amount, $isStudent);
            $final_amount = $total_amount + $deliveryFee;

            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'region_id' => $paymentDetails['data']['metadata']['region_id'],
                'district_id' => $paymentDetails['data']['metadata']['district_id'],
                'city_id' => $paymentDetails['data']['metadata']['city_id'],
                'name' => $paymentDetails['data']['metadata']['name'],
                'email' => $paymentDetails['data']['metadata']['email'],
                'phone' => $paymentDetails['data']['metadata']['phone'],
                'adress' => $paymentDetails['data']['metadata']['address'],
                'transaction_id' => $paymentDetails['data']['reference'],
                'post_code' => 'null',
                'notes' => $paymentDetails['data']['metadata']['notes'],

                'payment_type' => 'Mobile money',
                'payment_method' => 'Mobile money',

                'currency' => $paymentDetails['data']['currency'],
                'amount' => $final_amount,
                'order_number' => $paymentDetails['data']['receipt_number'],

                'invoice_no' => 'SMART' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'pending',
                'created_at' => Carbon::now(),
            ]);

            $invoice = Order::findOrFail($order_id);

            // Notify all admins of the new order
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new \App\Notifications\AdminNewOrderNotification($invoice));
            }

            // Process affiliate referral commission if set to percentage
            $setting = \App\Models\SiteSetting::find(1);
            if ($setting && $setting->referral_commission_type === 'percentage') {
                $userId = Auth::id();
                if ($userId) {
                    $orderUser = User::find($userId);
                    if ($orderUser && $orderUser->referred_by) {
                        // Check if they already have any logged referral commission
                        $alreadyEarned = \App\Models\AffiliateReferral::where('referred_id', $orderUser->id)->exists();
                        if (!$alreadyEarned) {
                            $percentage = $setting->referral_percentage ?? 10.00;
                            $commission = ($total_amount * $percentage) / 100;

                            // Create the referral commission record
                            \App\Models\AffiliateReferral::create([
                                'referrer_id' => $orderUser->referred_by,
                                'referred_id' => $orderUser->id,
                                'commission_earned' => $commission
                            ]);

                            // Add commission to referrer's balance
                            $referrer = User::find($orderUser->referred_by);
                            if ($referrer) {
                                $referrer->referral_balance += $commission;
                                $referrer->save();
                            }
                        }
                    }
                }
            }

            $user_email = $paymentDetails['data']['metadata']['email'];

            $data = [
                'invoice_no' => $invoice->invoice_no,
                'amount' => $final_amount,
                'name' => $invoice->name,
                'email' => $invoice->email,
            ];

            Mail::to($user_email)->send(new OrderMail($data));

            $carts = Cart::content();

            foreach ($carts as $cart) {

                $order_item = new OrderItem;

                $order_item->order_id = $order_id;
                $order_item->product_id = $cart->id;
                $product_id = $order_item->product_id;
                $order_item->vendor_id = $cart->options->vendor;
                $order_item->color = $cart->options->color;
                $order_item->size = $cart->options->size;
                $product_size = $order_item->size;
                $order_item->qty = $cart->qty;
                $product_qty = $order_item->qty;
                $order_item->price = $cart->price;
                $order_item->created_at = Carbon::now();
                $order_item->save();

                $get_product_stock = ProductAttribute::get_product_stock($product_id, $product_size);
                $new_product_stock = $get_product_stock - $product_qty;
                ProductAttribute::where(['product_id' => $product_id, 'size' => $product_size])->update(['stock' => $new_product_stock]);
            }

            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            Cart::destroy();

            $notification = array(
                'message' => 'Your Order Placed Successfully',
                'alert-type' => 'info'
            );

            $user_name = $paymentDetails['data']['metadata']['name'];

            Notification::send($user, new OrderComplete($user_name));
            return redirect()->route('user.order.page')->with($notification);

        } else {

            $notification = array(
                'message' => 'Something went wrong. Please try again',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function store_order(Request $request)
    {
        // $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        $metadata = json_encode(
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'price' => $request->amount,
                'institution_region' => $request->institution_region,
                'institution' => $request->institution,
                'hall' => $request->hall,
                'address' => $request->address,
                'region_id' => $request->region_id,
                'district_id' => $request->district_id,
                'city_id' => $request->city_id,
                'notes' => $request->notes,
            ]
        );

        $data = array(
            'metadata' => $metadata,
            'email' => $request->email,
            'amount' => (int)round($request->amount * 100),
            'reference' => $this->paystack->genTranxRef(),
            'currency' => "GHS",
            'callback_url' => url('/payment/callback'),
        );

        return $this->paystack->getAuthorizationUrl($data)->redirectNow();
    }

    // public function stripe_order(Request $request){

    //     if(Session::has('coupon')){
    //         $total_amount = Session::get('coupon')['total_amount'];
    //     }else{
    //         $total_amount = round(Cart::total());
    //     }

    //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    //     $token = $_POST['stripeToken'];

    //     $charge = \Stripe\Charge::create([
    //       'amount' => $total_amount*100,
    //       'currency' => 'usd',
    //       'description' => 'CBI',
    //       'source' => $token,
    //       'metadata' => ['order_id' => uniqid()],
    //     ]);

    //     // dd($charge);

    //     $order_id = Order::insertGetId([
    //         'user_id' => Auth::id(),
    //         'region_id' => $request->region_id,
    //         'district_id' => $request->district_id,
    //         'city_id' => $request->city_id,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'adress' => $request->address,
    //         'post_code' => $request->post_code,
    //         'notes' => $request->notes,

    //         'payment_type' => $charge->payment_method,
    //         'payment_method' => 'Stripe',
    //         'transaction_id' => $charge->balance_transaction,
    //         'currency' => $charge->currency,
    //         'amount' => $total_amount,
    //         'order_number' => $charge->metadata->order_id,

    //         'invoice_no' => 'CBI'.mt_rand(10000000,99999999),
    //         'order_date' => Carbon::now()->format('d F Y'),
    //         'order_month' => Carbon::now()->format('F'),
    //         'order_year' => Carbon::now()->format('Y'),
    //         'status' => 'pending',
    //         'created_at' => Carbon::now(),
    //     ]);

    //     // Start Send Email
    //     $invoice = Order::findOrFail($order_id);
    //     $data = [
    //         'invoice_no' => $invoice->invoice_no,
    //         'amount' => $total_amount,
    //         'name' => $invoice->name,
    //         'email' => $invoice->email,
    //     ];

    //     Mail::to($request->email)->send(new OrderMail($data));

    //     // End Send Email

    //     $carts = Cart::content();
    //     foreach($carts as $cart){

    //         OrderItem::insert([
    //             'order_id' => $order_id,
    //             'product_id' => $cart->id,
    //             'vendor_id' => $cart->options->vendor,
    //             'color' => $cart->options->color,
    //             'size' => $cart->options->size,
    //             'qty' => $cart->qty,
    //             'price' => $cart->price,
    //             'created_at' => Carbon::now(),
    //         ]);
    //     } // End Foreach

    //     if (Session::has('coupon')) {
    //        Session::forget('coupon');
    //     }

    //     Cart::destroy();

    //     $notification = array(
    //         'message' => 'Your Order Place Successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('user.order.page')->with($notification);
    // }

    // public function cash_order(Request $request){
    //     $user = User::where('role', 'admin')->get();

    //     if(Session::has('coupon')){
    //         $total_amount = Session::get('coupon')['total_amount'];
    //     }else{
    //         $total_amount = round(Cart::total());
    //     }

    //     $order_id = Order::insertGetId([
    //         'user_id' => Auth::id(),
    //         'region_id' => $request->region_id,
    //         'district_id' => $request->district_id,
    //         'city_id' => $request->city_id,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'adress' => $request->address,
    //         'post_code' => $request->post_code,
    //         'notes' => $request->notes,

    //         'payment_type' => 'Cash On Delivery',
    //         'payment_method' => 'Cash On Delivery',

    //         'currency' => 'Usd',
    //         'amount' => $total_amount,

    //         'invoice_no' => 'CBI'.mt_rand(10000000,99999999),
    //         'order_date' => Carbon::now()->format('d F Y'),
    //         'order_month' => Carbon::now()->format('F'),
    //         'order_year' => Carbon::now()->format('Y'),
    //         'status' => 'pending',
    //         'created_at' => Carbon::now(),
    //     ]);

    //     // Start Send Email
    //     $invoice = Order::findOrFail($order_id);
    //     $data = [
    //         'invoice_no' => $invoice->invoice_no,
    //         'amount' => $total_amount,
    //         'name' => $invoice->name,
    //         'email' => $invoice->email,
    //     ];

    //     Mail::to($request->email)->send(new OrderMail($data));
    //     // End Send Email

    //     $carts = Cart::content();

    //     foreach($carts as $cart){
    //         // OrderItem::insert([
    //         //     'order_id' => $order_id,
    //         //     'product_id' => $cart->id,
    //         //     'vendor_id' => $cart->options->vendor,
    //         //     'color' => $cart->options->color,
    //         //     'size' => $cart->options->size,
    //         //     'qty' => $cart->qty,
    //         //     'price' => $cart->price,
    //         //     'created_at' => Carbon::now(),
    //         // ]);
    //         $order_item = new OrderItem;
    //         $order_item->order_id = $order_id;

    //         $order_item->product_id = $cart->id;
    //         $product_id = $order_item->product_id;

    //         $order_item->vendor_id = $cart->options->vendor;
    //         $order_item->color = $cart->options->color;

    //         $order_item->size = $cart->options->size;
    //         $product_size = $order_item->size;

    //         $order_item->qty = $cart->qty;
    //         $product_qty = $order_item->qty;


    //         $order_item->price = $cart->price;
    //         $order_item->created_at = Carbon::now();
    //         $order_item->save();


    //         $get_product_stock = ProductAttribute::get_product_stock($product_id, $product_size);
    //         $new_product_stock = $get_product_stock - $product_qty;
    //         ProductAttribute::where(['product_id'=> $product_id, 'size' => $product_size])->update(['stock' => $new_product_stock]);
    //     } // End Foreach

    //     if (Session::has('coupon')) {
    //        Session::forget('coupon');
    //     }

    //     Cart::destroy();

    //     $notification = array(
    //         'message' => 'Your Order Placed Successfully',
    //         'alert-type' => 'success'
    //     );

    //     Notification::send($user, new OrderComplete($request->name));
    //     return redirect()->route('user.order.page')->with($notification);
    // }


}
