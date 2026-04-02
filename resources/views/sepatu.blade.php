<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>StreetVibe - Koleksi Baju</title>
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">

    <style>
        body { background: #ffffff; font-family: 'Poppins', sans-serif; }
        .product-header { padding: 80px 0 40px; text-align: center; background: #fbfbfb; margin-bottom: 50px; }
        .product-header h2 { font-weight: 900; letter-spacing: 3px; text-transform: uppercase; color: #222; }

        .product-grid { padding-bottom: 100px; }
        .single-product-item {
            margin-bottom: 40px;
            transition: 0.4s;
            border: 1px solid #eee;
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
        }
        .single-product-item:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }

        .product-img-box {
            width: 100%;
            height: 380px;
            background: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .product-img-box img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s; }

        .product-info { padding: 20px; text-align: center; }
        .product-info h4 { font-size: 16px; font-weight: 700; color: #333; margin-bottom: 10px; height: 40px; overflow: hidden; }
        .product-info .price { color: #ff6c00; font-weight: 800; font-size: 18px; margin-bottom: 15px; }

        /* Tombol See Detail */
        .btn-see-detail {
            display: block;
            width: 100%;
            padding: 10px 0;
            background: #222;
            color: #fff !important;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            border-radius: 5px;
            transition: 0.3s;
            text-decoration: none !important;
        }
        .btn-see-detail:hover { background: #ff6c00; }

        .back-home {
            position: fixed; top: 30px; left: 30px; width: 45px; height: 45px;
            background: #222; color: #fff !important; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            z-index: 1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    <a href="{{ route('welcome') }}" class="back-home" title="Kembali ke Beranda"><i class="fa fa-arrow-left"></i></a>

    <div class="product-header">
        <div class="container">
            <h2>Shoes collection </h2>
            <p class="text-muted">Tampil maksimal dengan pilihan atasan streetwear terbaik.</p>
        </div>
    </div>

    <section class="product-grid">
        <div class="container">
            <div class="row">
                @forelse($products as $product)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="single-product-item">
                        <div class="product-img-box">
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}">
                        </div>
                        <div class="product-info">
                            <h4>{{ $product->nama_produk }}</h4>
                            <div class="price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                            <a href="{{ route('products.show', $product->id) }}" class="btn-see-detail">See Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Produk baju belum tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

</body>
</html>
