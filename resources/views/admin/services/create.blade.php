@extends('layouts.admin')

@section('title', 'Create Project')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create Project</h1>
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name" class="form-label">Project Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Sub Title</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" 
                            name="subtitle" value="{{ old('subtitle') }}" >
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="menu_item_id" class="form-label">Service Type</label>
                            <select class="form-select @error('type_id') is-invalid @enderror" id="menu_item_id" name="menu_item_id" required>
                                <option value="">Select Service Type</option>
                                @foreach($serviceTypes as $serviceType)
                                    <option value="{{ $serviceType->id }}" {{ old('menu_item_id') == $serviceType->id ? 'selected' : '' }}>
                                        {{ $serviceType->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('menu_item_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="home_visibility" class="form-label">Home Visibility</label>
                            <select class="form-select @error('home_visibility') is-invalid @enderror" id="home_visibility" name="home_visibility" required>
                                <option value="1" {{ old('home_visibility') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="2" {{ old('home_visibility') == '2' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('home_visibility')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="image" class="form-label">Project Image</label>
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
                        <i class="fas fa-save"></i> Save Service
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection