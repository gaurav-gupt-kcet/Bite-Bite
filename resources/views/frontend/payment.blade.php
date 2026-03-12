@extends('layouts.frontend')

@section('content')

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card p-4">

<h3 class="text-center mb-4">Complete Your Payment</h3>

<p class="text-center">Total Amount: <strong>₹{{ $total }}</strong></p>

<form action="/payment/callback" method="POST" id="razorpay-form">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    
    <button type="submit" class="btn btn-primary w-100" id="pay-btn">Pay Now</button>
</form>

<div class="text-center mt-3">
    <p class="text-muted">Secure payment powered by Razorpay</p>
</div>

</div>

</div>

</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
var options = {
    "key": "{{ $key }}",
    "amount": "{{ $amount }}",
    "currency": "INR",
    "name": "Bite Bite",
    "description": "Order Payment",
    "image": "/favicon.ico",
    "order_id": "{{ $razorpayOrder->id }}",
    "handler": function (response){
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_signature').value = response.razorpay_signature;
        document.getElementById('razorpay-form').submit();
    },
    "prefill": {
        "name": "{{ session('order_name') }}",
        "phone": "{{ session('order_phone') }}"
    },
    "theme": {
        "color": "#ff6b35"
    }
};

var rzp1 = new Razorpay(options);

document.getElementById('pay-btn').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>

@endsection
