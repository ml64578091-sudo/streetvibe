<!DOCTYPE html>
<html lang="id" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>StreetVibe — {{ $product->nama_produk }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ─── VARIABLES ─── */
        :root {
            --black: #000000;
            --white: #ffffff;
            --orange: #ff5c00;
            --grey-100: #f8f9fa;
            --grey-200: #e9ecef;
            --grey-500: #6c757d;
            --grey-800: #343a40;
            --shopee: #ee4d2d;
            --wa: #25d366;
            --glass: rgba(255, 255, 255, 0.8);
            --border: rgba(0,0,0,0.06);
            --transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body.dark {
            --black: #ffffff;
            --white: #080808;
            --grey-100: #111111;
            --grey-200: #1a1a1a;
            --grey-500: #a0a0a0;
            --glass: rgba(8, 8, 8, 0.8);
            --border: rgba(255,255,255,0.08);
        }

        /* ─── RESET ─── */
        * { cursor: none !important; margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--white);
            color: var(--black);
            overflow-x: hidden;
            transition: background 0.5s ease;
        }

        /* ─── CURSOR ─── */
        #cDot { width: 6px; height: 6px; background: var(--orange); border-radius: 50%; position: fixed; pointer-events: none; z-index: 10001; transform: translate(-50%, -50%); }
        #cRing { width: 35px; height: 35px; border: 1.5px solid var(--orange); border-radius: 50%; position: fixed; pointer-events: none; z-index: 10000; transform: translate(-50%, -50%); transition: width 0.3s, height 0.3s, background 0.3s, border 0.3s; }

        /* ─── NAV ─── */
        .sv-nav {
            position: fixed; top: 0; width: 100%; z-index: 1000;
            padding: 30px 60px; display: flex; align-items: center; justify-content: space-between;
            background: transparent; transition: var(--transition);
        }
        .sv-nav.scrolled {
            padding: 15px 60px; background: var(--glass);
            backdrop-filter: blur(20px); border-bottom: 1px solid var(--border);
        }
        .sv-logo { font-family: 'Bebas Neue', sans-serif; font-size: 32px; letter-spacing: 2px; color: var(--black); text-decoration: none; }
        .sv-logo span { color: var(--orange); }

        .btn-circle {
            width: 48px; height: 48px; border-radius: 50%; border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            background: var(--white); color: var(--black); transition: var(--transition);
            text-decoration: none; font-size: 16px;
        }
        .btn-circle:hover { background: var(--black); color: var(--white); transform: translateY(-3px); }

        /* ─── MARQUEE ─── */
        .sv-marquee {
            background: var(--black); color: var(--white);
            padding: 15px 0; font-family: 'Bebas Neue', sans-serif;
            font-size: 16px; letter-spacing: 4px; overflow: hidden;
            white-space: nowrap; margin-top: 100px;
        }
        .marquee-inner { display: inline-block; animation: marquee 30s linear infinite; }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

        /* ─── LAYOUT ─── */
        .product-container { max-width: 1400px; margin: 80px auto; padding: 0 60px; }
        .product-grid { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 80px; }

        /* Left: Media */
        .media-wrap { position: sticky; top: 120px; }
        .main-image-card {
            background: var(--grey-100); border-radius: 24px;
            overflow: hidden; aspect-ratio: 4/5; position: relative;
            box-shadow: 0 40px 80px rgba(0,0,0,0.05);
        }
        .main-image-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1); }
        .category-badge {
            position: absolute; top: 30px; left: 30px;
            background: var(--black); color: var(--white);
            padding: 8px 20px; border-radius: 100px; font-size: 11px;
            font-weight: 800; letter-spacing: 2px; text-transform: uppercase; z-index: 10;
        }

        /* Right: Content */
        .product-eyebrow {
            font-weight: 800; color: var(--orange); letter-spacing: 6px;
            text-transform: uppercase; font-size: 13px; margin-bottom: 20px;
            display: block;
        }
        .product-title {
            font-family: 'Bebas Neue', sans-serif; font-size: 90px;
            line-height: 0.85; margin-bottom: 25px; text-transform: uppercase;
        }
        .price-box { display: flex; align-items: baseline; gap: 15px; margin-bottom: 40px; }
        .price-current { font-family: 'Playfair Display', serif; font-size: 48px; font-weight: 900; color: var(--black); }

        .spec-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px; }
        .spec-item {
            background: var(--grey-100); padding: 20px; border-radius: 16px;
            border: 1px solid var(--border); transition: var(--transition);
        }
        .spec-item:hover { border-color: var(--orange); background: var(--white); }
        .spec-label { display: block; font-size: 11px; font-weight: 700; color: var(--grey-500); text-transform: uppercase; margin-bottom: 5px; }
        .spec-value { font-weight: 800; font-size: 15px; }

        /* Deskripsi Styling */
        .description-text { font-size: 16px; line-height: 1.8; color: var(--grey-500); margin-bottom: 50px; text-align: justify; }
        .desc-line { margin-bottom: 12px; display: block; }
        .desc-bullet { display: flex; gap: 10px; margin-bottom: 8px; padding-left: 5px; }

        /* ─── BUTTONS ─── */
        .btn-primary-sv {
            width: 100%; height: 70px; background: var(--black); color: var(--white);
            border: none; border-radius: 18px; font-size: 15px; font-weight: 800;
            letter-spacing: 3px; text-transform: uppercase; display: flex;
            align-items: center; justify-content: center; gap: 15px;
            transition: var(--transition); position: relative; overflow: hidden;
            margin-bottom: 20px;
        }
        .btn-primary-sv:hover { background: var(--orange); transform: translateY(-5px); box-shadow: 0 20px 40px rgba(255, 92, 0, 0.2); }
        .btn-primary-sv:disabled { background: var(--grey-500); opacity: 0.5; transform: none; }

        .social-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .btn-outline {
            height: 65px; border-radius: 18px; display: flex; align-items: center;
            justify-content: center; gap: 12px; text-decoration: none; font-weight: 700;
            font-size: 14px; transition: var(--transition); border: 2px solid;
        }
        .btn-shopee-sv { border-color: var(--shopee); color: var(--shopee) !important; }
        .btn-shopee-sv:hover { background: var(--shopee); color: white !important; }

        .btn-wa-sv { border-color: var(--wa); color: var(--wa) !important; }
        .btn-wa-sv:hover { background: var(--wa); color: white !important; }

        .noise { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.05'/%3E%3C/svg%3E"); pointer-events: none; z-index: 9999; opacity: 0.3; }

        @media (max-width: 991px) {
            .product-grid { grid-template-columns: 1fr; }
            .product-container { padding: 0 30px; }
            .product-title { font-size: 60px; }
            .sv-nav { padding: 20px 30px; }
        }
    </style>
</head>

<body class="{{ (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') ? 'dark' : '' }}">

<div class="noise"></div>
<div id="cDot"></div>
<div id="cRing"></div>

<nav class="sv-nav" id="svNav">
    <a href="{{ route('welcome') }}" class="sv-logo">STREET<span>VIBE.</span></a>
    <div class="nav-right">
        <a href="javascript:history.back()" class="btn-circle"><i class="fa fa-chevron-left"></i></a>
        <button class="btn-circle" onclick="toggleDarkMode()"><i class="fa fa-adjust" id="themeIcon"></i></button>
        <a href="{{ route('cart.index') }}" class="btn-circle" style="position: relative;">
            <i class="lnr lnr-cart"></i>
            @php $count = session('cart') ? count(session('cart')) : 0; @endphp
            @if($count > 0)
                <span style="position:absolute; top:-5px; right:-5px; background:var(--orange); color:white; font-size:10px; width:20px; height:20px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800;">{{ $count }}</span>
            @endif
        </a>
    </div>
</nav>

<div class="sv-marquee">
    <div class="marquee-inner">
        STREETVIBE ARCHIVE 2026 — PREMIUM QUALITY GUARANTEED — LIMITED QUANTITY DROP — WORLDWIDE SHIPPING — STREETVIBE ARCHIVE 2026 — PREMIUM QUALITY GUARANTEED — LIMITED QUANTITY DROP — WORLDWIDE SHIPPING —
    </div>
</div>

<main class="product-container">
    <div class="product-grid">
        <div class="media-wrap">
            <div class="main-image-card" id="imgPanel">
                <span class="category-badge">{{ $product->category->nama_kategori ?? 'UNRELEASED' }}</span>
                <img id="mainImg" src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama_produk }}">
            </div>
        </div>

        <div class="content-wrap">
            <span class="product-eyebrow">Essentials Collection</span>
            <h1 class="product-title">{{ $product->nama_produk }}</h1>

            <div class="price-box">
                <span class="price-current">IDR {{ number_format($product->harga, 0, ',', '.') }}</span>
            </div>

            <div class="spec-grid">
                {{-- LOGIKA 3 STATUS: READY, SALE, SOLD --}}
                <div class="spec-item">
                    <span class="spec-label">Inventory Status</span>
                    @php $status = strtolower($product->status); @endphp
                    @if($status === 'ready')
                        <span class="spec-value" style="color: #2ed573;"><i class="fa fa-check-circle"></i> READY STOCK</span>
                    @elseif($status === 'sale' || $status === 'on sale')
                        <span class="spec-value" style="color: #FFD200;"><i class="fa fa-bolt"></i> ON SALE</span>
                    @else
                        <span class="spec-value" style="color: #ff3e3e;"><i class="fa fa-times-circle"></i> SOLD OUT</span>
                    @endif
                </div>

                <div class="spec-item">
                    <span class="spec-label">Units Left</span>
                    <span class="spec-value">{{ $product->stok }} PCS</span>
                </div>
                <div class="spec-item">
                    <span class="spec-label">Reference ID</span>
                    <span class="spec-value">#SV-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="spec-item">
                    <span class="spec-label">Authentic</span>
                    <span class="spec-value">100% GENUINE</span>
                </div>
            </div>

            {{-- LOGIKA AUTO-FORMAT DESKRIPSI --}}
            <div class="description-text">
                @php
                    $descLines = explode("\n", e($product->deskripsi));
                @endphp
                @foreach($descLines as $line)
                    @if(trim($line) != '')
                        @if(str_starts_with(trim($line), '-') || str_starts_with(trim($line), '*'))
                            <div class="desc-bullet">
                                <span style="color: var(--orange);">•</span>
                                <span>{{ ltrim(trim($line), '-* ') }}</span>
                            </div>
                        @else
                            <span class="desc-line">{{ $line }}</span>
                        @endif
                    @endif
                @endforeach
            </div>

            <div class="action-stack">
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary-sv" {{ $product->stok <= 0 ? 'disabled' : '' }}>
                        <i class="lnr lnr-bag"></i>
                        <span>{{ $product->stok > 0 ? 'Add to Shopping Bag' : 'Out of Stock' }}</span>
                    </button>
                </form>

                <div class="social-actions" style="margin-top: 15px; display: flex; gap: 10px;">
                    @php
                        $shopeeUrl = "https://shopee.co.id/search?keyword=" . urlencode($product->nama_produk);
                        $waNumber = "6283140760412";
                        $waText = "🔥 *STREETVIBE ORDER FORM* 🔥\n\n📦 *ITEM:* " . strtoupper($product->nama_produk) . "\n💰 *PRICE:* IDR " . number_format($product->harga, 0, ',', '.') . "\n\nIs this still available?";
                        $waUrl = "https://wa.me/" . $waNumber . "?text=" . urlencode($waText);
                    @endphp

                    <a href="{{ $waUrl }}" target="_blank" class="btn-outline btn-wa-sv" style="flex: 1;">
                        <i class="fa fa-whatsapp"></i><span>WHATSAPP</span>
                    </a>

                    <a href="{{ $shopeeUrl }}" target="_blank" class="btn-outline btn-shopee-sv" style="flex: 1;">
                        <i class="fa fa-shopping-bag"></i><span>SHOPEE</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<footer style="padding: 80px 0; text-align: center; background: var(--grey-100); margin-top: 100px;">
    <div style="font-family: 'Bebas Neue', sans-serif; font-size: 30px; letter-spacing: 3px;">STREET<span>VIBE.</span></div>
    <p style="font-size: 13px; color: var(--grey-500); margin-top: 15px; letter-spacing: 2px;">&copy; 2026. THE CULTURE OF STREETWEAR ARCHIVE.</p>
