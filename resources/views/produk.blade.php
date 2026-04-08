<!DOCTYPE html>
<html lang="id" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>StreetVibe — {{ $pageTitle ?? 'Koleksi Produk' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:       #0c0c0c;
            --surface:  #141414;
            --card:     #1a1a1a;
            --border:   rgba(255,255,255,0.07);
            --accent:   #ff5c1a;
            --accent2:  #ffb347;
            --text:     #f0ede8;
            --muted:    #787270;
            --font-display: 'Bebas Neue', sans-serif;
            --font-body:    'DM Sans', sans-serif;
            --radius:   18px;
            --transition: 0.45s cubic-bezier(0.22, 1, 0.36, 1);
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-body);
            font-size: 15px;
            overflow-x: hidden;
        }

        /* ── NOISE OVERLAY ── */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");
            opacity: 0.025;
            pointer-events: none;
            z-index: 9999;
        }

        /* ── BACK BUTTON ── */
        .btn-back {
            position: fixed; top: 28px; left: 28px;
            width: 46px; height: 46px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--text) !important;
            font-size: 14px;
            z-index: 1000;
            text-decoration: none !important;
            transition: var(--transition);
            backdrop-filter: blur(12px);
        }
        .btn-back:hover {
            background: var(--accent);
            border-color: var(--accent);
            transform: translateX(-3px);
        }

        /* ── HERO HEADER ── */
        .site-header {
            position: relative;
            min-height: 360px;
            display: flex;
            align-items: flex-end;
            padding: 0 0 60px;
            overflow: hidden;
        }

        .header-bg {
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 70% 60% at 60% 50%, rgba(255,92,26,0.18) 0%, transparent 70%),
                        radial-gradient(ellipse 40% 40% at 20% 80%, rgba(255,179,71,0.10) 0%, transparent 60%);
        }

        .header-line {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), var(--accent2), transparent);
        }

        .header-eyebrow {
            display: inline-flex; align-items: center; gap: 10px;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 18px;
        }
        .header-eyebrow span.dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--accent);
            display: inline-block;
            animation: pulse 2s ease infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.4; transform: scale(0.7); }
        }

        .header-title {
            font-family: var(--font-display);
            font-size: clamp(64px, 10vw, 130px);
            line-height: 0.9;
            letter-spacing: -1px;
            color: var(--text);
        }
        .header-title em {
            font-style: normal;
            -webkit-text-stroke: 1.5px var(--accent);
            color: transparent;
        }

        .header-sub {
            margin-top: 20px;
            color: var(--muted);
            font-size: 14px;
            font-weight: 300;
            max-width: 420px;
            line-height: 1.7;
        }

        .header-count {
            position: absolute;
            bottom: 60px; right: 40px;
            font-family: var(--font-display);
            font-size: 110px;
            color: rgba(255,255,255,0.03);
            line-height: 1;
            pointer-events: none;
            user-select: none;
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            padding: 0 0 50px;
        }
        .filter-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 18px 0;
        }
        .filter-label {
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
        }
        .filter-tags {
            display: flex;
            gap: 8px;
        }
        .filter-tag {
            padding: 6px 16px;
            border-radius: 100px;
            border: 1px solid var(--border);
            font-size: 12px;
            font-weight: 500;
            color: var(--muted);
            cursor: pointer;
            transition: 0.25s;
        }
        .filter-tag.active,
        .filter-tag:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        /* ── PRODUCT GRID ── */
        .product-section { padding-bottom: 120px; }

        .product-card {
            position: relative;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: var(--transition);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeUp 0.6s var(--transition) forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        .product-card:hover {
            border-color: rgba(255,92,26,0.35);
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,92,26,0.15);
        }

        /* staggered animation delays */
        .product-card:nth-child(1)  { animation-delay: 0.05s; }
        .product-card:nth-child(2)  { animation-delay: 0.10s; }
        .product-card:nth-child(3)  { animation-delay: 0.15s; }
        .product-card:nth-child(4)  { animation-delay: 0.20s; }
        .product-card:nth-child(5)  { animation-delay: 0.25s; }
        .product-card:nth-child(6)  { animation-delay: 0.30s; }
        .product-card:nth-child(7)  { animation-delay: 0.35s; }
        .product-card:nth-child(8)  { animation-delay: 0.40s; }

        /* IMAGE */
        .product-img-wrap {
            position: relative;
            width: 100%;
            padding-top: 120%; /* tall portrait ratio */
            background: #111;
            overflow: hidden;
        }
        .product-img-wrap img {
            position: absolute; inset: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .product-card:hover .product-img-wrap img {
            transform: scale(1.07);
        }

        /* badge */
        .product-badge {
            position: absolute;
            top: 14px; left: 14px;
            background: var(--accent);
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 5px 10px;
            border-radius: 100px;
        }

        /* overlay CTA */
        .product-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, transparent 55%);
            display: flex;
            align-items: flex-end;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .product-card:hover .product-overlay { opacity: 1; }

        .overlay-btn {
            width: 100%;
            padding: 12px;
            background: var(--accent);
            color: #fff !important;
            text-align: center;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-radius: 10px;
            text-decoration: none !important;
            transition: background 0.25s;
            display: block;
        }
        .overlay-btn:hover { background: var(--accent2); color: #000 !important; }

        /* INFO */
        .product-info {
            padding: 18px 20px 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 12px;
        }
        .product-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--text);
            line-height: 1.4;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .product-price {
            font-family: var(--font-display);
            font-size: 22px;
            color: var(--accent);
            white-space: nowrap;
            letter-spacing: 0.5px;
        }

        /* detail link below card (mobile fallback) */
        .product-detail-link {
            display: block;
            text-align: center;
            padding: 12px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted) !important;
            border-top: 1px solid var(--border);
            text-decoration: none !important;
            transition: 0.25s;
        }
        .product-detail-link:hover { color: var(--accent) !important; background: rgba(255,92,26,0.05); }

        /* ── EMPTY STATE ── */
        .empty-state {
            padding: 100px 20px;
            text-align: center;
        }
        .empty-icon {
            font-size: 64px;
            color: var(--border);
            margin-bottom: 20px;
        }
        .empty-state h4 {
            font-family: var(--font-display);
            font-size: 32px;
            color: var(--muted);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* ── FOOTER STRIP ── */
        .footer-strip {
            border-top: 1px solid var(--border);
            padding: 30px 0;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            letter-spacing: 1px;
        }
        .footer-strip span { color: var(--accent); }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 4px; }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .header-title { font-size: 60px; }
            .header-count { display: none; }
            .filter-tags { display: none; }
        }
        @media (max-width: 576px) {
            .product-detail-link { display: block; }
            .product-overlay { display: none; }
        }
    </style>
