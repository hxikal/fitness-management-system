<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Trainer;
use App\Models\EquipmentReport;
use App\Models\TrainerBooking; 


class AdminAuthController extends Controller
{
    public function login(Request $request) 
    {
        $request->validate([
            'uname' => 'required|email',
            'psw'   => 'required',
        ]);

        if (Auth::attempt(['email' => $request->uname, 'password' => $request->psw])) {
            $request->session()->regenerate();

            // ✅ Redirect based on role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('userdashboard');
        }

        return back()->with('error', 'Login failed. Invalid credentials.');
    }

public function dashboard()
{
    if (!Auth::guard('admin')->check() || Auth::guard('admin')->user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }

    $reports = EquipmentReport::latest()->get(); 
    $totalMembers = User::count();
    $pendingEquipmentReports = EquipmentReport::whereRaw('LOWER(status) = ?', ['pending'])->count();

    // ✅ Total trainer bookings count
    $totalTrainerBookings = \App\Models\TrainerBooking::count();

    return view('admin.dashboard', compact(
        'reports',
        'totalMembers',
        'pendingEquipmentReports',
        'totalTrainerBookings'
    ));
}

 public function trainerBookings()
{
    $bookings = TrainerBooking::with('user')->latest()->get();
    return view('admin.trainer_bookings.index', compact('bookings'));
}


public function showTrainers()
{
   $trainers = \App\Models\Trainer::all();
   return view('admin.trainers.index', compact('trainers'));
}



    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}