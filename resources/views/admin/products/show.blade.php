@extends('layouts.admin')

@section('title', 'View Product')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Product Details</h1>
        <div>
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary ms-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if($product->image)
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 300px;">
                            <i class="fas fa-image fa-4x text-secondary"></i>
                        </div>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h4 class="mb-0">{{ $product->formatted_price }}</h4>
                        <span class="badge badge-{{ $product->status == 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">{{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <h5>Description</h5>
                    <div class="mb-4">
                        {!! $product->description !!}
                    </div>
                    
                    <h5>Product Information</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 30%">Product ID</th>
                                <td>{{ $product->id }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $product->created_at->format('M d, Y g:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $product->updated_at->format('M d, Y g:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection