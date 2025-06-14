@extends('layouts.admin')

@section('title', 'View Feedback')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Feedback Details</h1>
        <div>
            <a href="{{ route('admin.feedback.edit', $feedback) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.feedback.index') }}" class="btn btn-outline-primary ms-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $feedback->subject }}</h4>
                <span class="badge badge-{{ $feedback->status == 'new' ? 'primary' : ($feedback->status == 'read' ? 'secondary' : ($feedback->status == 'replied' ? 'success' : 'warning')) }}">
                    {{ ucfirst($feedback->status) }}
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>From:</strong> {{ $feedback->name }}</p>
                    <p><strong>Email:</strong> {{ $feedback->email }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p><strong>Date:</strong> {{ $feedback->created_at->format('M d, Y g:i A') }}</p>
                    <p><strong>ID:</strong> #{{ $feedback->id }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <h5>Message:</h5>
                <div class="p-3 bg-light rounded">
                    {{ $feedback->message }}
                </div>
            </div>
            
            @if($feedback->reply)
                <div class="mb-3">
                    <h5>Reply:</h5>
                    <div class="p-3 bg-light rounded">
                        {!! $feedback->reply !!}
                    </div>
                </div>
            @endif
            
            @if($feedback->status != 'replied' && !$feedback->reply)
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> This feedback hasn't been replied to yet. 
                    <a href="{{ route('admin.feedback.edit', $feedback) }}" class="alert-link">Add a reply</a>
                </div>
            @endif
        </div>
    </div>
@endsection