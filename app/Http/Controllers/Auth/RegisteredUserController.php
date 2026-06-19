<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RegisterUserNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\DeliveryDistrict;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (request()->has('ref')) {
            session(['referrer_code' => request()->query('ref')]);
        }
        $institutions = DeliveryDistrict::where('district_name', '!=', '.select institution')->orderBy('district_name', 'ASC')->get();
        return view('auth.register', compact('institutions'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $new_user = User::where('role','admin')->get();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'status_identity' => ['required', 'string', 'in:student,non-student'],
            'institution' => ['required_if:status_identity,student', 'nullable', 'string', 'max:255'],
            'year_of_admission' => ['required_if:status_identity,student', 'nullable', 'integer', 'min:2000', 'max:' . (date('Y') + 1)],
            'year_of_completion' => ['required_if:status_identity,student', 'nullable', 'integer', 'min:2000', 'max:' . (date('Y') + 15), 'gte:year_of_admission'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Check for referral code
        $referredBy = null;
        $referrer = null;
        $refCode = $request->input('ref') ?: session('referrer_code');
        if ($refCode) {
            $referrer = User::where('referral_code', $refCode)->first();
            if ($referrer) {
                $referredBy = $referrer->id;
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => "inactive",
            'referred_by' => $referredBy,
            'referral_code' => User::generateReferralCode($request->username ?? $request->name),
            'year_of_admission' => $request->status_identity === 'student' ? $request->year_of_admission : null,
            'year_of_completion' => $request->status_identity === 'student' ? $request->year_of_completion : null,
            'institution' => $request->status_identity === 'student' ? $request->institution : null,
            'status_identity' => $request->status_identity,
            'student_id' => $request->status_identity === 'student' ? User::generateStudentId($request->year_of_admission, $request->year_of_completion) : null,
        ]);

        if ($referrer) {
            $setting = \App\Models\SiteSetting::find(1);
            $commissionType = $setting->referral_commission_type ?? 'flat';

            if ($commissionType === 'flat') {
                $flatAmount = $setting->referral_flat_amount ?? 15.00;

                // Log the referral
                \App\Models\AffiliateReferral::create([
                    'referrer_id' => $referrer->id,
                    'referred_id' => $user->id,
                    'commission_earned' => $flatAmount
                ]);

                // Add referral fee to referrer's balance
                $referrer->referral_balance += $flatAmount;
                $referrer->save();
            }

            // Clear session key
            session()->forget('referrer_code');
        }

        // Activate User after confirming email
        $email = $request->email;
        $messageData = [
            'email' => $request->email,
            'name' => $request->name,
            'code' => base64_encode($request->email)
        ];

        Mail::send('emails.user_confirmation_link', $messageData, function($message)use($email){
            $message->to($email)->subject('Smart Groceries: Activate Your Account!');
        });

        event(new Registered($user));
        
        // Auth::login($user);
        
        Notification::send($new_user, new RegisterUserNotification($request, $user));

        $notification = array(
            'message' => 'Kindly check your email to activate your account',
            'alert-type' => 'info'
        );

        return redirect()->route('register')->with($notification);

        // event(new Registered($user));
        
        // Auth::login($user);
        
        // Notification::send($new_user, new RegisterUserNotification($request, $user));
        // return redirect(RouteServiceProvider::HOME);
    }
}