</footer>

<script src="{{ asset('user/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script>
    /* ── CURSOR ── */
    const dot = document.getElementById('cDot');
    const ring = document.getElementById('cRing');
    let mX = 0, mY = 0, rX = 0, rY = 0;
    document.addEventListener('mousemove', e => {
        mX = e.clientX; mY = e.clientY;
        dot.style.left = `${mX}px`; dot.style.top = `${mY}px`;
    });
    function lerp() {
        rX += (mX - rX) * 0.15; rY += (mY - rY) * 0.15;
        ring.style.left = `${rX}px`; ring.style.top = `${rY}px`;
        requestAnimationFrame(lerp);
    }
    lerp();

    /* ── ZOOM ── */
    const panel = document.getElementById('imgPanel');
    const img = document.getElementById('mainImg');
    panel.addEventListener('mousemove', e => {
        const { left, top, width, height } = panel.getBoundingClientRect();
        const x = ((e.clientX - left) / width) * 100;
        const y = ((e.clientY - top) / height) * 100;
        img.style.transformOrigin = `${x}% ${y}%`;
        img.style.transform = 'scale(1.5)';
    });
    panel.addEventListener('mouseleave', () => img.style.transform = 'scale(1)');

    function toggleDarkMode() {
        document.body.classList.toggle('dark');
        localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
    }
    window.addEventListener('scroll', () => {
        document.getElementById('svNav').classList.toggle('scrolled', window.scrollY > 50);
    });
    if(localStorage.getItem('theme') === 'dark') document.body.classList.add('dark');
</script>

</body>
</html>
