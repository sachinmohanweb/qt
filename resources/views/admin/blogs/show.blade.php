@extends('layouts.admin')

@section('title', 'View Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Blog Details</h1>
        <div>
            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-primary ms-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    @if($blog->image)
                        <img src="{{ asset('storage/blogs/' . $blog->image) }}" alt="{{ $blog->heading }}" class="img-fluid rounded mb-3">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light rounded mb-3" style="height: 200px;">
                            <i class="fas fa-image fa-4x text-secondary"></i>
                        </div>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge badge-{{ $blog->home_visibility == 1 ? 'success' : 'secondary' }}">
                            {{ $blog->home_visibility == 1 ? 'Visible on Home' : 'Hidden from Home' }}
                        </span>
                        <span class="badge badge-{{ $blog->status == 1 ? 'success' : 'secondary' }}">
                            {{ $blog->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th>Author</th>
                                <td>{{ $blog->user_name }}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{ $blog->date->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td><code>{{ $blog->slug }}</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">{{ $blog->heading }}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="blog-content">
                            {!! $blog->description !!}
                        </div>
                    </div>
                    
                    <h5>Blog Information</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 30%">Blog ID</th>
                                <td>{{ $blog->id }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $blog->created_at->format('M d, Y g:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $blog->updated_at->format('M d, Y g:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.blog-content {
    line-height: 1.8;
    font-size: 1.1rem;
}
.blog-content h1, .blog-content h2, .blog-content h3, 
.blog-content h4, .blog-content h5, .blog-content h6 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    font-weight: 600;
}
.blog-content p {
    margin-bottom: 1rem;
}
.blog-content ul, .blog-content ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}
.blog-content blockquote {
    border-left: 4px solid var(--primary);
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    background-color: var(--background);
    padding: 1rem;
    border-radius: var(--radius-sm);
}
.blog-content img {
    max-width: 100%;
    height: auto;
    border-radius: var(--radius-sm);
    margin: 1rem 0;
}
.blog-content code {
    background-color: var(--background);
    padding: 0.2rem 0.4rem;
    border-radius: var(--radius-sm);
    font-size: 0.9rem;
}
.blog-content pre {
    background-color: var(--background);
    padding: 1rem;
    border-radius: var(--radius-sm);
    overflow-x: auto;
    margin: 1rem 0;
}
</style>
@endpush