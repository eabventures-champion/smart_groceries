<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BlogPost;
use App\Models\ExpertBooking;
use App\Models\ItemRequest;
use App\Models\AffiliateReferral;
use App\Models\AffiliatePayout;
use App\Models\ExpertCategory;
use App\Models\Expert;
use App\Models\HealthTip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FloatingFeatureController extends Controller
{
    /**
     * Get all blog posts.
     */
    public function getBlogPosts()
    {
        $blogs = BlogPost::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'blogs' => $blogs
        ]);
    }

    /**
     * Submit an expert booking request.
     */
    public function bookExpert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'expert_category' => 'required|string',
            'expert_name' => 'required|string',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $booking = ExpertBooking::create([
            'user_id' => Auth::id(),
            'expert_category' => $request->expert_category,
            'expert_name' => $request->expert_name,
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your session has been successfully booked! We will follow up via email.',
            'booking' => $booking
        ]);
    }

    /**
     * Submit a custom product request.
     */
    public function submitItemRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'special_note' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $itemRequest = ItemRequest::create([
            'user_id' => Auth::id(),
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'special_note' => $request->special_note,
            'status' => 'submitted',
        ]);

        // If guest, save request ID to session so they can track it during their visit
        if (!Auth::check()) {
            $guestRequests = session()->get('guest_item_requests', []);
            $guestRequests[] = $itemRequest->id;
            session()->put('guest_item_requests', $guestRequests);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product request submitted successfully! SG will review and source it soon.',
            'item_request' => $itemRequest
        ]);
    }

    /**
     * Fetch all product requests for the user.
     */
    public function getItemRequests()
    {
        if (Auth::check()) {
            $requests = ItemRequest::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $guestRequestIds = session()->get('guest_item_requests', []);
            $requests = ItemRequest::whereIn('id', $guestRequestIds)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return response()->json([
            'success' => true,
            'requests' => $requests
        ]);
    }

    /**
     * Fetch affiliate stats for the logged-in user.
     */
    public function getAffiliateStats()
    {
        if (!Auth::check()) {
            return response()->json([
                'authenticated' => false,
                'message' => 'Please log in to view affiliate details.'
            ]);
        }

        $user = Auth::user();

        // Fallback: Generate referral code if missing
        if (empty($user->referral_code)) {
            $user->referral_code = User::generateReferralCode($user->username ?? $user->name);
            $user->save();
        }

        $referralsCount = User::where('referred_by', $user->id)->count();
        $payouts = AffiliatePayout::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalEarned = AffiliateReferral::where('referrer_id', $user->id)->sum('commission_earned');
        // Let's fallback to referral_balance + total payouts completed as total earned
        if ($totalEarned == 0) {
            $payoutsSum = AffiliatePayout::where('user_id', $user->id)->where('status', 'completed')->sum('amount');
            $totalEarned = $user->referral_balance + $payoutsSum;
        }

        return response()->json([
            'authenticated' => true,
            'referral_code' => $user->referral_code,
            'referral_link' => url('/register?ref=' . $user->referral_code),
            'referral_count' => $referralsCount,
            'referral_balance' => number_format($user->referral_balance, 2),
            'total_earned' => number_format($totalEarned, 2),
            'payouts' => $payouts
        ]);
    }

    /**
     * Request a withdrawal of affiliate earnings.
     */
    public function requestAffiliatePayout(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:50',
            'payment_method' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $user = Auth::user();
        $amount = (float) $request->amount;

        if ($user->referral_balance < $amount) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient affiliate balance. Minimum balance required is Gh ' . number_format($amount, 2)
            ], 422);
        }

        // Deduct and save
        $user->referral_balance -= $amount;
        $user->save();

        // Create payout entry
        $payout = AffiliatePayout::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Withdrawal request of Gh ' . number_format($amount, 2) . ' submitted successfully!',
            'payout' => $payout
        ]);
    }

    /**
     * Track guest or user bookings by email.
     */
    public function trackBookings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $bookings = ExpertBooking::where('user_email', $request->email)
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'success' => true,
            'bookings' => $bookings
        ]);
    }

    /**
     * Fetch all experts, categories, and health tips.
     */
    public function getExpertsData()
    {
        $categories = ExpertCategory::all();
        $experts = Expert::with('category')->where('is_active', true)->get();
        $tips = HealthTip::latest()->get();

        // Attach confirmed bookings dates and times for slot blocking
        foreach ($experts as $expert) {
            $expert->confirmed_bookings = ExpertBooking::where('expert_name', $expert->name)
                ->where('status', 'confirmed')
                ->select('booking_date', 'booking_time')
                ->get();
        }

        return response()->json([
            'success' => true,
            'categories' => $categories,
            'experts' => $experts,
            'tips' => $tips
        ]);
    }
}
