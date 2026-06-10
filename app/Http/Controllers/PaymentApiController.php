<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentApiController extends Controller
{
    // Simulate payment request and update membership
    public function pay(Request $request)
    {

    if (!Auth::check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
        $user = Auth::user();
        $plan = $request->input('plan');
        $amount = $request->input('amount');
        $method = $request->input('method');

        // Determine expiry based on plan
        $expiry = match ($plan) {
            'walkin' => now()->addDay(),
            'monthly' => now()->addMonth(),
            'yearly' => now()->addYear(),
            default => now(),
        };

        // Update user membership info
      $user->membership_expiry = $expiry->format('Y-m-d'); // Force YYYY-MM-DD format
$user->is_active = 1; // Use 1 instead of true for tinyint
$user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment simulated and membership updated',
            'user' => $user->name,
            'plan' => $plan,
            'amount' => $amount,
            'method' => $method,
            'membership_expiry' => $expiry->format('d-m-Y'),
            'transaction_id' => uniqid('txn_')
        ]);
    }

    // Simulate payment history
    public function history()
    {
        return response()->json([
            ['transaction_id' => 'txn_12345', 'plan' => 'Monthly', 'amount' => 80, 'status' => 'success'],
            ['transaction_id' => 'txn_67890', 'plan' => 'Walk-in', 'amount' => 10, 'status' => 'success'],
        ]);
    }
}
