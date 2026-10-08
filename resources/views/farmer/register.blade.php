<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Farmer Registration | Farmer Produce System</title>

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
            background: rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 460px;
        }
    </style>
</head>
<body>

<div class="bg-overlay">

    <div class="register-card shadow-lg">

        <div class="text-center mb-4">
            <h3 class="fw-bold">👨‍🌾 Farmer Registration</h3>
            <p class="text-muted mb-0">Farmer Produce System</p>
        </div>

        {{-- VALIDATION ERRORS --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $e)
                    <div>• {{ $e }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('farmer.register.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">👤 Full Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Enter full name"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">📱 Mobile Number</label>
                <input type="text"
                       name="mobile"
                       class="form-control"
                       placeholder="Enter mobile number"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">🏡 Village</label>
                <input type="text"
                       name="village"
                       class="form-control"
                       placeholder="Enter village name"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">🔒 Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Create password"
                       required>
            </div>
            <div>
   

            <button class="btn btn-success w-100 fw-semibold">
                Register
            </button>
        </form>

        <hr>

        <div class="text-center">
            <p class="mb-1">
                Already registered?
                <a href="{{ route('farmer.login') }}" class="fw-semibold text-decoration-none">
                    Login
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
