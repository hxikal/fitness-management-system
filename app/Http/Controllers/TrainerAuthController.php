<?php

namespace App\Http\Controllers;

use App\Models\TrainerBooking; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter; 
use Illuminate\Support\Str;
use App\Models\Trainer; // Make sure this matches your actual Trainer model filename

class TrainerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('trainer.login'); 
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 1. Check Rate Limiter
    $throttleKey = Str::lower($request->input('email')).'|'.$request->ip();

    if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
        $seconds = RateLimiter::availableIn($throttleKey);
        $minutes = ceil($seconds / 60);

        return back()->withInput()->withErrors([
            'login_error' => "Too many login attempts. Please try again in {$minutes} minutes.",
        ]);
    }

    // Attempt to log the trainer in using the custom guard
    if (Auth::guard('trainer')->attempt($credentials)) {
        // 2. Clear on Success
        RateLimiter::clear($throttleKey);

        $request->session()->regenerate();

        // ✅ FIX: Force the redirect to go straight to the trainer dashboard!
        return redirect()->route('trainer.dashboard');
    }

    // 3. Increment Failures on Failure (900 seconds = 15 mins)
    RateLimiter::hit($throttleKey, 900);

    // If it fails, send them back to the login form with an error
    return back()->withInput()->withErrors([
        'login_error' => 'The email or password is wrong.',
    ]);
}

    public function logout(Request $request)
    {
        Auth::guard('trainer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/trainer/login');
    }

    // ==========================================
    // NEW METHODS ADDED BELOW FOR REGISTRATION
    // ==========================================

    // Show the registration form view
    public function showRegisterForm()
    {
        return view('trainer.register');
    }

    // Handle storing the newly registered trainer
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:trainers',
        'phone' => 'required|string|max:15',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // 1. Create the trainer record in the database
    Trainer::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
    ]);

    // 2. Redirect back to the trainer login page with a success message
    return redirect()->route('trainer.login')->with('success', 'Registration successful! Please log in.');
}
}