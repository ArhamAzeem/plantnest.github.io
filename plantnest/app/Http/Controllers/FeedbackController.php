<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
    
        Feedback::create($request->all());
    
        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }
    


    // Display all feedbacks in admin panel
    public function index()
    {
        $feedbacks = Feedback::all(); // You can also use pagination if needed
        return view('admin.feedback.index', compact('feedbacks'));
    }

    // Display a single feedback
    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback.show', compact('feedback'));
    }

    // Delete feedback
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback deleted successfully');
    }

}
