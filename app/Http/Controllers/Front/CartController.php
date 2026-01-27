<?php

namespace App\Http\Controllers\Front;

use Auth;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\DeliveryRegion;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

// https://www.youtube.com/watch?v=Jzi6aLKVw-A - shop cart


// https://www.youtube.com/watch?v=K72P3MzUUrg - drop shipping
// https://www.youtube.com/watch?v=wsupRo8x3Oc
// https://www.youtube.com/watch?v=Le9DP46x7pY

class CartController extends Controller
{
    public function add_to_cart(Request $request, $id){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        $get_product_stock = ProductAttribute::get_product_stock($id, $data['size']);
        if( $data['quantity'] > $get_product_stock){
            return response()->json(['error' => 'Requested quantity not available']); 
        }

        $size = $request->size;
        $product_attribute_price = ProductAttribute::where(['product_id' => $id, 'size' => $size])->first()->toArray();
        $price = $product_attribute_price['price'];

        $productDetails = Product::select('discount_price')->where('id', $id)->first();
        $productDetails = json_decode(json_encode($productDetails), true);

        $value = (100 - $productDetails['discount_price'])/100;
        $final_price = $value * $product_attribute_price['price'];
        
        $product = Product::findOrFail($id);

        // $carts = Cart::content()->groupBy('rowId');
        // dd($carts);

        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            if($cartItem->id === $request->id && 
               $cartItem->options->size === $request->size && 
               $cartItem->options->color === $request->color){
                return true;
            }
        });

        if($duplicates->isNotEmpty()){
            return response()->json(['error' => 'Product already in the Cart!']); 
        }

        if ($product->discount_price == NULL) {
            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $price,
                // 'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

        return response()->json(['success' => 'Successfully Added on Your Cart' ]);

        }else{

            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $final_price,
                // 'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

        return response()->json(['success' => 'Successfully Added on Your Cart' ]);

        }
    }

    public function add_mini_cart(){
        $carts = Cart::content();
        $cartItems = Cart::content()->count();
        $cartQty = Cart::count();
        // dd($cartQty);
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartItems' => $cartItems,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal
        ));
    }

    public function remove_mini_cart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Removed From Cart']);
    }

    public function add_to_cart_details(Request $request, $id){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;

        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        
        $get_product_stock = ProductAttribute::get_product_stock($id, $data['size']);
        if( $data['quantity'] > $get_product_stock){
            return response()->json(['error' => 'Requested quantity not available']); 
        }
        
        $size = $request->size;
        $product_attribute_price = ProductAttribute::where(['product_id' => $id, 'size' => $size])->first()->toArray();
        $price = $product_attribute_price['price'];

        $productDetails = Product::select('discount_price')->where('id', $id)->first();
        $productDetails = json_decode(json_encode($productDetails), true);

        $value = (100 - $productDetails['discount_price'])/100;
        $final_price = $value * $product_attribute_price['price'];

        $product = Product::findOrFail($id);

        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            if($cartItem->id === $request->id && 
               $cartItem->options->size === $request->size && 
               $cartItem->options->color === $request->color){
                return true;
            }
        });

        if($duplicates->isNotEmpty()){
            return response()->json(['error' => 'Product already in the Cart!']); 
        }
    

        if ($product->discount_price == NULL) {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart' ]);

        }else{

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $final_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart' ]);
        } 
        
        // $carts = Cart::content()->groupBy('id', 'size');
        // echo "<pre>"; print_r($carts); die;

        
    }

    public function my_cart(){
        return view('front.mycart.view_mycart');
    }

    public function get_cart_product(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal
        ));
    }

    public function cart_remove($rowId){
        // dd($rowId);
        Cart::remove($rowId);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]); 
        }

        return response()->json(['success' => 'Successfully Remove From Cart']);
    }

    public function cart_decrement($rowId){
        $row = Cart::get($rowId);
        // dd($row);
        Cart::update($rowId, $row->qty -1);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]); 
        }

        return response()->json(['success' => 'Product quantity decreased!']);
    }

    public function cart_increment($rowId){
        $row = Cart::get($rowId);
        // dd($row->options->size);
        $check_available_stock = ProductAttribute::select('stock')->where(
            [
                'product_id' => $row->id,
                'size' => $row->options->size
            ]
        )->first()->toArray();

        if(($row->qty +1) > $check_available_stock['stock']){
            return response()->json(['error' => 'Product Stock is not available for that quantity!']);
        }else{
            Cart::update($rowId, $row->qty +1);

            if(Session::has('coupon')){
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name', $coupon_name)->first();
    
               Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name, 
                    'coupon_discount' => $coupon->coupon_discount, 
                    'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                    'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
                ]); 
            }
    
            return response()->json(['success' => 'Product quantity increased!']);
        }

        
    }

    public function cart_empty(){
        Cart::destroy();

        $notification = array(
            'message' => 'Cart items removed successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('mycart')->with($notification);
    }

    public function coupon_apply(Request $request){
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
            ]);

            return response()->json(array(
                'validity' => true,                
                'success' => 'Coupon Applied Successfully'

            ));
        } else{
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function coupon_calculation(){
        if (Session::has('coupon')) {

            return response()->json(array(
             'subtotal' => Cart::total(),
             'coupon_name' => session()->get('coupon')['coupon_name'],
             'coupon_discount' => session()->get('coupon')['coupon_discount'],
             'discount_amount' => session()->get('coupon')['discount_amount'],
             'total_amount' => session()->get('coupon')['total_amount'], 
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        } 
    }

    public function coupon_remove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully']);
    }

    public function checkout_create(){
        if (Auth::check()) {

                if (Cart::total() > 0) { 

                    $carts = Cart::content();
                    // $carts = Cart::content()->groupBy('id', 'size');
                    // dd($carts);
                    // echo "<pre>"; print_r($carts); die;
                    $cartQty = Cart::count();
                    $cartTotal = Cart::total();

                    $regions = DeliveryRegion::orderBy('region_name', 'ASC')->get();

                    return view('front.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'regions'));


                }else{

                    $notification = array(
                    'message' => 'Shop at least one Product',
                    'alert-type' => 'error'
                    );

                    return redirect()->to('/')->with($notification); 
                }

        }else{

            $notification = array(
            'message' => 'You Need to Login First',
            'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification); 
        }
    }
}
