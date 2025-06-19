<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\VideoItem;

class VideoItemsController extends Controller
{
    /**
     * Display a listing of service galleries.
     */
    public function index()
    {
        $galleries = VideoItem::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.video_items.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new service gallery.
     */
    public function create()
    {
        return view('admin.video_items.create');
    }

    /**
     * Store a newly created service gallery in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'type' => 'required|exists:services,id',
            'link_path' => 'required|string',
            'thumb' => 'required|array|min:1',
            'thumb.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'home_visibility' => 'required|in:1,2',
            'status' => 'required|in:1,2',
        ]);

        if ($request->hasFile('thumb')) {
            $imageName = Str::slug($validated['link_path']) . '-' . time() . '.' . $request->thumb->extension();
            $request->thumb->storeAs('video_items', $imageName, 'public');
            $validated['thumb'] = $imageName;
        }

        $service = VideoItem::create($validated);


        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Added Video: ",
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.video-items.index')
            ->with('success', "Video added successfully");
    }

    /**
     * Display the specified service gallery.
     */
    public function show(VideoItem $serviceGallery)
    {
        return view('admin.video_items.show', compact('serviceGallery'));
    }

    /**
     * Show the form for editing the specified service gallery.
     */
    public function edit(VideoItem $serviceGallery)
    {
        return view('admin.video_items.edit', compact('serviceGallery'));
    }

    /**
     * Update the specified service gallery in storage.
     */
    public function update(Request $request, VideoItem $serviceGallery)
    {
        $validated = $request->validate([
            'type' => 'required|exists:services,id',
            'link_path' => 'required|string',
            'thumb' => 'required|array|min:1',
            'thumb.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'home_visibility' => 'required|in:1,2',
            'status' => 'required|in:1,2',
        ]);

        if ($request->hasFile('thumb')) {
            // Delete old thumb if it exists
            if ($service->thumb && Storage::disk('public')->exists('video_items/' . $serviceGallery->thumb)) {
                Storage::disk('public')->delete('video_items/' . $serviceGallery->thumb);
            }
            
            $thumbName = Str::slug($validated['name']) . '-' . time() . '.' . $request->thumb->extension();
            $request->thumb->storeAs('video_items', $thumbName, 'public');
            $validated['thumb'] = $thumbName;
        }

        $serviceGallery->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated Video Item',
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.video-items.index')
            ->with('success', 'Video updated successfully');
    }

    /**
     * Remove the specified service gallery from storage.
     */
    public function destroy(Request $request, VideoItem $serviceGallery)
    {
        // Delete gallery image if it exists
        if ($serviceGallery->thumb && Storage::disk('public')->exists('video_items/' . $serviceGallery->image)) {
            Storage::disk('public')->delete('video_items/' . $serviceGallery->thumb);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Deleted video',
            'ip_address' => $request->ip()
        ]);

        $serviceGallery->delete();

        return redirect()->route('admin.video-items.index')
            ->with('success', 'Video deleted successfully');
    }

    public function toggleHomeVisibility(Request $request, VideoItem $blog)
    {
        $blog->update([
            'home_visibility' => $blog->home_visibility == 1 ? 2 : 1
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Toggled home visibility for VideoItem: ',
            'ip_address' => $request->ip()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Toggle status
     */
    public function toggleStatus(Request $request, VideoItem $serviceGallery)
    {
        $serviceGallery->update([
            'status' => $serviceGallery->status == 1 ? 2 : 1
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Toggled status for VideoItem ',
            'ip_address' => $request->ip()
        ]);

        return response()->json(['success' => true]);
    }
}