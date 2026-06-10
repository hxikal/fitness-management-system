<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if the user is logged in
        // 2. Check if their 'role' column in the database is 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // If not an admin, redirect back to login with an error
        return redirect()->route('admin.login')->withErrors(['email' => 'Access Denied: Admins only.']);
    }
}