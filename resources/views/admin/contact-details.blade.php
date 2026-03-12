@extends('layouts.admin')

@section('page-title', 'Message Details')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="bi bi-envelope-open me-2"></i>Message</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small">From</label>
                    <p class="mb-1 fw-medium">{{ $contact->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Email</label>
                    <p class="mb-1 fw-medium">{{ $contact->email }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Phone</label>
                    <p class="mb-1 fw-medium">{{ $contact->phone ?? 'N/A' }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Subject</label>
                    <p class="mb-1 fw-medium">{{ $contact->subject ?? 'No Subject' }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Date</label>
                    <p class="mb-1 fw-medium">{{ $contact->created_at->format('d M Y, h:i A') }}</p>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="text-muted small">Message</label>
                    <div class="p-3 bg-light rounded">
                        {{ $contact->message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="bi bi-gear me-2"></i>Actions</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small">Current Status</label>
                    <p class="mb-3">
                        @if($contact->status == 'unread')
                        <span class="badge bg-warning text-dark">Unread</span>
                        @elseif($contact->status == 'read')
                        <span class="badge bg-info">Read</span>
                        @else
                        <span class="badge bg-success">Replied</span>
                        @endif
                    </p>
                </div>
                
                <form action="/admin/contacts/{{ $contact->id }}/status" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Update Status</label>
                        <select name="status" class="form-select">
                            <option value="unread" {{ $contact->status == 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ $contact->status == 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $contact->status == 'replied' ? 'selected' : '' }}>Replied</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        <i class="bi bi-check-lg me-1"></i> Update Status
                    </button>
                </form>
                
                <a href="/admin/contacts/delete/{{ $contact->id }}" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this message?')">
                    <i class="bi bi-trash me-1"></i> Delete Message
                </a>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="/admin/contacts" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Messages
    </a>
</div>

@endsection
