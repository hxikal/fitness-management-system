<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // <--- DON'T FORGET THIS
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class MembershipController extends Controller
{
    public function verifyMembership($id)
    {
        $user = User::findOrFail($id);

        $user->is_active = 1;

        if (Schema::hasColumn('users', 'membership_start')) {
            $user->membership_start = now();
        }

        if (Schema::hasColumn('users', 'status')) {
            $user->status = 'active';
        }

        if (Schema::hasColumn('users', 'type') && empty($user->type)) {
            $user->type = 'monthly';
        }

        if (Schema::hasColumn('users', 'membership_expiry')) {
            $user->membership_expiry = now()->addDays(30);
        }

        $user->save();

        return view('membership.success', compact('user'));
    }
}
