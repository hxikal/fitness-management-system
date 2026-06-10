<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // ✅ Monthly registration (default)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        DB::table('users')->insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'is_active'  => 0,
            'type'       => 'monthly',   // 🔑 added membership type
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/register')->with('success', 'Monthly Registration Successful! You can now log in.');
    }

    public function registerWalkin(Request $request)
    {
        // ✅ Walk-in registration
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        DB::table('users')->insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'is_active'  => 1,            // walk-in active immediately
            'type'       => 'walkin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/register')->with('success', 'Walk-in Registration Successful! You can now log in.');
    }

    public function registerAnnual(Request $request)
    {
        // ✅ Annual registration
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        DB::table('users')->insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'is_active'  => 0,
            'type'       => 'annual',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/register')->with('success', 'Annual Registration Successful! You can now log in.');
    }
}
