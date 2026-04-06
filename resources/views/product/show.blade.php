<!DOCTYPE html>
<html lang="id" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>StreetVibe — {{ $product->nama_produk }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,400&family=Playfair+Display:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ─── BASE ─── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --black:  #0a0a0a;
            --white:  #f5f2ee;
            --orange: #ff5c00;
            --grey:   #8a8680;
            --light:  #f0ede8;
            --border: rgba(0,0,0,0.08);
            --shopee: #ee4d2d;
            --wa:     #25d366;
        }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--black);
            overflow-x: hidden;
            cursor: none;
        }
        a { cursor: none; }
        button { cursor: none; }

        /* ─── DARK MODE ─── */
        body.dark {
            --white:  #111111;
            --light:  #1a1a1a;
            --black:  #f0ede8;
            --border: rgba(255,255,255,0.08);
            background: #111;
            color: #f0ede8;
        }
        body.dark .sv-nav { background: rgba(17,17,17,0.9); border-color: rgba(255,255,255,0.06); }
        body.dark .product-img-panel { background: #1a1a1a; }
        body.dark .info-row { border-color: rgba(255,255,255,0.07); }
        body.dark .btn-back { background: #1e1e1e; color: #f0ede8; }
        body.dark .btn-back:hover { background: var(--orange); }
        body.dark .pill-badge { background: rgba(255,92,0,0.15); }

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
            transition: transform 0.18s ease, width 0.3s, height 0.3s;
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
            transition: padding 0.4s, background 0.4s;
        }
        .sv-nav.scrolled { padding: 14px 48px; }
        .sv-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px; letter-spacing: 2px;
            color: var(--black); text-decoration: none;
        }
        .sv-logo span { color: var(--orange); }
        .nav-right { display: flex; align-items: center; gap: 20px; }
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
        .btn-back {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(0,0,0,0.06); color: var(--black) !important;
            border: none; padding: 9px 18px; border-radius: 50px;
            font-size: 12px; font-weight: 600; letter-spacing: 1px;
            text-transform: uppercase; text-decoration: none;
            transition: 0.3s;
        }
        .btn-back:hover { background: var(--orange); color: #fff !important; }
        .dark-toggle {
            display: inline-flex; align-items: center; justify-content: center;
            background: rgba(0,0,0,0.06); color: var(--black);
            border: none; width: 38px; height: 38px; border-radius: 50%;
            font-size: 15px; transition: 0.3s;
        }
        .dark-toggle:hover { background: var(--orange); color: #fff; }

        /* ─── PAGE WRAPPER ─── */
        .page-wrapper {
            min-height: 100vh;
            padding: 110px 0 80px;
        }
        .product-grid {
            max-width: 1200px; margin: 0 auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: start;
        }

        /* ─── LEFT — IMAGE PANEL ─── */
        .product-img-panel {
            position: sticky; top: 100px;
            background: var(--light);
            border-radius: 4px;
            overflow: hidden;
            aspect-ratio: 4/5;
            display: flex; align-items: center; justify-content: center;
        }
        .product-img-panel img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25,0.46,0.45,0.94);
            cursor: crosshair;
        }
        .img-badge {
            position: absolute; top: 20px; left: 20px;
            background: var(--black); color: var(--white);
            font-size: 10px; font-weight: 700; letter-spacing: 2px;
            text-transform: uppercase; padding: 6px 14px;
        }
        body.dark .img-badge { background: var(--orange); color: #fff; }
        .img-corner {
            position: absolute; bottom: 0; right: 0;
            width: 80px; height: 80px;
            background: var(--orange);
            display: flex; align-items: center; justify-content: center;
            flex-direction: column; color: #fff; text-align: center;
        }
        .img-corner-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px; line-height: 1;
        }
        .img-corner-label { font-size: 8px; letter-spacing: 2px; text-transform: uppercase; opacity: 0.8; }

        /* ─── RIGHT — INFO ─── */
        .product-info-panel { padding-top: 8px; }
        .product-eyebrow {
            font-size: 11px; letter-spacing: 4px; text-transform: uppercase;
            color: var(--orange); margin-bottom: 16px;
            display: flex; align-items: center; gap: 10px;
        }
        .product-eyebrow::before { content: ''; width: 24px; height: 1.5px; background: var(--orange); }
        .pill-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,92,0,0.1);
            color: var(--orange); padding: 5px 14px;
            border-radius: 50px; font-size: 11px; font-weight: 700;
            letter-spacing: 1px; text-transform: uppercase;
            margin-bottom: 20px;
        }
        .pill-badge::before { content: '●'; font-size: 8px; animation: pulse-dot 1.5s infinite; }
        @keyframes pulse-dot { 0%,100%{opacity:1} 50%{opacity:0.3} }
        .product-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(42px, 5vw, 68px);
            line-height: 0.9; letter-spacing: 1px;
            margin-bottom: 24px;
            color: var(--black);
        }
        .product-price {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 36px; color: var(--orange);
            margin-bottom: 32px;
        }
        .product-price small {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; color: var(--grey);
            font-style: normal; margin-left: 8px;
        }

        /* ─── INFO TABLE ─── */
        .info-table { margin: 0 0 32px; }
        .info-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 13px 0;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }
        .info-row:first-child { border-top: 1px solid var(--border); }
        .info-label { color: var(--grey); letter-spacing: 0.5px; }
        .info-val { font-weight: 700; color: var(--black); }
        .stock-in { color: #22a06b; }
        .stock-out { color: #e03131; }

        /* ─── DESCRIPTION ─── */
        .desc-block { margin-bottom: 36px; }
        .desc-label {
            font-size: 10px; letter-spacing: 3px; text-transform: uppercase;
            color: var(--orange); margin-bottom: 12px; font-weight: 700;
        }
        .desc-text {
            font-size: 15px; color: var(--grey);
            line-height: 1.85; white-space: pre-line;
        }

        /* ─── ACTION BUTTONS ─── */
        .action-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .btn-primary-sv {
            grid-column: span 2;
            display: flex; align-items: center; justify-content: center; gap: 12px;
            background: var(--black); color: var(--white) !important;
            border: none; padding: 18px;
            font-size: 12px; font-weight: 700; letter-spacing: 2px;
            text-transform: uppercase; text-decoration: none;
            position: relative; overflow: hidden;
            transition: color 0.4s; border-radius: 2px;
        }
        .btn-primary-sv::before {
            content: ''; position: absolute; inset: 0;
            background: var(--orange);
            transform: translateX(-101%);
            transition: transform 0.4s cubic-bezier(0.77,0,0.18,1);
        }
        .btn-primary-sv:hover::before { transform: translateX(0); }
        .btn-primary-sv:hover { color: #fff !important; }
        .btn-primary-sv > * { position: relative; z-index: 1; }
        .btn-primary-sv:disabled { opacity: 0.5; pointer-events: none; }

        .btn-shopee-sv {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            background: var(--shopee); color: #fff !important;
            border: none; padding: 15px;
            font-size: 12px; font-weight: 700; letter-spacing: 1px;
            text-transform: uppercase; text-decoration: none;
            border-radius: 2px; transition: 0.3s;
        }
        .btn-shopee-sv:hover { background: #d63f22; transform: translateY(-2px); color: #fff !important; }

        .btn-wa-sv {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            background: transparent; color: var(--wa) !important;
            border: 1.5px solid var(--wa); padding: 15px;
            font-size: 12px; font-weight: 700; letter-spacing: 1px;
            text-transform: uppercase; text-decoration: none;
            border-radius: 2px; transition: 0.3s;
        }
        .btn-wa-sv:hover { background: var(--wa); color: #fff !important; transform: translateY(-2px); }

        /* ─── TRUST BADGES ─── */
        .trust-strip {
            display: flex; gap: 24px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }
        .trust-item {
            flex: 1; text-align: center;
            font-size: 11px; color: var(--grey); letter-spacing: 0.5px;
        }
        .trust-item i { display: block; font-size: 20px; color: var(--orange); margin-bottom: 6px; }

        /* ─── RELATED PRODUCTS ─── */
        .related-section {
            max-width: 1200px; margin: 80px auto 0;
            padding: 0 40px;
        }
        .related-header {
            display: flex; align-items: baseline; gap: 16px; margin-bottom: 36px;
        }
        .related-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 40px; letter-spacing: 2px; color: var(--black);
        }
        .related-title span { color: var(--orange); }
        .related-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;
        }
        .rel-card {
            text-decoration: none;
            display: block; overflow: hidden; border-radius: 2px;
            background: var(--light);
            transition: transform 0.4s ease, box-shadow 0.4s;
        }
        .rel-card:hover { transform: translateY(-6px); box-shadow: 0 16px 36px rgba(0,0,0,0.1); }
        .rel-img-wrap { aspect-ratio: 3/4; overflow: hidden; position: relative; }
        .rel-img-wrap img { width:100%; height:100%; object-fit:cover; transition: transform 0.5s; }
        .rel-card:hover .rel-img-wrap img { transform: scale(1.06); }
        .rel-info { padding: 14px 16px 18px; }
        .rel-name { font-size: 13px; font-weight: 700; color: var(--black); margin-bottom: 4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .rel-price { font-size: 14px; color: var(--orange); font-weight: 700; }

        /* ─── ALERT TOAST ─── */
        .sv-toast {
            position: fixed; top: 90px; right: 24px;
            background: var(--black); color: var(--white);
            padding: 14px 22px; border-left: 3px solid var(--orange);
            font-size: 13px; z-index: 9000;
            display: flex; align-items: center; gap: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            animation: slide-in 0.4s ease forwards;
        }
        @keyframes slide-in { from { transform: translateX(120%); opacity:0; } to { transform: translateX(0); opacity:1; } }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 991px) {
            .product-grid { grid-template-columns: 1fr; gap: 40px; padding: 0 20px; }
            .product-img-panel { position: relative; top: auto; }
            .related-grid { grid-template-columns: repeat(2, 1fr); }
            .sv-nav { padding: 16px 24px; }
            .related-section { padding: 0 20px; }
        }
        @media (max-width: 575px) {
            .product-name { font-size: 48px; }
            .related-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .trust-strip { gap: 12px; }
        }
    </style>
</head>
<body>

<!-- CURSOR -->
<div class="c-dot" id="cDot"></div>
<div class="c-ring" id="cRing"></div>

<!-- ═══════════ NAVBAR ═══════════ -->
<nav class="sv-nav" id="svNav">
    <a href="{{ route('welcome') }}" class="sv-logo">STREET<span>VIBE.</span></a>
    <div class="nav-right">
        <a href="javascript:history.back()" class="btn-back">
            <i class="fa fa-chevron-left"></i> Back
        </a>
        <button class="dark-toggle" onclick="toggleDark()" id="darkBtn" title="Toggle Dark Mode">
            <i class="fa fa-moon-o" id="darkIcon"></i>
        </button>
        <a href="{{ route('cart.index') }}" class="nav-cart">
            <i class="lnr lnr-cart"></i>
            @php $cartCount = session('cart') ? count(session('cart')) : 0; @endphp
            @if($cartCount > 0)
                <span class="cart-badge">{{ $cartCount }}</span>
            @endif
        </a>
    </div>
</nav>

<!-- ═══════════ MAIN ═══════════ -->
<div class="page-wrapper">
    <div class="product-grid">

        <!-- LEFT: IMAGE -->
        <div style="position: relative;">
            <div class="product-img-panel" id="imgPanel">
                <div class="img-badge">{{ $product->category->nama_kategori ?? 'Vibe' }}</div>
                <img id="gambar"
                     src="{{ Storage::url($product->gambar) }}"
                     alt="{{ $product->nama_produk }}">
                <div class="img-corner">
                    <div class="img-corner-num">{{ $product->stok }}</div>
                    <div class="img-corner-label">Stock</div>
                </div>
            </div>
        </div>

        <!-- RIGHT: INFO -->
        <div class="product-info-panel">
            <div class="product-eyebrow">StreetVibe Collection</div>

            @if($product->stok > 0)
                <div class="pill-badge">Ready Stock</div>
            @else
                <div class="pill-badge" style="background:rgba(224,49,49,0.1); color:#e03131;">
                    Sold Out
                </div>
            @endif

            <h1 class="product-name">{{ $product->nama_produk }}</h1>

            <div class="product-price">
                IDR {{ number_format($product->harga, 0, ',', '.') }}
                <small>incl. tax</small>
            </div>

            <!-- INFO TABLE -->
            <div class="info-table">
                <div class="info-row">
                    <span class="info-label">Category</span>
                    <span class="info-val">{{ $product->category->nama_kategori ?? 'Vibe Essentials' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Availability</span>
                    <span class="info-val {{ $product->stok > 0 ? 'stock-in' : 'stock-out' }}">
                        {{ $product->stok > 0 ? '✓ In Stock ('.$product->stok.' pcs)' : '✗ Sold Out' }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">SKU</span>
                    <span class="info-val" style="font-family:'Bebas Neue',sans-serif; letter-spacing:2px; color: var(--orange);">
                        SV-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                    </span>
                </div>
            </div>

            <!-- DESCRIPTION -->
            @if($product->deskripsi)
            <div class="desc-block">
                <div class="desc-label">✦ Story & Details</div>
                <div class="desc-text">{!! nl2br(e($product->deskripsi)) !!}</div>
            </div>
            @endif

            <!-- ACTIONS -->
            <div class="action-grid">
                <form action="{{ route('cart.add', $product->id) }}" method="POST"
                      id="cartForm" style="grid-column: span 2; display: contents;">
                    @csrf
                    <button type="submit" class="btn-primary-sv" id="cartBtn"
                            {{ $product->stok <= 0 ? 'disabled' : '' }}>
                        <i class="lnr lnr-bag" id="cartIcon"></i>
                        <span id="cartText">
                            {{ $product->stok > 0 ? 'Add to Bag' : 'Out of Stock' }}
                        </span>
                    </button>
                </form>

                <a class="btn-shopee-sv"
                   href="https://shopee.co.id/search?keyword={{ urlencode($product->nama_produk) }}"
                   target="_blank">
                    <i class="fa fa-shopping-bag"></i> Shopee
                </a>

                <a class="btn-wa-sv"
                   href="https://wa.me/6283140760412?text=Hi%20StreetVibe%2C%20apakah%20{{ urlencode($product->nama_produk) }}%20masih%20tersedia%3F"
                   target="_blank">
                    <i class="fa fa-whatsapp"></i> WhatsApp
                </a>
            </div>

            <!-- TRUST -->
            <div class="trust-strip">
                <div class="trust-item"><i class="fa fa-truck"></i>Free Shipping<br>above 500k</div>
                <div class="trust-item"><i class="fa fa-shield"></i>Authentic<br>Guarantee</div>
                <div class="trust-item"><i class="fa fa-undo"></i>Easy<br>Returns</div>
                <div class="trust-item"><i class="fa fa-lock"></i>Secure<br>Payment</div>
            </div>
        </div>
    </div>

    {{-- RELATED PRODUCTS (optional — hapus jika tidak ada variable $relatedProducts) --}}
    @isset($relatedProducts)
    @if($relatedProducts->count() > 0)
    <div class="related-section">
        <div class="related-header">
            <div class="related-title">MORE <span>DROPS</span></div>
        </div>
        <div class="related-grid">
            @foreach($relatedProducts->take(4) as $rel)
            <a href="{{ route('products.show', $rel->id) }}" class="rel-card">
                <div class="rel-img-wrap">
                    <img src="{{ Storage::url($rel->gambar) }}" alt="{{ $rel->nama_produk }}">
                </div>
                <div class="rel-info">
                    <div class="rel-name">{{ strtoupper($rel->nama_produk) }}</div>
                    <div class="rel-price">Rp {{ number_format($rel->harga, 0, ',', '.') }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
    @endisset
</div>

<!-- FOOTER MINI -->
<footer style="text-align:center; padding: 40px; border-top: 1px solid var(--border); margin-top: 60px;">
    <a href="{{ route('welcome') }}" style="font-family:'Bebas Neue',sans-serif; font-size:22px; letter-spacing:2px; color:var(--black); text-decoration:none;">
        STREET<span style="color:var(--orange)">VIBE.</span>
    </a>
    <p style="font-size:12px; color:var(--grey); margin-top:8px; letter-spacing:1px;">&copy; 2026 ALL RIGHTS RESERVED.</p>
</footer>

<script src="{{ asset('user/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script>
    /* ── Cursor ── */
    const dot = document.getElementById('cDot'), ring = document.getElementById('cRing');
    document.addEventListener('mousemove', function(e) {
        dot.style.left = e.clientX + 'px';
        dot.style.top  = e.clientY + 'px';
        setTimeout(function() {
            ring.style.left = e.clientX + 'px';
            ring.style.top  = e.clientY + 'px';
        }, 60);
    });
    document.querySelectorAll('a, button').forEach(function(el) {
        el.addEventListener('mouseenter', function() { ring.style.width = ring.style.height = '54px'; });
        el.addEventListener('mouseleave', function() { ring.style.width = ring.style.height = '36px'; });
    });

    /* ── Navbar scroll ── */
    window.addEventListener('scroll', function() {
        document.getElementById('svNav').classList.toggle('scrolled', window.scrollY > 60);
    });

    /* ── Image zoom on hover ── */
    var panel = document.getElementById('imgPanel');
    var img   = document.getElementById('productImg');
    if (panel && img) {
        panel.addEventListener('mousemove', function(e) {
            var r = panel.getBoundingClientRect();
            var x = e.clientX - r.left;
            var y = e.clientY - r.top;
            img.style.transformOrigin = x + 'px ' + y + 'px';
            img.style.transform = 'scale(1.45)';
        });
        panel.addEventListener('mouseleave', function() {
            img.style.transform = 'scale(1)';
        });
    }

    /* ── Dark mode ── */
    if (localStorage.getItem('sv-theme') === 'dark') {
        document.body.classList.add('dark');
        document.getElementById('darkIcon').className = 'fa fa-sun-o';
    }
    function toggleDark() {
        document.body.classList.toggle('dark');
        var isDark = document.body.classList.contains('dark');
        localStorage.setItem('sv-theme', isDark ? 'dark' : 'light');
        document.getElementById('darkIcon').className = isDark ? 'fa fa-sun-o' : 'fa fa-moon-o';
    }

    /* ── Cart button loading ── */
    var cartForm = document.getElementById('cartForm');
    if (cartForm) {
        cartForm.addEventListener('submit', function() {
            var btn  = document.getElementById('cartBtn');
            var text = document.getElementById('cartText');
            var icon = document.getElementById('cartIcon');
            btn.disabled = true;
            text.textContent = 'Adding to Bag...';
            icon.className = 'fa fa-spinner fa-spin';
        });
    }

    /* ── SweetAlert success toast ── */
    @if(session('success'))
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        background: document.body.classList.contains('dark') ? '#1a1a1a' : '#fff',
        color: document.body.classList.contains('dark') ? '#f0ede8' : '#111',
        iconColor: '#ff5c00'
    });
    Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
    @endif
</script>
</body>
</html>
