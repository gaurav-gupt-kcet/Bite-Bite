@extends('layouts.admin')

@section('page-title', 'Edit User')

@section('content')

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-person-edit me-2"></i>Edit User</h5>
    </div>
    <div class="card-body">
        <form action="/admin/users/update/{{ $user->id }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Update User
                </button>
                <a href="/admin/users" class="btn btn-secondary">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
