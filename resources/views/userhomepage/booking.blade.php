@extends('layouts.app')

@section('title', 'Book ' . $vehicle->brand . ' ' . $vehicle->model . ' — VROAM')

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
    .breadcrumb-item.active { color: var(--text-muted); }
    .breadcrumb-item + .breadcrumb-item::before { color: #ccc; }

    /* ── Hero ── */
    .booking-hero {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        padding: 44px 0 36px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .booking-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse at 70% 50%, rgba(24,194,74,0.18) 0%, transparent 65%);
        pointer-events: none;
    }
    .booking-hero h1 { font-size: 2rem; font-weight: 900; margin-bottom: 4px; }
    .booking-hero p  { font-size: 0.88rem; opacity: 0.72; margin: 0; }

    /* ── Layout ── */
    .booking-section { padding: 44px 0 72px; }

    /* ── Form Card ── */
    .form-card {
        background: white;
        border-radius: 18px;
        border: 1px solid #eee;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        overflow: hidden;
        margin-bottom: 24px;
    }
    .form-card-header {
        background: #f8fffe;
        border-bottom: 1px solid #eaf7ef;
        padding: 16px 24px;
        display: flex; align-items: center; gap: 10px;
    }
    .form-card-header i { color: var(--primary-green); }
    .form-card-header h6 { margin: 0; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-dark); }
    .form-card-body { padding: 26px 24px; }

    /* ── Form Inputs ── */
    .form-label { font-size: 0.78rem; font-weight: 700; color: var(--text-dark); margin-bottom: 5px; }
    .form-label span { color: #e74c3c; }
    .form-control, .form-select {
        border-radius: 10px;
        border: 1.5px solid #e0e0e0;
        font-size: 0.85rem;
        padding: 10px 14px;
        transition: 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(24,194,74,0.12);
    }
    .form-control.is-invalid { border-color: #e74c3c; }
    .invalid-feedback { font-size: 0.75rem; }

    /* ── Vehicle Summary Card ── */
    .vehicle-summary {
        background: white;
        border-radius: 18px;
        border: 1px solid #eee;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        padding: 24px;
        position: sticky; top: 20px;
    }
    .vs-icon {
        width: 80px; height: 80px;
        background: #e8faf0;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px;
    }
    .vs-icon i { font-size: 2rem; color: var(--primary-green); }
    .vs-name { font-weight: 900; font-size: 1.05rem; color: var(--text-dark); text-align: center; margin-bottom: 4px; }
    .vs-cat  { text-align: center; margin-bottom: 16px; }
    .vs-cat span {
        background: #e8faf0; color: var(--primary-green);
        font-size: 0.7rem; font-weight: 700; border-radius: 20px;
        padding: 3px 12px; text-transform: uppercase;
    }
    .vs-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 9px 0; border-bottom: 1px solid #f4f4f4;
        font-size: 0.8rem;
    }
    .vs-row:last-child { border-bottom: none; }
    .vs-lbl { color: var(--text-muted); font-weight: 600; display: flex; align-items: center; gap: 6px; }
    .vs-lbl i { color: var(--primary-green); width: 14px; }
    .vs-val { font-weight: 700; color: var(--text-dark); }

    /* ── Submit Button ── */
    .btn-confirm {
        background: var(--primary-green); color: white; border: none;
        border-radius: 30px; padding: 14px 0;
        width: 100%; font-size: 0.92rem; font-weight: 800;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        transition: 0.25s; letter-spacing: 0.3px; margin-top: 8px;
    }
    .btn-confirm:hover { background: var(--dark-green); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(24,194,74,0.3); }
    .booking-note {
        margin-top: 14px; padding: 12px 14px;
        background: #f8fffe; border-radius: 10px;
        border-left: 3px solid var(--primary-green);
        font-size: 0.74rem; color: var(--text-muted); line-height: 1.6;
    }
    .booking-note i { color: var(--primary-green); }

    /* ── Animation ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-up { animation: fadeUp 0.4s ease both; }
    .delay-1 { animation-delay: 0.08s; }
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

<!-- Breadcrumb -->
<div class="back-bar">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:0.8rem;">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.category', $categorySlug) }}">{{ $vehicle->vehicle_category }} Rentals</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.show', $vehicle->id) }}">{{ $vehicle->brand }} {{ $vehicle->model }}</a></li>
                <li class="breadcrumb-item active">Book Now</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Hero -->
<section class="booking-hero">
    <div class="container">
        <h1><i class="fa-solid fa-calendar-check me-2" style="color:var(--primary-green);"></i>Complete Your Booking</h1>
        <p>Fill in your details below to reserve the <strong>{{ $vehicle->brand }} {{ $vehicle->model }}</strong></p>
    </div>
</section>

<!-- Booking Form -->
<section class="booking-section">
    <div class="container">

        @if(session('error'))
            <div class="alert alert-danger rounded-3 mb-4" style="font-size:0.85rem;">
                <i class="fa-solid fa-circle-exclamation me-2"></i>{{ session('error') }}
            </div>
        @endif

        <div class="row g-4">

            <!-- LEFT: Form -->
            <div class="col-lg-8">

                <form action="{{ route('user.booking.store', $vehicle->id) }}" method="POST" novalidate>
                    @csrf

                    <!-- Personal Details -->
                    <div class="form-card animate-up">
                        <div class="form-card-header">
                            <i class="fa-solid fa-user"></i>
                            <h6>Personal Details</h6>
                        </div>
                        <div class="form-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name <span>*</span></label>
                                    <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror"
                                           placeholder="e.g. Kasun Perera" value="{{ old('customer_name') }}">
                                    @error('customer_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIC / Passport No. <span>*</span></label>
                                    <input type="text" name="customer_nic" class="form-control @error('customer_nic') is-invalid @enderror"
                                           placeholder="e.g. 991234567V" value="{{ old('customer_nic') }}">
                                    @error('customer_nic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address <span>*</span></label>
                                    <input type="email" name="customer_email" class="form-control @error('customer_email') is-invalid @enderror"
                                           placeholder="e.g. kasun@gmail.com" value="{{ old('customer_email') }}">
                                    @error('customer_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number <span>*</span></label>
                                    <input type="text" name="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror"
                                           placeholder="e.g. 077 123 4567" value="{{ old('customer_phone') }}">
                                    @error('customer_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rental Details -->
                    <div class="form-card animate-up delay-1">
                        <div class="form-card-header">
                            <i class="fa-solid fa-calendar-days"></i>
                            <h6>Rental Details</h6>
                        </div>
                        <div class="form-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Pickup Date <span>*</span></label>
                                    <input type="date" name="pickup_date" class="form-control @error('pickup_date') is-invalid @enderror"
                                           min="{{ date('Y-m-d') }}" value="{{ old('pickup_date') }}">
                                    @error('pickup_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Drop-off Date <span>*</span></label>
                                    <input type="date" name="dropoff_date" class="form-control @error('dropoff_date') is-invalid @enderror"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('dropoff_date') }}">
                                    @error('dropoff_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Pickup Location <span>*</span></label>
                                    <input type="text" name="pickup_location" class="form-control @error('pickup_location') is-invalid @enderror"
                                           placeholder="e.g. Colombo 03, near Liberty Plaza"
                                           value="{{ old('pickup_location', $vehicle->location) }}">
                                    @error('pickup_location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Additional Notes <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror"
                                              rows="3" placeholder="Any special requests or requirements...">{{ old('notes') }}</textarea>
                                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-confirm">
                        <i class="fa-solid fa-circle-check"></i> Confirm Booking
                    </button>

                    <div class="text-center mt-3">
                        <a href="{{ route('user.show', $vehicle->id) }}" style="font-size:0.8rem; color:var(--text-muted); text-decoration:none;">
                            <i class="fa-solid fa-arrow-left me-1"></i> Cancel & go back
                        </a>
                    </div>

                </form>
            </div>

            <!-- RIGHT: Vehicle Summary -->
            <div class="col-lg-4">
                <div class="vehicle-summary">
                    <div class="vs-icon">
                        <i class="fa-solid {{ $icon }}"></i>
                    </div>
                    <div class="vs-name">{{ $vehicle->brand }} {{ $vehicle->model }}</div>
                    <div class="vs-cat"><span>{{ $vehicle->vehicle_category }}</span></div>

                    <div class="vs-row">
                        <span class="vs-lbl"><i class="fa-solid fa-location-dot"></i> Location</span>
                        <span class="vs-val">{{ $vehicle->location }}</span>
                    </div>
                    <div class="vs-row">
                        <span class="vs-lbl"><i class="fa-solid fa-circle-check"></i> Status</span>
                        <span class="vs-val" style="color:var(--primary-green);">Available</span>
                    </div>
                    <div class="vs-row">
                        <span class="vs-lbl"><i class="fa-solid fa-copyright"></i> Brand</span>
                        <span class="vs-val">{{ $vehicle->brand }}</span>
                    </div>
                    <div class="vs-row">
                        <span class="vs-lbl"><i class="fa-solid fa-car-side"></i> Model</span>
                        <span class="vs-val">{{ $vehicle->model }}</span>
                    </div>

                    <div class="booking-note mt-3">
                        <i class="fa-solid fa-shield-halved me-1"></i>
                        Your booking is protected by the VROAM guarantee. A confirmation will be sent to your email after booking.
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Auto-set dropoff min date when pickup changes
    document.querySelector('[name="pickup_date"]').addEventListener('change', function () {
        const pickup = new Date(this.value);
        pickup.setDate(pickup.getDate() + 1);
        const minDropoff = pickup.toISOString().split('T')[0];
        const dropoff = document.querySelector('[name="dropoff_date"]');
        dropoff.min = minDropoff;
        if (dropoff.value && dropoff.value <= this.value) {
            dropoff.value = minDropoff;
        }
    });
</script>
@endpush
