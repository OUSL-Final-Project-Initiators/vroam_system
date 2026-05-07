<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VROAM</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        /* ── Top Bar ── */
        .top-bar {
            background: #18c24a;
            color: white;
            text-align: center;
            padding: 6px;
            font-size: 12px;
            font-weight: bold;
        }

        /* ── Navbar ── */
        .navbar {
            background: white;
            padding: 15px 40px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: bold;
            color: #18c24a !important;
        }

        .nav-link {
            color: black !important;
            margin: 0 10px;
            font-weight: 600;
        }

        .nav-link:hover {
            color: #18c24a !important;
        }

        /* ── Hero ── */
        .hero {
            background: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600&auto=format&fit=crop') center/cover;
            height: 500px;
            position: relative;
            color: white;
        }

        .hero-overlay {
            background: rgba(0,0,0,0.5);
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .hero h1 {
            font-size: 50px;
            font-weight: bold;
        }

        .hero p {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .hero-buttons .btn {
            margin: 10px;
            padding: 12px 30px;
            font-weight: bold;
        }

        .search-box {
            background: rgba(255,255,255,0.95);
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            width: 80%;
        }

        /* ── Section Titles ── */
        .section-title {
            text-align: center;
            margin: 60px 0 30px;
        }

        .section-title h2 {
            font-weight: bold;
            font-size: 28px;
        }

        .section-title p {
            color: #666;
            margin-top: 8px;
        }

        /* ── Category Cards ── */
        .category-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: 0.3s;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .category-card img {
            width: 100%;
            height: 120px;
            object-fit: contain;
        }

        .category-card h5 {
            margin-top: 15px;
            font-weight: bold;
        }

        /* ── Vehicle Cards ── */
        .vehicle-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .vehicle-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .vehicle-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .vehicle-card-body {
            padding: 15px;
        }

        .vehicle-card h5 {
            font-weight: bold;
        }

        /* ── Why Choose Us ── */
        .why-section {
            background: #f8f8f8;
            padding: 60px 0;
        }

        .feature-card {
            background: white;
            border-radius: 10px;
            padding: 25px 15px;
            text-align: center;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .feature-card img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .feature-card h6 {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 12px;
            color: #666;
            line-height: 1.6;
        }

        /* ── Testimonials ── */
        .testimonials-section {
            background: url('https://images.unsplash.com/photo-1464219789935-c2d9d9aba644?q=80&w=1600&auto=format&fit=crop') center/cover;
            position: relative;
            padding: 80px 0;
            color: white;
        }

        .testimonials-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.65);
        }

        .testimonials-section .container {
            position: relative;
            z-index: 1;
        }

        .testimonial-card {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(4px);
            border-radius: 12px;
            padding: 25px 20px;
            text-align: center;
            height: 100%;
        }

        .testimonial-card .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .testimonial-card .avatar i {
            font-size: 28px;
            color: rgba(255,255,255,0.7);
        }

        .testimonial-card .name {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .testimonial-card .review {
            font-size: 12px;
            color: rgba(255,255,255,0.85);
            font-style: italic;
            margin-bottom: 10px;
        }

        .testimonial-card .stars {
            color: #ffc107;
            font-size: 13px;
        }

        /* ── Newsletter ── */
        .newsletter-section {
            background: #f5f5f5;
            padding: 70px 0;
            text-align: center;
        }

        .newsletter-section h3 {
            font-weight: bold;
            font-size: 26px;
            margin-bottom: 10px;
        }

        .newsletter-section p {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .newsletter-input-group {
            max-width: 480px;
            margin: 0 auto;
        }

        .newsletter-input-group .form-control {
            border-radius: 8px 0 0 8px;
            border: 1px solid #ddd;
            padding: 12px 16px;
            font-size: 14px;
        }

        .newsletter-input-group .btn {
            border-radius: 0 8px 8px 0;
            padding: 12px 24px;
            font-weight: bold;
        }

        /* ── CTA ── */
        .cta-section {
            background: white;
            padding: 70px 0;
            text-align: center;
        }

        .cta-section h2 {
            font-weight: bold;
            font-size: 30px;
            margin-bottom: 12px;
        }

        .cta-section p {
            color: #666;
            margin-bottom: 30px;
        }

        .cta-section .btn {
            margin: 8px;
            padding: 13px 32px;
            font-weight: bold;
            border-radius: 8px;
        }

        /* ── Footer ── */
        footer {
            background: #111;
            color: white;
            padding: 50px 0 20px;
            margin-top: 0;
        }

        .footer-logo {
            font-size: 26px;
            font-weight: bold;
            color: #18c24a;
        }

        .footer-logo-sub {
            font-size: 11px;
            color: #aaa;
            margin-top: 4px;
        }

        .footer-logo img {
            width: 80px;
            margin-bottom: 10px;
        }

        footer h6 {
            font-weight: bold;
            color: white;
            margin-bottom: 16px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li {
            margin-bottom: 8px;
        }

        footer ul li a {
            color: #aaa;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s;
        }

        footer ul li a:hover {
            color: #18c24a;
        }

        .footer-bottom {
            border-top: 1px solid #333;
            margin-top: 40px;
            padding-top: 20px;
            text-align: center;
            color: #666;
            font-size: 13px;
        }

        .footer-logo-wrap img {
            width: 110px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar">
        WELCOME VROAM PLATFORM - VEHICLE RENTAL ON ANY MODE
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">VROAM</a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="#">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">VEHICLES</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">CATEGORIES</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">ABOUT US</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">CONTACT US</a></li>
                </ul>
                <a href="#" class="btn btn-outline-success">Login / Sign-Up</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay">
            <h1>RENT ANY VEHICLE ANYTIME</h1>
            <p>From bicycles to heavy machinery - find the perfect vehicle for your journey.</p>
            <div class="hero-buttons">
                <button class="btn btn-success">Browse Vehicles</button>
                <button class="btn btn-success">Find Near Me</button>
            </div>
            <div class="search-box">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Pick-up Location">
                    </div>
                    <div class="col-md-3">
                        <input type="datetime-local" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="datetime-local" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success w-100">Show Vehicles</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vehicle Categories -->
    <div class="container">
        <div class="section-title">
            <h2>EXPLORE VEHICLE CATEGORIES</h2>
            <p>Choose from a wide range of vehicles.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="category-card">
                    <img src="https://cdn-icons-png.flaticon.com/512/2972/2972185.png">
                    <h5>BICYCLES</h5>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="category-card">
                    <img src="https://cdn-icons-png.flaticon.com/512/741/741407.png">
                    <h5>MOTORCYCLES</h5>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="category-card">
                    <img src="https://cdn-icons-png.flaticon.com/512/744/744465.png">
                    <h5>CARS</h5>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="category-card">
                    <img src="https://cdn-icons-png.flaticon.com/512/3774/3774278.png">
                    <h5>SUVS</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Picks -->
    <div class="container">
        <div class="section-title">
            <h2>Top Picks for You</h2>
            <p>Discover the most popular vehicles.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="vehicle-card">
                    <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=1000&auto=format&fit=crop">
                    <div class="vehicle-card-body">
                        <h5>Toyota Axio</h5>
                        <p>Category: Car</p>
                        <p>Price: Rs.7500 / Day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="vehicle-card">
                    <img src="https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?q=80&w=1000&auto=format&fit=crop">
                    <div class="vehicle-card-body">
                        <h5>Toyota Prado</h5>
                        <p>Category: SUV</p>
                        <p>Price: Rs.15000 / Day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="vehicle-card">
                    <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?q=80&w=1000&auto=format&fit=crop">
                    <div class="vehicle-card-body">
                        <h5>Suzuki WagonR</h5>
                        <p>Category: Car</p>
                        <p>Price: Rs.6000 / Day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="vehicle-card">
                    <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=1000&auto=format&fit=crop">
                    <div class="vehicle-card-body">
                        <h5>Yamaha R15</h5>
                        <p>Category: Motorcycle</p>
                        <p>Price: Rs.3000 / Day</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── WHY CHOOSE US ── -->
    <section class="why-section mt-5">
        <div class="container">
            <div class="section-title" style="margin-top:0">
                <h2>WHY CHOOSE OUR PLATFORM?</h2>
                <p>We provide a complete and reliable vehicle rental solution designed to meet every need—from personal travel to heavy-duty industrial work. Our platform ensures convenience, flexibility, and trust at every step of your journey.</p>
            </div>

            <div class="row g-4">
                <!-- Row 1 -->
                <div class="col-md-3 col-6">
                    <div class="feature-card">
                        <img src="https://cdn-icons-png.flaticon.com/512/3774/3774278.png" alt="Wide Range">
                        <h6>Wide Range of Vehicles</h6>
                        <p>Access an extensive collection of vehicles across multiple categories, including bicycles, motorcycles, cars, luxury vehicles, agricultural machinery, and construction equipment—all in one place.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="feature-card">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135706.png" alt="Pricing">
                        <h6>Affordable & Transparent Pricing</h6>
                        <p>Enjoy competitive rental rates with no hidden charges. Compare prices easily and choose the best option that fits your budget.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="feature-card">
                        <img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="Booking">
                        <h6>Easy & Fast Booking Process</h6>
                        <p>Our user-friendly system allows you to search, select, and book a vehicle in just a few clicks—saving you time and effort.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="feature-card">
                        <img src="https://cdn-icons-png.flaticon.com/512/1048/1048953.png" alt="Trusted">
                        <h6>Trusted & Verified Owners</h6>
                        <p>We ensure that all vehicle owners and listings are verified, providing you with a safe and reliable rental experience.</p>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="col-md-3 col-6">
                    <div class="feature-card">
                        <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Location">
                        <h6>Location-Based Search</h6>
                        <p>Find vehicles near your location quickly using smart search filters, making rentals more convenient and accessible.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="feature-card">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Flexible">
                        <h6>Flexible Rental Options</h6>
                        <p>Choose rental durations that suit your needs—hourly, daily, weekly, or long-term rentals.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="feature-card">
                        <img src="https://cdn-icons-png.flaticon.com/512/1379/1379617.png" alt="Ratings">
                        <h6>Ratings & Reviews</h6>
                        <p>Make informed decisions by checking ratings and reviews from other customers before booking.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="feature-card">
                        <img src="https://cdn-icons-png.flaticon.com/512/744/744465.png" alt="Maintained">
                        <h6>Well-Maintained Vehicles</h6>
                        <p>All listed vehicles are regularly maintained to ensure safety, reliability, and performance.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="feature-card">
                        <img src="https://cdn-icons-png.flaticon.com/512/597/597177.png" alt="Support">
                        <h6>24/7 Customer Support</h6>
                        <p>Our dedicated support team is available around the clock to assist you with bookings, issues, or inquiries.</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="feature-card">
                        <img src="https://cdn-icons-png.flaticon.com/512/2972/2972185.png" alt="All-in-One">
                        <h6>All-in-One Platform</h6>
                        <p>From a simple bicycle ride to heavy construction machinery, everything you need is available in a single platform.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── TESTIMONIALS ── -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-title" style="margin-top:0; color:white;">
                <h2 style="color:white;">WHAT OUR CUSTOMERS SAY</h2>
                <p style="color:rgba(255,255,255,0.75);">See what our customers say about their experience with our easy and flexible vehicle rental service.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-2 col-6">
                    <div class="testimonial-card">
                        <div class="avatar"><i class="fas fa-user"></i></div>
                        <div class="name">Stafeny</div>
                        <div class="review">"Very easy to rent and great service!"</div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="testimonial-card">
                        <div class="avatar"><i class="fas fa-user"></i></div>
                        <div class="name">Jhone</div>
                        <div class="review">"Wide range of vehicles and affordable prices."</div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="testimonial-card">
                        <div class="avatar"><i class="fas fa-user"></i></div>
                        <div class="name">Jhone</div>
                        <div class="review">"Wide range of vehicles and affordable prices."</div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="testimonial-card">
                        <div class="avatar"><i class="fas fa-user"></i></div>
                        <div class="name">Stafeny</div>
                        <div class="review">"Very easy to rent and great service!"</div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="testimonial-card">
                        <div class="avatar"><i class="fas fa-user"></i></div>
                        <div class="name">Stafeny</div>
                        <div class="review">"Very easy to rent and great service!"</div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── NEWSLETTER ── -->
    <section class="newsletter-section">
        <div class="container">
            <h3>Get the Latest Offers &amp; Updates</h3>
            <p>Stay updated with exclusive deals, special discounts, and the latest vehicle arrivals. Subscribe to our newsletter and never miss an opportunity to find the perfect ride.</p>
            <div class="input-group newsletter-input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-envelope text-muted"></i>
                </span>
                <input type="email" class="form-control border-start-0" placeholder="Enter Your Email Address" style="border-radius:0;">
                <button class="btn btn-success">Subscribe Now</button>
            </div>
        </div>
    </section>

    <!-- ── CTA ── -->
    <section class="cta-section">
        <div class="container">
            <h2>READY TO GET STARTED?</h2>
            <p>Join now and explore thousands of vehicles across multiple categories.</p>
            <a href="#" class="btn btn-success">
                <i class="fas fa-user-plus me-2"></i>Sign Up
            </a>
            <a href="#" class="btn btn-outline-success">
                <i class="fas fa-search me-2"></i>Browse Vehicles
            </a>
        </div>
    </section>

    <!-- ── FOOTER ── -->
    <footer>
        <div class="container">
            <div class="row g-4">

                <!-- Brand -->
                <div class="col-md-3">
                    <div class="footer-logo-wrap mb-3">
                        <div class="footer-logo">VROAM</div>
                        <div class="footer-logo-sub">VEHICLE RENTAL ON ANY MODE</div>
                    </div>
                    <p style="color:#aaa; font-size:13px; line-height:1.7;">
                        Your trusted platform for renting any vehicle — from bicycles to heavy machinery — anytime, anywhere.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-3">
                    <h6>Quick Links</h6>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Browse Vehicles</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Login / Sign Up</a></li>
                    </ul>
                </div>

                <!-- Vehicle Categories -->
                <div class="col-md-3">
                    <h6>Vehicle Categories</h6>
                    <ul>
                        <li><a href="#">Bicycles</a></li>
                        <li><a href="#">Motorcycles</a></li>
                        <li><a href="#">Cars</a></li>
                        <li><a href="#">SUVs</a></li>
                        <li><a href="#">Heavy Machinery</a></li>
                    </ul>
                </div>

                <!-- Customer Support -->
                <div class="col-md-3">
                    <h6>Customer Support</h6>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Report an Issue</a></li>
                    </ul>
                </div>

            </div>

            <div class="footer-bottom">
                © 2026 VROAM - All Rights Reserved
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
