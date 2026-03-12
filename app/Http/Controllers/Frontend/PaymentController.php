<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $cart = session()->get('cart');
        
        if(!$cart || count($cart) == 0){
            return redirect('/')->with('error', 'Your cart is empty');
        }
        
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }
        
        // Convert to paise for Razorpay
        $amountPaise = $total * 100;
        
        $api = new Api(config('settings.razorpay_key'), config('settings.razorpay_secret'));
        
        $razorpayOrder = $api->order->create([
            'amount' => $amountPaise,
            'currency' => 'INR',
            'receipt' => 'order_' . time(),
            'payment_capture' => 1
        ]);
        
        // Store order details in session for later use
        session([
            'razorpay_order_id' => $razorpayOrder->id,
            'razorpay_amount' => $amountPaise,
            'order_name' => $request->name,
            'order_phone' => $request->phone,
            'order_address' => $request->address,
            'order_payment_method' => $request->payment_method
        ]);
        
        return view('frontend.payment', [
            'razorpayOrder' => $razorpayOrder,
            'key' => config('settings.razorpay_key'),
            'amount' => $amountPaise,
            'total' => $total
        ]);
    }
    
    public function paymentCallback(Request $request)
    {
        $api = new Api(config('settings.razorpay_key'), config('settings.razorpay_secret'));
        
        try {
            $attributes = [
                'razorpay_order_id' => session('razorpay_order_id'),
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];
            
            $api->utility->verifyPaymentSignature($attributes);
            
            // Payment verified - Create order in database
            $cart = session()->get('cart');
            $total = 0;
            
            foreach($cart as $item){
                $total += $item['price'] * $item['quantity'];
            }
            
            $orderData = [
                'name' => session('order_name'),
                'phone' => session('order_phone'),
                'address' => session('order_address'),
                'total' => $total,
                'payment_method' => 'Online',
                'payment_id' => $request->razorpay_payment_id,
                'status' => 'pending'
            ];
            
            // Add user_id if logged in
            if (Auth::check()) {
                $orderData['user_id'] = Auth::user()->id;
            }
            
            $order = Order::create($orderData);
            
            foreach($cart as $id => $item){
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }
            
            session()->forget('cart');
            session()->forget('razorpay_order_id');
            session()->forget('razorpay_amount');
            session()->forget('order_name');
            session()->forget('order_phone');
            session()->forget('order_address');
            session()->forget('order_payment_method');
            
            return redirect('/')->with('success', 'Order placed successfully! Order ID: #' . $order->id);
            
        } catch (\Exception $e) {
            return redirect('/checkout')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}
