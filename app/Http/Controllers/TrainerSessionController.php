<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerBooking;
use App\Models\TrainerSession;
use Illuminate\Support\Facades\Auth;

class TrainerSessionController extends Controller
{
    // Show calendar with sessions
    public function index()
    {
        $sessions = TrainerBooking::where('trainer_name', Auth::user()->name)
                                  ->orderBy('booking_date', 'asc')
                                  ->get();

        return view('trainer.session.index', compact('sessions'));
    }

 public function getEvents()
{
    $sessions = TrainerSession::all();

    $events = $sessions->map(function ($session) {
        return [
            'id'     => $session->id,  // ← tambah ni
            'title'  => 'Availability: ' . $session->activity,
            'start'  => $session->session_date . 'T' . $session->session_time,
            'allDay' => false,
            'color'  => '#2ecc71'
        ];
    });

    return response()->json($events);
}

public function getMyEvents()
{
    $sessions = TrainerSession::where('trainer_name', Auth::user()->name)->get();

    $events = $sessions->map(function ($session) {
        return [
            'id'     => $session->id,  // penting untuk delete!
            'title'  => $session->activity,
            'start'  => $session->session_date . 'T' . $session->session_time,
            'allDay' => false,
            'color'  => '#2ecc71'
        ];
    });

    return response()->json($events);
}

   public function getUserAvailableSlots($trainerName)
{
    $formattedName = str_replace('-', ' ', $trainerName);

    $sessions = TrainerSession::where('trainer_name', $formattedName)
        ->get();

    $events = $sessions->map(function ($session) {
        return [
            'title'  => 'Availability: ' . $session->activity,
            'start'  => $session->session_date . 'T' . $session->session_time,
            'allDay' => false,
            'color'  => '#3182ce'
        ];
    });

    return response()->json($events);
}

    public function storeAvailability(Request $request)
{
    $request->validate([
        'trainer_name' => 'required|string',
        'session_date' => 'required|date',
        'session_time' => 'required',
        'activity'     => 'required|string',
        'status'       => 'required|string',
    ]);

    TrainerSession::create($request->all());

    return response()->json(['success' => true]);
}

public function getAllTrainerAvailability()
{
    $sessions = TrainerSession::all();

    $events = $sessions->map(function ($session) {
        return [
            'title'  => $session->activity,
            'start'  => $session->session_date . 'T' . $session->session_time,
            'allDay' => false,
            'color'  => '#2ecc71',
            'extendedProps' => [
                'trainer_name' => $session->trainer_name,
                'status'       => $session->status,
            ]
        ];
    });

    return response()->json($events);
}

public function destroyAvailability($id)
{
    $session = TrainerSession::findOrFail($id);
    $session->delete();

    return response()->json(['success' => true]);
}

    public function store(Request $request)
    {
        $request->validate([
            'trainer_name' => 'required|string|max:255',
            'date'         => 'required|date',
            'time'         => 'required',
            'activity'     => 'required|string|max:255',
        ]);

        TrainerBooking::create([
            'trainer_name' => $request->trainer_name,
            'booking_date' => $request->date,
            'booking_time' => $request->time,
            'activity'     => $request->activity,
            'status'       => 'Confirmed',
        ]);

        return redirect()->route('trainer.session.index')
                         ->with('success', 'Session created successfully!');
    }

    public function destroy($id)
{
    $session = TrainerSession::findOrFail($id);
    $session->delete();

    return response()->json(['success' => true]);
}
}
