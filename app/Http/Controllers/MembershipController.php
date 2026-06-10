<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // <--- DON'T FORGET THIS
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
   public function verify($id)
{
    // Find user by their membership string (PNP-00016)
    $user = User::where('membership_id', $id)->firstOrFail();

    // ONLY now do we set the status and the expiry date
    $user->update([
        'is_active' => true,
        'status' => 'active',
        'membership_expiry' => now()->addDays(30), // Expiry is set ONLY upon scan
    ]);

    return "Verification Successful! " . $user->name . " is now active.";
}

    // ... your other methods like renew()
}