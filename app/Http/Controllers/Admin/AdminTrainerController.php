<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainer; // <-- Pastikan nama Model database anda betul
use App\Models\AdminTrainer;

class AdminTrainerController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data jurulatih dari database
        $trainers = Trainer::all();

        // 2. Hantar data ke fail blade baru yang kita buat hari itu
       return view('admin.trainers.index', compact('trainers'));
    }

    public function destroy($id)
    {
        $trainer = Trainer::findOrFail($id);
        $trainer->delete();

        return redirect()->back()->with('success', 'Jurulatih berjaya dipadam.');
    }
}

