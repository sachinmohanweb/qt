@extends('layouts.admin')

@section('title', 'View Testimonial')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Testimonial Details</h1>
        <div>
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-primary ms-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if($testimonial->image)
                        <img src="{{ asset('storage/testimonials/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="img-fluid rounded-circle mb-3" style="max-height: 200px; width: 200px; object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light rounded-circle mx-auto mb-3" style="height: 200px; width: 200px;">
                            <i class="fas fa-user fa-4x text-secondary"></i>
                        </div>
                    @endif
                    
                    <h4>{{ $testimonial->name }}</h4>
                    <div class="star-rating mb-3">
                        {!! $testimonial->star_rating_html !!}
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge badge-{{ $testimonial->home_visibility == 1 ? 'success' : 'secondary' }}">
                            {{ $testimonial->home_visibility == 1 ? 'Visible on Home' : 'Hidden from Home' }}
                        </span>
                        <span class="badge badge-{{ $testimonial->status == 1 ? 'success' : 'secondary' }}">
                            {{ $testimonial->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Testimonial Content</h4>
                </div>
                <div class="card-body">
                    <h5>Description</h5>
                    <div class="mb-4">
                        <p>{{ $testimonial->description }}</p>
                    </div>
                    
                    <h5>Details</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 30%">ID</th>
                                <td>{{ $testimonial->id }}</td>
                            </tr>
                            <tr>
                                <th>Star Rating</th>
                                <td>{{ $testimonial->star_rating }} out of 5</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $testimonial->created_at->format('M d, Y g:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $testimonial->updated_at->format('M d, Y g:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection