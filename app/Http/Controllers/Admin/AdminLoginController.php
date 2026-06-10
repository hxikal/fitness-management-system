<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->route('user.dashboard');
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

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            if (Auth::guard('admin')->user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
            
            // Jika akaun betul tetapi bukan role admin, log keluar semula
            Auth::guard('admin')->logout();
            
            // ✅ Mengembalikan mesej ralat jika bukan role admin bagi mengelakkan skrin putih
            return back()->withErrors([
                'login_error' => 'Access denied. You do not have admin privileges.'
            ])->withInput($request->except('password'));
        }

        // ✅ PENYELESAIAN UTAMA: Mengembalikan ralat ke halaman asal jika log masuk gagal
        // Ini akan membetulkan ralat skrin putih kosong anda!
        return back()->withErrors([
            'login_error' => 'User login failed. Please check your credentials.'
        ])->withInput($request->except('password'));
    }

    // Handle admin logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}