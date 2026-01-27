<?php

namespace App\Http\Controllers\Back;

use App\Models\DeliveryCity;
use Illuminate\Http\Request;
use App\Models\DeliveryRegion;
use App\Models\DeliveryDistrict;
use App\Http\Controllers\Controller;

class DeliveryAreaController extends Controller
{
    public function all_region(){
        $region = DeliveryRegion::latest()->get();
        return view('back.admin.delivery.region.all_regions', compact('region'));
    } // End Method 

    public function add_region(){
        return view('back.admin.delivery.region.add_region');
    }// End Method 


    public function store_region(Request $request){ 

        DeliveryRegion::insert([ 
            'region_name' => $request->region_name, 
        ]);

       $notification = array(
            'message' => 'Region Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.regions')->with($notification); 
    }

    public function edit_region($id){

        $region = DeliveryRegion::findOrFail($id);
        return view('back.admin.delivery.region.edit_region',compact('region'));

    }// End Method 


     public function update_region(Request $request){

        $region_id = $request->id;

         DeliveryRegion::findOrFail($region_id)->update([
            'region_name' => $request->region_name,
        ]);

       $notification = array(
            'message' => 'Region Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.regions')->with($notification); 
    }// End Method 


    public function delete_region($id){

        DeliveryRegion::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Region Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }


    /////////////// District CRUD ///////////////

    public function all_institutions(){
        $district = DeliveryDistrict::latest()->get();
        return view('back.admin.delivery.district.all_district', compact('district'));
    } // End Method 

    public function add_institution(){
        $region = DeliveryRegion::orderBy('region_name','ASC')->get();
        return view('back.admin.delivery.district.add_district',compact('region'));
    }// End Method 


    public function store_institution(Request $request){ 

        DeliveryDistrict::insert([ 
            'region_id' => $request->region_id, 
            'district_name' => $request->district_name,
        ]);

       $notification = array(
            'message' => 'Institution Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.institutions')->with($notification); 
    }

    public function edit_institution($id){
        $region = DeliveryRegion::orderBy('region_name', 'ASC')->get();
        $district = DeliveryDistrict::findOrFail($id);

        return view('back.admin.delivery.district.edit_district', compact('district','region'));
    }// End Method 


    public function update_institution(Request $request){

        $district_id = $request->id;

         DeliveryDistrict::findOrFail($district_id)->update([
             'region_id' => $request->region_id, 
            'district_name' => $request->district_name,
        ]);

       $notification = array(
            'message' => 'Institution Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.institutions')->with($notification); 
    }// End Method 


     public function delete_institution($id){

        DeliveryDistrict::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Institution Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }



    /////////////// State CRUD ///////////////
    public function all_halls(){
        $city = DeliveryCity::latest()->get();
        return view('back.admin.delivery.city.all_cities', compact('city'));
    } // End Method 


    public function add_hall(){
        $region = DeliveryRegion::orderBy('region_name', 'ASC')->get();
        $district = DeliveryDistrict::orderBy('district_name', 'ASC')->get();

        return view('back.admin.delivery.city.add_city', compact('region', 'district'));
    }// End Method 


    public function get_institution($region_id){
        $institution = DeliveryDistrict::where('region_id', $region_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($institution);
    }

    public function store_hall(Request $request){ 

        DeliveryCity::insert([ 
            'region_id' => $request->region_id, 
            'district_id' => $request->district_id, 
            'city' => $request->city_name,
        ]);

       $notification = array(
            'message' => 'Hall Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.halls')->with($notification); 
    }

    public function edit_hall($id){
        $region = DeliveryRegion::orderBy('region_name', 'ASC')->get();
        $district = DeliveryDistrict::orderBy('district_name', 'ASC')->get();
        $city = DeliveryCity::findOrFail($id);
         return view('back.admin.delivery.city.edit_city', compact('region', 'district', 'city'));
    }// End Method 


     public function update_hall(Request $request){

        $city_id = $request->id;

         DeliveryCity::findOrFail($city_id)->update([
            'region_id' => $request->region_id, 
            'district_id' => $request->district_id, 
            'city' => $request->city_name,
        ]);

       $notification = array(
            'message' => 'Hall Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.halls')->with($notification); 


    }// End Method 

    public function delete_hall($id){

        DeliveryCity::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Hall Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }// End Method
}
