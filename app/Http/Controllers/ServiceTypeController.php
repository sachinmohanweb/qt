<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\MenuItem;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of service types.
     */
    public function index()
    {
        $serviceTypes = MenuItem::orderBy('created_at', 'desc')->get();
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
            'type' => 'required|in:1,2',
            'name' => 'required|string|max:255',
            'status' => 'required|in:1,2',
        ]);

        $serviceType = MenuItem::create($validated);

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
    public function show(MenuItem $serviceType)
    {
        return view('admin.service-types.show', compact('serviceType'));
    }

    /**
     * Show the form for editing the specified service type.
     */
    public function edit(MenuItem $serviceType)
    {
        return view('admin.service-types.edit', compact('serviceType'));
    }

    /**
     * Update the specified service type in storage.
     */
    public function update(Request $request, MenuItem $serviceType)
    {
        $validated = $request->validate([
            'type' => 'required|in:1,2',
            'name' => 'required|string|max:255',
            'status' => 'required|in:1,2',
        ]);

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
    public function destroy(Request $request, MenuItem $serviceType)
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
    public function toggleStatus(Request $request, MenuItem $serviceType)
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