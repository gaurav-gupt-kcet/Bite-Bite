@extends('layouts.frontend')

@section('content')

<div class="container py-5">
    <div class="text-center mb-4">
        <h3>{{ $category->name }}</h3>
        <p class="text-muted">Browse our delicious {{ $category->name }} collection</p>
    </div>

    @if(count($products) > 0)
    <div class="row">
        @foreach($products as $product)
        <div class="col-lg-3 col-md-4 col-6 mb-4">
            <div class="card product-card">
                <img src="/storage/{{$product->image}}" class="product-img" onclick="window.location='/product/{{$product->id}}'" style="cursor: pointer;">
                <div class="card-body text-center">
                    <h6>{{$product->name}}</h6>
                    <p class="price">₹{{$product->price}}</p>
                    <a href="/product/{{$product->id}}" class="btn btn-main btn-sm">
                        View Product
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-emoji-frown" style="font-size: 64px; color: #999;"></i>
        <h4 class="mt-3">No products found</h4>
        <p class="text-muted">We don't have any products in this category yet.</p>
        <a href="/products" class="btn btn-main mt-3">Browse All Products</a>
    </div>
    @endif
</div>

@endsection