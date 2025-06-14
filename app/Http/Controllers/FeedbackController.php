<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of feedback.
     */
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new feedback.
     */
    public function create()
    {
        return view('admin.feedback.create');
    }

    /**
     * Store a newly created feedback in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:new,read,replied,archived',
        ]);

        $feedback = Feedback::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => 'Created new feedback #' . $feedback->id,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback created successfully');
    }

    /**
     * Display the specified feedback.
     */
    public function show(Feedback $feedback)
    {
        return view('admin.feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified feedback.
     */
    public function edit(Feedback $feedback)
    {
        return view('admin.feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified feedback in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:new,read,replied,archived',
            'reply' => 'nullable|string',
        ]);

        $feedback->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated feedback #' . $feedback->id,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback updated successfully');
    }

    /**
     * Remove the specified feedback from storage.
     */
    public function destroy(Request $request, Feedback $feedback)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Deleted feedback #' . $feedback->id,
            'ip_address' => $request->ip()
        ]);

        $feedback->delete();

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback deleted successfully');
    }
}