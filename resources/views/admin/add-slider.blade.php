@extends('layouts.admin')

@section('page-title', 'Add New Slider')

@section('content')

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-plus-circle me-2"></i>Add New Slider</h5>
    </div>
    <div class="card-body">
        <form action="/admin/sliders/store" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Slider Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter slider title" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="order" class="form-control" value="1" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" placeholder="Enter subtitle">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Link to Product (Optional)</label>
                <select name="product_id" class="form-select">
                    <option value="">Select a Product</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - ₹{{ $product->price }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Select a product to link this slider to. Customers will be redirected to this product when clicking the slider.</small>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Or Custom Link</label>
                <input type="text" name="link" class="form-control" placeholder="https://example.com">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Slider Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
                <small class="text-muted">Recommended size: 1920x600 pixels</small>
            </div>
            
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="status" class="form-check-input" id="status" value="1" checked>
                    <label class="form-check-label" for="status">Active</label>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Save Slider
                </button>
                <a href="/admin/sliders" class="btn btn-secondary">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
