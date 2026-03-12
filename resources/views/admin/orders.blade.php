@extends('layouts.admin')

@section('page-title', 'Orders Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-cart3 me-2"></i>All Orders</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-person-circle text-muted"></i>
                            {{ $order->name }}
                        </div>
                    </td>
                    <td>
                        <small>{{ $order->phone }}</small>
                    </td>
                    <td class="price">₹{{ number_format($order->total, 2) }}</td>
                    <td>
                        @if($order->payment_method == 'COD')
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-cash me-1"></i> COD
                        </span>
                        @else
                        <span class="badge bg-success">
                            <i class="bi bi-credit-card me-1"></i> Online
                        </span>
                        @endif
                    </td>
                    <td>
                        @if($order->status == 'pending')
                        <span class="status-badge pending">Pending</span>
                        @elseif($order->status == 'processing')
                        <span class="status-badge processing">Processing</span>
                        @elseif($order->status == 'completed')
                        <span class="status-badge completed">Completed</span>
                        @else
                        <span class="status-badge cancelled">{{ ucfirst($order->status) }}</span>
                        @endif
                    </td>
                    <td>
                        <small>{{ $order->created_at->format('d M Y') }}</small>
                    </td>
                    <td>
                        <a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-primary" title="View Details">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
