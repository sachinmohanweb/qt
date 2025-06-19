<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\MenuItem;
use App\Models\Project;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index()
    {
        $services = Project::with('MenuItem')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        $serviceTypes = MenuItem::where('status', 1)->get();
        return view('admin.services.create', compact('serviceTypes'));
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'name' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'status' => 'required|in:1,2',
            'home_visibility' => 'required|in:1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($validated['name']) . '-' . time() . '.' . $request->image->extension();
            $request->image->storeAs('projects', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        $service = Project::create($validated);

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
    public function show(Project $service)
    {
        $service->load('MenuItem', 'ProjectImages');
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Project $service)
    {
        $serviceTypes = MenuItem::where('status', 1)->where('type',1)->get();
        return view('admin.services.edit', compact('service', 'serviceTypes'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Project $service)
    {
        $validated = $request->validate([
            'menu_item_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'status' => 'required|in:1,2',
            'home_visibility' => 'required|in:1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($service->image && Storage::disk('public')->exists('projects/' . $service->image)) {
                Storage::disk('public')->delete('projects/' . $service->image);
            }
            
            $imageName = Str::slug($validated['name']) . '-' . time() . '.' . $request->image->extension();
            $request->image->storeAs('projects', $imageName, 'public');
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
    public function destroy(Request $request, Project $service)
    {
        // Delete service image if it exists
        if ($service->image && Storage::disk('public')->exists('projects/' . $service->image)) {
            Storage::disk('public')->delete('projects/' . $service->image);
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

    public function toggleHomeVisibility(Request $request, Project $blog)
    {
        $blog->update([
            'home_visibility' => $blog->home_visibility == 1 ? 2 : 1
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Toggled home visibility for project: ' . $blog->name,
            'ip_address' => $request->ip()
        ]);

        return response()->json(['success' => true]);
    }


    /**
     * Toggle status
     */
    public function toggleStatus(Request $request, Project $service)
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