<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ Make sure Auth is imported
use App\Models\User; // ✅ Import your User model

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();  

        // Handle background image upload
        if ($request->hasFile('background')) {
            $path = $request->file('background')->store('backgrounds', 'public');
            $user->background = $path;
        }

        // Save changes
        $user->save();

        return redirect()->back()->with('success', 'Profile update successful.');
    }
}
