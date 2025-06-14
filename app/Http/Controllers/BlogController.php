<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new blog.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created blog in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'user_name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'home_visibility' => 'required|in:1,2',
            'status' => 'required|in:1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($validated['heading']) . '-' . time() . '.' . $request->image->extension();
            $request->image->storeAs('blogs', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        $blog = Blog::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => 'Created new blog: ' . $blog->heading,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully');
    }

    /**
     * Display the specified blog.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified blog.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified blog in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'user_name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'home_visibility' => 'required|in:1,2',
            'status' => 'required|in:1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($blog->image && Storage::disk('public')->exists('blogs/' . $blog->image)) {
                Storage::disk('public')->delete('blogs/' . $blog->image);
            }
            
            $imageName = Str::slug($validated['heading']) . '-' . time() . '.' . $request->image->extension();
            $request->image->storeAs('blogs', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        $blog->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated blog: ' . $blog->heading,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully');
    }

    /**
     * Remove the specified blog from storage.
     */
    public function destroy(Request $request, Blog $blog)
    {
        // Delete blog image if it exists
        if ($blog->image && Storage::disk('public')->exists('blogs/' . $blog->image)) {
            Storage::disk('public')->delete('blogs/' . $blog->image);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Deleted blog: ' . $blog->heading,
            'ip_address' => $request->ip()
        ]);

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully');
    }

    /**
     * Toggle home visibility
     */
    public function toggleHomeVisibility(Request $request, Blog $blog)
    {
        $blog->update([
            'home_visibility' => $blog->home_visibility == 1 ? 2 : 1
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Toggled home visibility for blog: ' . $blog->heading,
            'ip_address' => $request->ip()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Toggle status
     */
    public function toggleStatus(Request $request, Blog $blog)
    {
        $blog->update([
            'status' => $blog->status == 1 ? 2 : 1
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Toggled status for blog: ' . $blog->heading,
            'ip_address' => $request->ip()
        ]);

        return response()->json(['success' => true]);
    }
}