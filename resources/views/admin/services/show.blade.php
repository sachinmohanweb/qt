@extends('layouts.admin')

@section('title', 'View Service')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Service Details</h1>
        <div>
            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary ms-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if($service->image)
                        <img src="{{ asset('storage/services/' . $service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 300px;">
                            <i class="fas fa-tools fa-4x text-secondary"></i>
                        </div>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="badge badge-primary">{{ $service->serviceType->name }}</span>
                        <span class="badge badge-{{ $service->status == 1 ? 'success' : 'secondary' }}">
                            {{ $service->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">{{ $service->name }}</h4>
                </div>
                <div class="card-body">
                    <h5>Service Information</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 30%">Service ID</th>
                                <td>{{ $service->id }}</td>
                            </tr>
                            <tr>
                                <th>Service Type</th>
                                <td>{{ $service->serviceType->name }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $service->created_at->format('M d, Y g:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $service->updated_at->format('M d, Y g:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Gallery Images</th>
                                <td>{{ $service->galleries->count() }} images</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($service->galleries->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Gallery Images</h4>
                            <a href="{{ route('admin.service-galleries.create') }}?service_id={{ $service->id }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Add Image
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($service->galleries as $gallery)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('storage/service-galleries/' . $gallery->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge badge-{{ $gallery->status == 1 ? 'success' : 'secondary' }}">
                                                    {{ $gallery->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.service-galleries.edit', $gallery) }}" class="btn btn-outline-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.service-galleries.destroy', $gallery) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger delete-confirm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-images fa-3x text-secondary mb-3"></i>
                        <h5>No Gallery Images</h5>
                        <p class="text-muted">This service doesn't have any gallery images yet.</p>
                        <a href="{{ route('admin.service-galleries.create') }}?service_id={{ $service->id }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Image
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection