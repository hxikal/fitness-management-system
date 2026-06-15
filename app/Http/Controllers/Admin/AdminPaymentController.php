<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $payments     = Payment::with('user')->orderBy('created_at', 'desc')->get();
        $totalRevenue = Payment::where('status', 'Paid')->sum('amount');
        $pendingCount = Payment::where('status', 'Pending')->count();

        return view('admin.payments_history', compact('payments', 'totalRevenue', 'pendingCount'));
    }

    public function approveReceipt($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'status'         => 'Paid',
            'receipt_status' => 'approved',
        ]);

        // Update user membership
        $expiry = match ($payment->plan) {
            'walkin'  => now()->addDay(),
            'monthly' => now()->addMonth(),
            'yearly'  => now()->addYear(),
            default   => now(),
        };

        $payment->user->update([
            'membership_expiry' => $expiry->format('Y-m-d'),
            'is_active'         => 1,
        ]);

        return back()->with('success', 'Receipt approved and membership activated.');
    }

    public function approve($id)
{
    $payment = Payment::findOrFail($id);

    $payment->update([
        'status' => 'Paid',
    ]);

    // Jangan update is_active di sini — biar scanMember yang buat

    return redirect()->back()->with('success', 'Payment approved. Member must show QR for activation.');
}

    public function deleteReceipt($id)
    {
        $payment = Payment::findOrFail($id);

        if ($payment->receipt_path) {
            Storage::disk('public')->delete($payment->receipt_path);
        }

        $payment->update([
            'receipt_path'   => null,
            'receipt_status' => 'rejected',
            'status'         => 'Failed',
        ]);

        return back()->with('success', 'Receipt deleted.');
    }

  

public function destroy($id)
{
    $payment = Payment::findOrFail($id);

    if ($payment->receipt_path) {
        Storage::disk('public')->delete($payment->receipt_path);
    }

    $payment->delete();

    return back()->with('success', 'Payment record deleted.');
}
}