<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expert;
use App\Models\ExpertCategory;
use App\Models\ExpertBooking;

class ExpertDashboardController extends Controller
{
    /**
     * Display the expert dashboard.
     */
    public function dashboard()
    {
        $expert = Expert::where('user_id', Auth::id())->first();
        $categories = ExpertCategory::all();
        
        $totalBookings = 0;
        $pendingBookings = 0;
        $confirmedBookings = 0;
        
        if ($expert) {
            $totalBookings = ExpertBooking::where('expert_name', $expert->name)->count();
            $pendingBookings = ExpertBooking::where('expert_name', $expert->name)->where('status', 'pending')->count();
            $confirmedBookings = ExpertBooking::where('expert_name', $expert->name)->where('status', 'confirmed')->count();
        }

        return view('back.expert.dashboard', compact('expert', 'categories', 'totalBookings', 'pendingBookings', 'confirmedBookings'));
    }

    /**
     * Setup/Update expert profile details.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'expert_category_id' => 'required|exists:expert_categories,id',
            'specialty_description' => 'required|string',
            'available_days' => 'required|array|min:1',
            'available_days.*' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'whatsapp_number' => 'required|string|max:50',
            'whatsapp_message' => 'nullable|string',
            'avatar_bg_color' => 'required|string|max:15',
            'avatar_text_color' => 'required|string|max:15',
        ]);

        $user = Auth::user();
        
        // Auto-calculate initials from user name
        $words = explode(' ', $user->name);
        $initials = '';
        foreach ($words as $w) {
            $initials .= strtoupper(substr($w, 0, 1));
        }
        $initials = substr($initials, 0, 3);

        $availability = json_encode([
            'days' => $request->available_days,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        Expert::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $user->name,
                'expert_category_id' => $request->expert_category_id,
                'initials' => $initials,
                'specialty_description' => $request->specialty_description,
                'availability_schedule' => $availability,
                'whatsapp_number' => $request->whatsapp_number,
                'whatsapp_message' => $request->whatsapp_message,
                'avatar_bg_color' => $request->avatar_bg_color,
                'avatar_text_color' => $request->avatar_text_color,
                'is_active' => true,
            ]
        );

        $notification = [
            'message' => 'Expert profile information updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * View expert's bookings.
     */
    public function bookings()
    {
        $expert = Expert::where('user_id', Auth::id())->first();
        $bookings = $expert ? ExpertBooking::where('expert_name', $expert->name)->latest()->get() : collect();

        return view('back.expert.bookings', compact('bookings'));
    }

    /**
     * Update booking status.
     */
    public function updateBookingStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:expert_bookings,id',
            'status' => 'required|in:pending,confirmed,completed',
            'expert_feedback' => 'nullable|string|max:1000',
        ]);

        $expert = Expert::where('user_id', Auth::id())->first();
        if (!$expert) {
            return redirect()->back()->with([
                'message' => 'Please setup your profile first.',
                'alert-type' => 'error'
            ]);
        }

        $booking = ExpertBooking::where('id', $request->id)
            ->where('expert_name', $expert->name)
            ->firstOrFail();

        $booking->update([
            'status' => $request->status,
            'expert_feedback' => $request->expert_feedback
        ]);

        $notification = [
            'message' => 'Booking status updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * View availability page.
     */
    public function availability()
    {
        $expert = Expert::where('user_id', Auth::id())->first();
        return view('back.expert.availability', compact('expert'));
    }

    /**
     * Update availability schedule.
     */
    public function updateAvailability(Request $request)
    {
        $request->validate([
            'available_days' => 'required|array|min:1',
            'available_days.*' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
        ]);

        $expert = Expert::where('user_id', Auth::id())->first();
        if (!$expert) {
            $notification = [
                'message' => 'Please setup your profile information first.',
                'alert-type' => 'error'
            ];
            return redirect()->route('expert.dashboard')->with($notification);
        }

        $availability = json_encode([
            'days' => $request->available_days,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        $expert->update(['availability_schedule' => $availability]);

        $notification = [
            'message' => 'Availability schedule updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Logout expert.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = [
            'message' => 'Logged out successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.login')->with($notification);
    }
}
