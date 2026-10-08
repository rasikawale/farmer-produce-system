<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Farmer Produce System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6')
                        no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
        }

        .bg-overlay {
            min-height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 420px;
        }
    </style>
</head>
<body>

<div class="bg-overlay">

    <div class="login-card shadow-lg">

        <div class="text-center mb-4">
            <h3 class="fw-bold">🛠 Admin Login</h3>
            <p class="text-muted mb-0">Farmer Produce System</p>
        </div>

        {{-- ERROR MESSAGE --}}
        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">📧 Admin Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter admin email"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">🔒 Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Enter password"
                    required>
            </div>

            <button class="btn btn-success w-100 fw-semibold mb-3">
                Login
            </button>
        </form>

        <div class="text-center">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">
                ⬅ Back to Home
            </a>
        </div>

    </div>

</div>

</body>
</html>
