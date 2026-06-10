<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    /**
     * Display the payment management page for Admin.
     */
    public function index()
{
    // Ensure this collection has the keys your Blade file expects
    $payments = collect([]); 

    $totalRevenue = 0.00;
    $pendingCount = 0;

     
    return view('admin.payments_history', compact('payments', 'totalRevenue', 'pendingCount'));
    }
}