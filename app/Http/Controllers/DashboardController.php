<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     */
    public function index()
    {
        // Get counts for dashboard statistics
        $stats = [
            'users_count' => User::count(),
            'testimonial_count' => Testimonial::count(),
            'blogs_count' => Blog::count(),
        ];
        
        // Get recent activity logs
        $recentActivity = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        // Get recent feedback
        $recentTestimonial = Testimonial::orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentActivity', 'recentTestimonial'));
    }
}