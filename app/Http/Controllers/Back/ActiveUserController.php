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

        // Dynamically calculate and save recognition tier based on actual spent amount on all orders
        $totalSpent = (float)\App\Models\Order::where('user_id', $id)->sum('amount');
        $tiers = \App\Models\RecognitionTier::orderBy('min_spent', 'desc')->get();

        $new_tier = 'Regular Customer';
        foreach ($tiers as $t) {
            if ($totalSpent >= (float)$t->min_spent) {
                $new_tier = $t->name;
                break;
            }
        }

        if ($user->recognition_tier !== $new_tier) {
            $user->recognition_tier = $new_tier;
            $user->save();
        }

        return view('back.admin.user.user_detail', compact('user', 'totalOrders', 'pendingOrders', 'completedOrders'));
    } // End Method

    public function all_affiliates(){
        $affiliates = User::where('role', 'user')
            ->whereNotNull('referral_code')
            ->orderBy('referral_balance', 'desc')
            ->get();
        return view('back.admin.user.affiliate_all_data', compact('affiliates'));
    }
}
