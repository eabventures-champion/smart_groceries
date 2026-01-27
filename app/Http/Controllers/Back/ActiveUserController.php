<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveUserController extends Controller
{
    public function all_user(){
        $users = User::where(['role' => 'user', 'status' => 'active'])->latest()->get();
        return view('back.admin.user.user_all_data', compact('users'));

    } // End Mehtod 

    // public function all_vendor(){
    //     $vendors = User::where('role','vendor')->latest()->get();
    //     return view('backend.user.vendor_all_data',compact('vendors'));

    // }
}
