@extends('layouts.admin')

@section('title', 'View Project Image')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Project Image Details</h1>
        <div>
            <a href="{{ route('admin.service-galleries.edit', $serviceGallery) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.service-galleries.index') }}" class="btn btn-outline-primary ms-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ asset('storage/project_images/' . $serviceGallery->image) }}" alt="Gallery Image" class="img-fluid rounded" style="max-height: 400px;">
                    
                    <div class="mt-3">
                        <span class="badge badge-{{ $serviceGallery->status == 1 ? 'success' : 'secondary' }}">
                            {{ $serviceGallery->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Gallery Information</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 40%">Gallery ID</th>
                                <td>{{ $serviceGallery->id }}</td>
                            </tr>
                            <tr>
                                <th>Service</th>
                                <td>{{ $serviceGallery->Project->name }}</td>
                            </tr>
                            <tr>
                                <th>Service Type</th>
                                <td>{{ $serviceGallery->Project->MenuItem->name }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge badge-{{ $serviceGallery->status == 1 ? 'success' : 'secondary' }}">
                                        {{ $serviceGallery->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $serviceGallery->created_at->format('M d, Y g:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $serviceGallery->updated_at->format('M d, Y g:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        <h5>Related Service</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    @if($serviceGallery->Project->image)
                                        <img src="{{ asset('storage/projects/' . $serviceGallery->Project->image) }}" alt="{{ $serviceGallery->Project->name }}" style="height: 50px; width: 50px; object-fit: cover; border-radius: 4px;" class="me-3">
                                    @endif
                                    <div>
                                        <h6 class="mb-1">{{ $serviceGallery->Project->name }}</h6>
                                        <small class="text-muted">{{ $serviceGallery->Project->MenuItem->name }}</small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('admin.services.show', $serviceGallery->Project) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View Project
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection