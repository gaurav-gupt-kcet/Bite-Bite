@extends('layouts.admin')

@section('page-title', 'Product Reviews')

@section('content')

<div class="admin-card">
    <div class="card-header">
        <h5><i class="bi bi-star"></i> Product Reviews</h5>
    </div>
    <div class="card-body">
        <!-- Search & Filter -->
        <div class="table-filters mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search reviews...">
                </div>
                <div class="col-md-3">
                    <select id="statusFilter" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" id="reviewsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Customer Name</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                    <tr>
                        <td>#{{ $review->id }}</td>
                        <td>
                            <div class="product-info">
                                <img src="/storage/{{ $review->product->image }}" alt="{{ $review->product->name }}" class="product-thumb">
                                <span>{{ $review->product->name }}</span>
                            </div>
                        </td>
                        <td>{{ $review->name }}</td>
                        <td>
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td>
                            <span class="comment-preview">{{ Str::limit($review->comment, 50) }}</span>
                        </td>
                        <td>
                            @if($review->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                            @elseif($review->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                            @else
                            <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $review->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                @if($review->status == 'pending')
                                <form action="/admin/reviews/{{ $review->id }}/status" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                                <form action="/admin/reviews/{{ $review->id }}/status" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger" title="Reject">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </form>
                                @else
                                <form action="/admin/reviews/{{ $review->id }}/status" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="pending">
                                    <button type="submit" class="btn btn-sm btn-secondary" title="Reset">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </button>
                                </form>
                                @endif
                                <form action="/admin/reviews/{{ $review->id }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-star"></i>
                                <h5>No Reviews Yet</h5>
                                <p>Customer reviews will appear here</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reviews->hasPages())
        <div class="pagination-wrapper">
            {{ $reviews->links() }}
        </div>
        @endif
    </div>
</div>

<style>
.product-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.product-thumb {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 6px;
}

.rating {
    color: #ffc107;
    font-size: 14px;
}

.comment-preview {
    max-width: 150px;
    display: block;
    font-size: 13px;
    color: #666;
}

.action-buttons {
    display: flex;
    gap: 5px;
}

.action-buttons .btn {
    padding: 4px 8px;
    font-size: 14px;
}

.empty-state {
    text-align: center;
    padding: 40px;
}

.empty-state i {
    font-size: 48px;
    color: #ddd;
    margin-bottom: 15px;
}

.empty-state h5 {
    color: #666;
    margin-bottom: 5px;
}

.empty-state p {
    color: #999;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
</style>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const table = document.getElementById('reviewsTable');
    const rows = table.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});

document.getElementById('statusFilter').addEventListener('change', function() {
    const statusValue = this.value.toLowerCase();
    const table = document.getElementById('reviewsTable');
    const rows = table.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const statusBadge = row.querySelector('.badge');
        if (statusBadge) {
            const rowStatus = statusBadge.textContent.toLowerCase().trim();
            if (!statusValue || rowStatus === statusValue) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});
</script>

@endsection
