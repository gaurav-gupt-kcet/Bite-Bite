@extends('layouts.admin')

@section('page-title', 'Edit Category')

@section('content')

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-pencil-square me-2"></i>Edit Category</h5>
    </div>
    <div class="card-body">
        <form action="/admin/categories/update/{{ $category->id }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Update Category
                </button>
                <a href="/admin/categories" class="btn btn-secondary">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
