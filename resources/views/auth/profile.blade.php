<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile — StreetVibe</title>
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <style>
        body { background: #f4f4f4; font-family: 'Plus Jakarta Sans', sans-serif; padding-top: 50px; }
        .profile-container { max-width: 500px; margin: auto; }
        .main-card { background: #fff; border-radius: 30px; padding: 40px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); border: none; }
        .user-avatar { background: #000; color: #fff; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-size: 25px; }

        /* Shopee Style Stats Card */
        .stats-container { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 25px; }
        .stat-card { background: #fff; padding: 20px; border-radius: 20px; border: 1px solid #eee; text-align: center; text-decoration: none !important; transition: 0.3s; }
        .stat-card:hover { border-color: #ff6c00; transform: translateY(-5px); }
        .stat-card i, .stat-card span.lnr { font-size: 24px; color: #ff6c00; display: block; margin-bottom: 10px; }
        .stat-card .count { font-weight: 800; font-size: 18px; color: #111; }
        .stat-card .label { font-size: 12px; color: #888; font-weight: 600; text-transform: uppercase; }

        .btn-logout { background: #000; color: #fff; border: none; border-radius: 50px; padding: 12px; width: 100%; font-weight: 700; margin-top: 30px; transition: 0.3s; }
        .btn-logout:hover { background: #ff6c00; }
    </style>
</head>
<body>

<div class="container profile-container">
    <div class="main-card text-center">
        <div class="user-avatar">
            <span class="lnr lnr-user"></span>
        </div>
        <h4 style="font-weight: 900; letter-spacing: -1px;">{{ strtoupper($user->name) }}</h4>
        <p class="text-muted small">{{ $user->email }}</p>

        <div class="stats-container">
            {{-- Box Keranjang ala Shopee --}}
            <a href="{{ route('cart.index') }}" class="stat-card">
                <span class="lnr lnr-cart"></span>
                <div class="count">{{ $totalItemsInCart }}</div>
                <div class="label">Keranjang</div>
            </a>

            
        </div>

        {{-- Menu List Tambahan --}}
        <div class="text-left mt-4">
            <a href="{{ url('/') }}" class="d-flex justify-content-between align-items-center py-3 text-dark text-decoration-none border-bottom">
                <span><span class="lnr lnr-home mr-2"></span> Back to Store</span>
                <span class="lnr lnr-chevron-right"></span>
            </a>
            <a href="{{ route('user.outfits.index') }}" class="d-flex justify-content-between align-items-center py-3 text-dark text-decoration-none border-bottom">
                <span><span class="lnr lnr-picture mr-2"></span> My Outfit Inspiration</span>
                <span class="lnr lnr-chevron-right"></span>
            </a>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">LOGOUT</button>
        </form>
    </div>
</div>

</body>
</html>
