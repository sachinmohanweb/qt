@extends('layouts.admin')

@section('title', 'Edit Gallery Image')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Gallery Image</h1>
        <a href="{{ route('admin.service-galleries.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.service-galleries.update', $serviceGallery) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="service_id" class="form-label">Service</label>
                            <select class="form-select @error('service_id') is-invalid @enderror" id="service_id" name="service_id" required>
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id', $serviceGallery->service_id) == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} ({{ $service->serviceType->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="1" {{ old('status', $serviceGallery->status) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="2" {{ old('status', $serviceGallery->status) == '2' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="images" class="form-label">Gallery Images</label>
                    @if($serviceGallery->image)
                        <div class="mb-3">
                            <label class="form-label">Current Image:</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="{{ asset('storage/service-galleries/' . $serviceGallery->image) }}" alt="Current Image" class="card-img-top" style="height: 150px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <small class="text-muted">Current Image</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <input type="file" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" id="images" name="images[]" accept="image/*" multiple>
                    @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Leave empty to keep current image, or select new images to replace. You can select multiple images.</small>
                    
                    <div class="mt-3" id="image-previews">
                        <!-- Image previews will be shown here -->
                    </div>
                </div>
                
                <div class="form-group mt-4 mb-0">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Gallery Image
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.getElementById('images').addEventListener('change', function(e) {
    const previewContainer = document.getElementById('image-previews');
    previewContainer.innerHTML = '';
    
    if (e.target.files.length > 0) {
        const files = Array.from(e.target.files);
        
        files.forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'col-md-3 mb-3';
                    previewDiv.innerHTML = `
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body p-2">
                                <small class="text-muted">New Image ${index + 1}</small>
                            </div>
                        </div>
                    `;
                    
                    if (index === 0) {
                        previewContainer.innerHTML = '<div class="row"></div>';
                    }
                    previewContainer.querySelector('.row').appendChild(previewDiv);
                };
                
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endpush