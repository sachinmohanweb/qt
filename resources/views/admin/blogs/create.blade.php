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
                            <div id="editor-container">
                                <div id="editor"></div>
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
<style>
/* CKEditor Container Styling */
#editor-container {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    background: white;
    min-height: 400px;
}

#editor-container.focused {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* CKEditor Toolbar Styling */
.ck-toolbar {
    border: none !important;
    border-bottom: 1px solid #e5e7eb !important;
    border-radius: 8px 8px 0 0 !important;
    background: #f9fafb !important;
}

/* CKEditor Content Area */
.ck-content {
    border: none !important;
    border-radius: 0 0 8px 8px !important;
    min-height: 350px !important;
    padding: 20px !important;
    font-size: 16px !important;
    line-height: 1.6 !important;
    color: #374151 !important;
    background: white !important;
}

/* Fix text visibility issues */
.ck-content p {
    color: #374151 !important;
    margin: 0 0 1em 0 !important;
}

.ck-content h1, .ck-content h2, .ck-content h3, 
.ck-content h4, .ck-content h5, .ck-content h6 {
    color: #1f2937 !important;
    font-weight: bold !important;
}

.ck-content ul, .ck-content ol {
    color: #374151 !important;
    padding-left: 2em !important;
}

.ck-content blockquote {
    color: #6b7280 !important;
    border-left: 4px solid #e5e7eb !important;
    padding-left: 1em !important;
    margin: 1em 0 !important;
    font-style: italic !important;
}

/* Placeholder styling */
.ck-placeholder {
    color: #9ca3af !important;
    font-style: italic !important;
}

/* Focus outline */
.ck-focused {
    outline: none !important;
    box-shadow: none !important;
}

/* Image styling within editor */
.ck-content .image {
    margin: 1em 0 !important;
}

.ck-content .image img {
    max-width: 100% !important;
    height: auto !important;
    border-radius: 4px !important;
}
</style>
@endpush


@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let editor;
    
    const descriptionTextarea = document.getElementById('description');
    const initialContent = descriptionTextarea.value || '';
    
    // Custom upload adapter
    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    const data = new FormData();
                    data.append('upload', file);
                    data.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                    fetch('/admin/blogs/upload-image', {
                        method: 'POST',
                        body: data,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            resolve({
                                default: result.url
                            });
                        } else {
                            reject(result.message || 'Upload failed');
                        }
                    })
                    .catch(error => {
                        reject('Upload failed: ' + error.message);
                    });
                }));
        }

        abort() {
            // Handle upload abort
        }
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    // Initialize CKEditor with image upload
    ClassicEditor
        .create(document.querySelector('#editor'), {
            extraPlugins: [MyCustomUploadAdapterPlugin],
            toolbar: [
                'heading',
                '|',
                'bold', 'italic', 'underline', 'strikethrough',
                '|',
                'fontSize', 'fontColor', 'fontBackgroundColor',
                '|',
                'numberedList', 'bulletedList',
                '|',
                'outdent', 'indent',
                '|',
                'alignment',
                '|',
                'blockQuote', 'codeBlock',
                '|',
                'link', 'imageUpload', 'insertTable', 'mediaEmbed',
                '|',
                'undo', 'redo',
                '|',
                'sourceEditing'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                ]
            },
            fontSize: {
                options: [
                    'tiny', 'small', 'default', 'big', 'huge'
                ]
            },
            alignment: {
                options: ['left', 'center', 'right', 'justify']
            },
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:inline',
                    'imageStyle:block',
                    'imageStyle:side',
                    '|',
                    'imageStyle:alignLeft',
                    'imageStyle:alignCenter',
                    'imageStyle:alignRight'
                ],
                styles: [
                    'full',
                    'side',
                    'alignLeft',
                    'alignCenter',
                    'alignRight'
                ]
            },
            placeholder: 'Write your blog content here...'
        })
        .then(newEditor => {
            editor = newEditor;
            
            // Set initial content
            if (initialContent) {
                editor.setData(initialContent);
            }
            
            // Focus styling
            editor.ui.focusTracker.on('change:isFocused', (evt, name, isFocused) => {
                const container = document.getElementById('editor-container');
                if (isFocused) {
                    container.classList.add('focused');
                } else {
                    container.classList.remove('focused');
                }
            });
            
            // Update hidden textarea on content change
            editor.model.document.on('change:data', () => {
                descriptionTextarea.value = editor.getData();
            });
            
            // Set initial textarea value
            descriptionTextarea.value = editor.getData();
        })
        .catch(error => {
            console.error('Error initializing CKEditor:', error);
            descriptionTextarea.style.display = 'block';
            document.getElementById('editor-container').style.display = 'none';
        });

    // Form submission handler
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (editor) {
                descriptionTextarea.value = editor.getData();
            }
        });
    }
});
</script>
@endpush
