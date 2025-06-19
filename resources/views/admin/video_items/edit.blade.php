@extends('layouts.admin')

@section('title', 'Edit Project Image')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Project Image</h1>
        <a href="{{ route('admin.service-galleries.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.service-galleries.update', $serviceGallery) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="form-group col-md-4">
                    <label for="service_id" class="form-label">Video Source Type</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" 
                    name="type" required>
                        <option value="">Select Type</option>
                            <option value="link" {{ old('type') == 'link' ? 'selected' : '' }}>Link</option>
                            <!-- <option value="link">File</option> -->
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="status" class="form-label">Home Visibility</label>
                    <select class="form-select @error('home_visibility') is-invalid @enderror" id="home_visibility" name="home_visibility" required>
                        <option value="1" {{ old('home_visibility') == '1' ? 'selected' : '' }}>Show</option>
                        <option value="2" {{ old('home_visibility') == '2' ? 'selected' : '' }}>Hide</option>
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
                        <label for="name" class="form-label">Link</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="link_path" name="link_path" value="{{ old('link_path') }}" required>
                        @error('link_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="images" class="form-label">Video Thumb</label>
                    <input type="file" class="form-control @error('thumb') is-invalid @enderror @error('thumb.*') is-invalid @enderror" id="thumb" name="thumb" accept="image/*" required>
                    @error('thumb')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                        
                    <div class="mt-3" id="image-previews">
                        <!-- Image previews will be shown here -->
                    </div>
                </div>
                
                <div class="form-group mt-4 mb-0">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Video
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