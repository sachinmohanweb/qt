<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of service types.
     */
    public function index()
    {
        $serviceTypes = ServiceType::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.service-types.index', compact('serviceTypes'));
    }

    /**
     * Show the form for creating a new service type.
     */
    public function create()
    {
        return view('admin.service-types.create');
    }

    /**
     * Store a newly created service type in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:1,2',
        ]);
        
        if ($request->hasFile('icon')) {
            $imageName = Str::slug($validated['name']) . '-' . time() . '.' . $request->icon->extension();
            $request->icon->storeAs('service_types', $imageName, 'public');
            $validated['icon'] = $imageName;
        }

        $serviceType = ServiceType::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => 'Created new service type: ' . $serviceType->name,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Service type created successfully');
    }

    /**
     * Display the specified service type.
     */
    public function show(ServiceType $serviceType)
    {
        return view('admin.service-types.show', compact('serviceType'));
    }

    /**
     * Show the form for editing the specified service type.
     */
    public function edit(ServiceType $serviceType)
    {
        return view('admin.service-types.edit', compact('serviceType'));
    }

    /**
     * Update the specified service type in storage.
     */
    public function update(Request $request, ServiceType $serviceType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:1,2',
        ]);

        if ($request->hasFile('icon')) {
            // Delete old image if it exists
            if ($serviceType->icon && Storage::disk('public')->exists('service_types/' . $serviceType->icon)) {
                Storage::disk('public')->delete('service_types/' . $serviceType->icon);
            }
            
            $imageName = Str::slug($validated['name']) . '-' . time() . '.' . $request->icon->extension();
            $request->icon->storeAs('service_types', $imageName, 'public');
            $validated['icon'] = $imageName;
        }

        $serviceType->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Updated service type: ' . $serviceType->name,
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Service type updated successfully');
    }

    /**
     * Remove the specified service type from storage.
     */
    public function destroy(Request $request, ServiceType $serviceType)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Deleted service type: ' . $serviceType->name,
            'ip_address' => $request->ip()
        ]);

        $serviceType->delete();

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Service type deleted successfully');
    }

    /**
     * Toggle status
     */
    public function toggleStatus(Request $request, ServiceType $serviceType)
    {
        $serviceType->update([
            'status' => $serviceType->status == 1 ? 2 : 1
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Toggled status for service type: ' . $serviceType->name,
            'ip_address' => $request->ip()
        ]);

        return response()->json(['success' => true]);
    }
}