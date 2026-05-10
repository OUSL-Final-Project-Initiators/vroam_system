<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VROAM - Vehicle Rental on Any Mode')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #18c24a;
            --dark-green:    #13a03d;
            --light-bg:      #f4f6f9;
            --card-shadow:   0 4px 18px rgba(0,0,0,0.08);
            --text-dark:     #1a1a2e;
            --text-muted:    #6c757d;
        }

        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; color: var(--text-dark); overflow-x: hidden; }

        /* ── Top Bar ── */
        .top-bar {
            background: var(--primary-green);
            color: white;
            text-align: center;
            padding: 6px 15px;
            font-size: 12.5px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        /* ── Navbar ── */
        .navbar { padding: 10px 0; border-bottom: 1px solid #eee; }
        .navbar-brand img { width: 44px; height: 44px; object-fit: contain; }
        .navbar-brand span { font-size: 1.6rem; font-weight: 800; color: var(--primary-green); letter-spacing: -0.5px; }
        .nav-link {
            font-weight: 600;
            color: #333 !important;
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.5px;
            padding: 8px 12px !important;
            transition: color 0.2s;
        }
        .nav-link:hover, .nav-link.active { color: var(--primary-green) !important; }
        .btn-signin {
            background: var(--primary-green);
            color: white !important;
            border-radius: 25px;
            padding: 7px 22px !important;
            font-size: 0.78rem;
            font-weight: 700;
        }
        .btn-signin:hover { background: var(--dark-green); }

        /* ── Footer ── */
        footer { background: #111827; color: #9ca3af; padding: 55px 0 20px; }
        footer .brand-text { font-size: 1.5rem; font-weight: 800; color: var(--primary-green); }
        footer p { font-size: 0.82rem; line-height: 1.7; margin-top: 12px; }
        footer h6 { color: white; font-weight: 700; font-size: 0.88rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 18px; }
        footer ul { list-style: none; padding: 0; margin: 0; }
        footer ul li { margin-bottom: 10px; }
        footer ul li a { color: #9ca3af; text-decoration: none; font-size: 0.82rem; transition: color 0.2s; }
        footer ul li a:hover { color: var(--primary-green); }
        footer .contact-item { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 10px; font-size: 0.82rem; }
        footer .contact-item i { color: var(--primary-green); margin-top: 2px; min-width: 14px; }
        .social-icons a {
            display: inline-flex; align-items: center; justify-content: center;
            width: 36px; height: 36px;
            border-radius: 50%;
            background: #1f2937;
            color: #9ca3af;
            font-size: 0.9rem;
            margin-right: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }
        .social-icons a:hover { background: var(--primary-green); color: white; }
        .footer-divider { border-color: #374151; margin: 40px 0 20px; }
        .footer-copy { font-size: 0.78rem; text-align: center; color: #6b7280; }
    </style>

    @stack('styles')
</head>
<body>

<!-- Top Bar -->
<div class="top-bar">WELCOME TO VROAM — VEHICLE RENTAL ON ANY MODE</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('user.index') }}">
            <img src="{{ asset('assests/images/Logo1.png') }}" alt="VROAM Logo"
                 onerror="this.style.display='none'">
            <span>VROAM</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}"
                       href="{{ route('user.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.category') ? 'active' : '' }}"
                       href="#">Vehicles</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <a href="#" class="text-dark" title="Booking History">
                    <i class="fa-solid fa-clock-rotate-left fs-5"></i>
                </a>
                <a href="#" class="text-dark position-relative" title="Messages">
                    <i class="fa-solid fa-envelope fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size: 0.6rem;">2</span>
                </a>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle text-dark"
                       id="profileDropdown" data-bs-toggle="dropdown">
                        <div class="text-end d-none d-sm-block">
                            <div class="fw-bold" style="font-size: 0.82rem; line-height: 1.2;">Alex Perera</div>
                            <small class="text-muted" style="font-size: 0.7rem;">Verified User</small>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Alex+Perera&background=18c24a&color=fff"
                             class="rounded-circle border" style="width: 38px; height: 38px;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li><a class="dropdown-item py-2" href="#">
                            <i class="fa-solid fa-user me-2 text-success"></i> My Profile
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2 text-danger" href="#">
                            <i class="fa-solid fa-power-off me-2"></i> Logout
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Page Content -->
@yield('content')

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row g-5">
            <div class="col-md-3">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('assests/images/Logo1.png') }}" alt="VROAM"
                         style="width:40px; height:40px; object-fit:contain;"
                         onerror="this.style.display='none'">
                    <span class="brand-text">VROAM</span>
                </div>
                <p>We provide a complete vehicle rental experience — bikes, cars, vans, trucks, heavy machinery, and specialty equipment — all on one trusted platform.</p>
                <div class="contact-item mt-3">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Colombo, Sri Lanka</span>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-phone"></i>
                    <span>+94 (11) 234 5678</span>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span>info@vroam.lk</span>
                </div>
            </div>
            <div class="col-md-2">
                <h6>Quick Links</h6>
                <ul>
                    <li><a href="{{ route('user.index') }}">Home</a></li>
                    <li><a href="#">Lease Vehicles</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Vehicle Categories</h6>
                <ul>
                    <li><a href="{{ route('user.category', 'bicycles') }}">Bicycles</a></li>
                    <li><a href="{{ route('user.category', 'motorcycles') }}">Motorcycles</a></li>
                    <li><a href="{{ route('user.category', 'cars') }}">Cars</a></li>
                    <li><a href="{{ route('user.category', 'suvs') }}">SUVs</a></li>
                    <li><a href="{{ route('user.category', 'vans') }}">Vans</a></li>
                    <li><a href="{{ route('user.category', 'agricultural-vehicles') }}">Agricultural Vehicles</a></li>
                    <li><a href="{{ route('user.category', 'construction-vehicles') }}">Construction Vehicles</a></li>
                    <li><a href="{{ route('user.category', 'camper-vehicles') }}">Camper Vehicles</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Customer Support</h6>
                <ul class="mb-4">
                    <li><a href="#">Help Centre</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">How to Book / Return</a></li>
                    <li><a href="#">Cancellation Policy</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                </ul>
                <h6>Social Media</h6>
                <div class="social-icons">
                    <a href="#" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" title="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <hr class="footer-divider">
        <p class="footer-copy">© {{ date('Y') }} VROAM Platform. All Rights Reserved. | Designed &amp; Built for Sri Lanka's Vehicle Rental Market.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>
