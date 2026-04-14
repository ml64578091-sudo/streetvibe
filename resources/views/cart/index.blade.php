<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreetVibe — Your Selected Style</title>

    <!-- Modern Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">

    {{-- SweetAlert2 untuk konfirmasi hapus --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ========== COLOR & THEME ========== */
        :root {
            --primary: #ff6c00;
            --secondary: #1a1a1a;
            --accent: #00d4ff;
            --shopee: #ee4d2d;
            --bg-light: #f9f9f9;
            --border: #e8e8e8;
            --text-primary: #0a0a0a;
            --text-secondary: #666666;
            --success: #10b981;
            --danger: #ef4444;
        }

        /* ========== TYPOGRAPHY ========== */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
            color: var(--text-primary);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        /* ========== NAVBAR ========== */
        .navbar-cart {
            padding: 20px 0;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 100;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.03);
        }

        .navbar-cart .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 18px;
            letter-spacing: -1px;
            text-decoration: none !important;
            color: var(--text-primary) !important;
            transition: 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--primary) !important;
            transform: scale(1.02);
        }

        .navbar-brand span {
            color: var(--primary);
            background: linear-gradient(135deg, var(--primary), var(--shopee));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .continue-shopping {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary) !important;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .continue-shopping:hover {
            color: var(--primary) !important;
            transform: translateX(-5px);
        }

        /* ========== MAIN CONTENT ========== */
        .cart-container {
            padding: 80px 0 60px;
            min-height: 80vh;
        }

        .section-title {
            font-size: 48px;
            font-weight: 800;
            letter-spacing: -2px;
            margin-bottom: 15px;
            line-height: 1.1;
            background: linear-gradient(135deg, var(--text-primary) 0%, var(--text-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            font-size: 15px;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 40px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        /* ========== CART ITEMS ========== */
        .cart-item-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.6s ease-out forwards;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cart-item-card:nth-child(1) { animation-delay: 0.1s; }
        .cart-item-card:nth-child(2) { animation-delay: 0.2s; }
        .cart-item-card:nth-child(3) { animation-delay: 0.3s; }
        .cart-item-card:nth-child(4) { animation-delay: 0.4s; }

        .cart-item-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            opacity: 0;
            transition: opacity 0.35s ease;
            pointer-events: none;
            z-index: -1;
        }

        .cart-item-card:hover {
            border-color: var(--primary);
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(255, 108, 0, 0.12);
        }

        .cart-item-card:hover::before {
            opacity: 0.05;
        }

        .prod-image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            background: var(--bg-light);
            aspect-ratio: 3/4;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .prod-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .cart-item-card:hover .prod-thumb {
            transform: scale(1.08);
        }

        .prod-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--primary);
            color: white;
            padding: 8px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 12px rgba(255, 108, 0, 0.25);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .prod-name {
            font-weight: 700;
            font-size: 18px;
            letter-spacing: -0.3px;
            margin-bottom: 8px;
            text-transform: uppercase;
            color: var(--text-primary);
            font-family: 'Space Grotesk', sans-serif;
        }

        .prod-price {
            color: var(--primary);
            font-weight: 800;
            font-size: 24px;
            margin-bottom: 12px;
            font-family: 'Space Grotesk', sans-serif;
        }

        .badge-quantity {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary), var(--shopee));
            color: white;
            padding: 10px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(255, 108, 0, 0.2);
        }

        /* ========== QUANTITY & DELETE ========== */
        .quantity-control-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .remove-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: var(--text-secondary);
            font-weight: 700;
        }

        .remove-box {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-light);
            border-radius: 12px;
            padding: 6px;
            border: 2px solid var(--border);
            transition: all 0.3s ease;
        }

        .remove-box:hover {
            border-color: var(--danger);
            background: rgba(239, 68, 68, 0.05);
        }

        .input-qty-remove {
            width: 50px;
            border: none;
            background: transparent;
            text-align: center;
            font-weight: 700;
            font-size: 15px;
            outline: none;
            color: var(--text-primary);
        }

        .btn-delete {
            background: transparent;
            color: var(--text-secondary);
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 10px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-delete:hover {
            background: var(--danger);
            color: white;
            transform: scale(1.1);
        }

        /* ========== SHOPEE BUTTON ========== */
        .btn-shopee {
            background: linear-gradient(135deg, var(--shopee), #ff6b35);
            color: white !important;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            text-decoration: none !important;
            box-shadow: 0 8px 20px rgba(238, 77, 45, 0.25);
            font-family: 'Space Grotesk', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .btn-shopee::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.4s ease;
        }

        .btn-shopee:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(238, 77, 45, 0.35);
        }

        .btn-shopee:hover::before {
            left: 100%;
        }

        /* ========== EMPTY STATE ========== */
        .empty-bag {
            text-align: center;
            padding: 120px 40px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .empty-bag i {
            font-size: 100px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 30px;
            display: block;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .empty-bag h2 {
            font-size: 42px;
            margin-bottom: 15px;
            letter-spacing: -1px;
        }

        .empty-bag p {
            font-size: 16px;
            color: var(--text-secondary);
            margin-bottom: 30px;
        }

        .btn-discover {
            background: linear-gradient(135deg, var(--primary), var(--shopee));
            color: white !important;
            border: none;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            text-decoration: none !important;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(255, 108, 0, 0.25);
            font-family: 'Space Grotesk', sans-serif;
        }

        .btn-discover:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(255, 108, 0, 0.35);
        }

        /* ========== FOOTER ========== */
        footer {
            background: rgba(10, 10, 10, 0.02);
            border-top: 1px solid var(--border);
            padding: 60px 0;
            margin-top: 80px;
        }

        footer p {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* ========== NUMBER INPUT STYLING ========== */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .section-title {
                font-size: 36px;
            }

            .cart-item-card {
                padding: 20px;
            }

            .prod-price {
                font-size: 20px;
            }

            .btn-shopee {
                width: 100%;
                justify-content: center;
                margin-top: 15px;
            }

            .quantity-control-section {
                width: 100%;
            }

            .empty-bag {
                padding: 80px 20px;
            }

            .empty-bag i {
                font-size: 70px;
            }

            .empty-bag h2 {
                font-size: 32px;
            }
        }

        /* ========== SWEETALERT CUSTOMIZATION ========== */
        .swal2-popup {
            border-radius: 20px !important;
            font-family: 'Outfit', sans-serif !important;
        }

        .swal2-title {
            font-family: 'Space Grotesk', sans-serif !important;
            font-weight: 700 !important;
        }
    </style>
</head>
<body>

    <nav class="navbar-cart">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand">
                STREET<span>VIBE.</span>
            </a>
            <a href="{{ url('/') }}" class="continue-shopping">
                <i class="lnr lnr-arrow-left"></i> CONTINUE SHOPPING
            </a>
        </div>
    </nav>

    <div class="cart-container">
        <div class="container">
            @if(session('cart') && count(session('cart')) > 0)
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title">YOUR SELECTIONS</h2>
                        <p class="section-subtitle">Atur jumlah yang ingin dihapus atau lanjut ke checkout Shopee.</p>

                        @foreach(session('cart') as $id => $item)
                        <div class="cart-item-card">
                            <div class="row align-items-stretch">
                                <div class="col-12 col-md-3 mb-4 mb-md-0">
                                    <div class="prod-image-wrapper">
                                        <img src="{{ Storage::url($item['gambar']) }}" class="prod-thumb" alt="{{ $item['nama_produk'] }}">
                                        <div class="prod-badge">In Bag</div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="prod-name">{{ $item['nama_produk'] }}</div>
                                        <div class="prod-price">Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                                    </div>
                                    <div class="badge-quantity">
                                        Total: {{ $item['quantity'] }} pcs
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 d-flex flex-column justify-content-between">
                                    <div class="quantity-control-section">
                                        <div class="remove-label">Remove Items</div>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="remove-box">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="1" min="1" max="{{ $item['quantity'] }}" class="input-qty-remove">
                                            <button type="submit" class="btn-delete" title="Confirm Remove">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </form>
                                    </div>

                                    @php
                                        $shopeeSearchUrl = "https://shopee.co.id/search?keyword=" . urlencode($item['nama_produk']);
                                        $finalLink = $item['link_shopee'] ?? $shopeeSearchUrl;
                                    @endphp

                                    <a href="{{ $finalLink }}" target="_blank" class="btn-shopee">
                                        <i class="fa fa-shopping-bag"></i> CHECKOUT
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            @else
                <div class="empty-bag">
                    <i class="lnr lnr-cart"></i>
                    <h2>Your bag is empty</h2>
                    <p>Sepertinya kamu belum memilih item apapun.</p>
                    <a href="{{ url('/') }}" class="btn-discover">Discover Products</a>
                </div>
            @endif
        </div>
    </div>

    <footer class="text-center">
        <p>&copy; 2026 STREETVIBE — Official Merchandise Store.</p>
    </footer>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Updated!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000,
            borderRadius: '20px',
            background: '#f9f9f9',
            backdrop: `rgba(0,0,0,0.3)`
        });
    </script>
    @endif

</body>
</html>
