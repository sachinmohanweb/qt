<?php

namespace App\Http\Controllers;

use App\Models\ServiceGallery;
use App\Models\Service;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceGalleryController extends Controller
{
    /**
     * Display a listing of service galleries.
     */
    public function index()
    {
        $galleries = ServiceGallery::with('service')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.service-galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new service gallery.
     */
    public function create()
    {
        $services = Service::where('status', 1)->get();
        return view('admin.service-galleries.create', compact('services'));
    }

    /**
     * Store a newly created service gallery in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'status' => 'required|in:1,2',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $uploadedCount = 0;
        $service = Service::find($validated['service_id']);

        foreach ($request->file('images') as $image) {
            $imageName = 'gallery-' . time() . '-' . uniqid() . '.' . $image->extension();
            $image->storeAs('service-galleries', $imageName, 'public');
            
            ServiceGallery::create([
                'service_id' => $validated['service_id'],
                'status' => $validated['status'],
                'image' => $imageName,
            ]);
            
            $uploadedCount++;
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Added {$uploadedCount} gallery images for service: " . $service->name,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.service-galleries.index')
            ->with('success', "{$uploadedCount} gallery images added successfully");
    }

    /**
     * Display the specified service gallery.
     */
    public function show(ServiceGallery $serviceGallery)
    {
        $serviceGallery->load('service');
        return view('admin.service-galleries.show', compact('serviceGallery'));
    }

    /**
     * Show the form for editing the specified service gallery.
     */
    public function edit(ServiceGallery $serviceGallery)
    {
        $services = Service::where('status', 1)->get();
        return view('admin.service-galleries.edit', compact('serviceGallery', 'services'));
    }

    /**
     * Update the specified service gallery in storage.
     */
    public function update(Request $request, ServiceGallery $serviceGallery)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'status' => 'required|in:1,2',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update service and status
        $serviceGallery->update([
            'service_id' => $validated['service_id'],
            'status' => $validated['status'],
        ]);

        // Handle new images if uploaded
        if ($request->hasFile('images')) {
            // Delete old image if it exists
            if ($serviceGallery->image && Storage::disk('public')->exists('service-galleries/' . $serviceGallery->image)) {
                Storage::disk('public')->delete('service-galleries/' . $serviceGallery->image);
            }
            
            // For edit, we'll use the first uploaded image as the main image
            $firstImage = $request->file('images')[0];
            $imageName = 'gallery-' . time() . '-' . uniqid() . '.' . $firstImage->extension();
            $firstImage->storeAs('service-galleries', $imageName, 'public');
            
            $serviceGallery->update(['image' => $imageName]);
            
            // Create additional gallery entries for remaining images
            $additionalImages = array_slice($request->file('images'), 1);
            foreach ($additionalImages as $image) {
                $additionalImageName = 'gallery-' . time() . '-' . uniqid() . '.' . $image->extension();
                $image->storeAs('service-galleries', $additionalImageName, 'public');
                
                ServiceGallery::create([
                    'service_id' => $validated['service_id'],
                    'status' => $validated['status'],
                    'image' => $additionalImageName,
                ]);
            }
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated gallery image for service: ' . $serviceGallery->service->name,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.service-galleries.index')
            ->with('success', 'Service gallery updated successfully');
    }

    /**
     * Remove the specified service gallery from storage.
     */
    public function destroy(Request $request, ServiceGallery $serviceGallery)
    {
        // Delete gallery image if it exists
        if ($serviceGallery->image && Storage::disk('public')->exists('service-galleries/' . $serviceGallery->image)) {
            Storage::disk('public')->delete('service-galleries/' . $serviceGallery->image);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Deleted gallery image for service: ' . $serviceGallery->service->name,
            'ip_address' => $request->ip()
        ]);

        $serviceGallery->delete();

        return redirect()->route('admin.service-galleries.index')
            ->with('success', 'Service gallery deleted successfully');
    }

    /**
     * Toggle status
     */
    public function toggleStatus(Request $request, ServiceGallery $serviceGallery)
    {
        $serviceGallery->update([
            'status' => $serviceGallery->status == 1 ? 2 : 1
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Toggled status for gallery image of service: ' . $serviceGallery->service->name,
            'ip_address' => $request->ip()
        ]);

        return response()->json(['success' => true]);
    }
}