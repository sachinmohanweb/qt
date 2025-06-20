@extends('layouts.admin')

@section('title', 'Create Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create Blog</h1>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" 
            id="blog-form"  class="needs-validation" novalidate>
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="heading" class="form-label">Blog Heading</label>
                            <input type="text" class="form-control @error('heading') is-invalid @enderror" id="heading" name="heading" value="{{ old('heading') }}" required>
                            @error('heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Slug will be auto-generated from the heading</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="user_name" class="form-label">Author Name</label>
                            <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" value="{{ old('user_name') }}" required>
                            @error('user_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <div id="editor-container" style="height: 400px;">
                                <div id="editor">{!! old('description') !!}</div>
                            </div>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                            style="display: none !important;"
                            id="description" name="description" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date" class="form-label">Blog Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="home_visibility" class="form-label">Home Visibility</label>
                            <select class="form-select @error('home_visibility') is-invalid @enderror" id="home_visibility" name="home_visibility" required>
                                <option value="1" {{ old('home_visibility') == '1' ? 'selected' : '' }}>Visible</option>
                                <option value="2" {{ old('home_visibility') == '2' ? 'selected' : '' }}>Hidden</option>
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
                            <label for="image" class="form-label">Blog Image (Optional)</label>
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
                        <i class="fas fa-save"></i> Save Blog
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
#editor-container {
    border: 2px solid var(--border);
    border-radius: var(--radius-md);
}
#editor-container.focused {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(10, 132, 255, 0.1);
}
.ql-toolbar {
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: 1px solid var(--border);
    border-radius: var(--radius-md) var(--radius-md) 0 0;
}
.ql-container {
    border: none;
    border-radius: 0 0 var(--radius-md) var(--radius-md);
    height: 89%;
}
.ql-editor {
    min-height: 300px;
    font-size: 1rem;
    line-height: 1.6;
}
.ql-container.ql-snow {
    border: 0px solid #ccc;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'align': [] }],
                ['blockquote', 'code-block'],
                ['link', 'image'],
                ['clean']
            ]
        },
        placeholder: 'Write your blog content here...'
    });

    // Focus styling
    quill.on('selection-change', function(range) {
        const container = document.getElementById('editor-container');
        if (range) {
            container.classList.add('focused');
        } else {
            container.classList.remove('focused');
        }
    });

    // Update hidden textarea when form is submitted
    const form = document.getElementById('blog-form');
    form.addEventListener('submit', function() {
        const description = document.getElementById('description');
        description.value = quill.root.innerHTML;
    });

    // Update editor content when textarea changes (for validation errors)
    const description = document.getElementById('description');
    if (description.value) {
        quill.root.innerHTML = description.value;
    }
});
</script>
@endpush