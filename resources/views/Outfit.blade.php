<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('user/img/fav.png') }}">
    <meta charset="UTF-8">
    <title>streetvibe - Outfit Reference</title>

    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">

    <style>
        .outfit-section { padding: 100px 0; background: #f9f9f9; }

        /* Style untuk Card Outfit */
        .single-outfit {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: 0.4s;
            margin-bottom: 30px;
            border: 1px solid #eee;
        }

        .single-outfit:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .outfit-img-container {
            width: 100%;
            height: 400px; /* Tinggi seragam untuk kesan katalog */
            overflow: hidden;
            position: relative;
        }

        .outfit-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .single-outfit:hover img {
            transform: scale(1.05);
        }

        .outfit-content {
            padding: 20px;
            text-align: center;
        }

        .outfit-content h4 {
            font-size: 18px;
            font-weight: 700;
            color: #222;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .outfit-content p {
            font-size: 14px;
            color: #777;
            line-height: 1.6;
        }

        .outfit-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #ff6c00;
            color: #fff;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            z-index: 2;
        }

        /* Banner Style Custom */
        .outfit-banner {
            background: url("{{ asset('user/img/banner/common-banner.jpg') }}") no-repeat center;
            background-size: cover;
            padding: 80px 0;
        }

        /* TOMBOL KEMBALI KE HOME (FLOATING) */
        .home-btn {
            position: fixed;
            bottom: 30px;
            left: 30px;
            width: 60px;
            height: 60px;
            background-color: #222; /* Hitam elegan */
            border: none;
            border-radius: 50%;
            color: white !important;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            z-index: 999;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        .home-btn:hover {
            background-color: #ff6c00; /* Berubah jadi orange brand saat hover */
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(255, 108, 0, 0.4);
        }
    </style>
</head>

<body>

    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <a class="navbar-brand logo_h" href="{{ route('welcome') }}">
                        <img src="{{ asset('user/img/logo.png') }}" alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/baju') }}">Baju</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/celana') }}">Celana</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/sepatu') }}">Sepatu</a></li>
                            <li class="nav-item active"><a class="nav-link" href="{{ route('user.outfits.index') }}">Outfit</a></li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Account</a>
                                <div class="dropdown-menu">
                                    @auth
                                        <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                    @endauth
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Outfit Reference</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('welcome') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Outfit Gallery</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="outfit-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <div class="section-title">
                        <h1>Inspirasi Gayamu</h1>
                        <p>Temukan kombinasi pakaian terbaik dari koleksi pilihan kami untuk meningkatkan kepercayaan dirimu.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($outfits as $outfit)
                <div class="col-lg-4 col-md-6">
                    <div class="single-outfit">
                        <div class="outfit-img-container">
                            <span class="outfit-badge">Streetwear</span>
                            <img src="{{ asset('storage/' . $outfit->gambar) }}" alt="{{ $outfit->judul }}">
                        </div>
                        <div class="outfit-content">
                            <h4>{{ $outfit->judul }}</h4>
                            <p>{{ $outfit->deskripsi }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada referensi outfit yang tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="footer-area section_gap">
        <div class="container text-center">
            <p>&copy; 2026 StreetVibe Store. All rights reserved.</p>
        </div>
    </footer>

    <a href="{{ route('welcome') }}" class="home-btn" title="Kembali ke Beranda">
        <i class="fa fa-home"></i>
    </a>

    <script src="{{ asset('user/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('user/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('user/js/main.js') }}"></script>
</body>

</html>
