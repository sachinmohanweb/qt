@extends('layouts.admin')

@section('title', 'Create Menu Item')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create Menu Item</h1>
        <a href="{{ route('admin.service-types.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.service-types.store') }}" method="POST" enctype="multipart/form-data"
            class="needs-validation" novalidate>
                @csrf
                

                 <div class="form-group">
                    <label for="status" class="form-label">Type</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="type" name="type" required>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Project</option>
                        <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Video</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Item Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
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
                
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Menu Item
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection