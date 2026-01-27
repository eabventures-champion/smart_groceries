<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RegisterUserNotification;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function index(){
        return view('front.index');
    }

    public function about_us(){
        return view('front.information.about_us');
    }
    public function privacy_policy(){
        return view('front.information.privacy_policy');
    }
    public function terms_conditions(){
        return view('front.information.terms_conditions');
    }

    public function product_details($id, $slug){
        $product = Product::with([
            'attributes' => function($query){
                $query->where('stock', '>', 0)->where('status', 1);
            }
        ])->find($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $multiImage = MultiImage::where('product_id', $id)->get();
        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();

        $total_stock = ProductAttribute::where('product_id', $id)->sum('stock');

        return view('front.product.product_details', compact('product', 'cat_id', 'product_color', 'product_size', 'multiImage', 'relatedProduct', 'total_stock'));
    }

    public function get_product_price(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $get_attribute = Product::get_attribute($data['product_id'], $data['size']);
            return $get_attribute;
        }
    }

    public function cat_wise_product($id, $slug){
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->paginate(10);
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $breadcat = Category::where('id', $id)->first();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('front.product.category_view', compact('products', 'categories', 'breadcat', 'newProduct'));
    }

    public function sub_cat_wise_product($id, $slug){
        $products = Product::where('status', 1)->where('subcategory_id',$id)->orderBy('id','DESC')->paginate(10);
        $categories = Category::orderBy('category_name','ASC')->get();
        $breadsubcat = SubCategory::where('id',$id)->first();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

        return view('front.product.subcategory_view', compact('products', 'categories', 'breadsubcat', 'newProduct'));
    }

    public function product_view_ajax($id){
        $product = Product::with(
            [
                'category',
                'brand',
                'attributes' => function($query){
                    $query->where('stock', '>', 0)->where('status', 1);
                }
            ]
        )->findOrFail($id);

        $total_stock = ProductAttribute::where('product_id', $id)->sum('stock');

        $amount = (100 - $product->discount_price)/100;
        $new_price = $amount * $product->selling_price;

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $product_attribute = $product->attributes;

        return response()->json(array(
         'new_price' => $new_price,
         'total_stock' => $total_stock,
         'product' => $product,
         'color' => $product_color,
         'product_attribute' => $product_attribute,
        ));
    }

    public function product_search(Request $request){
        $request->validate(['search' => "required"]);

        $item = $request->search;
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $products = Product::where('product_name', 'LIKE', "%$item%")->get();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
        return view('front.product.search', compact('products', 'item', 'categories', 'newProduct'));
    }

    public function search_product(Request $request){
         $request->validate(['search' => "required"]);
         $item = $request->search;
         $products = Product::where('product_name', 'LIKE', "%$item%")->select('product_name', 'product_slug', 'product_thumbnail', 'selling_price', 'id')->limit(6)->get();

         return view('front.product.search_product', compact('products'));
    }

    public function confirm_user_account($code){
        $email = base64_decode($code);

        $new_user = User::where('role', 'admin')->get();

        $user_count_email = User::where('email', $email)->count();

        if($user_count_email > 0){
            $user_details = User::where('email', $email)->first();
            $user_details->status;
            if($user_details->status == "active"){
                $notification = array(
                    'message' => 'Your account is already activated. You can login',
                    'alert-type' => 'info'
                );

                return redirect()->route('login')->with($notification);

            }else{
                User::where('email', $email)->update(['status' => "active"]);

                // Send Welcome email
                $messageData = [
                    'email' => $email,
                    'name' => $user_details->name,
                ];

                Mail::send('emails.user_confirmed', $messageData, function($message)use($email){
                $message->to($email)->subject('Welcome!, Your account is activated');
                });

                $notification = array(
                    'message' => 'Your account is now activated, you can login now',
                    'alert-type' => 'info'
                );

                return redirect()->route('login')->with($notification);
            }
            // Notification::send($new_user, new RegisterUserNotification($request));
        }
        else{
            abort(404);
        }

    }
}
