@extends('layouts.admin')

@section('title', 'Project Image Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Project Image Management</h1>
        <a href="{{ route('admin.service-galleries.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Project Image
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success fade-in">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">All Project Images</h4>
                <div class="d-flex gap-2">
                    <select id="type-filter" class="form-select form_select" style="width: 200px;">
                        <option value="">All Menu Items</option>
                        @foreach(\App\Models\MenuItem::where('status', 1)->where('type',1)->get() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="service-galleries-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Project</th>
                            <th>Menu Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('assets/js/datatables.js') }}"></script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush