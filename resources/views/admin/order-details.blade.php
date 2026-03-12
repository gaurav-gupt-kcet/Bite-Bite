@extends('layouts.admin')

@section('page-title', 'Order Details')

@section('content')

<div class="row">
    <!-- Order Information -->
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="bi bi-person me-2"></i>Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small">Customer Name</label>
                    <p class="mb-1 fw-medium">{{ $order->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Phone Number</label>
                    <p class="mb-1 fw-medium">{{ $order->phone }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Delivery Address</label>
                    <p class="mb-1 fw-medium">{{ $order->address }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Order Date</label>
                    <p class="mb-1 fw-medium">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>
        </div>
        
        <!-- Payment Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="bi bi-credit-card me-2"></i>Payment Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small">Payment Method</label>
                    <p class="mb-1 fw-medium">
                        @if($order->payment_method == 'COD')
                        <span class="badge bg-warning text-dark"><i class="bi bi-cash me-1"></i> Cash On Delivery</span>
                        @elseif($order->payment_method == 'UPI')
                        <span class="badge bg-info"><i class="bi bi-phone me-1"></i> UPI</span>
                        @elseif($order->payment_method == 'Card')
                        <span class="badge bg-primary"><i class="bi bi-credit-card me-1"></i> Card</span>
                        @elseif($order->payment_method == 'Netbanking')
                        <span class="badge bg-secondary"><i class="bi bi-bank me-1"></i> Net Banking</span>
                        @else
                        {{ $order->payment_method }}
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Order Total</label>
                    <p class="mb-1 fw-bold text-primary" style="font-size: 1.5rem;">₹{{ number_format($order->total, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Status & Items -->
    <div class="col-lg-6">
        <!-- Update Status -->
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="bi bi-arrow-repeat me-2"></i>Update Order Status</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small">Current Status</label>
                    <p class="mb-3">
                        @if($order->status == 'pending')
                        <span class="status-badge pending">Pending</span>
                        @elseif($order->status == 'processing')
                        <span class="status-badge processing">Processing</span>
                        @elseif($order->status == 'shipped')
                        <span class="badge bg-info">Shipped</span>
                        @elseif($order->status == 'delivered')
                        <span class="status-badge completed">Delivered</span>
                        @else
                        <span class="status-badge cancelled">{{ ucfirst($order->status) }}</span>
                        @endif
                    </p>
                </div>
                <form action="/admin/orders/{{ $order->id }}/status" method="POST">
                    @csrf
                    <div class="d-flex gap-2">
                        <select name="status" class="form-select">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Order Items -->
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-bag me-2"></i>Order Items</h5>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>₹{{ $item->price }}</td>
                            <td>₹{{ $item->qty * $item->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="/admin/orders" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Orders
    </a>
</div>

@endsection
