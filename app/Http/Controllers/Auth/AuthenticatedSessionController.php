<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if(Auth::user()->status == "inactive"){
            Auth::logout();

            $notification = array(
                'message' => 'Please check your email to activate your account',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $request->session()->regenerate();

        $notification = array(
            'message' => 'Login successfully',
            'alert-type' => 'success'
        );

        $url = '';
        if($request->user()->role === 'admin'){
            $url = '/admin/dashboard';
        }elseif($request->user()->role === 'vendor'){
            $url = '/vendor/dashboard';
        }elseif($request->user()->role === 'expert'){
            $url = '/expert/dashboard';
        }elseif($request->user()->role === 'user'){
            $url = '/dashboard';
        }

        return redirect()->intended($url)->with($notification);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
