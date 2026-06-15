<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\User;

class PaymentApiController extends Controller
{
    public function pay(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $plan   = $request->input('plan');
        $amount = $request->input('amount');
        $method = $request->input('method');

        $expiry = match ($plan) {
            'walkin'  => now()->addDay(),
            'monthly' => now()->addMonth(),
            'yearly'  => now()->addYear(),
            default   => now(),
        };

$payment = Payment::create([
    'user_id'        => Auth::id(),
    'bill_code'      => uniqid('BILL-'),
    'transaction_id' => 'TXN-' . time(),
    'plan'           => $request->plan,
    'method'         => $request->method,
    'amount'         => $request->amount,
    'status'         => 'Pending'
]);

        User::where('id', Auth::id())->update([
            'membership_expiry' => $expiry->format('Y-m-d'),
            'is_active'         => 1,
        ]);

        return response()->json([
            'status'            => 'success',
            'message'           => 'Payment simulated and membership updated',
            'user'              => Auth::user()->name,
            'plan'              => $plan,
            'amount'            => $amount,
            'method'            => $method,
            'membership_expiry' => $expiry->format('d-m-Y'),
            'transaction_id'    => $payment->transaction_id,
        ]);
    }

    public function history()
    {
        $payments = Payment::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return response()->json($payments);
    }
}