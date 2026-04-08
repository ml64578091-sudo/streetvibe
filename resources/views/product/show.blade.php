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
        /* ─── RESET & VARIABLES ─── */
        :root {
            --black:  #0a0a0a;
            --white:  #ffffff;
            --orange: #ff5c00;
            --grey:   #8a8680;
            --light:  #f4f4f4;
            --border: rgba(0,0,0,0.1);
            --shopee: #ee4d2d;
            --wa:     #25d366;
            --transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        body.dark {
            --white:  #0d0d0d;
            --light:  #151515;
            --black:  #f5f5f5;
            --border: rgba(255,255,255,0.08);
        }

        * { cursor: none !important; } /* Custom Cursor Experience */

        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--black);
            overflow-x: hidden;
            transition: background 0.5s ease;
        }

        /* ─── CUSTOM CURSOR ─── */
        #cDot {
            width: 8px; height: 8px; background: var(--orange);
            border-radius: 50%; position: fixed; top: 0; left: 0;
            pointer-events: none; z-index: 10001; transform: translate(-50%, -50%);
        }
        #cRing {
            width: 40px; height: 40px; border: 1px solid var(--orange);
            border-radius: 50%; position: fixed; top: 0; left: 0;
            pointer-events: none; z-index: 10000; transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s, background 0.3s;
        }

        /* ─── NOISE OVERLAY ─── */
        .noise {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.05'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 9999; opacity: 0.4;
        }

        /* ─── NAVBAR ─── */
        .sv-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 25px 50px; display: flex; align-items: center; justify-content: space-between;
            background: transparent; transition: var(--transition);
        }
        .sv-nav.scrolled {
            padding: 15px 50px; background: var(--white);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(10px);
        }
        .sv-logo {
            font-family: 'Bebas Neue', sans-serif; font-size: 28px;
            letter-spacing: 2px; color: var(--black); text-decoration: none;
        }
        .sv-logo span { color: var(--orange); }

        .nav-right { display: flex; align-items: center; gap: 25px; }
        .btn-circle {
            width: 45px; height: 45px; border-radius: 50%; border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            background: var(--white); color: var(--black); transition: var(--transition);
            text-decoration: none; font-size: 18px;
        }
        .btn-circle:hover { background: var(--black); color: var(--white); border-color: var(--black); }

        /* ─── MARQUEE ─── */
        .sv-marquee {
            background: var(--black); color: var(--white);
            padding: 12px 0; font-family: 'Bebas Neue', sans-serif;
            font-size: 14px; letter-spacing: 3px; overflow: hidden;
            white-space: nowrap; margin-top: 90px;
        }
        .marquee-inner { display: inline-block; animation: marquee 25s linear infinite; }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

        /* ─── MAIN CONTENT ─── */
        .page-wrapper { padding: 60px 0 100px; }
        .product-grid {
            max-width: 1300px; margin: 0 auto; padding: 0 50px;
            display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 100px;
        }

        /* Left: Image */
        .img-container { position: sticky; top: 120px; }
        .product-img-panel {
            background: var(--light); position: relative;
            overflow: hidden; aspect-ratio: 4/5;
            box-shadow: 30px 30px 0px var(--light);
            transition: var(--transition);
        }
        .product-img-panel:hover { box-shadow: 15px 15px 0px var(--orange); }
        .product-img-panel img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .img-label {
            position: absolute; top: 20px; left: 20px;
            background: var(--black); color: var(--white);
            padding: 5px 15px; font-size: 10px; font-weight: 700; letter-spacing: 2px;
        }

        /* Right: Info */
        .product-eyebrow {
            color: var(--orange); font-size: 12px; font-weight: 700;
            letter-spacing: 5px; text-transform: uppercase; margin-bottom: 15px;
        }
        .product-name {
            font-family: 'Bebas Neue', sans-serif; font-size: clamp(50px, 6vw, 85px);
            line-height: 0.85; margin-bottom: 20px; text-transform: uppercase;
        }
        .product-price {
            font-family: 'Playfair Display', serif; font-size: 42px;
            font-style: italic; color: var(--orange); margin-bottom: 40px;
        }

        .info-list { border-top: 1px solid var(--border); margin-bottom: 40px; }
        .info-item {
            display: flex; justify-content: space-between; padding: 15px 0;
            border-bottom: 1px solid var(--border); font-size: 14px;
        }
        .info-item .label { color: var(--grey); text-transform: uppercase; letter-spacing: 1px; }
        .info-item .value { font-weight: 700; }

        /* ─── ACTIONS ─── */
        .action-stack { display: flex; flex-direction: column; gap: 15px; }
        .btn-main {
            width: 100%; height: 65px; display: flex; align-items: center; justify-content: center;
            gap: 15px; text-decoration: none; font-weight: 700; letter-spacing: 2px;
            text-transform: uppercase; font-size: 14px; transition: var(--transition);
            border: none; position: relative; z-index: 1; overflow: hidden;
        }
        .btn-bag { background: var(--black); color: var(--white); }
        .btn-bag::after {
            content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: var(--orange); z-index: -1; transition: var(--transition);
        }
        .btn-bag:hover::after { left: 0; }

        .btn-social-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .btn-shopee { background: var(--shopee); color: white !important; }
        .btn-wa { border: 1px solid var(--wa); color: var(--wa) !important; background: transparent; }
        .btn-wa:hover { background: var(--wa); color: white !important; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 991px) {
            .product-grid { grid-template-columns: 1fr; gap: 50px; padding: 0 25px; }
            .sv-nav { padding: 20px 25px; }
            .product-img-panel { box-shadow: 15px 15px 0px var(--light); }
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
        <a href="javascript:history.back()" class="btn-circle" title="Kembali">
            <i class="fa fa-arrow-left"></i>
        </a>
        <button class="btn-circle" onclick="toggleDarkMode()" id="themeToggle">
            <i class="fa fa-moon-o" id="themeIcon"></i>
        </button>
        <a href="{{ route('cart.index') }}" class="btn-circle" style="position: relative;">
            <i class="lnr lnr-cart"></i>
            @php $count = session('cart') ? count(session('cart')) : 0; @endphp
            @if($count > 0)
                <span style="position:absolute; top:-5px; right:-5px; background:var(--orange); color:white; font-size:10px; width:18px; height:18px; border-radius:50%; display:flex; align-items:center; justify-content:center;">{{ $count }}</span>
            @endif
        </a>
    </div>
</nav>

<div class="sv-marquee">
    <div class="marquee-inner">
        NEW DROP — STREETVIBE EXCLUSIVE — LIMITED QUANTITY — FREE SHIPPING OVER IDR 1.000.000 — NEW DROP — STREETVIBE EXCLUSIVE — LIMITED QUANTITY — FREE SHIPPING OVER IDR 1.000.000 —
    </div>
</div>

<div class="page-wrapper">
    <div class="product-grid">

        <div class="img-container">
            <div class="product-img-panel" id="imgPanel">
                <span class="img-label">{{ $product->category->nama_kategori ?? 'COLLECTION' }}</span>
                <img id="mainImg" src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama_produk }}">
            </div>
        </div>

        <div class="info-container">
            <div class="product-eyebrow">Essentials Drop Vol. 1</div>
            <h1 class="product-name">{{ $product->nama_produk }}</h1>

            <div class="product-price">
                IDR {{ number_format($product->harga, 0, ',', '.') }}
            </div>

            <div class="info-list">
                <div class="info-item">
                    <span class="label">Status</span>
                    <span class="value" style="color: {{ $product->stok > 0 ? 'var(--wa)' : 'red' }}">
                        {{ $product->stok > 0 ? 'READY STOCK' : 'OUT OF STOCK' }}
                    </span>
                </div>
                <div class="info-item">
                    <span class="label">Stock Available</span>
                    <span class="value">{{ $product->stok }} Units</span>
                </div>
                <div class="info-item">
                    <span class="label">SKU Number</span>
                    <span class="value">SV-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>

            <div style="margin-bottom: 40px;">
                <p style="font-size: 15px; line-height: 1.8; color: var(--grey);">
                    {!! nl2br(e($product->deskripsi)) !!}
                </p>
            </div>

            <div class="action-stack">
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-main btn-bag" {{ $product->stok <= 0 ? 'disabled' : '' }}>
                        <i class="lnr lnr-bag"></i>
                        {{ $product->stok > 0 ? 'Add to Bag' : 'Sold Out' }}
                    </button>
                </form>

                <div class="btn-social-grid">
                    <a href="https://shopee.co.id" target="_blank" class="btn-main btn-shopee">
                        <i class="fa fa-shopping-bag"></i> Shopee
                    </a>
                    <a href="https://wa.me/62812345678" target="_blank" class="btn-main btn-wa">
                        <i class="fa fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer style="padding: 60px 0; text-align: center; border-top: 1px solid var(--border);">
    <div style="font-family: 'Bebas Neue', sans-serif; font-size: 24px; letter-spacing: 2px;">
        STREET<span style="color: var(--orange);">VIBE.</span>
    </div>
    <p style="font-size: 12px; color: var(--grey); margin-top: 10px;">&copy; 2026. AUTHENTIC STREETWEAR CULTURE.</p>
