@extends('layouts.frontend')

@section('content')

<h3>Your Cart</h3>

<form action="/update-cart" method="POST">

@csrf

<table class="table table-bordered">

<tr>

<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
<th>Action</th>

</tr>

@php $total = 0; @endphp

@if(session('cart'))

@foreach(session('cart') as $id => $item)

@php

$subtotal = $item['price'] * $item['quantity'];

$total += $subtotal;

@endphp

<tr>

<td>

<img src="/storage/{{$item['image']}}" width="60">

{{$item['name']}}

</td>

<td>

₹{{$item['price']}}

</td>

<td>

<input type="number" name="quantity[{{$id}}]" value="{{$item['quantity']}}" width="60">

</td>

<td>

₹{{$subtotal}}

</td>

<td>

<a href="/remove-cart/{{$id}}" class="btn btn-danger btn-sm">

Remove

</a>

</td>

</tr>

@endforeach

@endif

</table>

<button class="btn btn-primary">

Update Cart

</button>

</form>

<h4 class="mt-4">

Total: ₹{{$total}}
<a href="/checkout" class="btn btn-success mt-3">
Proceed To Checkout
</a>

</h4>

@endsection