<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Ensure this is added

class PaymentController extends Controller
{
    public function index()
    {
        // confirm that you have : resources/views/paymenthistory.blade.php
        return view('payment_history'); 
    }

public function pay(Request $request)
{
    // Use $request->user() instead of the global auth() helper
    $user = $request->user();
    
    // Fallback if no user is logged in
    $name = $user ? $user->name : 'Guest Member';
    $email = $user ? $user->email : 'gym_member@example.com';

    $amountInCents = $request->amount * 100;

    $response = Http::asForm()->post('https://toyyibpay.com/index.php/api/createBill', [
        'userSecretKey' => env('TOYYIBPAY_SECRET_KEY'),
        'categoryCode'  => env('TOYYIBPAY_CATEGORY_CODE'),
        'billName'      => 'Gym Membership Payment',
        'billDescription' => 'Payment for plan: ' . $request->plan,
        'billAmount'    => $amountInCents,
        'billReturnUrl' => route('payment.callback'),
        'billCallbackUrl' => route('payment.webhook'),
        'billTo'        => $name,
        'billEmail'     => $email,
    ]);

    return $response->json();
}
}