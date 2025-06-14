@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['users_count'] }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-comment"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['testimonial_count'] }}</div>
                <div class="stat-label">Testimonial Received</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['blogs_count'] }}</div>
                <div class="stat-label">Blogs</div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Recent Activity</h4>
                </div>
                <div class="card-body">
                    @if($recentActivity->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead style="background-color: #f1f5f9;">
                                    <tr>
                                        <th>User</th>
                                        <th>Action</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentActivity as $activity)
                                        <tr>
                                            <td>{{ $activity->user->name }}</td>
                                            <td>
                                                <span class="badge badge-{{ $activity->action == 'login' ? 'primary' : ($activity->action == 'create' ? 'success' : ($activity->action == 'delete' ? 'danger' : 'secondary')) }}">
                                                    {{ ucfirst($activity->action) }}
                                                </span>
                                            </td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ $activity->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted">No recent activity</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Recent Testimonial</h4>
                </div>
                <div class="card-body" style="padding-top: 48px;">
                    @if($recentTestimonial->count() > 0)
                        @foreach($recentTestimonial as $test)
                             <div class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge 
                                        {{ 
                                            $test->star_rating == 5 ? 'badge-success' : 
                                            ($test->star_rating == 4 ? 'badge-primary' : 
                                            ($test->star_rating == 3 ? 'badge-info' : 
                                            ($test->star_rating == 2 ? 'badge-warning' : 
                                            'badge-danger')))
                                        }}">
                                        {{ $test->star_rating }} Star{{ $test->star_rating > 1 ? 's' : '' }}
                                    </span>
                                </div>
                                <p class="mb-1">{{ Str::limit($test->description, 100) }}</p>
                                <small class="text-muted">From: {{ $test->name }} - {{ $test->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted">No recent test</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-primary btn-sm">View All Testimonials</a>
                </div>
            </div>
        </div>
    </div>
@endsection