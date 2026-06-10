<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use App\Models\TrainerBooking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FitnessTrainerController extends Controller
{
    public function index()
    {
        // Fetch only the logged-in user's bookings
        $bookings = TrainerBooking::where('user_id', Auth::id())
            ->orderBy('booking_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();

        // Slot counts for availability
        $allBookings = TrainerBooking::select('booking_date', 'start_time', 'trainer_name')->get();
        $slotCounts = [];
        foreach ($allBookings as $b) {
            if (!empty($b->start_time) && !empty($b->booking_date)) {
                try {
                    $hour = Carbon::parse($b->start_time)->format('H');
                    $key = trim($b->booking_date) . '-' . $hour . '-' . trim($b->trainer_name);
                    $slotCounts[$key] = ($slotCounts[$key] ?? 0) + 1;
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

    

        // Trainers list for Blade availability generator
        $trainers = Trainer::all();

        // Pass everything needed to fitnesstrainer.blade.php
        return view('fitnesstrainer', compact('bookings', 'slotCounts', 'trainers'));
    }

    

    public function indexAdmin()
    {
        $trainers = Trainer::all(); 
        return view('admin.trainers.index', compact('trainers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trainer_name' => 'required|string',
            'activity'     => 'required|string|max:255',
            'booking_date' => 'required|date',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
        ]);

        // Find trainer by name (handles variations like "Coach Ahmad", "Trainer Ahmad", etc.)
        $trainer = Trainer::where('name', $request->trainer_name)
                     ->orWhere('name', 'Trainer ' . $request->trainer_name)
                     ->orWhere('name', 'Coach ' . $request->trainer_name)
                     ->first();

        if (!$trainer) {
            return redirect()->back()->with('error', 'Trainer not found. Please try again.');
        }

        $bookingDateTime = Carbon::parse($request->booking_date . ' ' . $request->start_time);
        $hourSlotStart   = $bookingDateTime->copy()->startOfHour()->format('H:i:s');
        $hourSlotEnd     = $bookingDateTime->copy()->endOfHour()->format('H:i:s');

        $totalBookedInSlot = TrainerBooking::where('trainer_id', $trainer->id)
            ->whereDate('booking_date', $request->booking_date)
            ->whereBetween('start_time', [$hourSlotStart, $hourSlotEnd])
            ->count();

        if ($totalBookedInSlot >= 5) {
            return redirect()->back()->with('error', 'Slot penuh! Maksimum 5 orang ahli sahaja dibenarkan untuk slot jam ini.');
        }

   TrainerBooking::create([
    'user_id'      => Auth::id(),
    'trainer_id'   => $trainer->id,
    'trainer_name' => $trainer->name,
    'activity'     => $request->activity,
    'booking_date' => $request->booking_date,
    'start_time'   => $request->start_time,
    'end_time'     => $request->end_time,
    'booking_time' => $request->start_time,
    'status'       => 'Confirmed',
]);

        return redirect()->route('fitnesstrainer')->with('success', 'Booking created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'booking_date' => 'required|date',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'activity'     => 'required|string|max:255',
        ]);

        $booking = TrainerBooking::findOrFail($id);
        $booking->update([
            'booking_date' => $request->booking_date,
            'start_time'   => $request->start_time,
            'end_time'     => $request->end_time,
            'activity'     => $request->activity,
        ]);

        return redirect()->route('fitnesstrainer')->with('success', 'Booking updated successfully!');
    }

    public function profile()
    {
        $trainer = Auth::guard('trainer')->user() ?? (Trainer::find(request('id')) ?? Trainer::first());
        return view('trainer.profile', compact('trainer'));
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:15', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $trainer = Trainer::findOrFail($id);
        $trainer->name  = $request->name;
        $trainer->phone = $request->phone; 

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile_images', 'public');
            $trainer->profile_image = $path; 
        }

        $trainer->save(); 

        return redirect()->back()->with('success', 'Profil berjaya dikemaskini!');
    }

    public function destroy($id)
    {
        $booking = TrainerBooking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Trainer booking deleted successfully.');
    }
}