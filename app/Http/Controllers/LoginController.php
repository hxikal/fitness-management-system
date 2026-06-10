<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;   
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter; 
use Illuminate\Support\Str; 

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email'    => 'required|email|string',
            'password' => 'required|string',
        ]);

        // 2. Bina kunci sekatan unik (Gabungan Emel + IP Pengguna)
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        // 3. Semak jika pengguna telah disekat (Maksimum 5 kali cubaan gagal)
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            // Menghantar ralat kembali ke borang tanpa mencetuskan skrin putih 500
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$minutes} minutes (or {$seconds} seconds)."
            ])->withInput($request->except('password'));
        }

        // 4. Ambil maklumat kelayakan log masuk (Credentials)
        $credentials = $request->only('email', 'password');

        // 5. Jalankan semakan kelayakan menggunakan Laravel Auth
        if (Auth::attempt($credentials)) {
            
            // Jika berjaya, padamkan rekod kegagalan log masuk (Reset semula kaunter)
            RateLimiter::clear($throttleKey);
            
            // Mencegah serangan CSRF / ralat 419
            $request->session()->regenerate();   

            // 🔑 Proses lencongan (Redirect) berdasarkan peranan (Role)
            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'trainer':
                    return redirect()->intended('/trainer/dashboard');
                default:
                    return redirect()->intended('/dashboard');
            }
        }

        // 6. Jika log masuk gagal, tambah nilai kaunter ralat (+1) dan sekat selama 15 minit (900 saat)
        RateLimiter::hit($throttleKey, 900);

        // Kembali ke halaman asal bersama mesej ralat jika maklumat akaun salah
        return back()->withErrors([
            'login_error' => 'User login failed. Please check your credentials.',
            'email'       => 'Invalid email or password.'
        ])->withInput($request->except('password'));
    }
}