</head>
<body>

    {{-- Back button --}}
    <a href="{{ route('welcome') }}" class="btn-back" title="Kembali ke Beranda">
        <i class="fa fa-arrow-left"></i>
    </a>

    {{-- ── HEADER ── --}}
    <header class="site-header">
        <div class="header-line"></div>
        <div class="header-bg"></div>
        <div class="header-count">{{ $products->count() ?? '' }}</div>

        <div class="container position-relative">
            <div class="header-eyebrow">
                <span class="dot"></span>
                StreetVibe Collection
            </div>
            <h1 class="header-title">
                {{ strtoupper(explode(' ', $pageTitle ?? 'Koleksi')[0]) }}<br>
                <em>{{ strtoupper(implode(' ', array_slice(explode(' ', $pageTitle ?? 'Produk Kami'), 1))) ?: 'Produk' }}</em>
            </h1>
            <p class="header-sub">{{ $pageSubtitle ?? 'Tampil maksimal dengan pilihan streetwear terbaik kami.' }}</p>
        </div>
    </header>

    {{-- ── FILTER BAR ── --}}
    <section class="filter-bar">
        <div class="container">
            <div class="filter-inner">
                <div class="filter-label">
                    {{ $products->count() }} item{{ $products->count() != 1 ? 's' : '' }} ditemukan
                </div>
                <div class="filter-tags">
                    <div class="filter-tag active" data-sort="default">Semua</div>
                    <div class="filter-tag" data-sort="price-asc">Harga ↑</div>
                    <div class="filter-tag" data-sort="price-desc">Harga ↓</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── PRODUCT GRID ── --}}
    <section class="product-section">
        <div class="container">
            <div class="row g-4">
                @forelse($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 col-6 product-col"
                     data-id="{{ $product->id }}"
                     data-price="{{ $product->harga }}"
                     data-name="{{ $product->nama_produk }}"
                     data-sold="{{ $product->terjual ?? 0 }}">
                    <article class="product-card">

                        <div class="product-img-wrap">
                            <img src="{{ Storage::url($product->gambar) }}"
                                 alt="{{ $product->nama_produk }}"
                                 loading="lazy">
                            <div class="product-badge">New</div>
                            <div class="product-overlay">
    <a href="{{ route('products.show', $product->id) }}" class="overlay-btn">
        Lihat Detail &rarr;
    </a>
</div>
                        </div>

                        <div class="product-info">
                            <p class="product-name">{{ $product->nama_produk }}</p>
                            <div class="product-price">
                                Rp&nbsp;{{ number_format($product->harga, 0, ',', '.') }}
                            </div>
                        </div>

                        <a href="{{ route('products.show', $product->id) }}" class="product-detail-link">
                            Lihat Detail &rarr;
                        </a>

                    </article>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fa fa-inbox"></i></div>
                        <h4>Belum Ada Produk</h4>
                        <p class="mt-3" style="color:var(--muted);font-size:14px;">
                            Koleksi {{ strtolower($pageTitle ?? 'ini') }} belum tersedia. Nantikan update terbaru!
                        </p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ── SEARCH BAR ── --}}
    <div style="max-width:420px;margin:0 auto 50px;padding:0 20px;">
        <div style="position:relative;">
            <i class="fa fa-search" style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:var(--muted);font-size:13px;pointer-events:none;"></i>
            <input id="product-search"
                   type="text"
                   placeholder="Cari produk..."
                   autocomplete="off"
                   style="
                       width:100%; padding:12px 16px 12px 42px;
                       background:var(--card); border:1px solid var(--border);
                       border-radius:100px; color:var(--text);
                       font-family:var(--font-body); font-size:13px;
                       outline:none; transition:border-color 0.25s;
                   "
                   onfocus="this.style.borderColor='var(--accent)'"
                   onblur="this.style.borderColor='var(--border)'">
        </div>
    </div>

    {{-- ── FOOTER ── --}}
    <footer class="footer-strip">
        &copy; {{ date('Y') }} <span>StreetVibe</span> &mdash; Semua hak dilindungi.
    </footer>

    <script>
    (function () {
        const grid        = document.querySelector('.row.g-4');
        const filterTags  = document.querySelectorAll('.filter-tag[data-sort]');
        const filterLabel = document.querySelector('.filter-label');

        /* collect original order once */
        const allCols     = Array.from(document.querySelectorAll('.product-col'));
        const originalOrder = [...allCols];

        const num = (el, attr) => parseFloat(el.dataset[attr]) || 0;

        const sorters = {
            'default'    : ()   => [...originalOrder],
            'newest'     : cols => [...cols].sort((a,b) => num(b,'id')    - num(a,'id')),
            'popular'    : cols => [...cols].sort((a,b) => num(b,'sold')  - num(a,'sold')),
            'price-asc'  : cols => [...cols].sort((a,b) => num(a,'price') - num(b,'price')),
            'price-desc' : cols => [...cols].sort((a,b) => num(b,'price') - num(a,'price')),
        };

        let searchQuery   = '';
        let activeSortKey = 'default';

        function render() {
            /* 1. sort */
            let result = sorters[activeSortKey](allCols);

            /* 2. search filter */
            if (searchQuery) {
                result = result.filter(col =>
                    col.dataset.name.toLowerCase().includes(searchQuery)
                );
            }

            /* 3. fade out */
            allCols.forEach(c => {
                c.style.transition = 'opacity 0.18s ease, transform 0.18s ease';
                c.style.opacity    = '0';
                c.style.transform  = 'translateY(10px)';
            });

            setTimeout(() => {
                /* reorder in DOM */
                result.forEach(col => grid.appendChild(col));

                /* hide cols not in result */
                allCols.forEach(col => {
                    col.style.display = result.includes(col) ? '' : 'none';
                });

                /* staggered fade in */
                result.forEach((col, i) => {
                    col.style.transition = `opacity 0.38s ease ${i * 0.04}s, transform 0.38s ease ${i * 0.04}s`;
                    col.style.opacity    = '1';
                    col.style.transform  = 'translateY(0)';
                });

                /* update item count label */
                const count = result.length;
                filterLabel.textContent = count + ' item' + (count !== 1 ? 's' : '') + ' ditemukan';
            }, 200);
        }

        /* filter tag clicks */
        filterTags.forEach(tag => {
            tag.addEventListener('click', () => {
                filterTags.forEach(t => t.classList.remove('active'));
                tag.classList.add('active');
                activeSortKey = tag.dataset.sort;
                render();
            });
        });

        /* search input */
        const searchInput = document.getElementById('product-search');
        if (searchInput) {
            searchInput.addEventListener('input', e => {
                searchQuery = e.target.value.trim().toLowerCase();
                render();
            });
        }
    })();
    </script>

</body>
</html>
