<?php

namespace App\Http\Controllers\Back;

use Image;
use App\Models\Seo;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingController extends Controller
{
    public function site_setting(){
        $setting = SiteSetting::find(1);
        return view('back.admin.setting.setting_update', compact('setting'));
    } // End Method 


    public function site_setting_update(Request $request){

        $setting_id = $request->id; 
        $setting = SiteSetting::findOrFail($setting_id);

        $deliveryDays = $request->has('delivery_days') ? implode(',', (array)$request->delivery_days) : ($setting->delivery_days ?? '1,4,6');
        $deliveryCutoffTime = $request->delivery_cutoff_time ?? ($setting->delivery_cutoff_time ?? '11:00');

        if ($request->file('logo')) {

        $image = $request->file('logo');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(180,56)->save('back/assets/images/logo/'.$name_gen);
        $save_url = 'back/assets/images/logo/'.$name_gen;


        $setting->update([
            'support_phone' => $request->support_phone,
            'phone_one' => $request->phone_one,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'copyright' => $request->copyright, 
            'logo' => $save_url, 
            'enable_affiliate_program' => isset($request->enable_affiliate_program) ? (int)$request->enable_affiliate_program : 1,
            'show_status_identity' => isset($request->show_status_identity) ? (int)$request->show_status_identity : 1,
            'show_status_student' => $request->has('show_status_student') ? 1 : 0,
            'show_status_non_student' => $request->has('show_status_non_student') ? 1 : 0,
            'show_status_partner' => $request->has('show_status_partner') ? 1 : 0,
            'referral_commission_type' => $request->referral_commission_type ?? ($setting->referral_commission_type ?? 'tiered'),
            'referral_flat_amount' => $request->referral_flat_amount ?? ($setting->referral_flat_amount ?? 15.00),
            'referral_percentage' => $request->referral_percentage ?? ($setting->referral_percentage ?? 10.00),
            'referral_tier1_amount' => $request->referral_tier1_amount ?? ($setting->referral_tier1_amount ?? 3.00),
            'referral_tier2_amount' => $request->referral_tier2_amount ?? ($setting->referral_tier2_amount ?? 4.00),
            'referral_tier3_amount' => $request->referral_tier3_amount ?? ($setting->referral_tier3_amount ?? 5.00),
            'partner_referral_amount' => $request->partner_referral_amount ?? ($setting->partner_referral_amount ?? 3.00),
            'student_flat_fee' => $request->student_flat_fee,
            'student_percent_fee' => $request->student_percent_fee,
            'non_student_flat_fee' => $request->non_student_flat_fee,
            'non_student_percent_fee' => $request->non_student_percent_fee,
            'min_order_amount' => $request->min_order_amount ?? ($setting->min_order_amount ?? 50.00),
            'recognition_platinum_min' => $request->recognition_platinum_min ?? ($setting->recognition_platinum_min ?? 500.00),
            'recognition_gold_min' => $request->recognition_gold_min ?? ($setting->recognition_gold_min ?? 300.00),
            'recognition_silver_min' => $request->recognition_silver_min ?? ($setting->recognition_silver_min ?? 100.00),
            'delivery_days' => $deliveryDays,
            'delivery_cutoff_time' => $deliveryCutoffTime,
        ]);

        $notification = array(
             'message' => 'Site Setting Updated with image Successfully',
             'alert-type' => 'success'
         );

          return redirect()->back()->with($notification); 

        } else {

            $setting->update([
            'support_phone' => $request->support_phone,
            'phone_one' => $request->phone_one,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'copyright' => $request->copyright, 
            'enable_affiliate_program' => isset($request->enable_affiliate_program) ? (int)$request->enable_affiliate_program : 1,
            'show_status_identity' => isset($request->show_status_identity) ? (int)$request->show_status_identity : 1,
            'show_status_student' => $request->has('show_status_student') ? 1 : 0,
            'show_status_non_student' => $request->has('show_status_non_student') ? 1 : 0,
            'show_status_partner' => $request->has('show_status_partner') ? 1 : 0,
            'referral_commission_type' => $request->referral_commission_type ?? ($setting->referral_commission_type ?? 'tiered'),
            'referral_flat_amount' => $request->referral_flat_amount ?? ($setting->referral_flat_amount ?? 15.00),
            'referral_percentage' => $request->referral_percentage ?? ($setting->referral_percentage ?? 10.00),
            'referral_tier1_amount' => $request->referral_tier1_amount ?? ($setting->referral_tier1_amount ?? 3.00),
            'referral_tier2_amount' => $request->referral_tier2_amount ?? ($setting->referral_tier2_amount ?? 4.00),
            'referral_tier3_amount' => $request->referral_tier3_amount ?? ($setting->referral_tier3_amount ?? 5.00),
            'partner_referral_amount' => $request->partner_referral_amount ?? ($setting->partner_referral_amount ?? 3.00),
            'student_flat_fee' => $request->student_flat_fee,
            'student_percent_fee' => $request->student_percent_fee,
            'non_student_flat_fee' => $request->non_student_flat_fee,
            'non_student_percent_fee' => $request->non_student_percent_fee,
            'min_order_amount' => $request->min_order_amount ?? ($setting->min_order_amount ?? 50.00),
            'recognition_platinum_min' => $request->recognition_platinum_min ?? ($setting->recognition_platinum_min ?? 500.00),
            'recognition_gold_min' => $request->recognition_gold_min ?? ($setting->recognition_gold_min ?? 300.00),
            'recognition_silver_min' => $request->recognition_silver_min ?? ($setting->recognition_silver_min ?? 100.00),
            'delivery_days' => $deliveryDays,
            'delivery_cutoff_time' => $deliveryCutoffTime,
        ]);

       $notification = array(
            'message' => 'Site Setting Updated without image Successfully',
            'alert-type' => 'success'
        );

         return redirect()->back()->with($notification); 

        } // end else

    }// End Method 

    public function seo_setting(){

        $seo = Seo::find(1);
        return view('back.admin.seo.seo_update', compact('seo'));

    } // End Method 

    public function seo_setting_update(Request $request){
        $seo_id = $request->id;

        Seo::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description, 
        ]);

       $notification = array(
            'message' => 'Seo Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);  
    }
}
