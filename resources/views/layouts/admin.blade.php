<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>@yield('title','Admin Dashboard')</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { margin:0; background:#f4f6f9; }
.sidebar {
    position: fixed;
    top: 0; left: 0;
    width: 240px; height: 100vh;
    background: #198754;
    color: white;
}
.sidebar a {
    color:white;
    padding:12px 20px;
    display:block;
    text-decoration:none;
}
.sidebar a:hover, .sidebar .active {
    background:#146c43;
}
.main {
    margin-left:240px;
}
.navbar {
    position: fixed;
    top:0; left:240px;
    right:0;
    z-index:1000;
}
.content {
    margin-top:70px;
    padding:20px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="text-center py-3">🛠 Admin</h4>
    <a class="active" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('admin.farmers') }}"><i class="bi bi-people"></i> Farmers</a>
    <a href="{{ route('admin.buyers') }}"><i class="bi bi-cart"></i> Buyers</a>
    <a href="{{ route('admin.analytics') }}"><i class="bi bi-bar-chart"></i> Analytics</a>
    <a href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- TOP NAVBAR -->
<nav class="navbar navbar-light bg-white shadow-sm px-4">
    <span class="navbar-brand fw-bold">🛠 Admin Dashboard</span>
    <span class="ms-auto">
        👤 Welcome, {{ session('admin_name','Admin') }}
    </span>
</nav>

<div class="main">
    <div class="content">
        @yield('content')
    </div>
</div>

</body>
</html>
