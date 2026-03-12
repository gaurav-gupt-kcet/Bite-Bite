@extends('layouts.admin')

@section('page-title', 'Add New Product')

@section('content')

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-plus-circle me-2"></i>Add New Product</h5>
    </div>
    <div class="card-body">
        <form action="/admin/products/store" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Enter product description"></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Original Price (₹)</label>
                        <input type="number" name="original_price" class="form-control" placeholder="999" step="0.01">
                        <small class="text-muted">MRP before discount</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Offer Price (₹)</label>
                        <input type="number" name="offer_price" class="form-control" placeholder="299" step="0.01">
                        <small class="text-muted">Selling price to show</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Base Price (₹)</label>
                        <input type="number" name="price" class="form-control" placeholder="299" step="0.01" required>
                        <small class="text-muted">For calculations</small>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Save Product
                </button>
                <a href="/admin/products" class="btn btn-secondary">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
