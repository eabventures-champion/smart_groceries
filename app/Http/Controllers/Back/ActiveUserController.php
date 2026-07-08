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
            ->orderBy('referral_balance', 'desc')
            ->get();
        return view('back.admin.user.affiliate_all_data', compact('affiliates'));
    }

    public function admin_live_chat(){
        // Query registered users counts
        $getUserStats = function($startDate, $endDate) {
            $query = \App\Models\User::query();
            if ($startDate) {
                $query->where('created_at', '>=', $startDate);
            }
            if ($endDate) {
                $query->where('created_at', '<=', $endDate);
            }
            return $query->count();
        };

        // Query visitor logs analytics
        $getVisitorStats = function($startDate, $endDate) {
            $query = \Illuminate\Support\Facades\DB::table('chat_visitor_logs');
            if ($startDate) {
                $query->where('created_at', '>=', $startDate);
            }
            if ($endDate) {
                $query->where('created_at', '<=', $endDate);
            }
            
            $totalPageViews = $query->count();
            $uniqueVisitors = $query->distinct('session_id')->count('session_id');
            
            $chatsStarted = (clone $query)->where('chat_started', true)->count();
            $chatsAnswered = (clone $query)->where('chat_answered', true)->count();
            $chatsMissed = max(0, $chatsStarted - $chatsAnswered);
            
            return [
                'page_views' => $totalPageViews,
                'unique_visitors' => $uniqueVisitors,
                'chats_answered' => $chatsAnswered,
                'chats_missed' => $chatsMissed
            ];
        };

        // Historical Chart Data generators (dates and visitor count trends)
        $getChartData = function($startDate, $endDate, $groupByFormat) {
            $results = \Illuminate\Support\Facades\DB::table('chat_visitor_logs')
                ->select(\Illuminate\Support\Facades\DB::raw("DATE_FORMAT(created_at, '$groupByFormat') as label"), \Illuminate\Support\Facades\DB::raw('count(distinct session_id) as count'))
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->groupBy('label')
                ->orderBy(\Illuminate\Support\Facades\DB::raw('MIN(created_at)'), 'asc')
                ->get();
                
            return [
                'labels' => $results->pluck('label')->toArray(),
                'data' => $results->pluck('count')->toArray(),
            ];
        };

        $timeframes = [
            'this_week' => [
                'users' => $getUserStats(now()->startOfWeek(), now()->endOfWeek()),
                'stats' => $getVisitorStats(now()->startOfWeek(), now()->endOfWeek()),
                'chart' => $getChartData(now()->startOfWeek(), now()->endOfWeek(), '%a')
            ],
            'last_week' => [
                'users' => $getUserStats(now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()),
                'stats' => $getVisitorStats(now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()),
                'chart' => $getChartData(now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek(), '%a')
            ],
            'this_month' => [
                'users' => $getUserStats(now()->startOfMonth(), now()->endOfMonth()),
                'stats' => $getVisitorStats(now()->startOfMonth(), now()->endOfMonth()),
                'chart' => $getChartData(now()->startOfMonth(), now()->endOfMonth(), '%d %b')
            ],
            'last_month' => [
                'users' => $getUserStats(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()),
                'stats' => $getVisitorStats(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()),
                'chart' => $getChartData(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth(), '%d %b')
            ],
            'last_12_months' => [
                'users' => $getUserStats(now()->subMonths(12)->startOfMonth(), now()->endOfMonth()),
                'stats' => $getVisitorStats(now()->subMonths(12)->startOfMonth(), now()->endOfMonth()),
                'chart' => $getChartData(now()->subMonths(12)->startOfMonth(), now()->endOfMonth(), '%b %Y')
            ],
        ];

        return view('back.admin.support_chat', compact('timeframes'));
    }
}
