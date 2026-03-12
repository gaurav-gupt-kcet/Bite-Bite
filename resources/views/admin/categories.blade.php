@extends('layouts.admin')

@section('page-title', 'Categories Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-tags me-2"></i>All Categories</h5>
        <a href="/admin/categories/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Category
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td><strong>#{{ $category->id }}</strong></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-folder-fill text-warning"></i>
                            <span class="fw-medium">{{ $category->name }}</span>
                        </div>
                    </td>
                    <td><code>{{ $category->slug }}</code></td>
                    <td>
                        <span class="badge bg-secondary">{{ $category->products ? $category->products->count() : 0 }} products</span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/admin/categories/edit/{{ $category->id }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="/admin/categories/delete/{{ $category->id }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this category?')">
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
