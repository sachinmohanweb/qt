@extends('layouts.admin')

@section('title', 'View Service Type')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Service Type Details</h1>
        <div>
            <a href="{{ route('admin.service-types.edit', $serviceType) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.service-types.index') }}" class="btn btn-outline-primary ms-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $serviceType->name }}</h4>
                <span class="badge badge-{{ $serviceType->status == 1 ? 'success' : 'secondary' }}">
                    {{ $serviceType->status == 1 ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <h5>Description</h5>
                <p>{{ $serviceType->description }}</p>
            </div>
            
            <h5>Service Type Information</h5>
            <table class="table">
                <tbody>
                    <tr>
                        <th style="width: 30%">Service Type ID</th>
                        <td>{{ $serviceType->id }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $serviceType->created_at->format('M d, Y g:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated</th>
                        <td>{{ $serviceType->updated_at->format('M d, Y g:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Services Count</th>
                        <td>{{ $serviceType->services->count() }} services</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    @if($serviceType->services->count() > 0)
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Related Services</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($serviceType->services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>
                                        <span class="badge badge-{{ $service->status == 1 ? 'success' : 'secondary' }}">
                                            {{ $service->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $service->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.services.show', $service) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection