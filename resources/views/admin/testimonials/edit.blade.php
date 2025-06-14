@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Testimonial</h1>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $testimonial->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $testimonial->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="star_rating" class="form-label">Star Rating</label>
                            <select class="form-select @error('star_rating') is-invalid @enderror" id="star_rating" name="star_rating" required>
                                <option value="">Select Rating</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('star_rating', $testimonial->star_rating) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                            @error('star_rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="home_visibility" class="form-label">Home Visibility</label>
                            <select class="form-select @error('home_visibility') is-invalid @enderror" id="home_visibility" name="home_visibility" required>
                                <option value="1" {{ old('home_visibility', $testimonial->home_visibility) == '1' ? 'selected' : '' }}>Visible</option>
                                <option value="2" {{ old('home_visibility', $testimonial->home_visibility) == '2' ? 'selected' : '' }}>Hidden</option>
                            </select>
                            @error('home_visibility')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="1" {{ old('status', $testimonial->status) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="2" {{ old('status', $testimonial->status) == '2' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            @if($testimonial->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/testimonials/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="img-thumbnail" style="max-height: 150px;">
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
                        <i class="fas fa-save"></i> Update Testimonial
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection