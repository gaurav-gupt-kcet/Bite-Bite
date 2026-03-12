<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
.main-navbar .dropdown-toggle::after {
    display: inline-block;
    margin-left: 5px;
    vertical-align: middle;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-left: 0.3em solid transparent;
}

.main-navbar .nav-link.dropdown-toggle {
    position: relative;
}

.main-navbar .nav-link.dropdown-toggle:hover {
    background: rgba(255,255,255,0.2);
    border-radius: 5px;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark main-navbar">

<div class="container">

<a class="navbar-brand logo" href="/">{{ env('SITE_NAME', 'Bite Bite') }}</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="/"><i class="bi bi-house-door"></i> Home</a>
</li>

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown">
<i class="bi bi-grid"></i> Categories
</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="/category/kaju-katli"><i class="bi bi-box-seam"></i> Kaju Katli</a></li>
<li><a class="dropdown-item" href="/category/gulab-jamun"><i class="bi bi-box-seam"></i> Gulab Jamun</a></li>
<li><a class="dropdown-item" href="/category/rasgulla"><i class="bi bi-box-seam"></i> Rasgulla</a></li>
<li><a class="dropdown-item" href="/category/ladoo"><i class="bi bi-box-seam"></i> Ladoo</a></li>
<li><a class="dropdown-item" href="/category/barfi"><i class="bi bi-box-seam"></i> Barfi</a></li>
<li><a class="dropdown-item" href="/category/halwa"><i class="bi bi-box-seam"></i> Halwa</a></li>
<li><a class="dropdown-item" href="/category/pak"><i class="bi bi-box-seam"></i> Pak</a></li>
<li><a class="dropdown-item" href="/category/special-combos"><i class="bi bi-box-seam"></i> Special Combos</a></li>
</ul>
</li>

<li class="nav-item">
<a class="nav-link" href="/products"><i class="bi bi-bag"></i> All Products</a>
</li>

<li class="nav-item">
<a class="nav-link" href="/cart"><i class="bi bi-cart3"></i> Cart</a>
</li>

@auth

@if(Auth::user()->is_admin == '1')

@endif

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
<i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="/profile"><i class="bi bi-person"></i> Profile</a></li>
<li>
<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit" class="btn btn-link dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
</form>
</li>
</ul>
</li>

@else

<li class="nav-item">
<a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Register</a>
</li>

@endauth

</ul>

</div>

</div>

</nav>
