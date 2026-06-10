<?php

namespace App\Http\Controllers;

use App\Models\TrainerBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerDashboardController extends Controller
{
    // Show trainer dashboard
    public function index()
    {
        // FIX: Added the where clause so it dynamically pulls data only for the logged-in coach
        $bookings = TrainerBooking::where('trainer_id', Auth::id())
            ->with('user')
            ->get();
            
        $total = $bookings->count();

        $confirmed = $bookings->filter(function ($b) {
            return strtolower(trim($b->status)) === 'confirmed';
        })->count();

        $pending = $bookings->filter(function ($b) {
            return strtolower(trim($b->status)) === 'pending';
        })->count();

        $cancelled = $bookings->filter(function ($b) {
            return strtolower(trim($b->status)) === 'cancelled';
        })->count();

        $today = $bookings->filter(function ($b) {
            return \Carbon\Carbon::parse($b->booking_date)->isToday();
        })->count();

        return view('trainer.dashboard', compact(
            'bookings',
            'total',
            'confirmed',
            'pending',
            'cancelled',
            'today'
        ));
    }

    // Update booking status (accept/cancel)
    public function updateStatus(Request $request, $id)
    {
        $booking = TrainerBooking::find($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found!');
        }

        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }

   
    

    public function storeSession(Request $request)
    {
        TrainerBooking::create([
            'trainer_id' => Auth::id(),
            'user_id' => null,
            'activity' => $request->activity,
            'booking_date' => $request->booking_date,
            'booking_time' => '09:00:00',
            'status' => 'Pending'
        ]);

        return response()->json(['success' => true]);
    }
}