<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        try {
            // Basic stats
            $totalOrders = Order::count();
            $totalUsers = User::count();
            $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');
            $avgOrderValue = $totalOrders > 0 ? round($totalRevenue / $totalOrders, 2) : 0;

            // Orders by status
            $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get()
                ->toArray();

            // Get last 7 days orders
            $last7Days = [];
            $last7DaysOrders = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $last7Days[] = now()->subDays($i)->format('d M');
                $last7DaysOrders[] = Order::whereDate('created_at', $date)->count();
            }

            // Get last 7 days users
            $last7DaysUsers = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $last7DaysUsers[] = User::whereDate('created_at', $date)->count();
            }

            // Monthly users (last 6 months)
            $monthlyUsers = [];
            $monthlyUsersData = [];
            for ($i = 5; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $monthlyUsers[] = $month->format('M');
                $monthlyUsersData[] = User::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count();
            }

            // Top selling products (simplified)
            $topProducts = [];
            $bottomProducts = [];
            
            $productSales = DB::table('order_items')
                ->select('product_id', DB::raw('SUM(qty) as total_sold'))
                ->groupBy('product_id')
                ->orderByDesc('total_sold')
                ->limit(5)
                ->get();

            foreach ($productSales as $sale) {
                $product = Product::find($sale->product_id);
                if ($product) {
                    $topProducts[] = [
                        'name' => $product->name,
                        'sold' => $sale->total_sold,
                        'image' => $product->image
                    ];
                }
            }

            // Bottom products (least sold)
            $leastProductSales = DB::table('order_items')
                ->select('product_id', DB::raw('SUM(qty) as total_sold'))
                ->groupBy('product_id')
                ->orderBy('total_sold')
                ->limit(5)
                ->get();

            foreach ($leastProductSales as $sale) {
                $product = Product::find($sale->product_id);
                if ($product) {
                    $bottomProducts[] = [
                        'name' => $product->name,
                        'sold' => $sale->total_sold,
                        'image' => $product->image
                    ];
                }
            }

            // Payment methods
            $paymentStats = Order::select('payment_method', DB::raw('count(*) as count'), DB::raw('SUM(total) as total'))
                ->groupBy('payment_method')
                ->get()
                ->toArray();

            // Recent orders
            $recentOrders = Order::latest()->limit(10)->get();

            // User registration trend
            $userGrowth = [];
            $userGrowthData = [];
            for ($i = 11; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $userGrowth[] = $month->format('M');
                $userGrowthData[] = User::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count();
            }

            // Today's stats
            $todayOrders = Order::whereDate('created_at', now()->toDateString())->count();
            $todayRevenue = Order::whereDate('created_at', now()->toDateString())
                ->where('status', '!=', 'cancelled')
                ->sum('total');
            $todayUsers = User::whereDate('created_at', now()->toDateString())->count();

            return view('admin.analytics', compact(
                'totalOrders',
                'totalUsers',
                'totalRevenue',
                'avgOrderValue',
                'ordersByStatus',
                'last7Days',
                'last7DaysOrders',
                'last7DaysUsers',
                'monthlyUsers',
                'monthlyUsersData',
                'topProducts',
                'bottomProducts',
                'paymentStats',
                'recentOrders',
                'userGrowth',
                'userGrowthData',
                'todayOrders',
                'todayRevenue',
                'todayUsers'
            ));
        } catch (\Exception $e) {
            // Return simple view on error
            return view('admin.analytics', [
                'error' => $e->getMessage(),
                'totalOrders' => 0,
                'totalUsers' => 0,
                'totalRevenue' => 0,
                'avgOrderValue' => 0,
                'ordersByStatus' => [],
                'last7Days' => [],
                'last7DaysOrders' => [],
                'last7DaysUsers' => [],
                'monthlyUsers' => [],
                'monthlyUsersData' => [],
                'topProducts' => [],
                'bottomProducts' => [],
                'paymentStats' => [],
                'recentOrders' => [],
                'userGrowth' => [],
                'userGrowthData' => [],
                'todayOrders' => 0,
                'todayRevenue' => 0,
                'todayUsers' => 0
            ]);
        }
    }
}
