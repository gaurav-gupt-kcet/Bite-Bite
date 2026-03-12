<footer class="footer">

<div class="container">

<div class="row">

<div class="col-md-4 mb-4">

<h5>{{ env('SITE_NAME', 'Bite Bite') }}</h5>

<p>Fresh Indian Mithai Delivered To Your Door</p>

</div>

<div class="col-md-4 mb-4">

<h5>Quick Links</h5>

<ul class="list-unstyled">

<li><a href="/" class="text-white text-decoration-none">Home</a></li>

<li><a href="/products" class="text-white text-decoration-none">Products</a></li>

<li><a href="/contact" class="text-white text-decoration-none">Contact Us</a></li>

</ul>

</div>

<div class="col-md-4 mb-4">

<h5>Contact Info</h5>

<p><i class="bi bi-envelope"></i> {{ env('SITE_EMAIL', 'info@shuddhswad.com') }}</p>

<p><i class="bi bi-phone"></i> {{ env('SITE_PHONE', '7061296558') }}</p>

<p><i class="bi bi-geo-alt"></i> {{ env('SITE_ADDRESS', 'Noida, India') }}</p>

</div>

</div>

<hr class="bg-white">

<p class="text-center mb-0">© {{ date('Y') }} {{ env('SITE_NAME', 'Bite Bite') }}. All Rights Reserved</p>

</div>

</footer>
