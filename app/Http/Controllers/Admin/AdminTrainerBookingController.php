<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainerBooking;
 

class AdminTrainerBookingController extends Controller 
{
    
    // Show all bookings
    public function index() {
        $bookings = TrainerBooking::with('user')->get();
        return view('admin.trainer_bookings.index', compact('bookings'));
    }

    // Change status
public function updateStatus(Request $request, $id)
{
    $booking = TrainerBooking::findOrFail($id);
    $booking->update(['status' => $request->status]);
    return back()->with('success', 'Data updated.');
}

    // Delete a record
public function destroy($id)
{
    $booking = TrainerBooking::findOrFail($id);
    $booking->delete();

    return redirect()->route('admin.trainer_bookings.index')
                     ->with('success', 'Booking deleted successfully.');
}
}
