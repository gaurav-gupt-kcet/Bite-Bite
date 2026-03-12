@extends('layouts.frontend')

@section('content')

<div class="container py-5">

<h2 class="mb-4 text-center">All Products</h2>

<div class="row">

@foreach($products as $product)

<div class="col-lg-3 col-md-4 col-6 mb-4">

<div class="card product-card">

<img src="/storage/{{$product->image}}" class="product-img" onclick="window.location='/product/{{$product->id}}'" style="cursor: pointer;">

<div class="card-body text-center">

<h6>{{$product->name}}</h6>

<p class="text-muted">{{$product->category->name ?? ''}}</p>

<p class="price">₹{{$product->price}}</p>

<a href="/product/{{$product->id}}" class="btn btn-main btn-sm">

View Product

</a>

</div>

</div>

</div>

@endforeach

</div>

</div>

@endsection