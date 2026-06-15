<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerBooking;
use App\Models\TrainerSession;
use Illuminate\Support\Facades\Auth;

class TrainerSessionController extends Controller
{
    // Trainer dashboard
    public function index()
    {
        $trainer = Auth::guard('trainer')->user();

        $sessions = TrainerBooking::where('trainer_name', $trainer?->name)
            ->orderBy('booking_date', 'asc')
            ->get();

        return view('trainer.index', compact('sessions'));
    }

    // Trainer events (for trainer calendar/table)
    public function getEvents()
    {
        $trainer = Auth::guard('trainer')->user();

        $sessions = TrainerSession::where('trainer_id', $trainer->id)->get();

        return response()->json(
            $sessions->map(function ($session) {
                return [
                    'id'    => $session->id,
                    'title' => $session->activity,
                    'start' => $session->session_date . 'T' . $session->start_time,
                    'end'   => $session->session_date . 'T' . $session->end_time,
                    'allDay'=> false,
                    'color' => '#2ecc71',
                ];
            })
        );
    }

    // Trainer events (simple version)
    public function getMyEvents()
    {
        $trainer = Auth::guard('trainer')->user();

        $sessions = TrainerSession::where('trainer_id', $trainer->id)->get();

        return response()->json(
            $sessions->map(function ($session) {
                return [
                    'title' => $session->activity,
                    'start' => $session->session_date . 'T' . $session->start_time,
                    'end'   => $session->session_date . 'T' . $session->end_time,
                ];
            })
        );
    }

    // User view: availability slots by trainer name
    public function getUserAvailableSlots($trainerName)
    {
        $sessions = TrainerSession::where('trainer_name', $trainerName)->get();

        return response()->json(
            $sessions->map(function ($session) {
                return [
                    'title'  => $session->activity,
                    'start'  => $session->session_date . 'T' . $session->start_time,
                    'end'    => $session->session_date . 'T' . $session->end_time,
                    'allDay' => false,
                    'color'  => '#3182ce',
                ];
            })
        );
    }

    // Store availability (trainer adds slot)
   public function storeAvailability(Request $request)
{
    $trainer = Auth::guard('trainer')->user();

    $session = TrainerSession::create([
        'trainer_id'   => $trainer->id,
        'trainer_name' => $trainer->name,
        'session_date' => $request->session_date,
        'start_time'   => $request->start_time,
        'end_time'     => $request->end_time,
        'activity'     => $request->activity,
        'status'       => 'available',
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Availability stored',
        'data'    => $session
    ]);
}


    // User view: trainer availability with props
    public function getTrainerAvailability($trainerName)
    {
        $sessions = TrainerSession::where('trainer_name', $trainerName)->get();

        return response()->json(
            $sessions->map(function ($session) {
                return [
                    'title' => $session->activity,
                    'start' => $session->session_date . 'T' . $session->start_time,
                    'end'   => $session->session_date . 'T' . $session->end_time,
                    'extendedProps' => [
                        'trainer_name' => $session->trainer_name,
                        'status'       => $session->status,
                    ],
                ];
            })
        );
    }

    // Delete availability (trainer)
   public function destroyAvailability($id)
{
    $trainer = Auth::guard('trainer')->user();

    $session = TrainerSession::where('id', $id)
        ->where('trainer_id', $trainer->id)
        ->firstOrFail();

    $session->delete();

    return response()->json([
        'success' => true,
        'message' => 'Availability deleted successfully'
    ]);
}
    // Store (manual insert, e.g. admin form)
    public function store(Request $request)
    {
        $request->validate([
            'trainer_name' => 'required|string|max:255',
            'date'         => 'required|date',
            'time'         => 'required',
            'activity'     => 'required|string|max:255',
        ]);

        TrainerSession::create([
            'trainer_name'  => $request->trainer_name,
            'session_date'  => $request->date,
            'start_time'    => $request->time, // guna start_time
            'end_time'      => $request->time, // kalau admin form hanya ada satu time, boleh duplicate
            'activity'      => $request->activity,
            'status'        => 'available',
        ]);

        return redirect()->route('trainer.session.index')
            ->with('success', 'Session created successfully!');
    }

    // Delete (manual)
    public function destroy($id)
    {
        $session = TrainerSession::findOrFail($id);
        $session->delete();

        return response()->json(['success' => true]);
    }

    public function getAvailabilityTable()
{
    $trainer = Auth::guard('trainer')->user();

    $sessions = TrainerSession::where('trainer_id', $trainer->id)
        ->orderBy('session_date', 'asc')
        ->get();

    return response()->json(
        $sessions->map(function ($session) {
            return [
                'id'           => $session->id,
                'trainer_name' => $session->trainer_name,
                'activity'     => $session->activity,
                'date'         => $session->session_date,
                'start_time'   => date('h:i A', strtotime($session->start_time)),
                'end_time'     => date('h:i A', strtotime($session->end_time)),
                'status'       => $session->status,
            ];
        })
    );
}
}
