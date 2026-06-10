<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; // ✅ Add this line
use App\Models\Feedback;




class FeedbackController extends Controller {
 public function index()
{
    $feedbacks = \App\Models\Feedback::all();
    return view('feedback', compact('feedbacks'));
}


public function store(Request $request)
{
  Feedback::create($request->validate([
    'user_name' => 'required|string',
    'rating' => 'required|integer|min:1|max:5',
    'comments' => 'required|string',
]));





   return redirect()->route('feedback.index')->with('success', 'Feedback submitted!');
}



public function edit($id)
{
    $feedback = Feedback::findOrFail($id);
   return view('feedback_edit', compact('feedback'));

}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'user_name' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'comments' => 'required|string',
    ]);

    $feedback = Feedback::findOrFail($id);
    $feedback->update($validated);

    return redirect()->route('feedback.index')->with('success', 'Feedback updated!');
}

public function delete($id)
{
    $feedback = Feedback::findOrFail($id);
    $feedback->delete();

    return redirect()->route('feedback.index')->with('success', 'Feedback deleted!');
}




}


