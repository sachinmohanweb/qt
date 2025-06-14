@extends('layouts.admin')

@section('title', 'Edit Feedback')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Feedback</h1>
        <a href="{{ route('admin.feedback.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.feedback.update', $feedback) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $feedback->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $feedback->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject', $feedback->subject) }}" required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message', $feedback->message) }}</textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="new" {{ old('status', $feedback->status) == 'new' ? 'selected' : '' }}>New</option>
                        <option value="read" {{ old('status', $feedback->status) == 'read' ? 'selected' : '' }}>Read</option>
                        <option value="replied" {{ old('status', $feedback->status) == 'replied' ? 'selected' : '' }}>Replied</option>
                        <option value="archived" {{ old('status', $feedback->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="reply" class="form-label">Reply</label>
                    <textarea class="form-control rich-editor @error('reply') is-invalid @enderror" id="reply" name="reply" rows="5">{{ old('reply', $feedback->reply) }}</textarea>
                    @error('reply')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Feedback
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection