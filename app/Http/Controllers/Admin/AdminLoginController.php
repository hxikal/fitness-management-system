<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter; // Ensure this is at the top of your controller file
use Illuminate\Support\Str;

class AdminLoginController extends Controller
{
    // Show user login form
    public function showLoginForm() 
    {
        return view('login');
    }

    // Handle user login
    public function login(Request $request) 
    {
        $creds = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($creds)) {
            $request->session()->regenerate();
           return redirect()->route('userdashboard');
        }

        return back()->with('error', 'User login failed. Please check your credentials.');
    }

    // Show admin login form
    public function showAdminLoginForm() 
    {
        return view('admin.login');
    }

    // Handle admin login
   public function adminLogin(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    // --- RATE LIMIT CHECK START ---
    $throttleKey = 'admin_login|'.Str::lower($request->input('email')).'|'.$request->ip();

    if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
        $seconds = RateLimiter::availableIn($throttleKey);
        $minutes = ceil($seconds / 60);

        return back()->withErrors([
            'login_error' => "Too many login attempts. Please try again in {$minutes} minutes."
        ])->withInput($request->except('password'));
    }
    // --- RATE LIMIT CHECK END ---

    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        if (Auth::guard('admin')->user()->role === 'admin') {
            // Clear rate limiter data on successful admin login
            RateLimiter::clear($throttleKey);

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        
        Auth::guard('admin')->logout();
        
       
        RateLimiter::hit($throttleKey, 900);

        return back()->withErrors([
            'login_error' => 'Access denied. You do not have admin privileges.'
        ])->withInput($request->except('password'));
    }

    // Hit the rate limiter on failed credentials check (900 seconds = 15 minutes lockout)
    RateLimiter::hit($throttleKey, 900);
   
    return back()->withErrors([
        'login_error' => 'User login failed. Please check your credentials.'
    ])->withInput($request->except('password'));
}

    // Handle admin logout
    public function adminLogout()
{
    Auth::guard('admin')->logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('admin.login');
}
}