</footer>

<script src="{{ asset('user/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script>
    /* ── CUSTOM CURSOR LOGIC ── */
    const dot = document.getElementById('cDot');
    const ring = document.getElementById('cRing');
    let mX = 0, mY = 0, rX = 0, rY = 0;

    document.addEventListener('mousemove', e => {
        mX = e.clientX;
        mY = e.clientY;
        dot.style.left = `${mX}px`;
        dot.style.top = `${mY}px`;
    });

    function lerpCursor() {
        rX += (mX - rX) * 0.15;
        rY += (mY - rY) * 0.15;
        ring.style.left = `${rX}px`;
        ring.style.top = `${rY}px`;
        requestAnimationFrame(lerpCursor);
    }
    lerpCursor();

    document.querySelectorAll('a, button, .product-img-panel').forEach(el => {
        el.addEventListener('mouseenter', () => {
            ring.style.width = '70px'; ring.style.height = '70px';
            ring.style.background = 'rgba(255, 92, 0, 0.1)';
        });
        el.addEventListener('mouseleave', () => {
            ring.style.width = '40px'; ring.style.height = '40px';
            ring.style.background = 'transparent';
        });
    });

    /* ── IMAGE ZOOM ── */
    const panel = document.getElementById('imgPanel');
    const img = document.getElementById('mainImg');
    panel.addEventListener('mousemove', e => {
        const { left, top, width, height } = panel.getBoundingClientRect();
        const x = ((e.clientX - left) / width) * 100;
        const y = ((e.clientY - top) / height) * 100;
        img.style.transformOrigin = `${x}% ${y}%`;
        img.style.transform = 'scale(1.8)';
    });
    panel.addEventListener('mouseleave', () => img.style.transform = 'scale(1)');

    /* ── DARK MODE ── */
    function toggleDarkMode() {
        document.body.classList.toggle('dark');
        const isDark = document.body.classList.contains('dark');
        document.getElementById('themeIcon').className = isDark ? 'fa fa-sun-o' : 'fa fa-moon-o';
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }

    /* ── SCROLL NAVBAR ── */
    window.addEventListener('scroll', () => {
        document.getElementById('svNav').classList.toggle('scrolled', window.scrollY > 50);
    });

    // Inisialisasi Tema Saat Load
    if(localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
        document.getElementById('themeIcon').className = 'fa fa-sun-o';
    }
</script>

</body>
</html>
