<?php

namespace App\Http\Controllers;

use App\Models\TrainerBooking; // Kept if needed elsewhere
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Trainer; // Make sure this matches your actual Trainer model filename

class TrainerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('trainer.login'); // Blade view for trainer login
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to log the trainer in using the custom guard
    if (Auth::guard('trainer')->attempt($credentials)) {
        $request->session()->regenerate();

        // ✅ FIX: Force the redirect to go straight to the trainer dashboard!
        return redirect()->route('trainer.dashboard');
    }

    // If it fails, send them back to the login form with an error
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
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