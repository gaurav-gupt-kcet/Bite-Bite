@extends('layouts.admin')

@section('page-title', 'Products Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-bag me-2"></i>All Products</h5>
        <a href="/admin/products/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Product
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Original Price</th>
                    <th>Offer Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td><strong>#{{ $product->id }}</strong></td>
                    <td>
                        <div class="product-info">
                            <span class="product-name">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-info">{{ $product->category ? $product->category->name : 'N/A' }}</span>
                    </td>
                    <td class="price">
                        @if($product->original_price)
                        <del class="text-muted">₹{{ number_format($product->original_price, 2) }}</del>
                        @else
                        -
                        @endif
                    </td>
                    <td class="price">
                        @if($product->offer_price)
                        <span class="text-danger fw-bold">₹{{ number_format($product->offer_price, 2) }}</span>
                        @else
                        ₹{{ number_format($product->price, 2) }}
                        @endif
                    </td>
                    <td>
                        <img src="/storage/{{ $product->image }}" class="product-img" alt="{{ $product->name }}">
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/admin/products/edit/{{ $product->id }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="/admin/products/delete/{{ $product->id }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
