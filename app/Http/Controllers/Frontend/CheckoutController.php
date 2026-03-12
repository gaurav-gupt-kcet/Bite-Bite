<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

public function checkout()
{

$cart = session()->get('cart');

if(!$cart || count($cart) == 0){
    return redirect('/')->with('error', 'Your cart is empty');
}

$total = 0;

foreach($cart as $item){

$total += $item['price'] * $item['quantity'];

}

return view('frontend.checkout',compact('total'));

}


public function placeOrder(Request $request)
{

$cart = session()->get('cart');

if(!$cart || count($cart) == 0){
    return redirect('/')->with('error', 'Your cart is empty');
}

$total = 0;

foreach($cart as $item){

$total += $item['price'] * $item['quantity'];

}

$paymentMethod = $request->payment_method;

// For online payment methods, we would redirect to payment gateway
// For now, we'll process COD directly
$paymentStatus = ($paymentMethod == 'COD') ? 'pending' : 'pending';

$orderData = [
    'name'=>$request->name,
    'phone'=>$request->phone,
    'address'=>$request->address,
    'total'=>$total,
    'payment_method'=>$paymentMethod,
    'status'=>'pending'
];

// Add user_id if logged in
if (Auth::check()) {
    $orderData['user_id'] = Auth::user()->id;
}

$order = Order::create($orderData);

foreach($cart as $id => $item){

OrderItem::create([

'order_id'=>$order->id,
'product_id'=>$id,
'quantity'=>$item['quantity'],
'price'=>$item['price']

]);

}

session()->forget('cart');

return redirect('/')->with('success','Order placed successfully! Order ID: #' . $order->id);

}

}
