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

    public function client_detail($id){
        $user = User::findOrFail($id);
        
        // Auto-refresh student ID prefix if status changed (STU ↔ ALM)
        $user->refreshStudentId();

        // Get order stats for dashboard
        $totalOrders = \App\Models\Order::where('user_id', $id)->count();
        $pendingOrders = \App\Models\Order::where('user_id', $id)->where('status', 'pending')->count();
        $completedOrders = \App\Models\Order::where('user_id', $id)->where('status', 'deliverd')->count();

        return view('back.admin.user.user_detail', compact('user', 'totalOrders', 'pendingOrders', 'completedOrders'));
    } // End Method

    public function all_affiliates(){
        $affiliates = User::where('role', 'user')
            ->whereNotNull('referral_code')
            ->orderBy('referral_balance', 'desc')
            ->get();
        return view('back.admin.user.affiliate_all_data', compact('affiliates'));
    }

    // public function all_vendor(){
    //     $vendors = User::where('role','vendor')->latest()->get();
    //     return view('backend.user.vendor_all_data',compact('vendors'));

    // }
}
