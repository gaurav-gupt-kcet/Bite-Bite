@extends('layouts.admin')

@section('page-title', 'Analytics')

@section('content')

<style>
.analytics-header {
    background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
    padding: 25px;
    border-radius: 15px;
    color: white;
    margin-bottom: 30px;
}
.analytics-header h2 { margin: 0; font-size: 1.5rem; }
.analytics-header p { margin: 5px 0 0; opacity: 0.9; }

.metric-card {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}
.metric-card:hover { transform: translateY(-5px); }
.metric-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
}
.metric-card.primary .metric-icon { background: rgba(255, 107, 53, 0.1); color: #ff6b35; }
.metric-card.success .metric-icon { background: rgba(40, 167, 69, 0.1); color: #28a745; }
.metric-card.info .metric-icon { background: rgba(23, 162, 184, 0.1); color: #17a2b8; }
.metric-card.warning .metric-icon { background: rgba(255, 193, 7, 0.1); color: #ffc107; }
.metric-value { font-size: 1.8rem; font-weight: 700; margin: 5px 0; }
.metric-label { color: #666; font-size: 0.9rem; }

.status-box {
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    background: #f8f9fa;
}
.status-box h3 { font-size: 2rem; margin: 0; }
.status-box.status-pending { background: rgba(255, 193, 7, 0.15); color: #856404; }
.status-box.status-processing { background: rgba(23, 162, 184, 0.15); color: #138496; }
.status-box.status-completed { background: rgba(40, 167, 69, 0.15); color: #28a745; }
.status-box.status-cancelled { background: rgba(220, 53, 69, 0.15); color: #dc3545; }

.chart-box {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}
.chart-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
}

.product-list-item {
    display: flex;
    align-items: center;
    padding: 12px;
    border-bottom: 1px solid #eee;
}
.product-list-item:last-child { border-bottom: none; }
.product-thumb {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 12px;
}
.product-details { flex: 1; }
.product-name { font-weight: 600; color: #333; }
.product-sold { font-size: 0.85rem; color: #28a745; }

.badge-sell { padding: 5px 10px; border-radius: 15px; font-size: 0.8rem; }
.badge-high { background: rgba(40, 167, 69, 0.15); color: #28a745; }
.badge-low { background: rgba(220, 53, 69, 0.15); color: #dc3545; }
</style>

<!-- Header -->
<div class="analytics-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-graph-up-arrow"></i> Analytics Dashboard</h2>
            <p>Track your store performance and user behavior</p>
        </div>
    </div>
</div>

<!-- Key Metrics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="metric-card">
            <div class="d-flex align-items-center">
                <div class="metric-icon"><i class="bi bi-cart3"></i></div>
                <div>
                    <div class="metric-label">Total Orders</div>
                    <div class="metric-value">{{ $totalOrders }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric-card">
            <div class="d-flex align-items-center">
                <div class="metric-icon success"><i class="bi bi-currency-rupee"></i></div>
                <div>
                    <div class="metric-label">Total Revenue</div>
                    <div class="metric-value">₹{{ number_format($totalRevenue) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric-card">
            <div class="d-flex align-items-center">
                <div class="metric-icon info"><i class="bi bi-people"></i></div>
                <div>
                    <div class="metric-label">Total Users</div>
                    <div class="metric-value">{{ $totalUsers }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric-card">
            <div class="d-flex align-items-center">
                <div class="metric-icon warning"><i class="bi bi-cart-check"></i></div>
                <div>
                    <div class="metric-label">Avg Order Value</div>
                    <div class="metric-value">₹{{ number_format($avgOrderValue) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Today's Stats -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="chart-box text-center">
            <div class="chart-title">Today's Orders</div>
            <h2 style="color: #ff6b35;">{{ $todayOrders }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart-box text-center">
            <div class="chart-title">Today's Revenue</div>
            <h2 style="color: #28a745;">₹{{ number_format($todayRevenue) }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart-box text-center">
            <div class="chart-title">New Users Today</div>
            <h2 style="color: #17a2b8;">{{ $todayUsers }}</h2>
        </div>
    </div>
</div>

<!-- Orders by Status -->
<div class="chart-box mb-4">
    <div class="chart-title">Orders by Status</div>
    <div class="row">
        @forelse($ordersByStatus as $status)
        <div class="col-md-3">
            <div class="status-box status-{{ $status['status'] }}">
                <h3>{{ $status['count'] }}</h3>
                <p>{{ ucfirst($status['status']) }}</p>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">No orders yet</div>
        @endforelse
    </div>
</div>

<!-- User Growth & Orders Chart -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="chart-box">
            <div class="chart-title">User Growth (Last 6 Months)</div>
            @if(count($monthlyUsersData) > 0 && array_sum($monthlyUsersData) > 0)
            <div style="display: flex; align-items: flex-end; height: 150px; gap: 10px; padding: 10px 0;">
                @foreach($monthlyUsersData as $index => $count)
                <div style="flex: 1; text-align: center;">
                    <div style="background: linear-gradient(135deg, #ff6b35, #f7931e); height: {{ $count > 0 ? ($count / max($monthlyUsersData)) * 120 : 5 }}px; border-radius: 5px 5px 0 0; min-height: 5px;"></div>
                    <div style="font-size: 0.7rem; color: #666; margin-top: 5px;">{{ $monthlyUsers[$index] }}</div>
                    <div style="font-size: 0.8rem; font-weight: 600;">{{ $count }}</div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-muted text-center">No user data yet</p>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="chart-box">
            <div class="chart-title">Daily Orders (Last 7 Days)</div>
            @if(array_sum($last7DaysOrders) > 0)
            <div style="display: flex; align-items: flex-end; height: 150px; gap: 10px; padding: 10px 0;">
                @foreach($last7DaysOrders as $index => $count)
                <div style="flex: 1; text-align: center;">
                    <div style="background: linear-gradient(135deg, #28a745, #20c997); height: {{ $count > 0 ? ($count / max($last7DaysOrders)) * 120 : 5 }}px; border-radius: 5px 5px 0 0; min-height: 5px;"></div>
                    <div style="font-size: 0.7rem; color: #666; margin-top: 5px;">{{ $last7Days[$index] }}</div>
                    <div style="font-size: 0.8rem; font-weight: 600;">{{ $count }}</div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-muted text-center">No order data yet</p>
            @endif
        </div>
    </div>
</div>

<!-- Top & Bottom Products -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="chart-box">
            <div class="chart-title"><i class="bi bi-trophy text-success"></i> Top Selling Products</div>
            @forelse($topProducts as $product)
            <div class="product-list-item">
                <img src="/storage/{{ $product['image'] }}" class="product-thumb" alt="{{ $product['name'] }}">
                <div class="product-details">
                    <div class="product-name">{{ $product['name'] }}</div>
                    <div class="product-sold">{{ $product['sold'] }} units sold</div>
                </div>
                <span class="badge-sell badge-high"><i class="bi bi-arrow-up"></i></span>
            </div>
            @empty
            <p class="text-muted text-center">No sales data yet</p>
            @endforelse
        </div>
    </div>
    <div class="col-md-6">
        <div class="chart-box">
            <div class="chart-title"><i class="bi bi-exclamation-triangle text-danger"></i> Low Selling Products</div>
            @forelse($bottomProducts as $product)
            <div class="product-list-item">
                <img src="/storage/{{ $product['image'] }}" class="product-thumb" alt="{{ $product['name'] }}">
                <div class="product-details">
                    <div class="product-name">{{ $product['name'] }}</div>
                    <div class="product-sold">{{ $product['sold'] }} units sold</div>
                </div>
                <span class="badge-sell badge-low"><i class="bi bi-arrow-down"></i></span>
            </div>
            @empty
            <p class="text-muted text-center">No sales data yet</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Payment Methods -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="chart-box">
            <div class="chart-title">Payment Methods</div>
            <div class="row">
                @forelse($paymentStats as $payment)
                <div class="col-md-4">
                    <div class="status-box">
                        <h3>{{ $payment['count'] }}</h3>
                        <p><i class="bi {{ $payment['payment_method'] == 'online' ? 'bi-credit-card' : 'bi-cash' }}"></i> {{ ucfirst($payment['payment_method']) }}</p>
                        <small class="text-muted">₹{{ number_format($payment['total']) }} total</small>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">No payment data yet</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="chart-box">
    <div class="chart-title">Recent Orders</div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>₹{{ number_format($order->total) }}</td>
                    <td>{{ ucfirst($order->payment_method) }}</td>
                    <td><span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">{{ ucfirst($order->status) }}</span></td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted">No orders yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
