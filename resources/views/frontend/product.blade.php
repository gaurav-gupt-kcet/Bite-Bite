@extends('layouts.frontend')

@section('content')

<div class="product-detail-container">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/products">Products</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        
        <!-- Product Image -->
        <div class="col-lg-6 mb-4">
            <div class="product-image-container">
                <img src="/storage/{{$product->image}}" class="product-detail-img" alt="{{$product->name}}">
                @if($product->offer_price && $product->original_price)
                <span class="product-badge">{{ round(($product->original_price - $product->offer_price) / $product->original_price * 100) }}% OFF</span>
                @elseif($product->price >= 500)
                <span class="product-badge">Best Seller</span>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="product-detail-content">
                <p class="product-category">{{$product->category ? $product->category->name : 'Uncategorized'}}</p>
                
                <h1 class="product-title">{{$product->name}}</h1>
                
                <div class="product-price">
                    @if($product->offer_price && $product->original_price)
                    <span class="current-price">₹{{$product->offer_price}}</span>
                    <span class="original-price">₹{{$product->original_price}}</span>
                    <span class="per-kg">/ kg</span>
                    @else
                    <span class="current-price">₹{{$product->price}}</span>
                    <span class="per-kg">/ kg</span>
                    @endif
                </div>

                <p class="product-description">{{$product->description}}</p>

                <!-- Quantity Selector -->
                <div class="quantity-selector">
                    <label>Quantity:</label>
                    <div class="quantity-controls">
                        <button type="button" class="qty-btn" onclick="decreaseQty()">-</button>
                        <input type="number" id="quantity" value="1" min="1" max="10">
                        <button type="button" class="qty-btn" onclick="increaseQty()">+</button>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                @if($product->price > 0)
                <a href="/add-to-cart/{{$product->id}}" class="btn btn-main btn-lg w-100 mb-3">
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </a>
                @else
                <button class="btn btn-secondary btn-lg w-100 mb-3" disabled>
                    Coming Soon
                </button>
                @endif

                <!-- Product Features -->
                <div class="product-features">
                    <div class="feature-item">
                        <i class="bi bi-truck"></i>
                        <span>Free Delivery above ₹500</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-shield-check"></i>
                        <span>100% Pure & Fresh</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-heart"></i>
                        <span>Made with Love</span>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-info-card">
                    <h5><i class="bi bi-info-circle"></i> Product Information</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Category:</strong></td>
                            <td>{{$product->category ? $product->category->name : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td><strong>Availability:</strong></td>
                            <td><span class="text-success"><i class="bi bi-check-circle"></i> In Stock</span></td>
                        </tr>
                        <tr>
                            <td><strong>Delivery:</strong></td>
                            <td>Same day delivery available</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="reviews-section mt-5">
        <h3 class="section-title">Customer Reviews</h3>
        
        <!-- Review Form -->
        @auth
        <div class="review-form-card mb-4">
            <h5>Write a Review</h5>
            <form action="/review" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                        <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" required>
                        <label for="star{{ $i }}"><i class="bi bi-star"></i></label>
                        @endfor
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Your Review</label>
                    <textarea name="comment" class="form-control" rows="4" placeholder="Share your experience with this product..." required></textarea>
                </div>
                <button type="submit" class="btn btn-main">Submit Review</button>
            </form>
        </div>
        @else
        <div class="alert alert-info mb-4">
            <a href="/login">Login</a> to write a review
        </div>
        @endauth

        <!-- Existing Reviews -->
        @if(count($reviews) > 0)
        <div class="reviews-list">
            @foreach($reviews as $review)
            <div class="review-card">
                <div class="review-header">
                    <div class="review-author">
                        <div class="author-avatar">{{ substr($review->name, 0, 1) }}</div>
                        <div>
                            <h6 class="mb-0">{{ $review->name }}</h6>
                            <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                    <div class="review-rating">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                        @endfor
                    </div>
                </div>
                <p class="review-comment">{{ $review->comment }}</p>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-secondary">
            No reviews yet. Be the first to review this product!
        </div>
        @endif
    </div>

    <!-- Related Products -->
    @if(count($relatedProducts) > 0)
    <div class="related-products-section">
        <h3 class="section-title">Related Products</h3>
        <div class="row">
            @foreach($relatedProducts as $related)
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card product-card">
                    <img src="/storage/{{$related->image}}" class="product-img" onclick="window.location='/product/{{$related->id}}'" style="cursor: pointer;">
                    <div class="card-body text-center">
                        <h6>{{$related->name}}</h6>
                        <p class="price">
                            @if($related->offer_price && $related->original_price)
                            <del class="text-muted">₹{{$related->original_price}}</del>
                            <span class="text-danger fw-bold">₹{{$related->offer_price}}</span>
                            @else
                            <span>₹{{$related->price}}</span>
                            @endif
                        </p>
                        <a href="/product/{{$related->id}}" class="btn btn-main btn-sm">View Product</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

<script>
function increaseQty() {
    var qty = document.getElementById('quantity');
    if(qty.value < 10) {
        qty.value = parseInt(qty.value) + 1;
    }
}

function decreaseQty() {
    var qty = document.getElementById('quantity');
    if(qty.value > 1) {
        qty.value = parseInt(qty.value) - 1;
    }
}
</script>

<style>
.product-detail-container {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.breadcrumb {
    background: #f8f9fa;
    padding: 10px 15px;
    border-radius: 8px;
}

.breadcrumb-item a {
    color: #ff6b35;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: #666;
}

.product-image-container {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
}

.product-detail-img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 15px;
}

.product-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #ff6b35;
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
}

.product-category {
    color: #ff6b35;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 14px;
    margin-bottom: 5px;
}

.product-title {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
}

.product-price {
    margin-bottom: 20px;
}

.current-price {
    font-size: 2rem;
    font-weight: 700;
    color: #ff6b35;
}

.original-price {
    font-size: 1.2rem;
    color: #999;
    text-decoration: line-through;
    margin-left: 10px;
}

.per-kg {
    font-size: 1rem;
    color: #666;
}

.product-description {
    color: #666;
    line-height: 1.8;
    margin-bottom: 25px;
}

.quantity-selector {
    margin-bottom: 25px;
}

.quantity-selector label {
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.qty-btn {
    width: 40px;
    height: 40px;
    border: 2px solid #ff6b35;
    background: white;
    color: #ff6b35;
    font-size: 18px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.qty-btn:hover {
    background: #ff6b35;
    color: white;
}

.quantity-controls input {
    width: 60px;
    height: 40px;
    text-align: center;
    border: 2px solid #eee;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
}

.product-features {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 25px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f8f9fa;
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 14px;
    color: #333;
}

.feature-item i {
    color: #ff6b35;
    font-size: 18px;
}

.product-info-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
}

.product-info-card h5 {
    color: #333;
    font-weight: 600;
    margin-bottom: 15px;
}

.product-info-card td {
    padding: 8px 0;
    color: #666;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    margin: 40px 0 25px;
    position: relative;
    padding-bottom: 10px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: #ff6b35;
    border-radius: 2px;
}

@media (max-width: 768px) {
    .product-detail-img {
        height: 300px;
    }
    
    .product-title {
        font-size: 1.5rem;
    }
    
    .current-price {
        font-size: 1.5rem;
    }
}

/* Reviews Section */
.reviews-section {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-top: 40px;
}

.review-form-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 25px;
}

.review-form-card h5 {
    color: #333;
    font-weight: 600;
    margin-bottom: 20px;
}

.rating-stars {
    display: flex;
    gap: 5px;
}

.rating-stars input {
    display: none;
}

.rating-stars label {
    cursor: pointer;
    font-size: 24px;
    color: #ddd;
    transition: color 0.2s;
}

.rating-stars label:hover,
.rating-stars input:checked ~ label,
.rating-stars label:hover ~ label {
    color: #ffc107;
}

.reviews-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.review-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.review-author {
    display: flex;
    align-items: center;
    gap: 12px;
}

.author-avatar {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #ff6b35, #ff8c42);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 18px;
}

.review-author h6 {
    color: #333;
    font-weight: 600;
}

.review-rating {
    color: #ffc107;
    font-size: 14px;
}

.review-rating i {
    margin-left: 2px;
}

.review-comment {
    color: #666;
    line-height: 1.6;
    margin-bottom: 0;
}
</style>

@endsection
