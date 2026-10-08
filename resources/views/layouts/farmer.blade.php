<!DOCTYPE html>
<html>
<head>
    <title>Farmer Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ---------- PAGE BACKGROUND ---------- */
        body {
            min-height: 100vh;
            background-image:
                linear-gradient(
                    rgba(255,255,255,0.85),
                    rgba(255,255,255,0.85)
                ),
                url('https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* ---------- NAVBAR ---------- */
        .navbar {
            background-image:
                linear-gradient(
                    rgba(25,135,84,0.95),
                    rgba(25,135,84,0.95)
                ),
                url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
        }

        /* ---------- CONTENT WRAPPER ---------- */
        .farmer-content {
            background-color: rgba(255,255,255,0.95);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark px-4 shadow">
    <span class="navbar-brand">🌾 Farmer Dashboard</span>

    <a href="{{ route('buyer.logout') }}" class="btn btn-danger btn-sm">
        🚪 Logout
    </a>
</nav>

<!-- PAGE CONTENT -->
<div class="container mt-4">
    <div class="farmer-content">
        @yield('content')
    </div>
</div>

</body>
</html>
