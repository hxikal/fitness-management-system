<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user')
                        ->where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('payment_history', compact('payments'));
    }

    public function pay(Request $request)
    {
        $request->validate([
            'plan'   => 'required|in:walkin,monthly,yearly',
            'amount' => 'required|numeric|min:1',
            'method' => 'required|string',
        ]);

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
            'plan'           => $plan,
            'amount'         => $amount,
            'method'         => $method,
            'status'         => 'Pending', // Pending until admin approves receipt
            'transaction_id' => 'TXN-' . strtoupper(uniqid()),
            'paid_at'        => now(),
        ]);

        return response()->json([
            'status'         => 'success',
            'transaction_id' => $payment->transaction_id,
            'payment_id'     => $payment->id,
            'amount'         => $amount,
            'plan'           => $plan,
        ]);
    }

    public function uploadReceipt(Request $request)
    {
        $request->validate([
            'receipt'    => 'required|image|mimes:jpg,jpeg,png,pdf|max:5120',
            'payment_id' => 'required|exists:payments,id',
        ]);

        $payment = Payment::where('id', $request->payment_id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        $path = $request->file('receipt')->store('receipts', 'public');

        $payment->update([
            'receipt_path'   => $path,
            'receipt_status' => 'pending',
        ]);

        return response()->json(['status' => 'success', 'message' => 'Receipt uploaded successfully']);
    }

    public function callback(Request $request)
    {
        return response('OK', 200);
    }

    public function success()
    {
        return view('payment.success');
    }
}