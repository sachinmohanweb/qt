<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'star_rating' => 'required|integer|min:1|max:5',
            'home_visibility' => 'required|in:1,2',
            'status' => 'required|in:1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($validated['name']) . '-' . time() . '.' . $request->image->extension();
            $request->image->storeAs('testimonials', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        $testimonial = Testimonial::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => 'Created new testimonial: ' . $testimonial->name,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully');
    }

    /**
     * Display the specified testimonial.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'star_rating' => 'required|integer|min:1|max:5',
            'home_visibility' => 'required|in:1,2',
            'status' => 'required|in:1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($testimonial->image && Storage::disk('public')->exists('testimonials/' . $testimonial->image)) {
                Storage::disk('public')->delete('testimonials/' . $testimonial->image);
            }
            
            $imageName = Str::slug($validated['name']) . '-' . time() . '.' . $request->image->extension();
            $request->image->storeAs('testimonials', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        $testimonial->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated testimonial: ' . $testimonial->name,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(Request $request, Testimonial $testimonial)
    {
        // Delete testimonial image if it exists
        if ($testimonial->image && Storage::disk('public')->exists('testimonials/' . $testimonial->image)) {
            Storage::disk('public')->delete('testimonials/' . $testimonial->image);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Deleted testimonial: ' . $testimonial->name,
            'ip_address' => $request->ip()
        ]);

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully');
    }

    /**
     * Toggle home visibility
     */
    public function toggleHomeVisibility(Request $request, Testimonial $testimonial)
    {
        $testimonial->update([
            'home_visibility' => $testimonial->home_visibility == 1 ? 2 : 1
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Toggled home visibility for testimonial: ' . $testimonial->name,
            'ip_address' => $request->ip()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Toggle status
     */
    public function toggleStatus(Request $request, Testimonial $testimonial)
    {
        $testimonial->update([
            'status' => $testimonial->status == 1 ? 2 : 1
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Toggled status for testimonial: ' . $testimonial->name,
            'ip_address' => $request->ip()
        ]);

        return response()->json(['success' => true]);
    }
}