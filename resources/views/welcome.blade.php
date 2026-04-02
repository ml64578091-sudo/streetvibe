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

        /* Banner Full Screen */
        .banner-area { height: 100vh; background: #ffffff; display: flex; align-items: center; position: relative; }
        .banner-content h1 { font-size: clamp(50px, 8vw, 90px); font-weight: 900; line-height: 0.9; letter-spacing: -3px; margin-bottom: 25px; color: #111; }
        .banner-content p { font-size: 18px; color: #666; max-width: 450px; }

        /* Tombol Modern */
        .primary-btn-custom { padding: 15px 40px; border-radius: 50px; background: #000; color: #fff !important; font-weight: 700; transition: 0.4s; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); border: none; cursor: pointer; }
        .primary-btn-custom:hover { background: #ff6c00; transform: translateY(-5px); }

        /* Section Foto Lebar */
        .aesthetic-section { padding: 80px 0; background: #fff; }
        .wide-image-container { position: relative; border-radius: 30px; overflow: hidden; height: 550px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .wide-image-container img { width: 100%; height: 100%; object-fit: cover; transition: 0.8s ease; }
        .overlay-text { position: absolute; bottom: 40px; left: 40px; color: #fff; z-index: 2; }
        .overlay-text h2 { font-size: 45px; font-weight: 800; font-family: 'Playfair Display', serif; font-style: italic; }

        /* Category Card — 4 kolom */
        .category-card {
            border: none;
            border-radius: 20px;
            transition: 0.4s;
            background: #fbfbfb;
            padding: 50px 20px;
            text-align: center;
            display: block;
            text-decoration: none !important;
        }
        .category-card:hover { background: #000; transform: translateY(-10px); }
        .category-card:hover h4,
        .category-card:hover .lnr,
        .category-card:hover .fa { color: #fff !important; }
        .category-card h4 { font-weight: 800; color: #222; margin-top: 16px; font-size: 15px; letter-spacing: 1px; }

        /* --- MASONRY GRID --- */
        .masonry-wrapper { padding: 80px 0; background: #fafafa; }
        .masonry-columns { column-count: 3; column-gap: 20px; }
        @media (max-width: 991px) { .masonry-columns { column-count: 2; } }
        @media (max-width: 575px) { .masonry-columns { column-count: 1; } }

        .masonry-item { display: inline-block; width: 100%; margin-bottom: 20px; border-radius: 15px; overflow: hidden; position: relative; transition: 0.3s; }
        .masonry-item img { width: 100%; display: block; filter: grayscale(20%); transition: 0.5s; }
        .masonry-item:hover img { filter: grayscale(0%); transform: scale(1.05); }
        .masonry-label { position: absolute; top: 15px; left: 15px; background: rgba(0,0,0,0.7); color: #fff; padding: 5px 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; border-radius: 5px; }

        /* Vibe Gallery Grid */
        .vibe-grid-4-col {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            padding: 0 20px;
            width: 100%;
        }
        .vibe-card-small {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            border-radius: 15px;
            background: #f8f8f8;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .vibe-card-small img { width: 100%; height: 100%; object-fit: cover; display: block; transition: 0.5s ease; }
        .vibe-card-small:hover img { transform: scale(1.1); }
        @media (max-width: 768px) {
            .vibe-grid-4-col { grid-template-columns: repeat(2, 1fr); gap: 10px; padding: 0 10px; }
        }

        .btn-outfit-float { position: fixed; bottom: 30px; right: 30px; background: #ff6c00; color: #fff !important; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; z-index: 9999; box-shadow: 0 10px 20px rgba(255,108,0,0.3); }
    </style>
</head>

<body>

    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <a class="navbar-brand logo_h" href="{{ url('/') }}">
                        <h3 style="font-weight: 900; letter-spacing: -1px;">STREET<span style="color:#ff6c00">VIBE.</span></h3>
                    </a>
                </div>
            </nav>
        </div>
    </header>

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

    {{-- ===================== 4 KATEGORI ===================== --}}
    <section id="products-section" class="section_gap_bottom">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 style="font-weight: 900; font-size: 40px; letter-spacing: -1px;">THE ESSENTIALS</h2>
                    <p class="text-muted">Pilih kategori favoritmu dan temukan koleksi terbaik.</p>
                </div>
            </div>
            <div class="row justify-content-center">

                {{-- Jacket --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ url('/products?kategori=jacket') }}" class="category-card">
                        <span class="fa fa-archive" style="font-size: 55px; color: #ff6c00;"></span>
                        <h4>JACKET</h4>
                    </a>
                </div>

                {{-- Baju / Upperwear --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ url('/products?kategori=baju') }}" class="category-card">
                        <span class="lnr lnr-shirt" style="font-size: 55px; color: #ff6c00;"></span>
                        <h4>UPPERWEAR</h4>
                    </a>
                </div>

                {{-- Celana / Bottomwear --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ url('/products?kategori=celana') }}" class="category-card">
                        <span class="lnr lnr-layers" style="font-size: 55px; color: #ff6c00;"></span>
                        <h4>BOTTOMWEAR</h4>
                    </a>
                </div>

                {{-- Sepatu / Footwear --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ url('/products?kategori=sepatu') }}" class="category-card">
                        <span class="lnr lnr-map" style="font-size: 55px; color: #ff6c00;"></span>
                        <h4>FOOTWEAR</h4>
                    </a>
                </div>

            </div>
        </div>
    </section>

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

    <section style="padding: 100px 0;">
    <div class="container text-center mb-5">
        <h6 style="letter-spacing: 5px; color: #ff6c00; font-weight: 800;"><a href="https://www.instagram.com/jeoujo_/" target="_blank">@jeoujo_</a></h6>
        <h2 style="font-weight: 900;">FOLLOW THE Own</h2>
    </div>
    <div style="padding: 40px 0; background: #fff;">
        <div class="vibe-grid-4-col">

        </div>
    </div>
</section>

    <a href="{{ route('user.outfits.index') }}" class="btn-outfit-float">
        <span class="lnr lnr-shirt"></span>
    </a>

    <script src="{{ asset('user/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script>
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
