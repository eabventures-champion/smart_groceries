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

        if ($request->file('logo')) {

        $image = $request->file('logo');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(180,56)->save('back/assets/images/logo/'.$name_gen);
        $save_url = 'back/assets/images/logo/'.$name_gen;


        SiteSetting::findOrFail($setting_id)->update([
            'support_phone' => $request->support_phone,
            'phone_one' => $request->phone_one,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'copyright' => $request->copyright, 
            'logo' => $save_url, 
            'referral_commission_type' => $request->referral_commission_type,
            'referral_flat_amount' => $request->referral_flat_amount,
            'referral_percentage' => $request->referral_percentage,
        ]);

       $notification = array(
            'message' => 'Site Setting Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

        } else {

            SiteSetting::findOrFail($setting_id)->update([
            'support_phone' => $request->support_phone,
            'phone_one' => $request->phone_one,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'copyright' => $request->copyright, 
            'referral_commission_type' => $request->referral_commission_type,
            'referral_flat_amount' => $request->referral_flat_amount,
            'referral_percentage' => $request->referral_percentage,
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
