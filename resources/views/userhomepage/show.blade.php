@extends('layouts.app')

@section('title', $vehicle->brand . ' ' . $vehicle->model . ' — VROAM')

@push('styles')
<style>
    body { background: var(--light-bg); }

    /* ── Back Bar ── */
    .back-bar {
        background: white;
        border-bottom: 1px solid #eee;
        padding: 12px 0;
        font-size: 0.82rem;
    }
    .back-bar a { color: var(--primary-green); text-decoration: none; font-weight: 600; }
    .back-bar a:hover { text-decoration: underline; }
    .breadcrumb-item.active { color: var(--text-muted); }
    .breadcrumb-item + .breadcrumb-item::before { color: #ccc; }

    /* ── Hero Banner ── */
    .vehicle-hero {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        padding: 56px 0 48px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .vehicle-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse at 75% 50%, rgba(24,194,74,0.18) 0%, transparent 65%);
        pointer-events: none;
    }
    .hero-icon-wrap {
        width: 110px; height: 110px;
        background: rgba(24,194,74,0.15);
        border: 2px solid rgba(24,194,74,0.4);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        backdrop-filter: blur(6px);
        margin-bottom: 20px;
    }
    .hero-icon-wrap i { font-size: 2.8rem; color: var(--primary-green); }
    .vehicle-hero h1 { font-size: 2.4rem; font-weight: 900; margin-bottom: 6px; }
    .vehicle-hero .hero-meta { font-size: 0.88rem; opacity: 0.72; }
    .status-badge-hero {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 18px; border-radius: 30px;
        font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        margin-top: 14px;
    }
    .status-available { background: rgba(24,194,74,0.2); border: 1px solid rgba(24,194,74,0.5); color: #a8ffba; }
    .status-rented    { background: rgba(230,92,0,0.2);  border: 1px solid rgba(230,92,0,0.5);  color: #ffd5a8; }
    .status-maintenance { background: rgba(192,57,43,0.2); border: 1px solid rgba(192,57,43,0.5); color: #ffb3ac; }

    /* ── Main Content ── */
    .detail-section { padding: 48px 0 72px; }

    /* ── Info Card ── */
    .info-card {
        background: white;
        border-radius: 18px;
        border: 1px solid #eee;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        overflow: hidden;
        margin-bottom: 24px;
    }
    .info-card-header {
        background: #f8fffe;
        border-bottom: 1px solid #eaf7ef;
        padding: 16px 22px;
        display: flex; align-items: center; gap: 10px;
    }
    .info-card-header i { color: var(--primary-green); font-size: 1rem; }
    .info-card-header h6 { margin: 0; font-weight: 800; font-size: 0.85rem; color: var(--text-dark); text-transform: uppercase; letter-spacing: 0.5px; }
    .info-card-body { padding: 22px; }

    /* ── Spec Grid ── */
    .spec-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f4f4f4;
    }
    .spec-row:last-child { border-bottom: none; padding-bottom: 0; }
    .spec-label { font-size: 0.78rem; color: var(--text-muted); font-weight: 600; display: flex; align-items: center; gap: 8px; }
    .spec-label i { color: var(--primary-green); width: 16px; text-align: center; }
    .spec-value { font-size: 0.88rem; font-weight: 700; color: var(--text-dark); }

    /* ── Status Badge (inline) ── */
    .status-pill {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 14px; border-radius: 20px;
        font-size: 0.75rem; font-weight: 700;
    }
    .pill-available    { background: #e8faf0; color: #0d9136; }
    .pill-rented       { background: #fff3e0; color: #e65c00; }
    .pill-maintenance  { background: #fdecea; color: #c0392b; }

    /* ── Booking Card ── */
    .booking-card {
        background: white;
        border-radius: 18px;
        border: 1px solid #eee;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        padding: 28px;
        position: sticky; top: 20px;
    }
    .booking-card h5 { font-weight: 800; font-size: 1rem; margin-bottom: 4px; }
    .booking-card p  { font-size: 0.8rem; color: var(--text-muted); margin-bottom: 20px; }
    .btn-book-now {
        background: var(--primary-green);
        color: white; border: none;
        border-radius: 30px;
        padding: 13px 0; font-size: 0.9rem; font-weight: 800;
        width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px;
        transition: 0.25s; letter-spacing: 0.3px;
    }
    .btn-book-now:hover:not(:disabled) { background: var(--dark-green); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(24,194,74,0.3); }
    .btn-book-now:disabled { background: #ccc; cursor: not-allowed; }
    .btn-contact {
        width: 100%; margin-top: 10px;
        background: transparent; color: var(--primary-green);
        border: 2px solid var(--primary-green);
        border-radius: 30px; padding: 11px 0;
        font-size: 0.85rem; font-weight: 700;
        transition: 0.25s;
    }
    .btn-contact:hover { background: var(--primary-green); color: white; }
    .booking-note {
        margin-top: 16px; padding: 12px 14px;
        background: #f8fffe; border-radius: 10px;
        border-left: 3px solid var(--primary-green);
        font-size: 0.75rem; color: var(--text-muted);
    }
    .booking-note i { color: var(--primary-green); }

    /* ── Quick Stats Strip ── */
    .quick-stats {
        display: grid; grid-template-columns: repeat(2, 1fr);
        gap: 1px; background: #eee;
        border-radius: 14px; overflow: hidden;
        margin-bottom: 20px;
    }
    .quick-stat {
        background: white; padding: 16px 10px; text-align: center;
    }
    .quick-stat .qs-val { font-size: 1.3rem; font-weight: 900; color: var(--primary-green); line-height: 1; }
    .quick-stat .qs-lbl { font-size: 0.66rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.4px; margin-top: 3px; }

    /* ── Animation ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-up { animation: fadeUp 0.45s ease both; }
    .delay-1 { animation-delay: 0.08s; }
    .delay-2 { animation-delay: 0.16s; }
    .delay-3 { animation-delay: 0.24s; }
</style>
@endpush

@section('content')

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
        'Special Vehicle'      => 'fa-star',
    ];
    $icon = $iconMap[$vehicle->vehicle_category] ?? 'fa-car';

    $slugMap = [
        'Car'                  => 'cars',
        'SUV'                  => 'suvs',
        'Van'                  => 'vans',
        'Truck'                => 'trucks',
        'Motorcycle'           => 'motorcycles',
        'Bicycle'              => 'bicycles',
        'Agricultural Vehicle' => 'agricultural-vehicles',
        'Construction Vehicle' => 'construction-vehicles',
        'Camper Vehicle'       => 'camper-vehicles',
        'Special Vehicle'      => 'special-vehicles',
    ];
    $categorySlug = $slugMap[$vehicle->vehicle_category] ?? strtolower($vehicle->vehicle_category);
@endphp

<!-- Breadcrumb Back Bar -->
<div class="back-bar">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:0.8rem;">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('user.category', $categorySlug) }}">{{ $vehicle->vehicle_category }} Rentals</a>
                </li>
                <li class="breadcrumb-item active">{{ $vehicle->brand }} {{ $vehicle->model }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Vehicle Hero -->
<section class="vehicle-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-icon-wrap">
                    <i class="fa-solid {{ $icon }}"></i>
                </div>
                <h1>{{ $vehicle->brand }} {{ $vehicle->model }}</h1>
                <p class="hero-meta">
                    <i class="fa-solid fa-tag me-1"></i>{{ $vehicle->vehicle_category }}
                    &nbsp;·&nbsp;
                    <i class="fa-solid fa-location-dot me-1"></i>{{ $vehicle->location }}, Sri Lanka
                    &nbsp;·&nbsp;
                    <i class="fa-regular fa-clock me-1"></i>
                    Listed {{ $vehicle->created_at ? $vehicle->created_at->diffForHumans() : 'recently' }}
                </p>
                <div>
                    @if($vehicle->status === 'available')
                        <span class="status-badge-hero status-available">
                            <i class="fa-solid fa-circle-check"></i> Available for Rent
                        </span>
                    @elseif($vehicle->status === 'rented')
                        <span class="status-badge-hero status-rented">
                            <i class="fa-solid fa-clock"></i> Currently Rented
                        </span>
                    @else
                        <span class="status-badge-hero status-maintenance">
                            <i class="fa-solid fa-wrench"></i> Under Maintenance
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Detail Content -->
<section class="detail-section">
    <div class="container">
        <div class="row g-4">

            <!-- LEFT: Vehicle Details -->
            <div class="col-lg-8">

                <!-- Vehicle Specifications -->
                <div class="info-card animate-up">
                    <div class="info-card-header">
                        <i class="fa-solid fa-list-check"></i>
                        <h6>Vehicle Specifications</h6>
                    </div>
                    <div class="info-card-body">
                        <div class="spec-row">
                            <span class="spec-label"><i class="fa-solid fa-tag"></i> Category</span>
                            <span class="spec-value">{{ $vehicle->vehicle_category }}</span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-label"><i class="fa-solid fa-copyright"></i> Brand</span>
                            <span class="spec-value">{{ $vehicle->brand }}</span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-label"><i class="fa-solid fa-car-side"></i> Model</span>
                            <span class="spec-value">{{ $vehicle->model }}</span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-label"><i class="fa-solid fa-location-dot"></i> Location</span>
                            <span class="spec-value">{{ $vehicle->location }}, Sri Lanka</span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-label"><i class="fa-solid fa-circle-info"></i> Status</span>
                            <span class="spec-value">
                                @if($vehicle->status === 'available')
                                    <span class="status-pill pill-available">
                                        <i class="fa-solid fa-circle-check"></i> Available
                                    </span>
                                @elseif($vehicle->status === 'rented')
                                    <span class="status-pill pill-rented">
                                        <i class="fa-solid fa-clock"></i> Rented
                                    </span>
                                @else
                                    <span class="status-pill pill-maintenance">
                                        <i class="fa-solid fa-wrench"></i> Maintenance
                                    </span>
                                @endif
                            </span>
                        </div>

                    </div>
                </div>

                <!-- About This Vehicle -->
                <div class="info-card animate-up delay-1">
                    <div class="info-card-header">
                        <i class="fa-solid fa-circle-info"></i>
                        <h6>About This Vehicle</h6>
                    </div>
                    <div class="info-card-body">
                        <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.75; margin:0;">
                            This <strong>{{ $vehicle->brand }} {{ $vehicle->model }}</strong> is a
                            {{ strtolower($vehicle->vehicle_category) }} currently based in
                            <strong>{{ $vehicle->location }}</strong>, Sri Lanka.
                            @if($vehicle->status === 'available')
                                It is <strong style="color:var(--primary-green);">available for immediate rental</strong>.
                                Book now to secure your dates before someone else does.
                            @elseif($vehicle->status === 'rented')
                                This vehicle is <strong style="color:#e65c00;">currently rented</strong> and unavailable.
                                Please check back later or browse other vehicles in this category.
                            @else
                                This vehicle is currently <strong style="color:#c0392b;">under maintenance</strong>.
                                It will be available for rent again once servicing is complete.
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Rental Policies -->
                <div class="info-card animate-up delay-2">
                    <div class="info-card-header">
                        <i class="fa-solid fa-shield-halved"></i>
                        <h6>Rental Policies</h6>
                    </div>
                    <div class="info-card-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div style="display:flex; align-items:flex-start; gap:12px;">
                                    <div style="width:36px; height:36px; background:#e8faf0; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                        <i class="fa-solid fa-id-card" style="color:var(--primary-green); font-size:0.85rem;"></i>
                                    </div>
                                    <div>
                                        <div style="font-size:0.8rem; font-weight:700; color:var(--text-dark);">Valid ID Required</div>
                                        <div style="font-size:0.73rem; color:var(--text-muted); margin-top:2px;">National ID or passport required at pickup.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div style="display:flex; align-items:flex-start; gap:12px;">
                                    <div style="width:36px; height:36px; background:#e8faf0; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                        <i class="fa-solid fa-file-contract" style="color:var(--primary-green); font-size:0.85rem;"></i>
                                    </div>
                                    <div>
                                        <div style="font-size:0.8rem; font-weight:700; color:var(--text-dark);">Rental Agreement</div>
                                        <div style="font-size:0.73rem; color:var(--text-muted); margin-top:2px;">A rental contract must be signed before use.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div style="display:flex; align-items:flex-start; gap:12px;">
                                    <div style="width:36px; height:36px; background:#e8faf0; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                        <i class="fa-solid fa-gas-pump" style="color:var(--primary-green); font-size:0.85rem;"></i>
                                    </div>
                                    <div>
                                        <div style="font-size:0.8rem; font-weight:700; color:var(--text-dark);">Fuel Policy</div>
                                        <div style="font-size:0.73rem; color:var(--text-muted); margin-top:2px;">Return the vehicle with the same fuel level.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div style="display:flex; align-items:flex-start; gap:12px;">
                                    <div style="width:36px; height:36px; background:#e8faf0; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                        <i class="fa-solid fa-umbrella" style="color:var(--primary-green); font-size:0.85rem;"></i>
                                    </div>
                                    <div>
                                        <div style="font-size:0.8rem; font-weight:700; color:var(--text-dark);">Insurance Included</div>
                                        <div style="font-size:0.73rem; color:var(--text-muted); margin-top:2px;">Basic insurance coverage is included in all rentals.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT: Booking Card -->
            <div class="col-lg-4 animate-up delay-3">

                <!-- Quick Stats -->
                <div class="quick-stats">
                    <div class="quick-stat">
                        <div class="qs-val">{{ $vehicle->vehicle_category === 'Bicycle' ? '0' : '4' }}★</div>
                        <div class="qs-lbl">Rating</div>
                    </div>
                    <div class="quick-stat">
                        <div class="qs-val">{{ $vehicle->location[0] }}L</div>
                        <div class="qs-lbl">Zone</div>
                    </div>
                </div>

                <!-- Booking Card -->
                <div class="booking-card">
                    <h5>
                        @if($vehicle->status === 'available')
                            <i class="fa-solid fa-bolt me-2" style="color:var(--primary-green);"></i>Ready to Book
                        @else
                            <i class="fa-solid fa-ban me-2" style="color:#ccc;"></i>Unavailable
                        @endif
                    </h5>
                    <p>
                        @if($vehicle->status === 'available')
                            This vehicle is available now. Reserve it before it's gone!
                        @elseif($vehicle->status === 'rented')
                            This vehicle is currently out on rental.
                        @else
                            This vehicle is currently under scheduled maintenance.
                        @endif
                    </p>

                    @if($vehicle->status === 'available')
                        <button class="btn-book-now">
                            <i class="fa-solid fa-calendar-check"></i> Book Now
                        </button>
                        <button class="btn-contact">
                            <i class="fa-solid fa-phone me-1"></i> Contact Owner
                        </button>
                        <div class="booking-note">
                            <i class="fa-solid fa-shield-halved me-1"></i>
                            Secure booking — your reservation is protected by VROAM guarantee.
                        </div>
                    @else
                        <button class="btn-book-now" disabled>
                            <i class="fa-solid fa-ban"></i>
                            {{ $vehicle->status === 'rented' ? 'Currently Rented' : 'Under Maintenance' }}
                        </button>
                        <a href="{{ route('user.category', $categorySlug) }}" class="btn-contact" style="display:block; text-align:center; text-decoration:none;">
                            <i class="fa-solid fa-arrow-left me-1"></i> Browse Other {{ $vehicle->vehicle_category }}s
                        </a>
                        <div class="booking-note">
                            <i class="fa-regular fa-clock me-1"></i>
                            Check back later — this vehicle may become available soon.
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- Back Buttons -->
        <div class="d-flex gap-3 flex-wrap mt-4">
            <a href="{{ route('user.category', $categorySlug) }}"
               class="btn"
               style="background:white; border:2px solid var(--primary-green); color:var(--primary-green); border-radius:25px; padding:10px 24px; font-weight:700; font-size:0.82rem; transition:0.2s;"
               onmouseover="this.style.background='var(--primary-green)'; this.style.color='white';"
               onmouseout="this.style.background='white'; this.style.color='var(--primary-green)';">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to {{ $vehicle->vehicle_category }} Listings
            </a>

        </div>
    </div>
</section>

@endsection
