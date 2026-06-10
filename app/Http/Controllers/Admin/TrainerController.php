<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trainer; // Make sure this is imported!
use Illuminate\Http\Request;

class TrainerController extends Controller
{
  public function destroy($id)
{
    $trainer = \App\Models\Trainer::findOrFail($id);
    $trainer->delete();
    return redirect()->back()->with('success', 'Jurulatih berjaya dipadam.');
}
}