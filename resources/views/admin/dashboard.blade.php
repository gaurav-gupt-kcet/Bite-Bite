@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

<!-- Stats Grid -->
<div class="stats-grid">

<div class="stat-card orders">
    <div class="stat-icon">
        <i class="bi bi-cart3"></i>
    </div>
    <div class="stat-info">
        <h3>{{ $totalOrders }}</h3>
        <p>Total Orders</p>
    </div>
    <span class="trend up"><i class="bi bi-arrow-up"></i> 12%</span>
</div>

<div class="stat-card revenue">
    <div class="stat-icon">
        <i class="bi bi-currency-rupee"></i>
    </div>
    <div class="stat-info">
        <h3>₹{{ number_format($totalRevenue, 0) }}</h3>
        <p>Total Revenue</p>
    </div>
    <span class="trend up"><i class="bi bi-arrow-up"></i> 8%</span>
</div>

<div class="stat-card products">
    <div class="stat-icon">
        <i class="bi bi-bag"></i>
    </div>
    <div class="stat-info">
        <h3>{{ $totalProducts }}</h3>
        <p>Total Products</p>
    </div>
    <span class="trend up"><i class="bi bi-arrow-up"></i> 5%</span>
</div>

<div class="stat-card categories">
    <div class="stat-icon">
        <i class="bi bi-tags"></i>
    </div>
    <div class="stat-info">
        <h3>{{ $totalCategories }}</h3>
        <p>Total Categories</p>
    </div>
    <span class="trend up"><i class="bi bi-arrow-up"></i> 3%</span>
</div>

</div>

<!-- Additional Stats Row -->
<div class="stats-grid">

<div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="stat-icon" style="background: rgba(255,255,255,0.2); color: white;">
        <i class="bi bi-people"></i>
    </div>
    <div class="stat-info">
        <h3 style="color: white;">{{\App\Models\User::count()}}</h3>
        <p style="color: rgba(255,255,255,0.8);">Total Users</p>
    </div>
</div>

<div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
    <div class="stat-icon" style="background: rgba(255,255,255,0.2); color: white;">
        <i class="bi bi-envelope"></i>
    </div>
    <div class="stat-info">
        <h3 style="color: white;">{{\App\Models\Contact::count()}}</h3>
        <p style="color: rgba(255,255,255,0.8);">Total Messages</p>
    </div>
</div>

</div>

<!-- Quick Actions -->
<div class="card mb-4">
    <div class="card-header">
        <h5><i class="bi bi-lightning-charge me-2"></i>Quick Actions</h5>
    </div>
    <div class="card-body">
        <div class="quick-actions">
            <a href="/admin/products/create" class="quick-action-btn">
                <i class="bi bi-plus-circle"></i>
                <span>Add Product</span>
            </a>
            <a href="/admin/categories/create" class="quick-action-btn">
                <i class="bi bi-tag"></i>
                <span>Add Category</span>
            </a>
            <a href="/admin/sliders/create" class="quick-action-btn">
                <i class="bi bi-image"></i>
                <span>Add Slider</span>
            </a>
            <a href="/admin/orders" class="quick-action-btn">
                <i class="bi bi-list-check"></i>
                <span>View Orders</span>
            </a>
        </div>
    </div>
</div>

<!-- Charts and Recent Orders Row -->
<div class="row">

<!-- Sales Chart -->
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h5><i class="bi bi-graph-up me-2"></i>Monthly Sales Overview</h5>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Top Products -->
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h5><i class="bi bi-star me-2"></i>Top Selling Products</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topProducts as $product)
                    <tr>
                        <td>
                            <span class="product-name">Product #{{ $product->product_id }}</span>
                        </td>
                        <td><span class="badge bg-success">{{ $product->qty }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">No data available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<!-- Recent Orders -->
<div class="card mt-4">
    <div class="card-header">
        <h5><i class="bi bi-clock-history me-2"></i>Recent Orders</h5>
        <a href="/admin/orders" class="btn btn-primary btn-sm">View All</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>{{ $order->name }}</td>
                    <td class="price">₹{{ number_format($order->total, 2) }}</td>
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
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var ctx = document.getElementById('salesChart').getContext('2d');

var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Monthly Revenue (₹)',
            data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 40000, 32000, 45000, 50000],
            borderColor: '#ff6b35',
            backgroundColor: 'rgba(255, 107, 53, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#ff6b35',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 7
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 20
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                },
                ticks: {
                    callback: function(value) {
                        return '₹' + value;
                    }
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>

@endsection
