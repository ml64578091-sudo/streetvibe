<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - StreetVibe</title>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #0f0f0f;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .profile-card {
            background: #1a1a1a;
            padding: 30px;
            border-radius: 24px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            border: 1px solid #2a2a2a;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }

        /* Header Profile */
        .avatar-box {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #2a2a2a, #111);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #ff4757;
            border: 2px solid #2a2a2a;
        }

        h2 { font-size: 1.4rem; letter-spacing: -0.5px; margin-bottom: 4px; text-transform: capitalize; }
        .email { color: #666; font-size: 0.85rem; margin-bottom: 15px; }

        .badge {
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 25px;
        }
        .admin { background: rgba(255, 71, 87, 0.1); color: #ff4757; border: 1px solid rgba(255, 71, 87, 0.3); }
        .user { background: rgba(46, 213, 115, 0.1); color: #2ed573; border: 1px solid rgba(46, 213, 115, 0.3); }

        /* Menu List */
        .profile-menu {
            text-align: left;
            margin-bottom: 25px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            background: #222;
            margin-bottom: 10px;
            border-radius: 12px;
            text-decoration: none;
            color: #eee;
            font-size: 0.9rem;
            transition: 0.3s;
            border: 1px solid transparent;
        }

        .menu-item i {
            margin-right: 12px;
            font-size: 1.1rem;
            color: #ff4757;
        }

        .menu-item:hover {
            background: #2a2a2a;
            border-color: #333;
            transform: translateX(5px);
        }

        /* Footer Actions */
        .logout-form {
            margin-top: 10px;
        }

        .btn-logout {
            width: 100%;
            background: #ff4757;
            color: white;
            padding: 14px;
            border-radius: 12px;
            border: none;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #ff2e44;
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #555;
            text-decoration: none;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .back-link:hover { color: #888; }
    </style>
</head>
<body>

<div class="profile-card">
    <div class="avatar-box">
        <span class="lnr lnr-user"></span>
    </div>

    <h2>{{ Auth::user()->name }}</h2>
    <p class="email">{{ Auth::user()->email }}</p>

    @if(Auth::user()->role == 'admin')
        <span class="badge admin">ADMINISTRATOR</span>
    @else
        <span class="badge user">STREETVIBE MEMBER</span>
    @endif

    <div class="profile-menu">
        @if(Auth::user()->role == 'admin')
        <a href="{{ route('admin.products.index') }}" class="menu-item">
            <i class="lnr lnr-layers"></i> Admin Panel
        </a>
        @endif

        <a href="{{ route('cart.index') }}" class="menu-item">
            <i class="lnr lnr-cart"></i> Keranjang Belanja
        </a>
        <a href="{{ route('user.outfits.index') }}" class="menu-item">
            <i class="lnr lnr-picture"></i> Inspirasi Outfit
        </a>
        <a href="#" class="menu-item">
            <i class="lnr lnr-heart"></i> Wishlist
        </a>
        <a href="#" class="menu-item">
            <i class="lnr lnr-cog"></i> Pengaturan Akun
        </a>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="btn-logout">
            <span class="lnr lnr-exit"></span> KELUAR AKUN
        </button>
    </form>

    <a href="{{ url('/') }}" class="back-link">
        <span class="lnr lnr-arrow-left"></span> Kembali ke Beranda
    </a>
</div>

</body>
</html>
