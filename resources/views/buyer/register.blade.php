<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buyer Registration | Farmer Produce System</title>

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
            <h3 class="fw-bold">🛒 Buyer Registration</h3>
            <p class="text-muted mb-0">Farmer Produce System</p>
        </div>

        {{-- ERRORS --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $e)
                    <div>• {{ $e }}</div>
                @endforeach
            </div>
        @endif

        {{-- LOCATION STATUS --}}
        <div id="locationStatus" class="alert alert-secondary">
            📍 Trying to detect location (optional)…
        </div>

        <form method="POST" action="{{ route('buyer.register.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">👤 Buyer Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">📱 Mobile Number</label>
                <input type="text" name="mobile" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">🏷 Buyer Type</label>
                <select class="form-select" name="buyer_type" required>
                    <option value="">Select Buyer Type</option>
                    <option value="retailer">Retailer</option>
                    <option value="wholesaler">Wholesaler</option>
                    <option value="hotel">Hotel</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">🏙 City</label>
                <input type="text" name="city" class="form-control" required>
                <small class="text-muted">Used if GPS is unavailable</small>
            </div>

            <div class="mb-3">
                <label class="form-label">🔒 Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            {{-- GPS (OPTIONAL) --}}
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                Register
            </button>
        </form>

        <hr>

        <div class="text-center">
            <a href="{{ route('buyer.login') }}">Already registered? Login</a>
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const status = document.getElementById('locationStatus');

    if (!navigator.geolocation) {
        status.innerText = "ℹ GPS not supported. City will be used.";
        return;
    }

    navigator.geolocation.getCurrentPosition(
        function (pos) {
            document.getElementById('latitude').value = pos.coords.latitude;
            document.getElementById('longitude').value = pos.coords.longitude;
            status.className = 'alert alert-success';
            status.innerText = '✅ Location detected automatically';
        },
        function () {
            status.className = 'alert alert-warning';
            status.innerText = '⚠ GPS denied. City location will be used.';
        }
    );
});
</script>

</body>
</html>
