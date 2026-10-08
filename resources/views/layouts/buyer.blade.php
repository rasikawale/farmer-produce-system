<!DOCTYPE html>
<html>
<head>
    <title>Buyer Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ----------- GLOBAL BACKGROUND ----------- */
        body {
            min-height: 100vh;
            background-image:
                linear-gradient(
                    rgba(255,255,255,0.9),
                    rgba(255,255,255,0.9)
                ),
                url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* ----------- NAVBAR ----------- */
        .buyer-navbar {
            background-image:
                linear-gradient(rgba(33,37,41,0.95), rgba(33,37,41,0.95)),
                url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
        }

        /* ----------- SIDEBAR ----------- */
        .buyer-sidebar {
            height: 100vh;
            background-image:
                linear-gradient(rgba(0, 97, 37, 0.9), rgba(13,110,253,0.9)),
                url('https://images.unsplash.com/photo-1592982537447-6b8c2b2f3d7f?auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .buyer-sidebar a {
            color: white;
            padding: 12px 15px;
            display: block;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 6px;
            transition: 0.2s;
        }

        .buyer-sidebar a:hover {
            background: rgba(255,255,255,0.2);
            padding-left: 20px;
        }

        /* ----------- CONTENT ----------- */
        .buyer-content {
            background: rgba(255,255,255,0.95);
            border-radius: 12px;
            padding: 20px;
            min-height: calc(100vh - 80px);
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark px-3 buyer-navbar shadow">
    <span class="navbar-brand">🛒 Buyer Dashboard</span>

    <a href="{{ route('buyer.logout') }}" class="btn btn-danger btn-sm">
        🚪 Logout
    </a>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 buyer-sidebar p-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('buyer.dashboard') }}">📊 Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('buyer.intent.create') }}">➕ New Demand</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('buyer.matches') }}">🤝 Matches</a>
                </li>
            </ul>
        </div>

        <!-- CONTENT -->
        <div class="col-md-10 p-4">
            <div class="buyer-content">
                @yield('content')
            </div>
        </div>

    </div>
</div>

</body>
</html>
