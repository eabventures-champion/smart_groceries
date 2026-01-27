<?php

namespace App\Http\Controllers\Front;

use App\Models\DeliveryCity;
use Illuminate\Http\Request;
use App\Models\DeliveryDistrict;
use App\Http\Controllers\Controller;
use App\Models\DeliveryRegion;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckOutController extends Controller
{
    public function institution_get_ajax($region_id){
        $delivery = DeliveryDistrict::where('region_id', $region_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($delivery);
    } // End Method 

    public function hall_get_ajax($institution_id){
        $delivery = DeliveryCity::where('district_id', $institution_id)->orderBy('city', 'ASC')->get(); 
        return json_encode($delivery);
    }

    public function check_out_store(Request $request){

        $data = array();
        $data['delivery_name'] = $request->delivery_name;
        $data['delivery_email'] = $request->delivery_email;
        $data['delivery_phone'] = $request->delivery_phone;
        // $data['post_code'] = $request->post_code; 

        $region_id = $request->region_id;
        $district_id = $request->district_id;
        $city_id = $request->city_id;
        
        $get_region = DeliveryRegion::where('id', $region_id)->first()->toArray();
        $get_district = DeliveryDistrict::where('id', $district_id)->first()->toArray();
        $get_city = DeliveryCity::where('id', $city_id)->first()->toArray();
        // dd($get_city['city']);

        $data['region'] = $get_region['region_name'];
        $data['district'] = $get_district['district_name'];
        $data['city'] = $get_city['city'];

        $data['region_id'] = $request->region_id;
        $data['district_id'] = $request->district_id;
        $data['city_id'] = $request->city_id;

        $data['delivery_address'] = $request->delivery_address;
        $data['notes'] = $request->notes; 
        $cartTotal = Cart::total();

        return view('front.payment.cash', compact('data','cartTotal'));

        // if ($request->payment_option == 'stripe') {
        //    return view('front.payment.stripe', compact('data','cartTotal'));
           
        // }elseif ($request->payment_option == 'card'){
        //     return 'Card Page';
        // }else{
        //     return view('front.payment.cash', compact('data','cartTotal'));
        // }
    }
}
