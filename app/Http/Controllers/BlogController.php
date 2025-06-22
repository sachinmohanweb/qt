<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

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

        // Extract image URLs from description
        preg_match_all('/<img[^>]+src="([^">]+)"/i', $blog->description, $matches);
        $imageUrls = $matches[1] ?? [];
        foreach ($imageUrls as $url) {
            // Extract relative file path
            $path = str_replace(asset('storage') . '/', '', $url);

            // Delete from storage if exists
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

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

    public function uploadImage(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048' // 2MB max
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . implode(', ', $validator->errors()->all())
                ], 422);
            }

            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                
                // Generate unique filename
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                
                // Store in public/storage/blog-descriptions directory
                $path = $file->storeAs('blog-descriptions', $filename, 'public');
                
                // Generate the full URL
                $url = asset('storage/' . $path);
                
                // Return success response for CKEditor
                return response()->json([
                    'success' => true,
                    'url' => $url,
                    'filename' => $filename,
                    'uploaded' => 1 // CKEditor expects this
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No file uploaded'
            ], 400);

        } catch (\Exception $e) {
            \Log::error('Image upload error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
                'error' => [
                    'message' => $e->getMessage()
                ]
            ], 500);
        }
    }
}