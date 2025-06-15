<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceType;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index()
    {
        $services = Service::with('serviceType')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        $serviceTypes = ServiceType::where('status', 1)->get();
        return view('admin.services.create', compact('serviceTypes'));
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_id' => 'required|exists:service_types,id',
            'name' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'status' => 'required|in:1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($validated['name']) . '-' . time() . '.' . $request->image->extension();
            $request->image->storeAs('services', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        $service = Service::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => 'Created new service: ' . $service->name,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully');
    }

    /**
     * Display the specified service.
     */
    public function show(Service $service)
    {
        $service->load('serviceType', 'galleries');
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        $serviceTypes = ServiceType::where('status', 1)->get();
        return view('admin.services.edit', compact('service', 'serviceTypes'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'type_id' => 'required|exists:service_types,id',
            'name' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'status' => 'required|in:1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($service->image && Storage::disk('public')->exists('services/' . $service->image)) {
                Storage::disk('public')->delete('services/' . $service->image);
            }
            
            $imageName = Str::slug($validated['name']) . '-' . time() . '.' . $request->image->extension();
            $request->image->storeAs('services', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        $service->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated service: ' . $service->name,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Request $request, Service $service)
    {
        // Delete service image if it exists
        if ($service->image && Storage::disk('public')->exists('services/' . $service->image)) {
            Storage::disk('public')->delete('services/' . $service->image);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Deleted service: ' . $service->name,
            'ip_address' => $request->ip()
        ]);

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully');
    }

    /**
     * Toggle status
     */
    public function toggleStatus(Request $request, Service $service)
    {
        $service->update([
            'status' => $service->status == 1 ? 2 : 1
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Toggled status for service: ' . $service->name,
            'ip_address' => $request->ip()
        ]);

        return response()->json(['success' => true]);
    }
}