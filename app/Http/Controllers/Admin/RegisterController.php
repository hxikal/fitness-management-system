<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        // 1. Validasi maklumat asas
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'admin_code' => 'required',
        ]);

        // 2. Semak Kod Akses (Hanya jika profil sah)
        if ($request->admin_code !== 'SECRET123') {
            return back()
                ->withErrors(['admin_code' => 'Admin Access Code tidak sah!'])
                ->withInput();
        }

        try {
            // 3. Simpan ke Database
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Wajib guna Hash
                'is_active' => 1,
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 4. Redirect ke Login dengan mesej kejayaan
            // Jika berjaya
        return back()->with('success_register', 'Account created! Click here to');

        } catch (\Exception $e) {
            Log::error("Registration Error: " . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan data ke pangkalan data.')->withInput();
        }
    } 
}