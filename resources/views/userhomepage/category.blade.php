@extends('layouts.app')

@section('title', $dbCategory . ' Rentals — VROAM')

@push('styles')
<style>
    body { background: var(--light-bg); }

    /* ── Category Hero Banner ── */
    .category-hero {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        padding: 52px 0 44px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .category-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse at 70% 50%, rgba(24,194,74,0.18) 0%, transparent 65%);
        pointer-events: none;
    }
    .category-hero .icon-bg {
        width: 80px; height: 80px;
        background: rgba(24,194,74,0.15);
        border: 2px solid rgba(24,194,74,0.4);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 18px;
        backdrop-filter: blur(6px);
    }
    .category-hero .icon-bg i { font-size: 2rem; color: var(--primary-green); }
    .category-hero h1 { font-size: 2.4rem; font-weight: 800; margin-bottom: 6px; }
    .category-hero p  { font-size: 0.92rem; opacity: 0.75; margin: 0; }
    .breadcrumb-item a { color: var(--primary-green); text-decoration: none; }
    .breadcrumb-item.active { color: rgba(255,255,255,0.6); }
    .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.35); }

    /* ── Stats Strip ── */
    .stats-strip {
        background: white;
        border-bottom: 1px solid #eee;
        padding: 14px 0;
    }
    .stat-item { text-align: center; }
    .stat-item .num { font-size: 1.4rem; font-weight: 800; color: var(--primary-green); line-height: 1; }
    .stat-item .lbl { font-size: 0.7rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }

    /* ── Filters Bar ── */
    .filter-bar {
        background: white;
        padding: 16px 0;
        border-bottom: 1px solid #eee;
        position: sticky; top: 0; z-index: 100;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }
    .filter-bar .form-select,
    .filter-bar .form-control {
        font-size: 0.8rem;
        border-radius: 8px;
        border: 1px solid #dde;
        padding: 7px 12px;
    }
    .filter-bar .form-select:focus,
    .filter-bar .form-control:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(24,194,74,0.12);
    }
    .filter-pill {
        background: #e8faf0;
        color: var(--primary-green);
        border: 1px solid #c3efd3;
        border-radius: 20px;
        padding: 5px 14px;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
        white-space: nowrap;
    }
    .filter-pill:hover, .filter-pill.active {
        background: var(--primary-green);
        color: white;
        border-color: var(--primary-green);
    }
    .result-count { font-size: 0.82rem; font-weight: 600; color: var(--text-muted); }
    .result-count strong { color: var(--text-dark); }

    /* ── Vehicle Cards ── */
    .vehicle-grid { padding: 36px 0 60px; }
    .vehicle-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }
    .vehicle-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #eee;
        transition: all 0.3s ease;
        height: 100%;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        position: relative;
        animation: fadeUp 0.4s ease both;
        cursor: pointer;
    }
    .vehicle-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 18px 36px rgba(24,194,74,0.14);
        border-color: var(--primary-green);
    }
    .badge-new {
        position: absolute; top: 12px; left: 12px;
        background: var(--primary-green); color: white;
        font-size: 0.65rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: 0.5px;
        border-radius: 20px; padding: 3px 10px; z-index: 2;
    }
    .card-icon-wrap {
        height: 170px;
        display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden;
    }
    .card-icon-wrap .bg-circle {
        width: 110px; height: 110px;
        border-radius: 50%;
        background: #e8faf0;
        display: flex; align-items: center; justify-content: center;
        transition: transform 0.4s ease;
    }
    .vehicle-card:hover .bg-circle { transform: scale(1.1); }
    .card-icon-wrap i { font-size: 3rem; color: var(--primary-green); opacity: 0.75; }
    .card-body-inner { padding: 18px; }
    .badge-cat {
        display: inline-block; background: #e8faf0; color: var(--primary-green);
        font-size: 0.68rem; font-weight: 700; border-radius: 20px;
        padding: 3px 10px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.3px;
    }
    .badge-status-available {
        display: inline-block; background: #e8faf0; color: #0d9136;
        font-size: 0.68rem; font-weight: 700; border-radius: 20px;
        padding: 3px 10px; margin-bottom: 8px; margin-left: 4px;
    }
    .badge-status-rented {
        display: inline-block; background: #fff3e0; color: #e65c00;
        font-size: 0.68rem; font-weight: 700; border-radius: 20px;
        padding: 3px 10px; margin-bottom: 8px; margin-left: 4px;
    }
    .badge-status-maintenance {
        display: inline-block; background: #fdecea; color: #c0392b;
        font-size: 0.68rem; font-weight: 700; border-radius: 20px;
        padding: 3px 10px; margin-bottom: 8px; margin-left: 4px;
    }
    .vehicle-name { font-weight: 800; font-size: 1rem; margin-bottom: 6px; color: var(--text-dark); }
    .vehicle-meta { font-size: 0.75rem; color: var(--text-muted); display: flex; align-items: center; gap: 4px; margin-top: 5px; }
    .vehicle-meta i { color: var(--primary-green); width: 14px; }
    .card-footer-inner {
        padding: 12px 18px 16px; border-top: 1px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between;
    }
    .listing-date { font-size: 0.68rem; color: var(--text-muted); }
    .listing-date i { color: var(--primary-green); margin-right: 3px; }
    .btn-book {
        background: var(--primary-green); color: white; border: none;
        border-radius: 20px; padding: 7px 18px; font-size: 0.75rem; font-weight: 700; transition: 0.2s;
    }
    .btn-book:hover { background: var(--dark-green); color: white; }
    .btn-book:disabled, .btn-book.disabled-btn { background: #ccc; cursor: not-allowed; }

    /* ── Empty State ── */
    .empty-state { text-align: center; padding: 80px 20px; background: white; border-radius: 18px; border: 1px dashed #ccc; }
    .empty-state i { font-size: 4rem; color: #ddd; margin-bottom: 20px; }
    .empty-state h4 { font-weight: 800; color: var(--text-dark); }
    .empty-state p  { color: var(--text-muted); font-size: 0.88rem; }

    /* ── Animation ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
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
    $heroIcon     = $iconMap[$dbCategory] ?? 'fa-car';
    $available    = $vehicles->where('status', 'available')->count();
    $total        = $vehicles->count();
    $newThreshold = now()->subDays(3);
@endphp

<!-- Category Hero -->
<section class="category-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb" style="background:none; padding:0; margin:0; font-size:0.78rem;">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Categories</a></li>
                <li class="breadcrumb-item active">{{ $dbCategory }}</li>
            </ol>
        </nav>
        <div class="icon-bg">
            <i class="fa-solid {{ $heroIcon }}"></i>
        </div>
        <h1>{{ $dbCategory }} Rentals</h1>
        <p>Find the perfect {{ strtolower($dbCategory) }} for your journey, wherever you are.</p>
    </div>
</section>

<!-- Stats Strip -->
<div class="stats-strip">
    <div class="container">
        <div class="row g-0 text-center">
            <div class="col-4 stat-item border-end">
                <div class="num">{{ $total }}</div>
                <div class="lbl">Total Listed</div>
            </div>
            <div class="col-4 stat-item border-end">
                <div class="num">{{ $available }}</div>
                <div class="lbl">Available Now</div>
            </div>
            <div class="col-4 stat-item">
                <div class="num">{{ $vehicles->where('status', 'rented')->count() }}</div>
                <div class="lbl">Currently Rented</div>
            </div>
        </div>
    </div>
</div>

<!-- Filter / Sort Bar -->
<div class="filter-bar">
    <div class="container">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <span class="result-count">
                Showing <strong>{{ $total }}</strong> {{ Str::plural(strtolower($dbCategory), $total) }}
            </span>
            <div class="d-flex gap-2 flex-wrap ms-auto">
                <button class="filter-pill active" onclick="filterCards('all', this)">All</button>
                <button class="filter-pill" onclick="filterCards('available', this)">
                    <i class="fa-solid fa-circle-check me-1"></i> Available
                </button>
                <button class="filter-pill" onclick="filterCards('rented', this)">
                    <i class="fa-solid fa-clock me-1"></i> Rented
                </button>
                <button class="filter-pill" onclick="filterCards('maintenance', this)">
                    <i class="fa-solid fa-wrench me-1"></i> Maintenance
                </button>
                <select class="form-select" style="width:auto;" onchange="sortCards(this.value)">
                    <option value="newest">Sort: Newest First</option>
                    <option value="az">Sort: Brand A–Z</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Vehicle Grid -->
<section class="vehicle-grid">
    <div class="container">
        @if($vehicles->isEmpty())
            <div class="empty-state">
                <i class="fa-solid {{ $heroIcon }}"></i>
                <h4>No {{ $dbCategory }}s Listed Yet</h4>
                <p>There are currently no {{ strtolower($dbCategory) }} listings on the platform.<br>Check back soon — new vehicles are added regularly.</p>
                <a href="{{ route('user.index') }}" class="btn mt-3"
                   style="background:var(--primary-green); color:white; border-radius:25px; padding:10px 28px; font-weight:700;">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back to Home
                </a>
            </div>
        @else
            <div class="row g-4" id="vehicleGrid">
                @foreach($vehicles as $index => $vehicle)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 vehicle-col"
                     data-status="{{ $vehicle->status }}"
                     data-brand="{{ $vehicle->brand }}"
                     data-index="{{ $index }}"
                     style="animation-delay: {{ $index * 0.05 }}s">

                    {{-- Entire card is a link to the vehicle detail page --}}
                    <a href="{{ route('user.show', $vehicle->id) }}" class="vehicle-card-link">
                        <div class="vehicle-card h-100">

                            @if($index < 3)
                                <span class="badge-new">✦ New</span>
                            @endif

                            <div class="card-icon-wrap"
                                 style="background: {{ $vehicle->status === 'available' ? '#f0faf4' : ($vehicle->status === 'rented' ? '#fff8f0' : '#fdf0f0') }};">
                                <div class="bg-circle">
                                    <i class="fa-solid {{ $heroIcon }}"></i>
                                </div>
                            </div>

                            <div class="card-body-inner">
                                <div>
                                    <span class="badge-cat">{{ $vehicle->vehicle_category }}</span>
                                    @if($vehicle->status === 'available')
                                        <span class="badge-status-available">
                                            <i class="fa-solid fa-circle-check"></i> Available
                                        </span>
                                    @elseif($vehicle->status === 'rented')
                                        <span class="badge-status-rented">
                                            <i class="fa-solid fa-clock"></i> Rented
                                        </span>
                                    @else
                                        <span class="badge-status-maintenance">
                                            <i class="fa-solid fa-wrench"></i> Maintenance
                                        </span>
                                    @endif
                                </div>
                                <div class="vehicle-name">{{ $vehicle->brand }} {{ $vehicle->model }}</div>
                                <div class="vehicle-meta">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>{{ $vehicle->location }}</span>
                                </div>
                                <div class="vehicle-meta">
                                    <i class="fa-solid fa-tag"></i>
                                    <span>{{ $vehicle->brand }}</span>
                                </div>
                            </div>

                            <div class="card-footer-inner">
                                <div class="listing-date">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $vehicle->created_at ? $vehicle->created_at->diffForHumans() : 'Recently listed' }}
                                </div>
                                @if($vehicle->status === 'available')
                                    <span class="btn-book">
                                        <i class="fa-solid fa-bolt me-1"></i> Book Now
                                    </span>
                                @else
                                    <span class="btn-book disabled-btn">
                                        {{ ucfirst($vehicle->status) }}
                                    </span>
                                @endif
                            </div>

                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Back to Categories -->
<div class="container pb-5 text-center">
    <a href="{{ route('user.index') }}" class="btn"
       style="background:white; border:2px solid var(--primary-green); color:var(--primary-green); border-radius:25px; padding:10px 28px; font-weight:700; font-size:0.85rem; transition:0.2s;"
       onmouseover="this.style.background='var(--primary-green)'; this.style.color='white';"
       onmouseout="this.style.background='white'; this.style.color='var(--primary-green)';">
        <i class="fa-solid fa-grid-2 me-2"></i>All Categories
    </a>
</div>

@endsection

@push('scripts')
<script>
    function filterCards(status, btn) {
        document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.vehicle-col').forEach(col => {
            const match = status === 'all' || col.dataset.status === status;
            col.style.display = match ? '' : 'none';
        });
    }

    function sortCards(order) {
        const grid = document.getElementById('vehicleGrid');
        const cols = [...grid.querySelectorAll('.vehicle-col')];
        if (order === 'newest') {
            cols.sort((a, b) => parseInt(a.dataset.index) - parseInt(b.dataset.index));
        } else if (order === 'az') {
            cols.sort((a, b) => a.dataset.brand.localeCompare(b.dataset.brand));
        }
        cols.forEach(col => grid.appendChild(col));
    }
</script>
@endpush
