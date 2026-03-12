<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin Panel - {{ env('SITE_NAME', 'Bite Bite') }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body>

<div class="admin-wrapper">

<!-- Sidebar -->

<aside class="sidebar">

<div class="sidebar-header">
    <a href="/admin" class="logo">
        <i class="bi bi-cup-hot-fill"></i>
        {{ env('SITE_NAME', 'Bite Bite') }}
    </a>
</div>

<nav class="sidebar-menu">
    <div class="menu-section">Main Menu</div>
    <ul>
        <li>
            <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Dashboard
            </a>
        </li>
    </ul>
    
    <div class="menu-section">Management</div>
    <ul>
        <li>
            <a href="/admin/sliders" class="{{ request()->is('admin/sliders*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Sliders
            </a>
        </li>
        <li>
            <a href="/admin/products" class="{{ request()->is('admin/products*') ? 'active' : '' }}">
                <i class="bi bi-bag"></i> Products
            </a>
        </li>
        <li>
            <a href="/admin/categories" class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Categories
            </a>
        </li>
        <li>
            <a href="/admin/orders" class="{{ request()->is('admin/orders*') ? 'active' : '' }}">
                <i class="bi bi-cart3"></i> Orders
            </a>
        </li>
        <li>
            <a href="/admin/reviews" class="{{ request()->is('admin/reviews*') ? 'active' : '' }}">
                <i class="bi bi-star"></i> Reviews
            </a>
        </li>
        <li>
            <a href="/admin/analytics" class="{{ request()->is('admin/analytics') || request()->is('analytics') ? 'active' : '' }}">
                <i class="bi bi-graph-up-arrow"></i> Analytics
            </a>
        </li>
    </ul>
    
    <div class="menu-section">Users & Messages</div>
    <ul>
        <li>
            <a href="/admin/users" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Users
            </a>
        </li>
        <li>
            <a href="/admin/contacts" class="{{ request()->is('admin/contacts*') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i> Messages
            </a>
        </li>
    </ul>
    
    <div class="menu-section">System</div>
    <ul>
        <li>
            <a href="/admin/settings" class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Settings
            </a>
        </li>
    
    <div class="menu-section">External</div>
    <ul>
        <li>
            <a href="/" target="_blank">
                <i class="bi bi-box-arrow-up-right"></i> View Website
            </a>
        </li>
    </ul>
</nav>

<div class="sidebar-footer">
    <div class="user-info">
        <i class="bi bi-person-circle"></i>
        <div>
            <div class="name">Admin</div>
            <div class="role">Super Administrator</div>
        </div>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="mt-3">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="bi bi-box-arrow-left"></i> Logout
        </button>
    </form>
</div>

</aside>

<!-- Main Content -->

<main class="main-content">

<!-- Top Header -->

<header class="top-header">
    <div class="header-title">
        <h4>@yield('page-title', 'Dashboard')</h4>
    </div>
    <div class="header-actions">
        <button class="header-btn" title="Notifications">
            <i class="bi bi-bell"></i>
            <span class="badge">3</span>
        </button>
        <button class="header-btn" title="Settings">
            <i class="bi bi-gear"></i>
        </button>
    </div>
</header>

<!-- Page Content -->

<div class="page-content">
    @yield('content')
</div>

</main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
