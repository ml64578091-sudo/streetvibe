<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('user/img/fav.png') }}">
    <meta charset="UTF-8">
    <title>StreetVibe — Define Your Style</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&family=Playfair+Display:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; background-color: #fff; }

        /* Banner & Buttons */
        .banner-area { height: 100vh; background: #ffffff; display: flex; align-items: center; position: relative; }
        .banner-content h1 { font-size: clamp(50px, 8vw, 90px); font-weight: 900; line-height: 0.9; letter-spacing: -3px; margin-bottom: 25px; color: #111; }
        .banner-content p { font-size: 18px; color: #666; max-width: 450px; }
        .primary-btn-custom { padding: 15px 40px; border-radius: 50px; background: #000; color: #fff !important; font-weight: 700; transition: 0.4s; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); border: none; cursor: pointer; }
        .primary-btn-custom:hover { background: #ff6c00; transform: translateY(-5px); }

        /* Sections */
        .aesthetic-section { padding: 80px 0; background: #fff; }
        .wide-image-container { position: relative; border-radius: 30px; overflow: hidden; height: 550px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .wide-image-container img { width: 100%; height: 100%; object-fit: cover; transition: 0.8s ease; }
        .overlay-text { position: absolute; bottom: 40px; left: 40px; color: #fff; z-index: 2; }
        .overlay-text h2 { font-size: 45px; font-weight: 800; font-family: 'Playfair Display', serif; font-style: italic; }

        /* Category Card */
        .category-card { border: none; border-radius: 20px; transition: 0.4s; background: #fbfbfb; padding: 50px 20px; text-align: center; display: block; text-decoration: none !important; }
        .category-card:hover { background: #000; transform: translateY(-10px); }
        .category-card:hover h4, .category-card:hover .lnr, .category-card:hover .fa { color: #fff !important; }
        .category-card h4 { font-weight: 800; color: #222; margin-top: 16px; font-size: 15px; letter-spacing: 1px; }

        /* Masonry Grid */
        .masonry-wrapper { padding: 80px 0; background: #fafafa; }
        .masonry-columns { column-count: 3; column-gap: 20px; }
        @media (max-width: 991px) { .masonry-columns { column-count: 2; } }
        @media (max-width: 575px) { .masonry-columns { column-count: 1; } }
        .masonry-item { display: inline-block; width: 100%; margin-bottom: 20px; border-radius: 15px; overflow: hidden; position: relative; transition: 0.3s; }
        .masonry-item img { width: 100%; display: block; filter: grayscale(20%); transition: 0.5s; }
        .masonry-item:hover img { filter: grayscale(0%); transform: scale(1.05); }
        .masonry-label { position: absolute; top: 15px; left: 15px; background: rgba(0,0,0,0.7); color: #fff; padding: 5px 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; border-radius: 5px; }

        /* Vibe Gallery & Products */
        .vibe-grid-4-col { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; padding: 0 20px; width: 100%; }
        .vibe-card-small { position: relative; width: 100%; overflow: hidden; border-radius: 15px; background: #fff; }
        .vibe-card-small img { width: 100%; height: 100%; object-fit: cover; display: block; transition: 0.5s ease; }
        .vibe-card-small:hover img { transform: scale(1.05); }
        .gallery-overlay { position: absolute; bottom: 0; left: 0; width: 100%; padding: 20px; background: linear-gradient(transparent, rgba(0,0,0,0.8)); color: #fff; opacity: 0; transition: 0.3s; }
        .vibe-card-small:hover .gallery-overlay { opacity: 1; }
        @media (max-width: 768px) { .vibe-grid-4-col { grid-template-columns: repeat(2, 1fr); gap: 10px; padding: 0 10px; } }

        /* Cart & Floating elements */
        .btn-outfit-float { position: fixed; bottom: 30px; right: 30px; background: #ff6c00; color: #fff !important; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; z-index: 9999; box-shadow: 0 10px 20px rgba(255,108,0,0.3); transition: 0.3s; }
        .btn-outfit-float:hover { transform: scale(1.1) rotate(15deg); }

        .badge-cart { position: absolute; top: -8px; right: -12px; background: #ff6c00; color: white; border-radius: 50%; padding: 2px 6px; font-size: 11px; font-weight: bold; }
        .btn-add-cart { background:#000; color:#fff; border:none; border-radius:8px; padding: 8px 12px; transition: 0.3s; font-size: 14px; }
        .btn-add-cart:hover { background:#ff6c00; transform: translateY(-2px); }
    </style>
</head>

<body>

    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container d-flex justify-content-between align-items-center">
                    <a class="navbar-brand logo_h" href="{{ url('/') }}">
                        <h3 style="font-weight: 900; letter-spacing: -1px; margin:0;">STREET<span style="color:#ff6c00">VIBE.</span></h3>
                    </a>

                    {{-- Ikon Keranjang di Navbar --}}
                    <div>
                        <a href="{{ route('cart.index') }}" style="position: relative; color: #111; font-size: 22px;">
                            <span class="lnr lnr-cart"></span>
                            @php $cart = session('cart'); @endphp
                            @if($cart && count($cart) > 0)
                                <span class="badge-cart">{{ count($cart) }}</span>
                            @endif
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="container mt-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    <section class="banner-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content">
                        <h1>STREET<br>ARTISTRY.</h1>
                        <p>Lebih dari sekadar pakaian. Ini adalah pernyataan tentang siapa dirimu di tengah keramaian kota.</p>
                        <div class="mt-4">
                            <a class="primary-btn-custom" href="#products-section">Start Curating <span class="lnr lnr-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner-img">
                        <img class="img-fluid" src="{{ asset('img/convers.png') }}" alt="Hero Image" style="filter: drop-shadow(0 30px 50px rgba(0,0,0,0.2));">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="aesthetic-section">
        <div class="container">
            <div class="wide-image-container">
                <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?auto=format&fit=crop&w=1350&q=80" alt="Wide View">
                <div class="overlay-text">
                    <p style="letter-spacing: 3px; text-transform: uppercase; font-size: 12px; font-weight: 700;">Trend 2026</p>
                    <h2>"Style is a way to say who you are <br>without having to speak."</h2>
                </div>
                <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(transparent, rgba(0,0,0,0.6));"></div>
            </div>
        </div>
    </section>

    {{-- KATEGORI --}}
    <section id="products-section" class="section_gap_bottom" style="padding-top: 80px;">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 style="font-weight: 900; font-size: 40px; letter-spacing: -1px;">THE ESSENTIALS</h2>
                    <p class="text-muted">Pilih kategori favoritmu dan temukan koleksi terbaik.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 mb-4"><a href="{{ url('/products?kategori=jacket') }}" class="category-card"><span class="fa fa-archive" style="font-size: 55px; color: #ff6c00;"></span><h4>JACKET</h4></a></div>
                <div class="col-lg-3 col-md-6 mb-4"><a href="{{ url('/products?kategori=baju') }}" class="category-card"><span class="lnr lnr-shirt" style="font-size: 55px; color: #ff6c00;"></span><h4>UPPERWEAR</h4></a></div>
                <div class="col-lg-3 col-md-6 mb-4"><a href="{{ url('/products?kategori=celana') }}" class="category-card"><span class="lnr lnr-layers" style="font-size: 55px; color: #ff6c00;"></span><h4>BOTTOMWEAR</h4></a></div>
                <div class="col-lg-3 col-md-6 mb-4"><a href="{{ url('/products?kategori=sepatu') }}" class="category-card"><span class="lnr lnr-map" style="font-size: 55px; color: #ff6c00;"></span><h4>FOOTWEAR</h4></a></div>
            </div>
        </div>
    </section>

    {{-- PRODUK DARI DATABASE (DENGAN TOMBOL ADD TO CART) --}}
    <section class="section_gap_bottom" style="background: #fff;">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 style="font-weight: 900; font-size: 40px; letter-spacing: -1px;">LATEST DROPS</h2>
                    <p class="text-muted">Koleksi terbaru yang baru saja mendarat di katalog kami.</p>
                </div>
            </div>
            <div class="row">
                @forelse($products as $product)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="vibe-card-small">
                        {{-- Gambar Produk --}}
                        <a href="{{ route('products.show', $product->id) }}" style="display:block; aspect-ratio:3/4;">
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}">
                        </a>

                        {{-- Info & Action --}}
                        <div style="padding: 15px 0;">
                            <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none;">
                                <h6 style="font-weight: 800; color: #111; margin: 0; font-size: 14px;">{{ strtoupper($product->nama_produk) }}</h6>
                            </a>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p style="color: #ff6c00; font-weight: 700; margin: 0;">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>

                                {{-- Form Add To Cart --}}
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-add-cart" title="Add to Cart">
                                        <span class="lnr lnr-cart"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada produk yang tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- MASONRY (STATIS) --}}
    <section class="masonry-wrapper">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-left">
                    <h1 style="font-family: 'Playfair Display', serif; font-weight: 700; font-style: italic;">Street Lookbook</h1>
                    <p class="text-muted">Inspirasi gaya tak terbatas untuk harimu.</p>
                </div>
            </div>
            <div class="masonry-columns">
                <div class="masonry-item"><div class="masonry-label">Vibe 01</div><img src="{{ asset('img/2.jpeg') }}" alt="Vibe 1"></div>
                <div class="masonry-item"><div class="masonry-label">Vibe 02</div><img src="{{ asset('img/3.jpeg') }}" alt="Vibe 2"></div>
                <div class="masonry-item"><div class="masonry-label">Vibe 03</div><img src="{{ asset('img/4.jpeg') }}" alt="Vibe 3"></div>
                <div class="masonry-item"><div class="masonry-label">Vibe 04</div><img src="{{ asset('img/8.jpeg') }}" alt="Vibe 4"></div>
                <div class="masonry-item"><div class="masonry-label">Vibe 05</div><img src="{{ asset('img/6.jpeg') }}" alt="Vibe 5"></div>
                <div class="masonry-item"><div class="masonry-label">Vibe 06</div><img src="{{ asset('img/7.jpeg') }}" alt="Vibe 6"></div>
            </div>
        </div>
    </section>

    {{-- GALLERY DARI DATABASE --}}
    <section style="padding: 100px 0; background: #fff;">
        <div class="container text-center mb-5">
            <h6 style="letter-spacing: 5px; color: #ff6c00; font-weight: 800;">
                <a href="https://www.instagram.com/jeoujo_/" target="_blank" style="color: #ff6c00; text-decoration: none;">@jeoujo_</a>
            </h6>
            <h2 style="font-weight: 900;">FOLLOW THE OWN</h2>
        </div>
        <div class="vibe-grid-4-col">
            @foreach($galleryPhotos as $photo)
            <div class="vibe-card-small" style="aspect-ratio: 1/1;">
                <img src="{{ asset('storage/' . $photo->foto) }}" alt="Gallery Image">
                <div class="gallery-overlay">
                    <p style="font-size: 12px; margin: 0; font-weight: 600;">{{ $photo->caption }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <a href="{{ route('user.outfits.index') }}" class="btn-outfit-float">
        <span class="lnr lnr-shirt"></span>
    </a>

    <footer style="padding: 50px 0; background: #000; color: #fff; text-align: center;">
        <p style="font-size: 12px; opacity: 0.5;">&copy; 2026 STREETVIBE. ALL RIGHTS RESERVED.</p>
    </footer>

    <script src="{{ asset('user/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('user/js/vendor/bootstrap.min.js') }}"></script> <script>
        $(document).ready(function(){
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if( target.length ) {
                    event.preventDefault();
                    $('html, body').stop().animate({ scrollTop: target.offset().top - 80 }, 1000);
                }
            });
        });
    </script>
</body>
</html>
