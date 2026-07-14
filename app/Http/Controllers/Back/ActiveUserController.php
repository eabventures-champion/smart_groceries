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
        
        if (\Illuminate\Support\Facades\Schema::hasTable('recognition_tiers')) {
            $tiers = \App\Models\RecognitionTier::orderBy('min_spent', 'desc')->get();
        } else {
            $tiers = collect([
                (object)['name' => 'VIP Platinum', 'min_spent' => 500.00, 'discount_percent' => 20.00, 'badge_style' => 'warning'],
                (object)['name' => 'Gold Tier', 'min_spent' => 300.00, 'discount_percent' => 10.00, 'badge_style' => 'secondary'],
                (object)['name' => 'Silver Tier', 'min_spent' => 100.00, 'discount_percent' => 5.00, 'badge_style' => 'light'],
            ]);
        }

        $new_tier = 'Regular Customer';
        foreach ($tiers as $t) {
            if ($totalSpent >= (float)$t->min_spent) {
                $new_tier = $t->name;
                break;
            }
        }

        if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'recognition_tier')) {
            if ($user->recognition_tier !== $new_tier) {
                $user->recognition_tier = $new_tier;
                $user->save();
            }
        }

        $orders = \App\Models\Order::with('orderItems.product')
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('back.admin.user.user_detail', compact('user', 'totalOrders', 'pendingOrders', 'completedOrders', 'orders'));
    } // End Method

    public function all_affiliates(){
        $affiliates = User::where('role', 'user')
            ->whereNotNull('referral_code')
            ->orderBy('id', 'desc')
            ->get();
        return view('back.admin.user.affiliate_all_data', compact('affiliates'));
    }

    public function get_referral_details($id){
        $referredUsers = User::where('referred_by', $id)
            ->select('id', 'name', 'email', 'phone', 'status', 'created_at')
            ->orderBy('id', 'desc')
            ->get();
            
        $referredUsers->transform(function($user) {
            $user->date_joined = $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('M d, Y h:i A') : 'N/A';
            $user->has_ordered = \App\Models\Order::where('user_id', $user->id)
                ->whereIn('status', ['confirmed', 'processing', 'delivering', 'delivered'])
                ->exists();
            return $user;
        });

        return response()->json($referredUsers);
    }

    public function all_payouts(){
        $payoutUsers = User::whereHas('affiliatePayouts')
            ->withCount(['affiliatePayouts as total_requests'])
            ->withCount(['affiliatePayouts as pending_requests' => function($query) {
                $query->where('status', 'pending');
            }])
            ->get()
            ->map(function($user) {
                $user->total_amount = \App\Models\AffiliatePayout::where('user_id', $user->id)->sum('amount');
                $user->pending_amount = \App\Models\AffiliatePayout::where('user_id', $user->id)->where('status', 'pending')->sum('amount');
                return $user;
            });
            
        return view('back.admin.user.affiliate_payouts', compact('payoutUsers'));
    }

    public function get_user_payouts($id){
        $payouts = \App\Models\AffiliatePayout::where('user_id', $id)
            ->orderBy('id', 'desc')
            ->get();
            
        $payouts->transform(function($p) {
            $p->date_requested = $p->created_at ? \Carbon\Carbon::parse($p->created_at)->format('d M Y, h:i A') : 'N/A';
            return $p;
        });
        
        return response()->json($payouts);
    }

    public function approve_payout($id){
        $payout = \App\Models\AffiliatePayout::findOrFail($id);
        $payout->status = 'completed';
        $payout->save();

        $notification = array(
            'message' => 'Payout request approved successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function reject_payout($id){
        $payout = \App\Models\AffiliatePayout::findOrFail($id);
        $payout->status = 'rejected';
        $payout->save();

        // Refund the user's referral balance
        $user = $payout->user;
        $user->referral_balance += $payout->amount;
        $user->save();

        $notification = array(
            'message' => 'Payout request rejected and amount refunded successfully.',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function payout_receipt($id){
        $payout = \App\Models\AffiliatePayout::with('user')->findOrFail($id);

        if (\Illuminate\Support\Facades\Auth::user()->role !== 'admin' && $payout->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('back.admin.user.payout_receipt', compact('payout'));
    }

    public function admin_live_chat(){
        return view('back.admin.support_chat');
    }
}
