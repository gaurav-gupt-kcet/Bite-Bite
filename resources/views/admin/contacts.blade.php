@extends('layouts.admin')

@section('page-title', 'Messages Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-envelope me-2"></i>All Messages</h5>
    </div>
    <div class="card-body">
        <!-- Filter Form -->
        <form method="GET" action="/admin/contacts" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Messages</option>
                        <option value="unread" {{ $status == 'unread' ? 'selected' : '' }}>Unread</option>
                        <option value="read" {{ $status == 'read' ? 'selected' : '' }}>Read</option>
                        <option value="replied" {{ $status == 'replied' ? 'selected' : '' }}>Replied</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr class="{{ $contact->status == 'unread' ? 'table-warning' : '' }}">
                    <td>
                        @if($contact->status == 'unread')
                        <span class="badge bg-warning text-dark">Unread</span>
                        @elseif($contact->status == 'read')
                        <span class="badge bg-info">Read</span>
                        @else
                        <span class="badge bg-success">Replied</span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $contact->name }}</strong>
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->subject ?? 'No Subject' }}</td>
                    <td>{{ $contact->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/admin/contacts/{{ $contact->id }}" class="btn btn-sm btn-primary" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="/admin/contacts/delete/{{ $contact->id }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this message?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No messages found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
@if($contacts->hasPages())
<div class="mt-4">
    {{ $contacts->links() }}
</div>
@endif

@endsection
