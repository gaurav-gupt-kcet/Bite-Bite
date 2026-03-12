<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

public function index()
{

$orders = Order::latest()->get();

return view('admin.orders', compact('orders'));

}


public function show($id)
{

$order = Order::with('items')->findOrFail($id);

return view('admin.order-details', compact('order'));

}

public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();
    
    return redirect('/admin/orders')->with('success', 'Order status updated successfully');
}

}