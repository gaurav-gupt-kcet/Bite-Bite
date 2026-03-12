@extends('layouts.frontend')

@section('content')

<!-- ===================== WELCOME BANNER ===================== -->
<div class="welcome-banner">
    <div class="container">
        <h1>Welcome to Bite Bite</h1>
        <p>Experience the authentic taste of traditional Indian sweets, made with love and purity</p>
    </div>
</div>

<!-- ===================== FEATURES SECTION ===================== -->
<div class="features-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="feature-box">
                    <i class="bi bi-heart-fill"></i>
                    <h5>100% Pure</h5>
                    <p>No artificial colors or preservatives</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-box">
                    <i class="bi bi-clock-fill"></i>
                    <h5>Fresh Daily</h5>
                    <p>Made fresh every morning</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-box">
                    <i class="bi bi-truck"></i>
                    <h5>Fast Delivery</h5>
                    <p>Quick delivery across India</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-box">
                    <i class="bi bi-shield-check"></i>
                    <h5>Quality Guaranteed</h5>
                    <p>Best quality ingredients</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===================== SLIDER ===================== -->

@if(count($sliders) > 0)

<div id="homeSlider" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="3000">

<div class="carousel-indicators">

@foreach($sliders as $key => $slider)

<button type="button" data-bs-target="#homeSlider" data-bs-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></button>

@endforeach

</div>

<div class="carousel-inner">

@foreach($sliders as $key => $slider)

<div class="carousel-item {{$key == 0 ? 'active' : ''}}">

@if($slider->product_id)

<a href="/product/{{$slider->product_id}}">

<img src="/storage/{{$slider->image}}" class="d-block w-100" style="height:500px;object-fit:cover;">

</a>

@elseif($slider->link)

<a href="{{$slider->link}}">

<img src="/storage/{{$slider->image}}" class="d-block w-100" style="height:500px;object-fit:cover;">

</a>

@else

<img src="/storage/{{$slider->image}}" class="d-block w-100" style="height:420px;object-fit:cover;">

@endif

<div class="carousel-caption">

<h2>{{$slider->title}}</h2>

@if($slider->subtitle)

<p>{{$slider->subtitle}}</p>

@endif

@if($slider->product_id)

<a href="/product/{{$slider->product_id}}" class="btn btn-warning">

Shop Now

</a>

@endif

</div>

</div>

@endforeach

</div>

@if(count($sliders) > 1)

<button class="carousel-control-prev" type="button" data-bs-target="#homeSlider" data-bs-slide="prev">

<span class="carousel-control-prev-icon"></span>

</button>

<button class="carousel-control-next" type="button" data-bs-target="#homeSlider" data-bs-slide="next">

<span class="carousel-control-next-icon"></span>

</button>

@endif

</div>

@else

<!-- Fallback static slider if no sliders configured -->

<div id="homeSlider" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="3000">

<div class="carousel-indicators">

<button type="button" data-bs-target="#homeSlider" data-bs-slide-to="0" class="active"></button>
<button type="button" data-bs-target="#homeSlider" data-bs-slide-to="1"></button>
<button type="button" data-bs-target="#homeSlider" data-bs-slide-to="2"></button>
<button type="button" data-bs-target="#homeSlider" data-bs-slide-to="3"></button>

</div>

<div class="carousel-inner">

<!-- SLIDE 1 -->

<div class="carousel-item active">

<img src="/slider/slide1.jpg" class="d-block w-100" style="height:500px;object-fit:cover;">

<div class="carousel-caption">

<h2>Republic Day Offer</h2>

<p>Get 25% OFF on Special Mithai</p>

<a href="/cart" class="btn btn-warning">

Order Now

</a>

</div>

</div>

<!-- SLIDE 2 -->

<div class="carousel-item">

<img src="/slider/slide2.jpg" class="d-block w-100" style="height:500px;object-fit:cover;">

<div class="carousel-caption">

<h2>Fresh Kaju Katli</h2>

<p>Pure Desi Taste</p>

