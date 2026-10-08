<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Farmer Produce System')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* ---------------- GLOBAL ---------------- */
        body {
            overflow-x: hidden;
            background-color: #f4f6f9;
        }

        /* ---------------- SIDEBAR ---------------- */
        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            color: white;

            /* Farming background (online image) */
            background-image:
                linear-gradient(rgba(25,135,84,0.95), rgba(25,135,84,0.95)),
                url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
        }

        .sidebar h4 {
            font-weight: bold;
        }

        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.15);
            padding-left: 25px;
        }

        /* ---------------- CONTENT ---------------- */
        .content {
            margin-left: 230px;
            padding: 20px;
        }

        /* ---------------- DASHBOARD BACKGROUND ---------------- */
        .admin-dashboard-bg {
            background-image:
                linear-gradient(
                    rgba(255,255,255,0.88),
                    rgba(255,255,255,0.88)
                ),
                url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: calc(100vh - 80px);
            padding: 20px;
            border-radius: 12px;
        }

        /* ---------------- CARDS ---------------- */
        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
        }

        /* ---------------- NAVBAR ---------------- */
        .top-navbar {
            border-radius: 12px;
        }

        /* ---------------- MAP ---------------- */
        #map {
            border-radius: 12px;
        }
    </style>
</head>

<body>

<!-- ================= SIDEBAR ================= -->
<div class="sidebar">
    <h4 class="text-center mt-3">🌾 Farmer System</h4>

    @if(session()->has('admin_id'))
        <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        <a href="#">👨‍🌾 Farmers</a>
        <a href="#">🛒 Buyers</a>
        <a href="#">📈 Analytics</a>
        <a href="{{ route('admin.logout') }}">🚪 Logout</a>
    @endif
</div>

<!-- ================= CONTENT ================= -->
<div class="content">

    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-light bg-light mb-4 shadow-sm px-3 top-navbar">
        <span class="navbar-brand fw-semibold">
            Welcome,
            @if(session()->has('admin_name'))
                {{ session('admin_name') }} (Admin)
            @else
                Admin
            @endif
        </span>

        <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-sm">
            🚪 Logout
        </a>
    </nav>

    <!-- PAGE CONTENT -->
    @yield('content')

</div>

</body>
</html>
