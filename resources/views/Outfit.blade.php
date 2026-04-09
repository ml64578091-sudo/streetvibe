<!DOCTYPE html>
<html lang="id" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('user/img/fav.png') }}">
    <meta charset="UTF-8">
    <title>StreetVibe — Outfit Reference</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,400&family=Playfair+Display:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">

    <style>
        /* ─── BASE ─── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --black:  #0a0a0a;
            --white:  #f5f2ee;
            --orange: #ff5c00;
            --grey:   #8a8680;
            --light:  #f0ede8;
            --card:   #ffffff;
            --border: rgba(0,0,0,0.07);
        }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--black);
            overflow-x: hidden;
            cursor: none;
        }
        a, button { cursor: none; }

        /* ─── NOISE ─── */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 9990; opacity: 0.3;
        }

        /* ─── CURSOR ─── */
        .c-dot {
            width: 8px; height: 8px; background: var(--orange);
            border-radius: 50%; position: fixed; top: 0; left: 0;
            pointer-events: none; z-index: 99999;
            transform: translate(-50%,-50%); transition: transform 0.1s;
        }
        .c-ring {
            width: 36px; height: 36px; border: 1.5px solid var(--orange);
            border-radius: 50%; position: fixed; top: 0; left: 0;
            pointer-events: none; z-index: 99998;
            transform: translate(-50%,-50%);
            transition: left 0.18s ease, top 0.18s ease, width 0.3s, height 0.3s;
            opacity: 0.7;
        }

        /* ─── NAVBAR ─── */
        .sv-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 20px 48px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(245,242,238,0.88);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
            transition: padding 0.4s;
        }
        .sv-nav.scrolled { padding: 13px 48px; }
        .sv-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px; letter-spacing: 2px;
            color: var(--black); text-decoration: none;
        }
        .sv-logo span { color: var(--orange); }
        .sv-nav-links { display: flex; gap: 30px; list-style: none; }
        .sv-nav-links a {
            font-size: 12px; font-weight: 500; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--black);
            text-decoration: none; position: relative; padding-bottom: 3px;
        }
        .sv-nav-links a::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 0; height: 1.5px; background: var(--orange);
            transition: width 0.3s ease;
        }
        .sv-nav-links a:hover::after,
        .sv-nav-links a.active::after { width: 100%; }
        .sv-nav-links a.active { color: var(--orange); }
        .nav-cart {
            position: relative; color: var(--black);
            font-size: 20px; text-decoration: none;
            transition: color 0.3s;
        }
        .nav-cart:hover { color: var(--orange); }
        .cart-badge {
            position: absolute; top: -7px; right: -9px;
            background: var(--orange); color: #fff;
            border-radius: 50%; width: 17px; height: 17px;
            font-size: 9px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
        }

        /* ─── HERO BANNER ─── */
        .outfit-hero {
            min-height: 52vh;
            background: var(--black);
            display: flex; align-items: flex-end;
            padding-bottom: 70px;
            padding-top: 120px;
            position: relative; overflow: hidden;
        }
        .hero-bg-text {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(120px, 20vw, 260px);
            color: rgba(255,255,255,0.03);
            white-space: nowrap; user-select: none;
            letter-spacing: -4px; line-height: 1;
        }
        .hero-accent-line {
            position: absolute; top: 0; left: 0;
            width: 4px; height: 100%;
            background: var(--orange);
        }
        .outfit-hero .container { position: relative; z-index: 2; }
        .hero-eyebrow {
            font-size: 11px; letter-spacing: 5px; text-transform: uppercase;
            color: var(--orange); margin-bottom: 16px;
            display: flex; align-items: center; gap: 12px;
        }
        .hero-eyebrow::before { content: ''; width: 32px; height: 1.5px; background: var(--orange); }
        .hero-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(60px, 9vw, 120px);
            line-height: 0.88; letter-spacing: 2px;
            color: #fff; margin-bottom: 24px;
        }
        .hero-title em {
            font-family: 'Playfair Display', serif;
            color: var(--orange); font-style: italic;
            font-size: 0.6em; display: block;
        }
        .hero-desc {
            font-size: 16px; color: #666;
            max-width: 420px; line-height: 1.7;
        }
        .hero-breadcrumb {
            display: flex; align-items: center; gap: 10px;
            margin-top: 28px;
            font-size: 11px; letter-spacing: 2px; text-transform: uppercase;
        }
        .hero-breadcrumb a { color: #555; text-decoration: none; transition: color 0.3s; }
        .hero-breadcrumb a:hover { color: var(--orange); }
        .hero-breadcrumb span { color: var(--orange); }
        .hero-stat {
            position: absolute; bottom: 48px; right: 60px;
            text-align: right;
        }
        .hero-stat-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 64px; color: #fff; line-height: 1;
        }
        .hero-stat-num span { color: var(--orange); }
        .hero-stat-label { font-size: 11px; color: #555; letter-spacing: 3px; text-transform: uppercase; }

        /* ─── TICKER ─── */
        .ticker {
            background: var(--orange); padding: 12px 0; overflow: hidden;
        }
        .ticker-track {
            display: flex; animation: ticker-run 20s linear infinite;
            width: max-content;
        }
        .ticker-item {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px; color: #fff;
            letter-spacing: 3px; padding: 0 36px; white-space: nowrap;
        }
        .ticker-sep { color: rgba(255,255,255,0.4); }
        @keyframes ticker-run { from { transform: translateX(0); } to { transform: translateX(-50%); } }

        /* ─── FILTER BAR ─── */
        .filter-bar {
            padding: 36px 0 0;
            background: var(--white);
        }
        .filter-inner {
            max-width: 1280px; margin: 0 auto; padding: 0 48px;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 16px;
        }
        .filter-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px; letter-spacing: 2px; color: var(--black);
        }
        .filter-count {
            font-size: 13px; color: var(--grey); margin-left: 10px;
            font-weight: 400; font-family: 'DM Sans', sans-serif;
        }
        .view-toggle { display: flex; gap: 8px; }
        .view-btn {
            width: 38px; height: 38px; border: 1.5px solid var(--border);
            background: transparent; color: var(--grey);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; transition: 0.3s; border-radius: 2px;
        }
        .view-btn.active, .view-btn:hover {
            background: var(--black); color: #fff; border-color: var(--black);
        }

        /* ─── OUTFIT GRID ─── */
        .outfit-section { padding: 40px 0 100px; background: var(--white); }
        .outfits-grid {
            max-width: 1280px; margin: 0 auto; padding: 0 48px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            margin-top: 32px;
        }
        .outfits-grid.list-view { grid-template-columns: 1fr; }

        /* ─── OUTFIT CARD ─── */
        .outfit-card {
            background: var(--card);
            position: relative; overflow: hidden;
            border-radius: 2px;
            transition: transform 0.45s cubic-bezier(0.25,0.46,0.45,0.94),
                        box-shadow 0.45s ease;
        }
        .outfit-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 28px 56px rgba(0,0,0,0.12);
        }

        /* Card number */
        .card-num {
            position: absolute; top: 18px; right: 18px; z-index: 3;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 13px; letter-spacing: 2px;
            color: rgba(255,255,255,0.7);
            background: rgba(0,0,0,0.4);
            padding: 3px 10px; border-radius: 2px;
        }

        /* Image wrap */
        .outfit-img-wrap {
            position: relative; overflow: hidden;
            aspect-ratio: 3/4;
            background: var(--light);
        }
        .outfit-img-wrap img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.7s cubic-bezier(0.25,0.46,0.45,0.94),
                        filter 0.5s;
            filter: grayscale(10%);
        }
        .outfit-card:hover .outfit-img-wrap img {
            transform: scale(1.07);
            filter: grayscale(0%);
        }

        /* Overlay on hover */
        .outfit-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(transparent 40%, rgba(0,0,0,0.88));
            opacity: 0;
            transition: opacity 0.45s;
            display: flex; flex-direction: column;
            justify-content: flex-end;
            padding: 28px;
            z-index: 2;
        }
        .outfit-card:hover .outfit-overlay { opacity: 1; }
        .overlay-label {
            font-size: 10px; letter-spacing: 3px; text-transform: uppercase;
            color: var(--orange); margin-bottom: 6px; font-weight: 700;
        }
        .overlay-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px; color: #fff; letter-spacing: 1px;
            transform: translateY(12px);
            transition: transform 0.45s ease;
        }
        .outfit-card:hover .overlay-title { transform: translateY(0); }
        .overlay-desc {
            font-size: 13px; color: rgba(255,255,255,0.65);
            line-height: 1.6; margin-top: 6px;
            transform: translateY(12px); opacity: 0;
            transition: transform 0.45s ease 0.05s, opacity 0.45s ease 0.05s;
        }
        .outfit-card:hover .overlay-desc { transform: translateY(0); opacity: 1; }

        /* Badge */
        .outfit-badge {
            position: absolute; top: 18px; left: 18px; z-index: 3;
            background: var(--orange); color: #fff;
            font-size: 9px; font-weight: 700; letter-spacing: 2px;
            text-transform: uppercase; padding: 5px 12px;
        }

        /* Card body (below image) */
        .outfit-body {
            padding: 20px 22px 24px;
            border-top: 2px solid transparent;
            transition: border-color 0.3s;
        }
        .outfit-card:hover .outfit-body { border-top-color: var(--orange); }
        .outfit-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px; letter-spacing: 1.5px; color: var(--black);
            margin-bottom: 6px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .outfit-desc-preview {
            font-size: 13px; color: var(--grey); line-height: 1.6;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }
        .outfit-footer {
            display: flex; align-items: center; justify-content: space-between;
            margin-top: 16px;
        }
        .outfit-tag {
            font-size: 10px; letter-spacing: 2px; text-transform: uppercase;
            color: var(--orange); font-weight: 700;
        }
        .outfit-arrow {
            width: 34px; height: 34px;
            border: 1.5px solid var(--border);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: var(--grey);
            transition: 0.3s;
        }
        .outfit-card:hover .outfit-arrow {
            background: var(--orange); border-color: var(--orange); color: #fff;
        }

        /* ─── LIST VIEW CARD ─── */
        .outfits-grid.list-view .outfit-card { display: grid; grid-template-columns: 280px 1fr; }
        .outfits-grid.list-view .outfit-img-wrap { aspect-ratio: auto; height: 100%; }
        .outfits-grid.list-view .outfit-overlay { display: none; }
        .outfits-grid.list-view .outfit-body {
            padding: 32px 36px;
            display: flex; flex-direction: column; justify-content: center;
        }
        .outfits-grid.list-view .outfit-name { font-size: 32px; white-space: normal; }
        .outfits-grid.list-view .outfit-desc-preview { -webkit-line-clamp: 4; font-size: 14px; }
        .outfits-grid.list-view .card-num { top: 22px; right: 22px; }

        /* ─── EMPTY STATE ─── */
        .empty-state {
            grid-column: 1/-1; text-align: center; padding: 100px 20px;
        }
        .empty-icon {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 80px; color: var(--light);
            letter-spacing: 4px; display: block;
            margin-bottom: 16px;
        }
        .empty-state p { font-size: 15px; color: var(--grey); }

        /* ─── INSPIRASI BANNER ─── */
        .inspo-banner {
            background: var(--black);
            padding: 80px 0; margin-top: 80px;
            position: relative; overflow: hidden;
        }
        .inspo-banner::before {
            content: 'VIBE';
            font-family: 'Bebas Neue', sans-serif;
            font-size: 220px; color: rgba(255,255,255,0.025);
            position: absolute; right: -30px; top: 50%;
            transform: translateY(-50%);
            line-height: 1; user-select: none;
        }
        .inspo-inner {
            max-width: 1280px; margin: 0 auto; padding: 0 48px;
            display: flex; align-items: center; justify-content: space-between; gap: 40px;
        }
        .inspo-text { max-width: 560px; }
        .inspo-eyebrow {
            font-size: 11px; letter-spacing: 4px; color: var(--orange);
            text-transform: uppercase; margin-bottom: 16px; font-weight: 700;
        }
        .inspo-title {
            font-family: 'Playfair Display', serif;
            font-style: italic; font-size: clamp(32px, 4vw, 52px);
            color: #fff; line-height: 1.2; margin-bottom: 20px;
        }
        .inspo-body { font-size: 15px; color: #666; line-height: 1.8; }
        .inspo-cta {
            display: inline-flex; align-items: center; gap: 10px;
            border: 1.5px solid var(--orange); color: var(--orange) !important;
            padding: 14px 32px; font-size: 11px;
            letter-spacing: 2px; text-transform: uppercase;
            text-decoration: none; transition: 0.3s; font-weight: 700;
            margin-top: 32px;
        }
        .inspo-cta:hover { background: var(--orange); color: #fff !important; }

        /* ─── FLOAT BTN ─── */
        .float-home {
            position: fixed; bottom: 30px; left: 30px;
            background: var(--black); color: #fff !important;
            width: 54px; height: 54px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; z-index: 9000;
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
            text-decoration: none;
            transition: background 0.3s, transform 0.3s;
        }
        .float-home:hover { background: var(--orange); transform: scale(1.1); color: #fff !important; }

        /* ─── FOOTER ─── */
        .sv-footer {
            background: var(--black);
            padding: 40px 0;
            text-align: center;
        }
        .sv-footer .f-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px; letter-spacing: 3px; color: #fff;
        }
        .sv-footer .f-logo span { color: var(--orange); }
        .sv-footer p { font-size: 11px; color: #444; letter-spacing: 1px; margin-top: 8px; }

        /* ─── PAGE LOAD ANIM ─── */
        .reveal {
            opacity: 0; transform: translateY(36px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 991px) {
            .sv-nav { padding: 16px 24px; }
            .sv-nav-links { display: none; }
            .outfits-grid { grid-template-columns: repeat(2, 1fr); padding: 0 20px; }
            .filter-inner { padding: 0 20px; }
            .inspo-inner { flex-direction: column; padding: 0 24px; }
            .hero-stat { display: none; }
            .outfit-hero { padding-left: 0; }
        }
        @media (max-width: 575px) {
            .outfits-grid { grid-template-columns: 1fr; gap: 16px; }
            .outfits-grid.list-view .outfit-card { grid-template-columns: 1fr; }
            .outfits-grid.list-view .outfit-img-wrap { height: 260px; }
        }
    </style>
</head>
<body>

<!-- CURSOR -->
<div class="c-dot" id="cDot"></div>
<div class="c-ring" id="cRing"></div>

<!-- ═══════════════════ NAVBAR ═══════════════════ -->
<nav class="sv-nav" id="svNav">
    <a href="{{ route('welcome') }}" class="sv-logo">STREET<span>VIBE.</span></a>
    <ul class="sv-nav-links">
        <li><a href="{{ route('welcome') }}">Home</a></li>
        <li><a href="{{ url('/products?kategori=baju') }}">Upperwear</a></li>
        <li><a href="{{ url('/products?kategori=celana') }}">Bottomwear</a></li>
        <li><a href="{{ url('/products?kategori=sepatu') }}">Footwear</a></li>
        <li><a href="{{ route('user.outfits.index') }}" class="active">Outfit</a></li>
        @auth

        @else
        <li><a href="{{ route('login') }}">Login</a></li>
        @endauth
    </ul>
    <a href="{{ route('cart.index') }}" class="nav-cart">
        <i class="lnr lnr-cart"></i>
        @php $cartCount = session('cart') ? count(session('cart')) : 0; @endphp
        @if($cartCount > 0)
            <span class="cart-badge">{{ $cartCount }}</span>
        @endif
    </a>
</nav>

<!-- ═══════════════════ HERO ═══════════════════ -->
<section class="outfit-hero">
    <div class="hero-bg-text">OUTFIT</div>
    <div class="hero-accent-line"></div>
    <div class="container">
        <div class="hero-eyebrow">Style Curation</div>
        <h1 class="hero-title">
            OUTFIT<br>
            <em>"Reference"</em>
            GALLERY
        </h1>
        <p class="hero-desc">Temukan kombinasi pakaian terbaik dari koleksi pilihan kami — inspirasi tanpa batas untuk harimu.</p>
        <div class="hero-breadcrumb">
            <a href="{{ route('welcome') }}">Home</a>
            <span>✦</span>
            <span style="color: #fff;">Outfit Gallery</span>
        </div>
    </div>
    <div class="hero-stat">
        <div class="hero-stat-num">{{ $outfits->count() ?? 0 }}<span>+</span></div>
        <div class="hero-stat-label">Outfit References</div>
    </div>
</section>

<!-- ═══════════════════ TICKER ═══════════════════ -->
<div class="ticker">
    <div class="ticker-track">
        @foreach(range(1,2) as $i)
        <span class="ticker-item">STREETWEAR</span>
        <span class="ticker-item ticker-sep">✦</span>
        <span class="ticker-item">OUTFIT INSPO</span>
        <span class="ticker-item ticker-sep">✦</span>
        <span class="ticker-item">URBAN STYLE</span>
        <span class="ticker-item ticker-sep">✦</span>
        <span class="ticker-item">DEFINE YOUR VIBE</span>
        <span class="ticker-item ticker-sep">✦</span>
        <span class="ticker-item">STREET CULTURE 2026</span>
        <span class="ticker-item ticker-sep">✦</span>
        <span class="ticker-item">LOOK BOOK</span>
        <span class="ticker-item ticker-sep">✦</span>
        @endforeach
    </div>
</div>

<!-- ═══════════════════ FILTER BAR ═══════════════════ -->
<div class="filter-bar">
    <div class="filter-inner">
        <div>
            <span class="filter-title">ALL LOOKS</span>
            <span class="filter-count">{{ $outfits->count() }} references</span>
        </div>
        <div class="view-toggle">
            <button class="view-btn active" id="btnGrid" onclick="setView('grid')" title="Grid View">
                <i class="fa fa-th-large"></i>
            </button>
            <button class="view-btn" id="btnList" onclick="setView('list')" title="List View">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════ OUTFITS GRID ═══════════════════ -->
<section class="outfit-section">
    <div class="outfits-grid" id="outfitsGrid">
        @forelse($outfits as $i => $outfit)
        <div class="outfit-card reveal">
    {{-- Link Instagram membungkus area gambar dan overlay --}}
    <a href="https://www.instagram.com/{{ $outfit->deskripsi }}" target="_blank" rel="noopener noreferrer" style="text-decoration: none; color: inherit;">
        <div class="outfit-img-wrap">
            <div class="outfit-badge">Streetwear</div>
            <div class="card-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>

            <img src="{{ Storage::url($outfit->gambar) }}" alt="{{ $outfit->judul }}">

            <div class="outfit-overlay">
                <div class="overlay-label">✦ Outfit Reference</div>
                <div class="overlay-title">{{ strtoupper($outfit->judul) }}</div>
                {{-- Menampilkan Username dengan simbol @ di overlay --}}
                <div class="overlay-desc">@ {{ $outfit->deskripsi }}</div>
            </div>
        </div>
    </a>

    <div class="outfit-body">
        <div class="outfit-name">{{ strtoupper($outfit->judul) }}</div>
        {{-- Link tambahan pada bagian deskripsi bawah --}}
            <div class="outfit-desc-preview" style="color: #666;">
            </div>
        </a>
        <div class="outfit-footer">
            <span class="outfit-tag">✦ Style Guide</span>
            <div class="outfit-arrow"><i class="fa fa-arrow-right"></i></div>
        </div>
    </div>
</div>
        @empty
        <div class="empty-state">
            <span class="empty-icon">EMPTY</span>
            <p>Belum ada referensi outfit yang tersedia.</p>
        </div>
        @endforelse
    </div>

    <!-- INSPIRASI BANNER -->
    <div class="inspo-banner">
        <div class="inspo-inner">
            <div class="inspo-text">
                <div class="inspo-eyebrow">✦ Build Your Look</div>
                <h2 class="inspo-title">"Your outfit is your<br>daily self-portrait."</h2>
                <p class="inspo-body">Setiap referensi outfit di sini lahir dari kultur jalanan yang autentik. Gunakan sebagai panduan, lalu tambahkan sentuhan pribadimu.</p>
                <a href="{{ route('welcome') }}#products-section" class="inspo-cta">
                    Shop The Look <i class="fa fa-arrow-right"></i>
                </a>
            </div>
            <div style="display: flex; flex-direction: column; gap: 24px; min-width: 200px;">
                <div style="border-left: 2px solid #222; padding-left: 24px;">
                    <div style="font-family:'Bebas Neue',sans-serif; font-size:52px; color:#fff; line-height:1;">{{ $outfits->count() }}<span style="color:var(--orange)">+</span></div>
                    <div style="font-size:11px; color:#555; letter-spacing:3px; text-transform:uppercase;">Style Guides</div>
                </div>
                <div style="border-left: 2px solid #222; padding-left: 24px;">
                    <div style="font-family:'Bebas Neue',sans-serif; font-size:52px; color:#fff; line-height:1;">100<span style="color:var(--orange)">%</span></div>
                    <div style="font-size:11px; color:#555; letter-spacing:3px; text-transform:uppercase;">Authentic Vibe</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FLOAT HOME BTN -->
<a href="{{ route('welcome') }}" class="float-home" title="Kembali ke Beranda">
    <i class="fa fa-home"></i>
</a>

<!-- ═══════════════════ FOOTER ═══════════════════ -->
<footer class="sv-footer">
    <div class="f-logo">STREET<span>VIBE.</span></div>
    <p>&copy; 2026 STREETVIBE. ALL RIGHTS RESERVED.</p>
</footer>

<script src="{{ asset('user/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script>
    /* ── Cursor ── */
    var dot  = document.getElementById('cDot');
    var ring = document.getElementById('cRing');
    document.addEventListener('mousemove', function(e) {
        dot.style.left = e.clientX + 'px';
        dot.style.top  = e.clientY + 'px';
        setTimeout(function() {
            ring.style.left = e.clientX + 'px';
            ring.style.top  = e.clientY + 'px';
        }, 65);
    });
    document.querySelectorAll('a, button').forEach(function(el) {
        el.addEventListener('mouseenter', function() { ring.style.width = ring.style.height = '54px'; });
        el.addEventListener('mouseleave', function() { ring.style.width = ring.style.height = '36px'; });
    });

    /* ── Navbar scroll ── */
    window.addEventListener('scroll', function() {
        document.getElementById('svNav').classList.toggle('scrolled', window.scrollY > 60);
    });

    /* ── Scroll reveal ── */
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry, i) {
            if (entry.isIntersecting) {
                setTimeout(function() {
                    entry.target.classList.add('visible');
                }, i * 90);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08 });
    document.querySelectorAll('.reveal').forEach(function(el) { observer.observe(el); });

    /* ── View toggle ── */
    function setView(mode) {
        var grid   = document.getElementById('outfitsGrid');
        var btnGrid = document.getElementById('btnGrid');
        var btnList = document.getElementById('btnList');
        if (mode === 'list') {
            grid.classList.add('list-view');
            btnList.classList.add('active');
            btnGrid.classList.remove('active');
        } else {
            grid.classList.remove('list-view');
            btnGrid.classList.add('active');
            btnList.classList.remove('active');
        }
    }
</script>
</body>
</html>
