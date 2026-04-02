<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>StreetVibe — {{ $product->nama_produk }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&family=Playfair+Display:ital,wght@1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #ff6c00;
            --dark-bg: #0a0a0a;
            --soft-gray: #f8f9fa;
            --glass: rgba(255, 255, 255, 0.8);
            --shopee: #ee4d2d;
        }

        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #1a1a1a; background-color: #fff; transition: all 0.3s ease; }

        /* --- DARK MODE --- */
        body.dark-mode { background-color: var(--dark-bg); color: #f0f0f0; }
        body.dark-mode .main_box { background: rgba(10, 10, 10, 0.9) !important; border-bottom: 1px solid #222; }
        body.dark-mode .navbar-light .navbar-nav .nav-link { color: #fff; }
        body.dark-mode .zoom-container { background: #151515; border-color: #222; }
        body.dark-mode .description-text { color: #bbb; }
        body.dark-mode .info-list li { border-color: #222; }

        /* --- NAVIGATION --- */
        .main_box { border-bottom: 1px solid #eee; backdrop-filter: blur(10px); background: var(--glass) !important; height: 80px; display: flex; align-items: center; }

        /* Nav Cart Icon & Badge */
        .nav-cart-btn { position: relative; font-size: 20px; color: #000; transition: 0.3s; }
        .nav-cart-badge {
            position: absolute; top: -8px; right: -10px; background: var(--primary); color: #fff;
            font-size: 10px; font-weight: 800; padding: 2px 6px; border-radius: 50%; border: 2px solid #fff;
        }
        body.dark-mode .nav-cart-btn { color: #fff; }
        body.dark-mode .nav-cart-badge { border-color: var(--dark-bg); }

        /* --- TOP ACTION BAR --- */
        .top-action-bar { position: fixed; top: 120px; right: 25px; display: flex; flex-direction: column; gap: 12px; z-index: 1001; }
        .action-btn {
            width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            background: #fff; color: #000 !important; box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); border: none;
        }
        .action-btn:hover { transform: translateY(-5px); background: var(--primary); color: #fff !important; }

        /* --- PRODUCT DISPLAY --- */
        .zoom-container { border-radius: 24px; background: var(--soft-gray); overflow: hidden; height: 600px; display: flex; align-items: center; justify-content: center; border: 1px solid #f1f1f1; transition: 0.3s; }
        #product-zoom { width: 100%; height: 100%; object-fit: cover; cursor: crosshair; }
        .s_product_text h3 { font-weight: 800; font-size: 42px; letter-spacing: -1.5px; line-height: 1.1; margin-bottom: 15px; }
        .price-tag { font-size: 32px; font-weight: 400; color: var(--primary); font-family: 'Playfair Display', serif; font-style: italic; }

        /* --- BUTTONS --- */
        .purchase-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 35px; }
        .btn-cart { background: #000; color: #fff !important; padding: 18px; border-radius: 15px; font-weight: 700; border: none; transition: 0.3s; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-cart:hover:not(:disabled) { background: #333; transform: translateY(-3px); }
        .btn-shopee { background: var(--shopee); color: #fff !important; padding: 18px; border-radius: 15px; font-weight: 700; border: none; transition: 0.3s; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-shopee:hover { background: #ff5722; transform: translateY(-3px); }
        .btn-wa-full { grid-column: span 2; background: transparent; color: #25D366 !important; border: 2px solid #eee; padding: 14px; border-radius: 15px; font-weight: 700; text-align: center; text-decoration: none !important; transition: 0.3s; font-size: 13px; }
        .btn-wa-full:hover { background: #25D366; color: #fff !important; border-color: #25D366; }
    </style>
</head>

<body>
    {{-- Update Navbar dengan Tombol Keranjang --}}
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <a class="navbar-brand logo_h" href="{{ route('welcome') }}">
                        <h4 style="font-weight: 900; letter-spacing: -1px; margin-bottom:0;">STREET<span style="color:var(--primary)">VIBE.</span></h4>
                    </a>

                    {{-- Navigasi Kanan (Keranjang) --}}
                    <div class="ml-auto d-flex align-items-center">
                        <a href="{{ route('cart.index') }}" class="nav-cart-btn">
                            <i class="lnr lnr-cart"></i>
                            @php $cartCount = session('cart') ? count(session('cart')) : 0; @endphp
                            @if($cartCount > 0)
                                <span class="nav-cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    {{-- Action Bar (Tetap ada sebagai akses cepat) --}}
    <div class="top-action-bar">
        <a href="javascript:history.back()" class="action-btn" title="Back"><i class="fa fa-chevron-left"></i></a>
        <div class="action-btn" onclick="toggleDarkMode()" style="cursor:pointer;"><i id="dark-icon" class="fa fa-moon-o"></i></div>
    </div>

    <div class="container" style="margin-top: 150px; margin-bottom: 100px;">
        <div class="row">
            <div class="col-lg-7">
                <div class="zoom-container" id="zoom-box">
                    <img id="product-zoom" src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}">
                </div>
            </div>

            <div class="col-lg-5 pl-lg-5">
                <div class="s_product_text">
                    <span class="badge-premium bg-ready" style="padding: 6px 16px; border-radius: 100px; font-size: 11px; font-weight: 800; background: #e6fcf5; color: #0ca678;">{{ $product->status ?? 'Ready Stock' }}</span>
                    <h3>{{ $product->nama_produk }}</h3>
                    <div class="price-tag">IDR {{ number_format($product->harga, 0, ',', '.') }}</div>

                    <ul class="info-list" style="list-style: none; padding: 0; margin: 25px 0;">
                        <li style="padding: 12px 0; border-bottom: 1px solid #f1f1f1; display: flex; justify-content: space-between; font-size: 14px;"><span>Category</span> <b>{{ $product->category->nama_kategori ?? 'Vibe Essentials' }}</b></li>
                        <li style="padding: 12px 0; border-bottom: 1px solid #f1f1f1; display: flex; justify-content: space-between; font-size: 14px;"><span>Availability</span> <b>{{ $product->stok > 0 ? 'In Stock' : 'Sold Out' }}</b></li>
                    </ul>

                    <div class="description-container mt-4">
                        <h6 class="fw-bold mb-2 small text-uppercase" style="color: var(--primary);">Story & Details</h6>
                        <div class="description-text" style="color: #666; line-height: 1.8; font-size: 15px; white-space: pre-line;">{!! nl2br(e($product->deskripsi)) !!}</div>
                    </div>

                    <div class="purchase-actions">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" id="addToBagForm">
                            @csrf
                            <button type="submit" class="btn-cart w-100" id="btnSubmitBag">
                                <i class="lnr lnr-bag" id="bagIcon"></i>
                                <span id="btnBagText">Add to Bag</span>
                            </button>
                        </form>

                        <a class="btn-shopee" href="https://shopee.co.id/search?keyword={{ urlencode($product->nama_produk) }}" target="_blank">
                            <i class="fa fa-shopping-bag"></i> Shopee
                        </a>

                        <a href="https://wa.me/6283140760412?text=Hi StreetVibe, is {{ $product->nama_produk }} still available?" class="btn-wa-full">
                            <i class="fa fa-whatsapp"></i> Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('user/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script>
        // DARK MODE
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            document.getElementById('dark-icon').classList.replace('fa-moon-o', 'fa-sun-o');
        }
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            const icon = document.getElementById('dark-icon');
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                icon.classList.replace('fa-moon-o', 'fa-sun-o');
            } else {
                localStorage.setItem('theme', 'light');
                icon.classList.replace('fa-sun-o', 'fa-moon-o');
            }
        }

        // ZOOM EFFECT
        const box = document.getElementById('zoom-box');
        const img = document.getElementById('product-zoom');
        box.addEventListener('mousemove', (e) => {
            const x = e.clientX - box.offsetLeft;
            const y = e.clientY - box.offsetTop;
            img.style.transformOrigin = `${x}px ${y}px`;
            img.style.transform = "scale(1.5)";
        });
        box.addEventListener('mouseleave', () => { img.style.transform = "scale(1)"; });

        // LOADING BUTTON
        document.getElementById('addToBagForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmitBag');
            const text = document.getElementById('btnBagText');
            const icon = document.getElementById('bagIcon');
            btn.disabled = true;
            text.innerHTML = "Adding Vibe...";
            icon.className = "fa fa-spinner fa-spin";
        });

        // SWEETALERT
        @if(session('success'))
            const isDark = document.body.classList.contains('dark-mode');
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: isDark ? '#151515' : '#fff',
                color: isDark ? '#fff' : '#000'
            });
            Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
        @endif
    </script>
</body>
</html>
