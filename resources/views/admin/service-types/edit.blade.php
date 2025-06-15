@extends('layouts.admin')

@section('title', 'Edit Service Type')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Service Type</h1>
        <a href="{{ route('admin.service-types.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.service-types.update', $serviceType) }}" method="POST"  
            enctype="multipart/form-data"class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name" class="form-label">Service Type Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $serviceType->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $serviceType->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="icon" class="form-label">Icon</label>
                    @if($serviceType->icon)
                        <div class="mb-2">
                            <img src="{{ asset('storage/service_types/' . $serviceType->icon) }}" alt="{{ $serviceType->name }}" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" class="form-control image-input @error('icon') is-invalid @enderror" id="icon"
                     name="icon" data-preview="image-preview" accept="image/*">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="mt-2">
                        <img id="image-preview" src="#" alt="Preview" style="max-width: 100%; display: none;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Sub Title</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" 
                    name="subtitle" value="{{ old('subtitle', $serviceType->subtitle) }}" required>
                    @error('subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="1" {{ old('status', $serviceType->status) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="2" {{ old('status', $serviceType->status) == '2' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Service Type
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection