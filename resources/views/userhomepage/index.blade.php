@extends('layouts.app')

@section('title', 'VROAM - Vehicle Rental on Any Mode')

@push('styles')
<style>
    body { background: white; }

    /* ── Hero ── */
    .hero {
        background: linear-gradient(rgba(0,0,0,0.58), rgba(0,0,0,0.58)),
                    url('{{ asset("assests/images/photorealistic-view-off-road-car-with-nature-terrain-weather-conditions (2).jpg") }}') center/cover no-repeat;
        min-height: 620px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        padding: 60px 0 40px;
    }
    .hero h1 {
        font-size: 3rem;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .hero p { font-size: 1rem; opacity: 0.9; margin-bottom: 22px; }
    .hero-btn-browse {
        background: var(--primary-green);
        color: white;
        border: none;
        border-radius: 30px;
        padding: 11px 32px;
        font-weight: 700;
        font-size: 0.9rem;
        margin-right: 10px;
        transition: 0.3s;
    }
    .hero-btn-browse:hover { background: var(--dark-green); color: white; }
    .hero-btn-find {
        background: transparent;
        color: white;
        border: 2px solid white;
        border-radius: 30px;
        padding: 11px 32px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: 0.3s;
    }
    .hero-btn-find:hover { background: white; color: var(--text-dark); }

    /* ── Search Box ── */
    .search-container { width: 96%; max-width: 1140px; margin-top: 32px; }
    .search-box {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(14px);
        border: 1px solid rgba(255,255,255,0.25);
        border-radius: 14px;
        padding: 24px 28px;
    }
    .search-box label {
        font-size: 0.72rem;
        font-weight: 700;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    .search-box .form-control,
    .search-box .form-select,
    .search-box .input-group-text {
        border: none;
        border-radius: 8px;
        font-size: 0.85rem;
        background: white;
    }
    .search-box .input-group .form-control { border-radius: 0 8px 8px 0; }
    .search-box .input-group-text { border-radius: 8px 0 0 8px; border-right: 1px solid #eee; }
    .btn-show-vehicles {
        background: var(--primary-green);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 10px;
        width: 100%;
        transition: 0.3s;
    }
    .btn-show-vehicles:hover { background: var(--dark-green); }

    /* ── Location Dropdown ── */
    .loc-trigger {
        cursor: pointer;
        user-select: none;
    }
    .loc-trigger .form-control {
        cursor: pointer;
        display: flex !important;
        align-items: center;
        justify-content: space-between;
    }
    .loc-panel {
        display: none;
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.13);
        z-index: 9999;
        max-height: 300px;
        overflow-y: auto;
        scrollbar-width: thin;
    }
    .loc-panel::-webkit-scrollbar { width: 4px; }
    .loc-panel::-webkit-scrollbar-thumb { background: #ddd; border-radius: 4px; }
    .loc-panel.open { display: block; }
    .loc-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        cursor: pointer;
        font-size: 0.84rem;
        color: #333;
        border-bottom: 1px solid #f5f5f5;
        transition: background 0.12s;
    }
    .loc-item:last-child { border-bottom: none; }
    .loc-item:hover { background: #f0faf5; }
    .loc-item.all-opt {
        font-weight: 700;
        background: #f8fffe;
        border-bottom: 1px solid #e0f5ec;
        color: var(--primary-green, #18c24a);
    }
    .loc-item.all-opt:hover { background: #e8faf0; }
    .loc-item.back-opt {
        color: #888;
        font-size: 0.8rem;
        border-bottom: 1px solid #eee;
        background: #fafafa;
    }
    .loc-item.back-opt:hover { background: #f0f0f0; }
    .loc-section-lbl {
        font-size: 0.68rem;
        font-weight: 700;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 8px 14px 4px;
        background: #fff;
    }
    .loc-chevron-right {
        margin-left: auto;
        font-size: 0.65rem;
        color: #bbb;
    }
    .loc-caret { font-size: 0.7rem; transition: transform 0.2s; }
    .loc-caret.open { transform: rotate(180deg); }

    /* ── Section Header ── */
    .section-header { text-align: center; margin-bottom: 42px; }
    .section-header h2 { font-size: 1.75rem; font-weight: 800; text-transform: uppercase; margin-bottom: 8px; }
    .section-header p { color: var(--text-muted); font-size: 0.9rem; }
    .section-header .green-line {
        width: 50px; height: 3px; background: var(--primary-green);
        margin: 10px auto 0; border-radius: 2px;
    }

    /* ── Category Cards ── */
    .category-section { background: #fff; padding: 60px 0; }
    .category-card {
        background: white;
        border: 1px solid #eee;
        border-radius: 14px;
        padding: 22px 15px 18px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        height: 100%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }
    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(24,194,74,0.15);
        border-color: var(--primary-green);
    }
    .category-card img { height: 75px; object-fit: contain; margin-bottom: 12px; }
    .category-card h6 {
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        color: #333;
        margin: 0;
        letter-spacing: 0.3px;
    }

    /* ── How It Works ── */
    .how-it-works { background: var(--light-bg); padding: 65px 0; }

    /* ── Top Picks ── */
    .top-picks { background: white; padding: 65px 0; }
    .vehicle-card {
        border: 1px solid #eee;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.3s;
        height: 100%;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }
    .vehicle-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(0,0,0,0.1);
    }
    .vehicle-card img { width: 100%; height: 160px; object-fit: cover; }
    .vehicle-card-body { padding: 16px; }
    .vehicle-card-body h6 { font-weight: 700; font-size: 0.9rem; margin-bottom: 4px; }
    .vehicle-card-body .badge-cat {
        display: inline-block;
        background: #e8faf0;
        color: var(--primary-green);
        font-size: 0.7rem;
        font-weight: 600;
        border-radius: 20px;
        padding: 3px 10px;
        margin-bottom: 8px;
    }
    .vehicle-card-body .price { font-weight: 800; color: var(--primary-green); font-size: 1rem; }
    .vehicle-card-body .price span { font-size: 0.75rem; font-weight: 500; color: var(--text-muted); }
    .vehicle-meta { font-size: 0.75rem; color: var(--text-muted); margin-top: 8px; }
    .vehicle-meta i { color: var(--primary-green); margin-right: 4px; }
    .stars { color: #f5a623; font-size: 0.75rem; }

    /* ── Search Results ── */
    .search-results { background: var(--light-bg); padding: 60px 0; }
    .result-vehicle-card {
        background: white;
        border: 1px solid #eee;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.3s;
        height: 100%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }
    .result-vehicle-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(24,194,74,0.15);
        border-color: var(--primary-green);
    }
    .result-vehicle-card .card-img-top {
        height: 160px;
        background: #e8faf0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .result-vehicle-card .card-img-top i {
        font-size: 3.5rem;
        color: var(--primary-green);
        opacity: 0.6;
    }
    .result-vehicle-card .card-body { padding: 16px; }
    .no-results-box {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 14px;
        border: 1px dashed #ddd;
    }

    /* ── Why Choose ── */
    .why-choose { background: var(--light-bg); padding: 65px 0; }
    .feature-card {
        background: white;
        border-radius: 14px;
        padding: 28px 20px;
        text-align: center;
        height: 100%;
        border: 1px solid #eee;
        transition: all 0.3s;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }
    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(24,194,74,0.12);
        border-color: var(--primary-green);
    }
    .feature-icon-wrap {
        width: 68px; height: 68px;
        background: #e8faf0;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px;
    }
    .feature-icon-wrap img { width: 36px; height: 36px; object-fit: contain; }
    .feature-icon-wrap i { font-size: 1.5rem; color: var(--primary-green); }
    .feature-card h6 { font-weight: 700; font-size: 0.9rem; margin-bottom: 8px; }
    .feature-card p { font-size: 0.78rem; color: var(--text-muted); margin: 0; line-height: 1.6; }

    /* ── Testimonials ── */
    .testimonials {
        background: linear-gradient(rgba(0,0,0,0.72), rgba(0,0,0,0.72)),
                    url('{{ asset("assests/images/couple-bus-sunset.jpg") }}') center/cover no-repeat;
        padding: 65px 0;
        color: white;
    }
    .testimonials .section-header h2 { color: white; }
    .testimonials .section-header p { color: rgba(255,255,255,0.75); }
    .testimonial-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 14px;
        padding: 24px 20px;
        text-align: center;
        height: 100%;
    }
    .testimonial-card .avatar-placeholder {
        width: 60px; height: 60px;
        border-radius: 50%;
        background: var(--primary-green);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 12px;
        border: 3px solid rgba(255,255,255,0.4);
    }
    .testimonial-card .avatar-placeholder i { font-size: 1.5rem; color: white; }
    .testimonial-card h6 { font-weight: 700; font-size: 0.9rem; margin-bottom: 4px; color: white; }
    .testimonial-card .t-role { font-size: 0.72rem; color: rgba(255,255,255,0.6); margin-bottom: 12px; }
    .testimonial-card p { font-size: 0.8rem; color: rgba(255,255,255,0.85); margin-bottom: 10px; line-height: 1.6; }
    .testimonial-card .stars { color: #f5c518; }

    /* ── Newsletter ── */
    .newsletter-section { background: white; padding: 60px 0; text-align: center; }
    .newsletter-section h2 { font-size: 1.6rem; font-weight: 800; margin-bottom: 8px; }
    .newsletter-section p { color: var(--text-muted); font-size: 0.88rem; margin-bottom: 28px; }
    .newsletter-form { max-width: 460px; margin: 0 auto; }
    .newsletter-form .form-control {
        border-radius: 30px 0 0 30px;
        border: 1px solid #ddd;
        padding: 12px 20px;
        font-size: 0.88rem;
    }
    .newsletter-form .btn-subscribe {
        background: var(--primary-green);
        color: white;
        border-radius: 0 30px 30px 0;
        border: none;
        padding: 12px 28px;
        font-weight: 700;
        font-size: 0.88rem;
    }

    /* ── CTA Banner ── */
    .cta-banner { background: var(--light-bg); padding: 55px 0; text-align: center; }
    .cta-banner h2 { font-size: 1.65rem; font-weight: 800; margin-bottom: 8px; }
    .cta-banner p { color: var(--text-muted); font-size: 0.88rem; margin-bottom: 28px; }
    .btn-cta-signup {
        background: var(--primary-green);
        color: white;
        border: none;
        border-radius: 30px;
        padding: 12px 34px;
        font-weight: 700;
        font-size: 0.9rem;
        margin: 0 6px;
        transition: 0.3s;
    }
    .btn-cta-signup:hover { background: var(--dark-green); color: white; }
    .btn-cta-browse {
        background: transparent;
        color: var(--primary-green);
        border: 2px solid var(--primary-green);
        border-radius: 30px;
        padding: 12px 34px;
        font-weight: 700;
        font-size: 0.9rem;
        margin: 0 6px;
        transition: 0.3s;
    }
    .btn-cta-browse:hover { background: var(--primary-green); color: white; }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="container d-flex flex-column align-items-center">
        <h1>RENT ANY VEHICLE ANYTIME</h1>
        <p>From bicycles to heavy machinery — find the perfect vehicle for your journey, wherever you are.</p>
        <div>
            <button class="hero-btn-browse"><i class="fa-solid fa-car me-2"></i>Browse Vehicles</button>
            <button class="hero-btn-find"><i class="fa-solid fa-location-dot me-2"></i>Find Near Me</button>
        </div>

        <!-- Search Box -->
        <div class="search-container">
            <form action="{{ route('user.index') }}" method="GET" id="searchForm">
                <div class="search-box">
                    <div class="row g-3 align-items-end">

                        {{-- Vehicle Type --}}
                        <div class="col-md-2">
                            <label><i class="fa-solid fa-list me-1"></i> Vehicle Category</label>
                            <select class="form-select form-select-sm" name="vehicle_type">
                                <option value="">Select Category</option>
                                <option value="Bicycle"              {{ request('vehicle_type') == 'Bicycle'              ? 'selected' : '' }}>Bicycles</option>
                                <option value="Motorcycle"           {{ request('vehicle_type') == 'Motorcycle'           ? 'selected' : '' }}>Motorcycles</option>
                                <option value="Car"                  {{ request('vehicle_type') == 'Car'                  ? 'selected' : '' }}>Cars / Sedans</option>
                                <option value="SUV"                  {{ request('vehicle_type') == 'SUV'                  ? 'selected' : '' }}>SUVs</option>
                                <option value="Van"                  {{ request('vehicle_type') == 'Van'                  ? 'selected' : '' }}>Vans</option>
                                <option value="Truck"                {{ request('vehicle_type') == 'Truck'                ? 'selected' : '' }}>Trucks</option>
                                <option value="Agricultural Vehicle" {{ request('vehicle_type') == 'Agricultural Vehicle' ? 'selected' : '' }}>Agricultural</option>
                                <option value="Construction Vehicle" {{ request('vehicle_type') == 'Construction Vehicle' ? 'selected' : '' }}>Construction</option>
                                <option value="Camper Vehicle"       {{ request('vehicle_type') == 'Camper Vehicle'       ? 'selected' : '' }}>Camper Vehicles</option>
                            </select>
                        </div>

                        {{-- Pick-up Location (two-level dropdown) --}}
                        <div class="col-md-3" style="position: relative;">
                            <label><i class="fa-solid fa-location-dot me-1"></i> Location</label>

                            {{-- Visible trigger button --}}
                            <div class="input-group input-group-sm loc-trigger" id="locTrigger">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-map-pin text-muted"></i>
                                </span>
                                <span class="form-control" id="locDisplay" style="color:#6c757d; cursor:pointer;">
                                    <span id="locLabel">Select location…</span>
                                    <i class="fa-solid fa-chevron-down loc-caret ms-auto" id="locCaret"></i>
                                </span>
                            </div>

                            {{-- Hidden input submitted with form --}}
                            <input type="hidden" name="location" id="locationValue" value="{{ request('location') }}">

                            {{-- Dropdown panel --}}
                            <div class="loc-panel" id="locPanel">
                                <div id="locPanelInner"></div>
                            </div>
                        </div>

                        {{-- Pick-up Date & Time --}}
                        <div class="col-md-2">
                            <label><i class="fa-solid fa-calendar me-1"></i> Pick Date & Time</label>
                            <input type="datetime-local" class="form-control form-control-sm"
                                   name="pickup_date" value="{{ request('pickup_date') }}">
                        </div>

                        {{-- Drop-off Date & Time --}}
                        <div class="col-md-2">
                            <label><i class="fa-solid fa-calendar-check me-1"></i> Drop Date & Time</label>
                            <input type="datetime-local" class="form-control form-control-sm"
                                   name="dropoff_date" value="{{ request('dropoff_date') }}">
                        </div>

                        {{-- Submit --}}
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn-show-vehicles fw-bold py-2">
                                <i class="fa-solid fa-magnifying-glass me-2"></i>Show Vehicles
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- ── Search Results Section ── --}}
@if($searched)
<section class="search-results" id="search-results">
    <div class="container">
        <div class="section-header">
            <h2>Available Vehicles</h2>
            @if($vehicles->count())
                <p>
                    <strong style="color: var(--primary-green);">{{ $vehicles->count() }}</strong>
                    vehicle(s) available
                    @if(request('location')) in <strong>{{ request('location') }}</strong>@endif
                    @if(request('vehicle_type')) &nbsp;·&nbsp; Category: <strong>{{ request('vehicle_type') }}</strong>@endif
                    &nbsp;·&nbsp; {{ \Carbon\Carbon::parse(request('pickup_date'))->format('d M Y, h:i A') }}
                    &nbsp;→&nbsp; {{ \Carbon\Carbon::parse(request('dropoff_date'))->format('d M Y, h:i A') }}
                </p>
            @else
                <p>No available vehicles match your search criteria. Try adjusting your filters.</p>
            @endif
            <div class="green-line"></div>
        </div>

        @if($vehicles->count())
            <div class="row g-4">
                @foreach($vehicles as $vehicle)
                <div class="col-md-3 col-sm-6">
                    <div class="result-vehicle-card">
                        <div class="card-img-top">
                            @php
                                $iconMap = [
                                    'Car'                  => 'fa-car',
                                    'SUV'                  => 'fa-truck-pickup',
                                    'Van'                  => 'fa-van-shuttle',
                                    'Truck'                => 'fa-truck',
                                    'Motorcycle'           => 'fa-motorcycle',
                                    'Bicycle'              => 'fa-bicycle',
                                    'Agricultural Vehicle' => 'fa-tractor',
                                    'Construction Vehicle' => 'fa-helmet-safety',
                                    'Camper Vehicle'       => 'fa-caravan',
                                ];
                                $icon = $iconMap[$vehicle->vehicle_category] ?? 'fa-car';
                            @endphp
                            <i class="fa-solid {{ $icon }}"></i>
                        </div>
                        <div class="card-body">
                            <span class="badge-cat" style="display:inline-block; background:#e8faf0; color:var(--primary-green); font-size:0.7rem; font-weight:600; border-radius:20px; padding:3px 10px; margin-bottom:8px;">
                                {{ $vehicle->vehicle_category }}
                            </span>
                            <h6 class="fw-bold mb-1" style="font-size: 0.95rem;">
                                {{ $vehicle->brand }} {{ $vehicle->model }}
                            </h6>
                            <div class="vehicle-meta">
                                <i class="fa-solid fa-location-dot"></i> {{ $vehicle->location }}
                            </div>
                            <div class="vehicle-meta mt-1">
                                <i class="fa-solid fa-circle-check" style="color: var(--primary-green);"></i>
                                <span style="color: var(--primary-green); font-weight: 600;">Available</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top">
                                <div>
                                    <div style="font-size: 0.72rem; color: var(--text-muted);">
                                        <i class="fa-solid fa-calendar-days me-1"></i>
                                        {{ \Carbon\Carbon::parse(request('pickup_date'))->format('d M') }}
                                        →
                                        {{ \Carbon\Carbon::parse(request('dropoff_date'))->format('d M') }}
                                    </div>
                                </div>
                                <button class="btn btn-sm" style="background:#e8faf0; color:var(--primary-green); font-weight:700; border-radius:20px; padding:6px 14px; font-size:0.75rem; border: none;">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="no-results-box">
                <i class="fa-solid fa-magnifying-glass fa-3x text-muted mb-3" style="opacity:0.4;"></i>
                <h5 class="fw-bold mt-3">No Vehicles Found</h5>
                <p class="text-muted" style="font-size:0.88rem;">
                    No vehicles are available for your selected criteria.<br>
                    Try different dates, a different location, or leave the category blank to see all.
                </p>
            </div>
        @endif
    </div>
</section>
@endif

<!-- Explore Vehicle Categories -->
<section class="category-section">
    <div class="container">
        <div class="section-header">
            <h2>Explore Vehicle Categories</h2>
            <p>Choose from a wide range of vehicle categories to suit your needs</p>
            <div class="green-line"></div>
        </div>
        <div class="row g-3 justify-content-center">
            @php
                $cats = [
                    ['name' => 'Bicycles',               'slug' => 'bicycles',               'img' => 'Untitled design (1).png',  'icon' => 'fa-bicycle'],
                    ['name' => 'Motorcycles',            'slug' => 'motorcycles',            'img' => 'Untitled design (2).png',  'icon' => 'fa-motorcycle'],
                    ['name' => 'Cars',                   'slug' => 'cars',                   'img' => 'Untitled design (3).png',  'icon' => 'fa-car'],
                    ['name' => 'SUVs',                   'slug' => 'suvs',                   'img' => 'Untitled design (4).png',  'icon' => 'fa-truck-pickup'],
                    ['name' => 'Vans',                   'slug' => 'vans',                   'img' => 'Untitled design (14).png', 'icon' => 'fa-van-shuttle'],
                    ['name' => 'Trucks',                 'slug' => 'trucks',                 'img' => 'Untitled design (10).png', 'icon' => 'fa-truck'],
                    ['name' => 'Agricultural Vehicles',  'slug' => 'agricultural-vehicles',  'img' => 'Untitled design (11).png', 'icon' => 'fa-tractor'],
                    ['name' => 'Construction Vehicles',  'slug' => 'construction-vehicles',  'img' => 'Untitled design (12).png', 'icon' => 'fa-helmet-safety'],
                    ['name' => 'Special Vehicles',       'slug' => 'special-vehicles',       'img' => 'Untitled design (13).png', 'icon' => 'fa-star'],
                    ['name' => 'Camper Vehicles',        'slug' => 'camper-vehicles',        'img' => 'Untitled design (14).png', 'icon' => 'fa-caravan'],
                ];
            @endphp
            @foreach($cats as $cat)
            <div class="col-md-2 col-6">
                <a href="{{ route('user.category', $cat['slug']) }}" style="text-decoration: none; color: inherit;">
                    <div class="category-card">
                        <img src="{{ asset('assests/images/' . $cat['img']) }}" alt="{{ $cat['name'] }}"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div style="display:none; width:75px; height:75px; background:#e8faf0; border-radius:50%; align-items:center; justify-content:center; margin:0 auto 12px;">
                            <i class="fa-solid {{ $cat['icon'] }} fa-2x" style="color: var(--primary-green);"></i>
                        </div>
                        <h6>{{ $cat['name'] }}</h6>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works">
    <div class="container">
        <div class="section-header">
            <h2>How It Works</h2>
            <p>Renting a vehicle has never been easier. Follow these simple steps to find your vehicle, confirm your booking, make your payment, and enjoy your ride.</p>
            <div class="green-line"></div>
        </div>
        @php
            $steps = [
                ['num'=>1, 'title'=>'Search Your Vehicle',      'img'=>'Untitled design (20).png', 'desc'=>'Browse through a large range of vehicles'],
                ['num'=>2, 'title'=>'Choose the Right Vehicle', 'img'=>'Untitled design (19).png', 'desc'=>'Compare listings & pick the best fit for you'],
                ['num'=>3, 'title'=>'Book Your Vehicle',        'img'=>'Untitled design (17).png', 'desc'=>'Select dates & confirm your reservation'],
                ['num'=>4, 'title'=>'Make Payment',             'img'=>'Untitled design (16).png', 'desc'=>'Pay safely using our secure payment gateway'],
                ['num'=>5, 'title'=>'Enjoy Your Ride',          'img'=>'Untitled design (18).png', 'desc'=>'Pick up your vehicle and hit the road'],
            ];
        @endphp
        <!-- Top: Step Images -->
        <div class="row g-0 text-center mb-3">
            @foreach($steps as $step)
            <div class="col">
                <div style="width:110px; height:110px; margin:0 auto; background:#eaf7ef; border-radius:50%; display:flex; align-items:center; justify-content:center; overflow:hidden; border:3px solid #d4f0e0;">
                    <img src="{{ asset('assests/images/' . $step['img']) }}"
                         alt="{{ $step['title'] }}"
                         style="width:90px; height:90px; object-fit:contain;">
                </div>
            </div>
            @endforeach
        </div>
        <!-- Middle: Numbered circles connected by line -->
        <div style="position:relative; display:flex; align-items:center; justify-content:center; margin: 10px 0 16px;">
            <div style="position:absolute; top:50%; left:10%; right:10%; height:4px; background:linear-gradient(to right, #18c24a, #a8edbe); transform:translateY(-50%); z-index:0;"></div>
            @foreach($steps as $step)
            <div style="flex:1; display:flex; justify-content:center; position:relative; z-index:1;">
                <div style="width:48px; height:48px; border-radius:50%;
                            background:linear-gradient(135deg, #1a9ed4, #18c24a);
                            color:white; font-weight:800; font-size:1.1rem;
                            display:flex; align-items:center; justify-content:center;
                            box-shadow:0 4px 14px rgba(24,194,74,0.4);
                            border:3px solid white;">
                    {{ $step['num'] }}
                </div>
            </div>
            @endforeach
        </div>
        <!-- Bottom: Title + Description -->
        <div class="row g-0 text-center">
            @foreach($steps as $step)
            <div class="col px-2">
                <h6 class="fw-bold mb-1" style="font-size:0.82rem; color:#1a1a2e;">{{ $step['title'] }}</h6>
                <p class="text-muted mb-0" style="font-size:0.72rem; line-height:1.5;">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Top Picks For You -->
<section class="top-picks">
    <div class="container">
        <div class="section-header">
            <h2>Top Picks for You</h2>
            <p>Discover our most popular vehicles trusted and loved by our customers</p>
            <div class="green-line"></div>
        </div>
        <div class="row g-4">
            @php
                $topVehicles = [
                    ['name'=>'Toyota Axio',          'cat'=>'Car',        'img'=>'Toyota Axio.png',  'price'=>'3,500', 'location'=>'Colombo', 'rating'=>4.8, 'reviews'=>124, 'seats'=>5, 'fuel'=>'Petrol'],
                    ['name'=>'Toyota Prado TX',      'cat'=>'SUV',        'img'=>'Prado TX.png',     'price'=>'8,500', 'location'=>'Kandy',   'rating'=>4.9, 'reviews'=>98,  'seats'=>7, 'fuel'=>'Diesel'],
                    ['name'=>'Suzuki Wagon R Euro 2','cat'=>'Car',        'img'=>'Untitled design (26).png', 'price'=>'2,800', 'location'=>'Galle', 'rating'=>4.6, 'reviews'=>76, 'seats'=>5, 'fuel'=>'Petrol'],
                    ['name'=>'Yamaha R15',           'cat'=>'Motorcycle', 'img'=>'Yamaha R15.png',   'price'=>'1,200', 'location'=>'Negombo', 'rating'=>4.7, 'reviews'=>54,  'seats'=>2, 'fuel'=>'Petrol'],
                ];
            @endphp
            @foreach($topVehicles as $v)
            <div class="col-md-3 col-sm-6">
                <div class="vehicle-card">
                    <img src="{{ asset('assests/images/' . $v['img']) }}" alt="{{ $v['name'] }}"
                         style="width:100%; height:160px; object-fit:contain; background:#f8f9fa; padding:10px;"
                         onerror="this.style.objectFit='cover'; this.src='https://via.placeholder.com/400x160?text={{ urlencode($v['name']) }}'">
                    <div class="vehicle-card-body">
                        <span class="badge-cat">{{ $v['cat'] }}</span>
                        <h6>{{ $v['name'] }}</h6>
                        <div class="vehicle-meta">
                            <i class="fa-solid fa-location-dot"></i>{{ $v['location'] }} &nbsp;
                            <i class="fa-solid fa-gas-pump"></i>{{ $v['fuel'] }} &nbsp;
                            <i class="fa-solid fa-user-group"></i>{{ $v['seats'] }} Seats
                        </div>
                        <div class="d-flex align-items-center justify-content-between pt-2 border-top mt-2">
                            <div>
                                <div class="price">LKR {{ $v['price'] }} <span>/ day</span></div>
                                <div class="stars mt-1">
                                    @for($i=1;$i<=5;$i++)
                                        @if($i <= floor($v['rating']))
                                            <i class="fa-solid fa-star"></i>
                                        @else
                                            <i class="fa-regular fa-star"></i>
                                        @endif
                                    @endfor
                                    <small class="text-muted ms-1">{{ $v['rating'] }} ({{ $v['reviews'] }})</small>
                                </div>
                            </div>
                            <button class="btn btn-sm" style="background:#e8faf0; color:var(--primary-green); font-weight:700; border-radius:20px; padding:6px 14px; font-size:0.75rem;">Book</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Choose Our Platform -->
<section class="why-choose">
    <div class="container">
        <div class="section-header">
            <h2>Why Choose Our Platform?</h2>
            <p>We provide a complete vehicle rental solution that delivers the perfect vehicle — from personal travel, business, or leisure. Our platform ensures a seamless rental experience that keeps customers coming back.</p>
            <div class="green-line"></div>
        </div>
        <div class="row g-4">
            @php
                $features = [
                    ['img'=>'Untitled design (11).png', 'icon'=>'fa-cars',               'title'=>'Wide Range of Vehicles',           'desc'=>'From economy cars to luxury SUVs, bikes, trucks and specialty equipment.'],
                    ['img'=>'Untitled design (12).png', 'icon'=>'fa-tags',               'title'=>'Affordable & Transparent Pricing',  'desc'=>'No hidden fees. Clear pricing that matches the quality of service you receive.'],
                    ['img'=>'Untitled design (13).png', 'icon'=>'fa-bolt',               'title'=>'Easy & Fast Booking Process',      'desc'=>'Book your vehicle in minutes with our simple step-by-step process.'],
                    ['img'=>'Untitled design (14).png', 'icon'=>'fa-shield-halved',      'title'=>'Trusted & Verified Owners',        'desc'=>'Every vehicle owner is verified. You rent with complete confidence.'],
                    ['img'=>'Untitled design (15).png', 'icon'=>'fa-location-crosshairs','title'=>'Location Based Search',            'desc'=>'Find available vehicles near you with our smart location-based filters.'],
                    ['img'=>'Untitled design (16).png', 'icon'=>'fa-sliders',            'title'=>'Flexible Rental Options',          'desc'=>'Hourly, daily, weekly or monthly — rental plans tailored to your needs.'],
                    ['img'=>'Untitled design (17).png', 'icon'=>'fa-award',              'title'=>'Ratings & Reviews',                'desc'=>'Read honest reviews from real renters to make confident decisions.'],
                    ['img'=>'Untitled design (18).png', 'icon'=>'fa-car-side',           'title'=>'Well Maintained Vehicles',         'desc'=>'All listed vehicles are regularly serviced and inspected for safety.'],
                    ['img'=>'Untitled design (19).png', 'icon'=>'fa-headset',            'title'=>'24/7 Customer Support',            'desc'=>'Round-the-clock assistance via chat, call or email whenever you need.'],
                    ['img'=>'Untitled design (20).png', 'icon'=>'fa-mobile-screen',      'title'=>'All in One Platform',              'desc'=>'Manage bookings, payments, and profiles seamlessly in one place.'],
                ];
            @endphp
            @foreach($features as $f)
            <div class="col-md-3 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon-wrap">
                        <img src="{{ asset('assests/images/' . $f['img']) }}" alt="{{ $f['title'] }}"
                             style="width:36px; height:36px; object-fit:contain;"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                        <i class="fa-solid {{ $f['icon'] }}" style="display:none; font-size:1.5rem; color:var(--primary-green);"></i>
                    </div>
                    <h6>{{ $f['title'] }}</h6>
                    <p>{{ $f['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials">
    <div class="container">
        <div class="section-header">
            <h2>What Our Customers Say</h2>
            <p>See what our customers have to say about their experience with us and how VROAM has made vehicle rental easy.</p>
            <div class="green-line" style="background:var(--primary-green);"></div>
        </div>
        <div class="row g-4">
            @php
                $testimonials = [
                    ['name'=>'Saman K.',   'role'=>'Regular User',      'text'=>'Amazing service! I rented a car within minutes. The vehicle was clean and the owner was very helpful.', 'rating'=>5],
                    ['name'=>'Nuwan P.',   'role'=>'Business Traveler',  'text'=>'VROAM made my trip so easy. Great selection, fair prices. Will definitely rent again from this platform.', 'rating'=>5],
                    ['name'=>'Perera D.',  'role'=>'Weekend Traveler',   'text'=>'Found the perfect SUV for our family trip to Ella. Booking was seamless and support was very responsive.', 'rating'=>4],
                    ['name'=>'Chathu S.', 'role'=>'Student User',        'text'=>'Rented a bicycle for my daily commute. Very affordable and convenient. Highly recommend VROAM!', 'rating'=>5],
                    ['name'=>'Nimsha W.', 'role'=>'Verified User',       'text'=>'Top-notch platform! Wide variety of vehicles, transparent pricing. My go-to for all vehicle rentals.', 'rating'=>5],
                ];
            @endphp
            @foreach($testimonials as $t)
            <div class="col-md col-sm-6">
                <div class="testimonial-card">
                    <div class="avatar-placeholder">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h6>{{ $t['name'] }}</h6>
                    <div class="t-role">{{ $t['role'] }}</div>
                    <p>"{{ $t['text'] }}"</p>
                    <div class="stars">
                        @for($i=1;$i<=5;$i++)
                            <i class="{{ $i <= $t['rating'] ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                        @endfor
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter-section">
    <div class="container">
        <h2>Get the Latest Offers & Updates</h2>
        <p>Stay updated with our promotions, new vehicle listings, and tips on the best travel experiences in Sri Lanka.</p>
        <div class="newsletter-form">
            <div class="input-group">
                <input type="email" class="form-control" placeholder="Enter your Email Address">
                <button class="btn-subscribe">Subscribe Now</button>
            </div>
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="cta-banner">
    <div class="container">
        <h2>READY TO GET STARTED?</h2>
        <p>Join thousands of happy customers who trust VROAM for all their vehicle rental needs.</p>
        <button class="btn-cta-signup"><i class="fa-solid fa-user-plus me-2"></i>Sign Up</button>
        <button class="btn-cta-browse"><i class="fa-solid fa-car me-2"></i>Browse Vehicles</button>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    /* ─────────────────────────────────────────────
       Sri Lanka Districts → Towns data
    ───────────────────────────────────────────── */
    var SL = {
        'Colombo':      { label: 'Colombo District',      towns: ['All of Colombo','Colombo City','Dehiwala','Moratuwa','Sri Jayawardenepura Kotte','Kolonnawa','Maharagama','Nugegoda','Ratmalana','Homagama','Kaduwela','Kesbewa','Avissawella','Hanwella'] },
        'Gampaha':      { label: 'Gampaha District',      towns: ['All of Gampaha','Gampaha City','Negombo','Ja-Ela','Wattala','Ragama','Kelaniya','Minuwangoda','Katunayake','Divulapitiya','Mirigama','Veyangoda','Nittambuwa'] },
        'Kalutara':     { label: 'Kalutara District',     towns: ['All of Kalutara','Kalutara City','Beruwala','Aluthgama','Matugama','Bandaragama','Horana','Panadura','Ingiriya','Bulathsinhala'] },
        'Kandy':        { label: 'Kandy District',        towns: ['All of Kandy','Kandy City','Peradeniya','Katugastota','Gampola','Nawalapitiya','Wattegama','Kundasale','Teldeniya','Akurana','Hatton'] },
        'Matale':       { label: 'Matale District',       towns: ['All of Matale','Matale City','Dambulla','Sigiriya','Rattota','Ukuwela','Galewela','Pallepola'] },
        'NuwaraEliya':  { label: 'Nuwara Eliya District', towns: ['All of Nuwara Eliya','Nuwara Eliya City','Hatton','Talawakele','Ginigathena','Maskeliya','Ragala'] },
        'Galle':        { label: 'Galle District',        towns: ['All of Galle','Galle City','Ambalangoda','Elpitiya','Hikkaduwa','Baddegama','Karandeniya','Bentota','Balapitiya','Ahangama','Unawatuna','Weligama'] },
        'Matara':       { label: 'Matara District',       towns: ['All of Matara','Matara City','Weligama','Mirissa','Akuressa','Hakmana','Deniyaya','Kamburupitiya','Dikwella'] },
        'Hambantota':   { label: 'Hambantota District',   towns: ['All of Hambantota','Hambantota City','Tangalle','Tissamaharama','Beliatta','Sooriyawewa','Weeraketiya','Ambalantota'] },
        'Jaffna':       { label: 'Jaffna District',       towns: ['All of Jaffna','Jaffna City','Chavakachcheri','Point Pedro','Nallur','Tellippalai','Kopay'] },
        'Kilinochchi':  { label: 'Kilinochchi District',  towns: ['All of Kilinochchi','Kilinochchi City','Paranthan','Kandavalai'] },
        'Mannar':       { label: 'Mannar District',       towns: ['All of Mannar','Mannar City','Murunkan','Nanattan'] },
        'Vavuniya':     { label: 'Vavuniya District',     towns: ['All of Vavuniya','Vavuniya City','Cheddikulam','Nedunkeni'] },
        'Mullaitivu':   { label: 'Mullaitivu District',   towns: ['All of Mullaitivu','Mullaitivu City','Oddusuddan','Puthukudiyiruppu'] },
        'Batticaloa':   { label: 'Batticaloa District',   towns: ['All of Batticaloa','Batticaloa City','Kattankudy','Eravur','Valaichchenai','Kalmunai'] },
        'Ampara':       { label: 'Ampara District',       towns: ['All of Ampara','Ampara City','Kalmunai','Sainthamaruthu','Akkarepattu','Dehiattakandiya','Uhana','Mahaoya'] },
        'Trincomalee':  { label: 'Trincomalee District',  towns: ['All of Trincomalee','Trincomalee City','Kinniya','Muttur','Kantale','Seruvila'] },
        'Kurunegala':   { label: 'Kurunegala District',   towns: ['All of Kurunegala','Kurunegala City','Kuliyapitiya','Mawathagama','Nikaweratiya','Pannala','Wariyapola','Polgahawela','Giriulla'] },
        'Puttalam':     { label: 'Puttalam District',     towns: ['All of Puttalam','Puttalam City','Chilaw','Wennappuwa','Anamaduwa','Nattandiya','Dankotuwa'] },
        'Anuradhapura': { label: 'Anuradhapura District', towns: ['All of Anuradhapura','Anuradhapura City','Medawachchiya','Nochchiyagama','Mihintale','Kekirawa','Tambuttegama','Galnewa','Eppawala'] },
        'Polonnaruwa':  { label: 'Polonnaruwa District',  towns: ['All of Polonnaruwa','Polonnaruwa City','Hingurakgoda','Medirigiriya','Manampitiya','Lankapura'] },
        'Badulla':      { label: 'Badulla District',      towns: ['All of Badulla','Badulla City','Bandarawela','Haputale','Welimada','Mahiyanganaya','Passara','Ella','Hali-Ela'] },
        'Moneragala':   { label: 'Moneragala District',   towns: ['All of Moneragala','Moneragala City','Wellawaya','Buttala','Bibile','Medagama','Siyambalanduwa'] },
        'Ratnapura':    { label: 'Ratnapura District',    towns: ['All of Ratnapura','Ratnapura City','Balangoda','Embilipitiya','Kuruwita','Eheliyagoda','Pelmadulla','Ayagama'] },
        'Kegalle':      { label: 'Kegalle District',      towns: ['All of Kegalle','Kegalle City','Mawanella','Warakapola','Rambukkana','Ruwanwella','Dehiovita','Aranayake','Yatiyanthota'] },
    };

    /* ── Element refs ── */
    var trigger   = document.getElementById('locTrigger');
    var panel     = document.getElementById('locPanel');
    var inner     = document.getElementById('locPanelInner');
    var labelEl   = document.getElementById('locLabel');
    var caret     = document.getElementById('locCaret');
    var hidden    = document.getElementById('locationValue');
    var isOpen    = false;

    /* ── Restore display label on page reload after search ── */
    var existing = hidden.value;
    if (existing) {
        labelEl.textContent = existing;
        labelEl.style.color = '#212529';
    }

    /* ── Open / Close ── */
    function openPanel() {
        isOpen = true;
        panel.classList.add('open');
        caret.classList.add('open');
        renderDistricts();
    }
    function closePanel() {
        isOpen = false;
        panel.classList.remove('open');
        caret.classList.remove('open');
    }

    trigger.addEventListener('click', function () {
        isOpen ? closePanel() : openPanel();
    });

    /* Close when clicking outside */
    document.addEventListener('click', function (e) {
        var wrap = document.getElementById('locTrigger').closest('.col-md-3');
        if (wrap && !wrap.contains(e.target)) closePanel();
    });

    /* ── Select a value ── */
    function selectValue(displayText, inputVal) {
        labelEl.textContent = displayText;
        labelEl.style.color = '#212529';
        hidden.value = inputVal;
        closePanel();
    }

    /* ── Build a single row element ── */
    function makeItem(html, classes, onClick) {
        var el = document.createElement('div');
        el.className = 'loc-item ' + (classes || '');
        el.innerHTML = html;
        el.addEventListener('click', function (e) { e.stopPropagation(); onClick(); });
        return el;
    }

    /* ── Level 1: Districts ── */
    function renderDistricts() {
        inner.innerHTML = '';

        /* "All of Sri Lanka" */
        inner.appendChild(makeItem(
            '<i class="fa-solid fa-globe fa-fw"></i> All of Sri Lanka',
            'all-opt',
            function () { selectValue('All of Sri Lanka', ''); }
        ));

        /* Section label */
        var lbl = document.createElement('div');
        lbl.className = 'loc-section-lbl';
        lbl.textContent = 'Select District';
        inner.appendChild(lbl);

        /* Each district */
        Object.keys(SL).forEach(function (key) {
            inner.appendChild(makeItem(
                '<i class="fa-solid fa-map fa-fw"></i> ' + SL[key].label +
                '<i class="fa-solid fa-chevron-right fa-fw loc-chevron-right"></i>',
                '',
                function () { renderTowns(key); }
            ));
        });
    }

    /* ── Level 2: Towns ── */
    function renderTowns(key) {
        var district = SL[key];
        inner.innerHTML = '';

        /* Back button */
        inner.appendChild(makeItem(
            '<i class="fa-solid fa-arrow-left fa-fw"></i> Back to districts',
            'back-opt',
            renderDistricts
        ));

        /* Section label */
        var lbl = document.createElement('div');
        lbl.className = 'loc-section-lbl';
        lbl.textContent = district.label;
        inner.appendChild(lbl);

        /* Each town */
        district.towns.forEach(function (town, idx) {
            var isAll = idx === 0;
            // "All of Galle"  → strips "All of "  → sends "Galle"   (matches all in district)
            // "Colombo City"  → strips " City"    → sends "Colombo" (matches DB value)
            // "Hikkaduwa"     → no change         → sends "Hikkaduwa"
            var submitVal = isAll
                ? town.replace('All of ', '')
                : town.replace(' City', '');

            inner.appendChild(makeItem(
                '<i class="fa-solid ' + (isAll ? 'fa-map' : 'fa-map-pin') + ' fa-fw"></i> ' + town,
                isAll ? 'all-opt' : '',
                function () { selectValue(town, submitVal); }
            ));
        });
    }
})();
</script>

{{-- Auto-scroll to results after search --}}
@if($searched)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var results = document.getElementById('search-results');
        if (results) results.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
</script>
@endif
@endpush
