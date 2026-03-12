@extends('layouts.admin')

@section('page-title', 'Add New Category')

@section('content')

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-plus-circle me-2"></i>Add New Category</h5>
    </div>
    <div class="card-body">
        <form action="/admin/categories/store" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Save Category
                </button>
                <a href="/admin/categories" class="btn btn-secondary">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
