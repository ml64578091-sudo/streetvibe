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

    <style>
        :root {
            --primary: #ff6c00;
            --dark-bg: #0a0a0a;
            --soft-gray: #f8f9fa;
            --glass: rgba(255, 255, 255, 0.8);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1a1a1a;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        /* --- DARK MODE --- */
        body.dark-mode { background-color: var(--dark-bg); color: #f0f0f0; }
        body.dark-mode .zoom-container { background: #151515; border-color: #222; }
        body.dark-mode .main_box { background: rgba(10, 10, 10, 0.9) !important; border-bottom: 1px solid #222; }
        body.dark-mode .related-card { background: #151515; }
        body.dark-mode .text-dark { color: #fff !important; }

        /* --- NAVIGATION --- */
        .main_box {
            border-bottom: 1px solid #eee;
            backdrop-filter: blur(10px);
            background: var(--glass) !important;
        }

        /* --- TOP ACTION BAR --- */
        .top-action-bar {
            position: fixed; top: 100px; right: 25px; display: flex; flex-direction: column; gap: 12px; z-index: 1001;
        }
        .action-btn {
            width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            background: #fff; color: #000 !important; box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none !important;
            border: none;
        }
        .action-btn:hover { transform: translateY(-5px); background: var(--primary); color: #fff !important; }

        /* --- PRODUCT DISPLAY --- */
        .zoom-container {
            border-radius: 24px; background: var(--soft-gray); overflow: hidden;
            height: 600px; display: flex; align-items: center; justify-content: center;
            border: 1px solid #f1f1f1; transition: 0.3s;
        }
        #product-zoom { width: 100%; height: 100%; object-fit: cover; cursor: crosshair; }

        .s_product_text h3 {
            font-weight: 800; font-size: 42px; letter-spacing: -1.5px; line-height: 1.1; margin-bottom: 15px;
        }
        .price-tag {
            font-size: 32px; font-weight: 400; color: var(--primary); font-family: 'Playfair Display', serif; font-italic: italic;
        }

        /* --- STATUS BADGE --- */
        .badge-premium {
            padding: 6px 16px; border-radius: 100px; font-size: 11px; font-weight: 800;
            text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 20px;
        }
        .bg-ready { background: #e6fcf5; color: #0ca678; }
        .bg-out { background: #fff5f5; color: #f03e3e; }
        .bg-sale { background: #e7f5ff; color: #1971c2; }

        /* --- INFO LIST --- */
        .info-list { list-style: none; padding: 0; margin: 30px 0; }
        .info-list li { padding: 12px 0; border-bottom: 1px solid #f1f1f1; display: flex; justify-content: space-between; font-size: 14px; }
        .info-list li span { font-weight: 600; color: #888; }
        .info-list li b { color: var(--primary); }

        /* --- BUTTONS --- */
        .btn-shopee {
            background: #000; color: #fff !important; padding: 18px 40px; border-radius: 100px;
            font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s;
            display: inline-flex; align-items: center; gap: 10px; border: none; flex-grow: 1; justify-content: center;
        }
        .btn-shopee:hover { background: var(--primary); transform: scale(1.02); box-shadow: 0 10px 20px rgba(255, 108, 0, 0.2); }

        .btn-wa {
            width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            border: 2px solid #eee; color: #25D366 !important; font-size: 24px; transition: 0.3s;
        }
        .btn-wa:hover { border-color: #25D366; background: #25D366; color: #fff !important; }

        /* --- RELATED PRODUCTS --- */
        .section-title { font-weight: 800; font-size: 30px; margin-bottom: 50px; text-align: left; }
        .related-card { border: none; border-radius: 20px; overflow: hidden; background: #fff; transition: 0.4s; }
        .related-card:hover { transform: translateY(-10px); }
        .rel-img { height: 350px; position: relative; overflow: hidden; }
        .rel-img img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .related-card:hover .rel-img img { transform: scale(1.1); }

        .rel-info { padding: 20px 0; }
        .rel-info h6 { font-weight: 700; font-size: 18px; margin-bottom: 5px; }
        .rel-price { font-family: 'Playfair Display', serif; color: var(--primary); font-size: 16px; }

    </style>
</head>

<body>
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <a class="navbar-brand logo_h" href="{{ route('welcome') }}">
                        <h4 style="font-weight: 900; letter-spacing: -1px;">STREET<span style="color:var(--primary)">VIBE.</span></h4>
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <div class="top-action-bar">
        <a href="javascript:history.back()" class="action-btn" title="Kembali Halaman Sebelumnya">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a href="{{ route('welcome') }}" class="action-btn" title="Ke Beranda"><i class="fa fa-th-large"></i></a>
        <div class="action-btn" onclick="toggleDarkMode()" style="cursor:pointer;"><i id="dark-icon" class="fa fa-moon-o"></i></div>
    </div>

    <div class="container" style="margin-top: 150px; margin-bottom: 100px;">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="zoom-container" id="zoom-box">
                    <img id="product-zoom" src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}">
                </div>
            </div>

            <div class="col-lg-5 pl-lg-5">
                <div class="s_product_text">
                    @php
                        $statusLabel = $product->status ?? 'Ready';
                        $colorClass = 'bg-ready';
                        if($statusLabel == 'Out of Stock') $colorClass = 'bg-out';
                        if($statusLabel == 'Sale') $colorClass = 'bg-sale';
                    @endphp
                    <span class="badge-premium {{ $colorClass }}">{{ $statusLabel }}</span>

                    <h3>{{ $product->nama_produk }}</h3>
                    <div class="price-tag">IDR {{ number_format($product->harga, 0, ',', '.') }}</div>

                    <ul class="info-list">
                        <li><span>Category</span> <b>{{ $product->category->nama_kategori ?? 'Uncategorized' }}</b></li>
                        <li><span>Item Stock</span> <b>{{ $product->stok }} Units</b></li>
                        <li><span>Availability</span> <b>Jakarta, ID</b></li>
                    </ul>

                    <p style="color: #666; line-height: 1.8; font-size: 15px; margin-bottom: 40px;">
                        {{ $product->deskripsi }}
                    </p>

                    <div class="d-flex align-items-center gap-3" style="gap: 15px;">
                        <a class="btn-shopee" href="https://shopee.co.id/search?keyword={{ urlencode($product->nama_produk) }}" target="_blank">
                            Get it on Shopee <i class="fa fa-external-link"></i>
                        </a>
                        <a href="https://wa.me/6283140760412?text=Hi StreetVibe, is {{ $product->nama_produk }} still available?" class="btn-wa">
                            <i class="fa fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 150px;">
            <h2 class="section-title">Complete Your <br><i style="font-family:'Playfair Display'; font-weight: 400;">Visual Aesthetic</i></h2>
            <div class="row">
                @forelse($relatedProducts as $related)
                <div class="col-lg-6 col-md-6 mb-5">
                    <div class="related-card">
                        <a href="{{ route('products.show', $related->id) }}" class="text-decoration-none">
                            <div class="rel-img">
                                <img src="{{ asset('storage/' . $related->gambar) }}">
                            </div>
                            <div class="rel-info">
                                <h6 class="text-dark">{{ $related->nama_produk }}</h6>
                                <div class="rel-price">IDR {{ number_format($related->harga, 0, ',', '.') }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-muted">Curating more vibes for you soon.</div>
                @endforelse
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

        // SMOOTH IMAGE ZOOM
        const box = document.getElementById('zoom-box');
        const img = document.getElementById('product-zoom');
        box.addEventListener('mousemove', (e) => {
            const x = e.clientX - box.offsetLeft;
            const y = e.clientY - box.offsetTop;
            img.style.transformOrigin = `${x}px ${y}px`;
            img.style.transform = "scale(1.5)";
        });
        box.addEventListener('mouseleave', () => { img.style.transform = "scale(1)"; });
    </script>
</body>
</html>
