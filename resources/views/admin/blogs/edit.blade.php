@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Blog</h1>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="heading" class="form-label">Blog Heading</label>
                            <input type="text" class="form-control @error('heading') is-invalid @enderror" id="heading" name="heading" value="{{ old('heading', $blog->heading) }}" required>
                            @error('heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Current slug: {{ $blog->slug }}</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="user_name" class="form-label">Author Name</label>
                            <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" value="{{ old('user_name', $blog->user_name) }}" required>
                            @error('user_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="8" required>{{ old('description', $blog->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date" class="form-label">Blog Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $blog->date->format('Y-m-d')) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="home_visibility" class="form-label">Home Visibility</label>
                            <select class="form-select @error('home_visibility') is-invalid @enderror" id="home_visibility" name="home_visibility" required>
                                <option value="1" {{ old('home_visibility', $blog->home_visibility) == '1' ? 'selected' : '' }}>Visible</option>
                                <option value="2" {{ old('home_visibility', $blog->home_visibility) == '2' ? 'selected' : '' }}>Hidden</option>
                            </select>
                            @error('home_visibility')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="1" {{ old('status', $blog->status) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="2" {{ old('status', $blog->status) == '2' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="image" class="form-label">Blog Image (Optional)</label>
                            @if($blog->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/blogs/' . $blog->image) }}" alt="{{ $blog->heading }}" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                            <input type="file" class="form-control image-input @error('image') is-invalid @enderror" id="image" name="image" data-preview="image-preview" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <img id="image-preview" src="#" alt="Preview" style="max-width: 100%; display: none;">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-4 mb-0">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Blog
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection