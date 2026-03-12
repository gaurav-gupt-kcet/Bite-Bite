<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use DB;

class DashboardController extends Controller
{

public function index()
{

$totalOrders = Order::count();

$totalProducts = Product::count();

$totalCategories = Category::count();

$totalRevenue = Order::sum('total');

$orders = Order::latest()->take(5)->get();

/* MONTHLY SALES */

$monthlySales = Order::select(
DB::raw("SUM(total) as total"),
DB::raw("MONTH(created_at) as month")
)
->groupBy("month")
->pluck("total","month");


/* TOP SELLING PRODUCTS */

$topProducts = OrderItem::select(
'product_id',
DB::raw("SUM(quantity) as qty")
)
->groupBy('product_id')
->orderByDesc('qty')
->take(5)
->get();

return view('admin.dashboard',compact(

'totalOrders',
'totalProducts',
'totalCategories',
'totalRevenue',
'orders',
'monthlySales',
'topProducts'

));

}

}