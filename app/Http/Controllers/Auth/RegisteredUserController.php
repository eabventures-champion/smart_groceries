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

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => "inactive",
        ]);

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
