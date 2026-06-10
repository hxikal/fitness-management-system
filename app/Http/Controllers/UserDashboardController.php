<?php

namespace App\Http\Controllers;

use App\Models\EquipmentReport;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
public function index()
{
    // Redirect if not logged in
    if (!Auth::check()) {
        return redirect()->route('login')->withErrors('You must be logged in.');
    }

    $user = Auth::user();

    // Count reports safely
    $reportCount = EquipmentReport::where('user_id', $user->id)->count();

    // ✅ Total workout sessions booked by this user
    $totalSessions = \App\Models\TrainerBooking::where('user_id', $user->id)->count();

   
    // ✅ Maintenance alerts (pending equipment reports)
    $maintenanceAlerts = \App\Models\EquipmentReport::where('status', 'pending')->count();

    return view('userdashboard', [
        'reportCount'        => $reportCount,
        'user'               => $user,
        'totalSessions'      => $totalSessions,
        'maintenanceAlerts'  => $maintenanceAlerts,
    ]);
}
}