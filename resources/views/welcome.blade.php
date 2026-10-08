<!DOCTYPE html>
<html lang="en">
<head>
    <title>FarmMatch | Direct Farmer–Buyer System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts: Rubik -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1b5e20; /* Deep Green */
            --secondary: #4caf50; /* Fresh Green */
            --accent: #fdd835; /* Harvest Yellow */
            --dark: #121212;
            --light: #f8f9fa;
            --shadow-soft: 0 15px 35px rgba(0,0,0,0.05);
            --shadow-hover: 0 25px 50px rgba(27, 94, 32, 0.15);
        }

        body {
            font-family: 'Rubik', sans-serif;
            background-color: #ffffff;
            color: #333;
            overflow-x: hidden;
            position: relative;
        }

        /* --- BACKGROUND SHAPES --- */
        .bg-shape {
            position: absolute;
            z-index: -1;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.6;
            animation: floatShape 10s infinite alternate;
        }
        .shape-1 { top: -10%; right: -5%; width: 500px; height: 500px; background: #e8f5e9; }
        .shape-2 { bottom: 10%; left: -10%; width: 400px; height: 400px; background: #fff9c4; }

        @keyframes floatShape {
            0% { transform: translate(0, 0); }
            100% { transform: translate(20px, 40px); }
        }

        /* --- NAVBAR --- */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            padding: 15px 0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 15px rgba(0,0,0,0.03);
        }
        .navbar-brand {
            font-weight: 900;
            color: var(--primary) !important;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
        }
        .nav-link {
            font-weight: 500;
            color: #444 !important;
            margin: 0 12px;
            font-size: 0.95rem;
        }
        .nav-link:hover {
            color: var(--primary) !important;
        }
        .btn-ghost {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
            padding: 8px 20px;
            border-radius: 30px;
            transition: 0.3s;
        }
        .btn-ghost:hover {
            background: var(--primary);
            color: #fff;
        }

        /* --- HERO SECTION --- */
        .hero {
            padding: 180px 0 100px;
            position: relative;
            overflow: hidden;
        }
        
        /* NEW: Background Image Styling */
        .hero-bg-image {
            position: absolute;
            top: 0;
            right: 0;
            width: 60%; /* Cover right side */
            height: 100%;
            /* High quality Agri-Tech Image */
            background: url('https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            z-index: -3;
        }

        /* NEW: The Gradient Overlay to blend image into white */
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, #ffffff 0%, #ffffff 40%, rgba(255,255,255,0.4) 70%, rgba(255,255,255,0.1) 100%);
            z-index: -2;
        }

        .hero h1 {
            font-weight: 800;
            font-size: 3.8rem;
            line-height: 1.1;
            margin-bottom: 20px;
            color: var(--dark);
        }
        .text-gradient {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .hero-btn {
            padding: 16px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 10px 20px rgba(27, 94, 32, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-block;
        }
        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(27, 94, 32, 0.4);
        }

        /* --- STEPS SECTION --- */
        .step-icon-box {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            transition: 0.3s;
        }
        .step-card:hover .step-icon-box {
            background: var(--primary);
            color: white;
            transform: rotateY(360deg);
        }

        /* --- ROLE SELECTION (The Core Conversion) --- */
        #role-section {
            scroll-margin-top: 80px; /* Offset for sticky header */
        }
        .role-card-modern {
            background: white;
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 24px;
            padding: 40px 30px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
            box-shadow: var(--shadow-soft);
        }
        
        /* Dynamic Top Border */
        .role-card-modern::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 6px;
            background: var(--primary);
            transition: 0.3s;
        }
        .role-buyer::before { background: #1976d2; }
        .role-admin::before { background: #424242; }

        .role-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }

        .role-img-circle {
            width: 100px;
            height: 100px;
            margin: -70px auto 20px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: 0.4s;
            position: relative;
            z-index: 2;
        }
        
        .role-card-modern:hover .role-img-circle {
            transform: scale(1.1);
        }

        .role-farmer .role-img-circle { color: var(--primary); }
        .role-buyer .role-img-circle { color: #1976d2; }
        .role-admin .role-img-circle { color: #424242; }

        .btn-role {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            margin-bottom: 10px;
            border: 1px solid transparent;
            transition: 0.3s;
        }
        .btn-role-filled {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(27, 94, 32, 0.2);
        }
        .btn-role-filled:hover {
            background: #144a17;
            transform: translateY(-2px);
        }
        .btn-role-outline {
            border-color: var(--primary);
            color: var(--primary);
            background: transparent;
        }
        .btn-role-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* Colors for specific roles */
        .role-buyer .btn-role-filled { background: #1976d2; box-shadow: 0 4px 12px rgba(25, 118, 210, 0.2); }
        .role-buyer .btn-role-outline { border-color: #1976d2; color: #1976d2; }
        .role-buyer .btn-role-outline:hover { background: #1976d2; color: white; }
        
        .role-admin .btn-role-filled { background: #424242; box-shadow: 0 4px 12px rgba(66, 66, 66, 0.2); }

        /* --- TRUST / STATS --- */
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.02);
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark);
            display: block;
        }
        .stat-label {
            color: #666;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* --- FOOTER --- */
        footer {
            background: #0d0d0d;
            color: #888;
            padding: 60px 0 30px;
            font-size: 0.9rem;
        }
        .footer-brand {
            font-size: 1.5rem;
            color: #fff;
            font-weight: 700;
            margin-bottom: 20px;
            display: block;
        }
        .footer-link {
            color: #888;
            text-decoration: none;
            display: block;
            margin-bottom: 12px;
            transition: 0.3s;
        }
        .footer-link:hover {
            color: var(--accent);
            padding-left: 5px;
        }

        /* --- ANIMATIONS --- */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 992px) {
            /* On tablets/mobile, make image a full background with dark overlay */
            .hero-bg-image {
                width: 100%;
                opacity: 0.15; /* Make it subtle so text reads well */
            }
            .hero-overlay {
                background: #ffffff; /* Solid white on mobile */
            }
        }
        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .hero { padding-top: 120px; }
        }
    </style>
</head>
<body>

    <!-- Background Shapes -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-seedling me-2 text-success"></i> FarmMatch
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about.system') }}">About System</a></li>
                  
                    <!-- Single "Explore" CTA in nav, rather than specific joins -->
                    <li class="nav-item ms-lg-3">
                        <a href="#role-section" class="btn-ghost">Get Started</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero d-flex align-items-center">
        <!-- NEW: Background Image Layer -->
        <div class="hero-bg-image"></div>
        <!-- NEW: Gradient Overlay Layer -->
        <div class="hero-overlay"></div>
        
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in-up">
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-3">
                        <i class="fas fa-circle text-success small me-2" style="font-size: 8px;"></i> #1 Agri-Tech Platform
                    </span>
                    <h1>Bridging the gap between <br><span class="text-gradient">Farmers & Buyers</span></h1>
                    <p class="lead text-secondary mb-5">Eliminate middlemen. Secure fair prices. Access fresh produce directly from the source.</p>
                    
                    <!-- MODERN CHANGE: Only one main call to action here -->
                    <a href="#role-section" class="hero-btn btn-success">
                        Explore Roles <i class="fas fa-arrow-down ms-2"></i>
                    </a>
                </div>
                <!-- Right side is left empty to show the background image clearly on desktop -->
                <div class="col-lg-6 d-none d-lg-block"></div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5 fade-in-up">
                <h6 class="text-success text-uppercase fw-bold letter-spacing-2">Process</h6>
                <h2 class="fw-bold display-6">How It Works</h2>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4 fade-in-up">
                    <div class="step-card p-4">
                        <div class="step-icon-box mx-auto"><i class="fas fa-fingerprint"></i></div>
                        <h5 class="fw-bold">1. Register</h5>
                        <p class="text-muted">Create a secure profile in seconds using your mobile number.</p>
                    </div>
                </div>
                <div class="col-md-4 fade-in-up" style="animation-delay: 0.1s;">
                    <div class="step-card p-4">
                        <div class="step-icon-box mx-auto"><i class="fas fa-box-open"></i></div>
                        <h5 class="fw-bold">2. List or Search</h5>
                        <p class="text-muted">Farmers list produce; Buyers post demand. Real-time data.</p>
                    </div>
                </div>
                <div class="col-md-4 fade-in-up" style="animation-delay: 0.2s;">
                    <div class="step-card p-4">
                        <div class="step-icon-box mx-auto"><i class="fas fa-comments-dollar"></i></div>
                        <h5 class="fw-bold">3. Direct Trade</h5>
                        <p class="text-muted">Connect directly, negotiate, and complete the trade fairly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ROLE SELECTION (The ONLY place with specific Join buttons) -->
    <section id="role-section" class="py-5 bg-light position-relative">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5 fade-in-up">
                    <h2 class="fw-bold mb-3">Choose Your Identity</h2>
                    <p class="text-muted">Select a role below to access your personalized dashboard and start trading.</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                
                <!-- FARMER CARD -->
                <div class="col-md-4 fade-in-up">
                    <div class="role-card-modern role-farmer text-center">
                        <div class="role-img-circle">
                            <i class="fas fa-tractor"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Farmer</h4>
                        <p class="text-muted small mb-4">Sell your harvest directly to the market and get the best price.</p>
                        
                        <a href="{{ route('farmer.login') }}" class="btn btn-role btn-role-filled">
                            Login to Farm
                        </a>
                        <a href="{{ route('farmer.register') }}" class="btn btn-role btn-role-outline">
                            Register New
                        </a>
                    </div>
                </div>

                <!-- BUYER CARD -->
                <div class="col-md-4 fade-in-up" style="animation-delay: 0.1s;">
                    <div class="role-card-modern role-buyer text-center">
                        <div class="role-img-circle">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Buyer</h4>
                        <p class="text-muted small mb-4">Source fresh, high-quality produce from verified local farmers.</p>
                        
                        <a href="{{ route('buyer.login') }}" class="btn btn-role btn-role-filled">
                            Login to Buy
                        </a>
                        <a href="{{ route('buyer.register') }}" class="btn btn-role btn-role-outline">
                            Register New
                        </a>
                    </div>
                </div>

                <!-- ADMIN CARD -->
                <div class="col-md-4 fade-in-up" style="animation-delay: 0.2s;">
                    <div class="role-card-modern role-admin text-center">
                        <div class="role-img-circle">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Admin</h4>
                        <p class="text-muted small mb-4">Manage the platform, verify users, and oversee transactions.</p>
                        
                        <a href="{{ route('admin.login') }}" class="btn btn-role btn-role-filled">
                            Admin Panel
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- TRUST & STATS -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 fade-in-up">
                    <div class="stat-card">
                        <i class="fas fa-shield-alt text-success mb-3 fs-2"></i>
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Verified Profiles</span>
                    </div>
                </div>
                <div class="col-md-4 fade-in-up">
                    <div class="stat-card">
                        <i class="fas fa-coins text-warning mb-3 fs-2"></i>
                        <span class="stat-number">0%</span>
                        <span class="stat-label">Middlemen Fee</span>
                    </div>
                </div>
                <div class="col-md-4 fade-in-up">
                    <div class="stat-card">
                        <i class="fas fa-bolt text-primary mb-3 fs-2"></i>
                        <span class="stat-number">Fast</span>
                        <span class="stat-label">Direct Matching</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT CTA (Replacing duplicate Join section) -->
    <section class="py-5 bg-success bg-opacity-10">
        <div class="container text-center fade-in-up">
            <h3 class="fw-bold mb-3">Have Questions?</h3>
            <p class="text-muted mb-4">Our support team is here to help you get started on the right foot.</p>
            <a href="#" class="btn btn-outline-success rounded-pill px-4">Contact Support</a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <span class="footer-brand"><i class="fas fa-leaf text-success me-2"></i> FarmMatch</span>
                    <p class="small">Revolutionizing agriculture through technology. We build bridges between the hardworking farmer and the everyday buyer.</p>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="text-white mb-3">Platform</h5>
                    <a href="#" class="footer-link">About Us</a>
                    <a href="#" class="footer-link">Careers</a>
                    <a href="#" class="footer-link">Press</a>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="text-white mb-3">Links</h5>
                    <a href="{{ route('home') }}" class="footer-link">Home</a>
                    <a href="#role-section" class="footer-link">Login</a>
                    <a href="#role-section" class="footer-link">Register</a>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white mb-3">Newsletter</h5>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Your email">
                        <button class="btn btn-success" type="button">Subscribe</button>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="text-center small">
                <p class="mb-0">© {{ date('Y') }} FarmMatch System. All rights reserved.</p>
                <p class="mb-0 text-muted mt-1">Designed by <span class="text-warning fw-bold">Rasika Wale</span></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Smooth Scrolling for "Explore Roles" button
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Fade In Animation on Scroll
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });
    </script>

</body>
</html>