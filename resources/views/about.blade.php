<!DOCTYPE html>
<html lang="en">
<head>
    <title>About System | FarmMatch</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f4f7f6;
            font-family: 'Rubik', sans-serif;
        }

        .about-hero {
            background: linear-gradient(135deg, #2E7D32, #66BB6A);
            color: white;
            padding: 80px 0;
            text-align: center;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
        }

        .about-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            height: 100%;
        }

        .icon {
            font-size: 2rem;
            color: #2E7D32;
            margin-bottom: 15px;
        }

        footer {
            background: #222;
            color: #bbb;
            padding: 20px;
            margin-top: 50px;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- HERO -->
<section class="about-hero">
    <div class="container">
        <h1>🌾 About FarmMatch System</h1>
        <p class="mt-3">
            A smart digital platform that directly connects Farmers and Buyers
        </p>
    </div>
</section>

<!-- CONTENT -->
<div class="container mt-5">
    <div class="row g-4">

        <!-- DIRECT MATCHING -->
        <div class="col-md-4">
            <div class="about-card text-center">
                <div class="icon">🤝</div>
                <h5>Direct Matching</h5>
                <p>
                    Farmers and buyers connect directly without any middlemen,
                    ensuring transparency and trust.
                </p>
            </div>
        </div>

        <!-- FAIR PRICING -->
        <div class="col-md-4">
            <div class="about-card text-center">
                <div class="icon">💰</div>
                <h5>Fair Pricing</h5>
                <p>
                    Transparent pricing system that helps farmers earn better
                    value for their produce.
                </p>
            </div>
        </div>

        <!-- MOBILE BASED -->
        <div class="col-md-4">
            <div class="about-card text-center">
                <div class="icon">📱</div>
                <h5>Mobile Based System</h5>
                <p>
                    Simple and secure login using mobile numbers,
                    easy to use for everyone.
                </p>
            </div>
        </div>

    </div>

    <!-- HOW IT WORKS -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="about-card">
                <h4 class="mb-3">⚙️ How Does FarmMatch Work?</h4>
                <ul>
                    <li>👨‍🌾 Farmers add their produce details</li>
                    <li>🛒 Buyers submit their crop requirements</li>
                    <li>🤖 System calculates match percentage</li>
                    <li>📞 Direct contact via WhatsApp or phone</li>
                    <li>✅ Deals can be accepted or rejected</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- BACK BUTTON -->
    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-success">
            ⬅ Back to Home
        </a>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <p>© {{ date('Y') }} FarmMatch System | Designed by Rasika Wale</p>
</footer>

</body>
</html>
