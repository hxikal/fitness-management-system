<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
   public function index()
    {
        // 1. Create the static data collection
        $feedbacks = collect([]);
            

        // 2. Calculate Statistics
        $totalSubmissions = $feedbacks->count();
        $avgRating = $feedbacks->avg('rating');

        // 3. Pass everything to the view
        return view('admin.feedbacks_report', compact('feedbacks', 'totalSubmissions', 'avgRating'));
    }
}