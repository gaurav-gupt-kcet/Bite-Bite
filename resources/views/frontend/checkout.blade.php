@extends('layouts.frontend')

@section('content')

<div class="row">

<div class="col-md-7">

<h3>Checkout</h3>

<form action="/place-order" method="POST" id="checkout-form">

@csrf

<div class="mb-3">

<label>Name</label>

<input type="text" name="name" class="form-control" required>

</div>

<div class="mb-3">

<label>Phone</label>

<input type="text" name="phone" class="form-control" required>

</div>

<div class="mb-3">

<label>Address</label>

<textarea name="address" class="form-control" rows="3" required></textarea>

</div>

<div class="mb-3">

<label>Payment Method</label>

<select name="payment_method" class="form-control" id="paymentMethod">

<option value="COD">Cash On Delivery</option>

<option value="Online">Online Payment (UPI / Card / Netbanking)</option>

</select>

<div class="form-text" id="paymentText">Pay when you receive your order.</div>

</div>

<button type="submit" class="btn btn-main" id="submitBtn">

Place Order

</button>

</form>

</div>

<div class="col-md-5">

<h4>Order Summary</h4>

<table class="table">

<thead>

<tr>

<th>Product</th>
<th>Qty</th>
<th>Price</th>

</tr>

</thead>

<tbody>

@php

$cart = session()->get('cart', []);

$subtotal = 0;

@endphp

@foreach($cart as $id => $item)

<tr>

<td>{{$item['name']}}</td>

<td>{{$item['quantity']}}</td>

<td>₹{{$item['price'] * $item['quantity']}}</td>

</tr>

@php

$subtotal += $item['price'] * $item['quantity'];

@endphp

@endforeach

<tr>

<td colspan="2"><strong>Total</strong></td>

<td><strong>₹{{$subtotal}}</strong></td>

</tr>

</tbody>

</table>

</div>

</div>

<script>
document.getElementById('paymentMethod').addEventListener('change', function() {
    var method = this.value;
    var text = document.getElementById('paymentText');
    var form = document.getElementById('checkout-form');
    
    if (method === 'Online') {
        text.innerHTML = 'You will be redirected to payment gateway to complete payment.';
        form.action = '/payment/create';
    } else {
        text.innerHTML = 'Pay when you receive your order.';
        form.action = '/place-order';
    }
});
</script>

@endsection
