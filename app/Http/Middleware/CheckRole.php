<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // 1. Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // 2. Get the user's role safely
        $userRole = strtolower(Auth::user()->role ?? '');

        // 3. Compare with the required role (case-insensitive)
        if ($userRole !== strtolower($role)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('error', "Unauthorized. You are logged in as {$userRole} but need {$role} access.");
        }

        // 4. Allow request to continue
        return $next($request);
    }
}
