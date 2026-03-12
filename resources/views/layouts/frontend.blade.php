<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ env('SITE_NAME', 'Bite Bite') }} - Premium Indian Sweets</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

@include('components.navbar')

<main>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="bi bi-check-circle"></i> {{ session('success') }}
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<i class="bi bi-exclamation-circle"></i> {{ session('error') }}
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@yield('content')

</main>

<!-- Footer -->
<footer class="footer">
<div class="container">
<div class="row">
<div class="col-md-4">
<h5>{{ env('SITE_NAME', 'Bite Bite') }}</h5>
<p>Premium Indian sweets and mithai delivered fresh to your doorstep. Traditional recipes with modern convenience.</p>
</div>
<div class="col-md-4">
<h5>Quick Links</h5>
<ul class="list-unstyled">
<li><a href="/" class="text-white text-decoration-none"><i class="bi bi-chevron-right"></i> Home</a></li>
<li><a href="/products" class="text-white text-decoration-none"><i class="bi bi-chevron-right"></i> Products</a></li>
<li><a href="/cart" class="text-white text-decoration-none"><i class="bi bi-chevron-right"></i> Cart</a></li>
</ul>
</div>
<div class="col-md-4">
<h5>Contact Us</h5>
<p><i class="bi bi-envelope"></i> {{ env('SITE_EMAIL', 'info@shuddhswad.com') }}</p>
<p><i class="bi bi-phone"></i> {{ env('SITE_PHONE', '7061296558') }}</p>
<p><i class="bi bi-geo-alt"></i> {{ env('SITE_ADDRESS', 'Noida, India') }}</p>
</div>
</div>
<hr style="border-color: rgba(255,255,255,0.3);">
<div class="text-center">
<p>&copy; 2026 {{ env('SITE_NAME', 'Bite Bite') }}. All rights reserved.</p>
</div>
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@include('components.chat-widget')

</body>
</html>
