@extends('layouts.admin')

@section('title', 'Feedback Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Feedback Management</h1>
        <a href="{{ route('admin.feedback.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Feedback
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
                <h4 class="mb-0">All Feedback</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="feedback-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Date</th>
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