<a href="/" class="btn btn-warning">

Shop Now

</a>

</div>

</div>

<!-- SLIDE 3 -->

<div class="carousel-item">

<img src="/slider/slide3.jpg" class="d-block w-100" style="height:500px;object-fit:cover;">

<div class="carousel-caption">

<h2>Festival Sweet Combo</h2>

<p>Special Discount Available</p>

<a href="/" class="btn btn-warning">

Buy Now

</a>

</div>

</div>

<!-- SLIDE 4 -->

<div class="carousel-item">

<img src="/slider/slide4.jpg" class="d-block w-100" style="height:500px;object-fit:cover;">

<div class="carousel-caption">

<h2>Traditional Indian Sweets</h2>

<p>Freshly Made Everyday</p>

<a href="/" class="btn btn-warning">

Order Today

</a>

</div>

</div>

</div>

<button class="carousel-control-prev" type="button" data-bs-target="#homeSlider" data-bs-slide="prev">

<span class="carousel-control-prev-icon"></span>

</button>

<button class="carousel-control-next" type="button" data-bs-target="#homeSlider" data-bs-slide="next">

<span class="carousel-control-next-icon"></span>

</button>

</div>

@endif

<!-- ===================== CATEGORIES ===================== -->

@if(count($categories) > 0)

<div class="container mb-5">

<h3 class="mb-4 text-center animated-section">Shop by Category</h3>

<div class="row">

@foreach($categories as $key => $category)

<div class="col-lg-2 col-md-3 col-4 text-center mb-3 animated-section stagger-{{$key + 1}}">

<a href="/category/{{$category->slug}}" class="text-decoration-none">

<div class="category-box p-3 rounded">

<h6>{{$category->name}}</h6>

</div>

</a>

</div>

@endforeach

</div>

</div>

@endif

<!-- ===================== PRODUCTS ===================== -->

<div class="container">

<h3 class="mb-4 text-center animated-section">

Popular Mithai

</h3>

<div class="row">

@foreach($products as $key => $product)

<div class="col-lg-3 col-md-4 col-6 mb-4 animated-section stagger-{{$key + 1}}">

<div class="card product-card">

@if($product->offer_price && $product->original_price)
<span class="product-badge">{{
    round(($product->original_price - $product->offer_price) / $product->original_price * 100)
}}% OFF</span>
@elseif($product->price >= 500)
<span class="product-badge">Best Seller</span>
@endif

<img src="/storage/{{$product->image}}" class="product-img" onclick="window.location='/product/{{$product->id}}'" style="cursor: pointer;">

<div class="card-body text-center">

<h6>{{$product->name}}</h6>

<p class="price">
@if($product->offer_price)
<del class="text-muted">₹{{$product->original_price}}</del>
<span class="text-danger fw-bold">₹{{$product->offer_price}}</span>
@else
<span>₹{{$product->price}}</span>
@endif
</p>

<a href="/product/{{$product->id}}" class="btn btn-main btn-sm">

View Product

</a>

</div>

</div>

</div>

@endforeach

</div>

</div>

<!-- ===================== NEWSLETTER ===================== -->
<div class="newsletter-section">
    <div class="container">
        <h3 class="animated-section">Subscribe to Our Newsletter</h3>
        <p class="animated-section">Get exclusive offers and updates on new products</p>
        <form class="newsletter-form" action="#" method="POST">
            @csrf
            <input type="email" class="newsletter-input" placeholder="Enter your email" required>
            <button type="submit" class="newsletter-btn">Subscribe</button>
        </form>
    </div>
</div>

<!-- ===================== SCROLL ANIMATION SCRIPT ===================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.animated-section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = 'all 0.8s ease-out';
        observer.observe(section);
    });
    
    // Add visible class after page load
    setTimeout(() => {
        document.querySelectorAll('.animated-section').forEach(section => {
            section.classList.add('visible');
            section.style.opacity = '1';
            section.style.transform = 'translateY(0)';
        });
    }, 100);
});
</script>

@endsection
