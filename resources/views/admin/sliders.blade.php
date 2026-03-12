@extends('layouts.admin')

@section('page-title', 'Sliders Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-images me-2"></i>All Sliders</h5>
        <a href="/admin/sliders/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Slider
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Slider Image</th>
                    <th>Title</th>
                    <th>Linked Product</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $slider)
                <tr>
                    <td><strong>#{{ $slider->id }}</strong></td>
                    <td>
                        <img src="/storage/{{ $slider->image }}" class="product-img" alt="Slider">
                    </td>
                    <td>
                        <span class="fw-medium">{{ $slider->title }}</span>
                    </td>
                    <td>
                        @if($slider->product)
                        <a href="/product/{{ $slider->product->id }}" target="_blank" class="text-decoration-none">
                            {{ $slider->product->name }}
                            <i class="bi bi-box-arrow-up-right ms-1"></i>
                        </a>
                        @else
                        <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ $slider->order }}</span>
                    </td>
                    <td>
                        @if($slider->status)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/admin/sliders/edit/{{ $slider->id }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="/admin/sliders/delete/{{ $slider->id }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this slider?')">
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
