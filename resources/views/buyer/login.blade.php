<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buyer Login | Farmer Produce System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6')
                        no-repeat center center fixed;
            background-size: cover;
        }

        .bg-overlay {
            min-height: 100vh;
            background: rgba(0, 0, 0, 0.55);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            background: #ffffff;
        }
    </style>
</head>
<body>

<div class="bg-overlay">

    <div class="card login-card shadow-lg p-4">

        <div class="text-center mb-3">
            <h3>🛒 Buyer Login</h3>
            <p class="text-muted small mb-0">Farmer Produce System</p>
        </div>

        {{-- ERROR --}}
        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        {{-- SUCCESS --}}
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('buyer.login.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">📱 Mobile Number</label>
                <input type="text"
                       name="mobile"
                       class="form-control"
                       placeholder="Enter mobile number"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">🔒 Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter password"
                       required>
            </div>

            <button class="btn btn-success w-100 fw-semibold">
                Login
            </button>
        </form>

        <hr>

        <div class="text-center">
            <p class="mb-1">
                New Buyer?
                <a href="{{ route('buyer.register') }}" class="fw-semibold text-decoration-none">
                    Create Account
                </a>
            </p>

            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm mt-2">
                ⬅ Back to Home
            </a>
        </div>

    </div>
</div>

</body>
</html>
