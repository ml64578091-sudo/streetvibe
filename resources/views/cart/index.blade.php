<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreetVibe — Your Selected Style</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">

    {{-- SweetAlert2 untuk konfirmasi hapus --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root { --primary: #ff6c00; --shopee: #ee4d2d; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #ffffff; color: #111; }
        .navbar-cart { padding: 20px 0; border-bottom: 1px solid #f2f2f2; position: sticky; top: 0; background: #fff; z-index: 100; }
        .cart-container { padding: 60px 0; min-height: 80vh; }
        .section-title { font-weight: 800; font-size: 32px; letter-spacing: -1.5px; margin-bottom: 10px; }

        /* Card Style */
        .cart-item-card {
            background: #fff; border-radius: 20px; border: 1px solid #eee;
            padding: 25px; margin-bottom: 20px; transition: 0.3s;
        }
        .cart-item-card:hover { border-color: var(--primary); box-shadow: 0 15px 40px rgba(0,0,0,0.05); }

        .prod-thumb { width: 90px; height: 120px; object-fit: cover; border-radius: 15px; }
        .prod-name { font-weight: 800; font-size: 17px; margin-bottom: 5px; text-transform: uppercase; color: #000; }
        .prod-price { color: var(--primary); font-weight: 700; font-size: 19px; }

        /* Quantity & Delete System */
        .remove-box { display: flex; align-items: center; background: #f8f9fa; border-radius: 12px; padding: 5px; border: 1px solid #eee; }
        .input-qty-remove {
            width: 50px; border: none; background: transparent; text-align: center;
            font-weight: 700; font-size: 14px; outline: none;
        }
        .btn-delete {
            background: #fff; color: #ff4d4d; border: none; width: 35px; height: 35px;
            border-radius: 10px; transition: 0.3s; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .btn-delete:hover { background: #ff4d4d; color: #fff; transform: scale(1.05); }

        /* Shopee Button */
        .btn-shopee {
            background-color: var(--shopee); color: white !important; border: none;
            padding: 14px 25px; border-radius: 15px; font-weight: 800; font-size: 13px;
            display: inline-flex; align-items: center; gap: 10px; transition: 0.3s; text-decoration: none !important;
        }
        .btn-shopee:hover { background-color: #ff5722; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(238, 77, 45, 0.2); }

        .empty-bag { text-align: center; padding: 100px 0; }
        .empty-bag i { font-size: 80px; color: #eee; margin-bottom: 20px; }

        /* Chrome, Safari, Edge, Opera - Remove arrows from number input */
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    </style>
</head>
<body>

    <nav class="navbar-cart">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" style="text-decoration:none; color:#111;">
                <h4 class="mb-0 fw-bold">STREET<span style="color:var(--primary)">VIBE.</span></h4>
            </a>
            <a href="{{ url('/') }}" class="text-muted small fw-bold text-decoration-none">
                <i class="lnr lnr-arrow-left"></i> CONTINUE SHOPPING
            </a>
        </div>
    </nav>

    <div class="cart-container">
        <div class="container">
            @if(session('cart') && count(session('cart')) > 0)
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h2 class="section-title">YOUR <span style="color:var(--primary)">SELECTIONS.</span></h2>
                        <p class="text-muted mb-5">Atur jumlah yang ingin dihapus atau lanjut ke checkout Shopee.</p>

                        @foreach(session('cart') as $id => $item)
                        <div class="cart-item-card shadow-sm">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-2">
                                    <img src="{{ asset('storage/' . $item['gambar']) }}" class="prod-thumb shadow-sm">
                                </div>

                                <div class="col-8 col-md-4">
                                    <div class="prod-name">{{ $item['nama_produk'] }}</div>
                                    <div class="prod-price">Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                                    <div class="badge bg-light text-dark mt-2 p-2 px-3 border rounded-pill">
                                        Total In Bag: <b>{{ $item['quantity'] }} pcs</b>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 mt-4 mt-md-0 d-flex flex-wrap align-items-center justify-content-md-end gap-3">

                                    <div class="d-flex flex-column align-items-md-end">
                                        <small class="text-muted mb-1 fw-bold" style="font-size: 10px; text-transform: uppercase;">Hapus Sejumlah:</small>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="remove-box">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="1" min="1" max="{{ $item['quantity'] }}" class="input-qty-remove">
                                            <button type="submit" class="btn-delete" title="Confirm Remove">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="vr d-none d-md-block mx-2" style="height: 40px; opacity: 0.1;"></div>

                                    @php
                                        $shopeeSearchUrl = "https://shopee.co.id/search?keyword=" . urlencode($item['nama_produk']);
                                        $finalLink = $item['link_shopee'] ?? $shopeeSearchUrl;
                                    @endphp

                                    <a href="{{ $finalLink }}" target="_blank" class="btn-shopee">
                                        <i class="fa fa-shopping-bag"></i> CHECKOUT VIA SHOPEE
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
                    <h2 class="fw-bold">Your bag is empty.</h2>
                    <p class="text-muted">Sepertinya kamu belum memilih item apapun.</p>
                    <a href="{{ url('/') }}" class="btn btn-dark rounded-pill px-5 py-3 fw-bold mt-4">DISCOVER PRODUCTS</a>
                </div>
            @endif
        </div>
    </div>

    <footer class="py-5 border-top text-center mt-5">
        <p class="small text-muted mb-0">&copy; 2026 STREETVIBE — Official Merchandise Store.</p>
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
            borderRadius: '20px'
        });
    </script>
    @endif

</body>
</html>
