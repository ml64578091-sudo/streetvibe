@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="fw-semibold mb-0">Edit Produk: {{ $product->nama_produk }}</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="{{ $product->nama_produk }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Harga</label>
                        <input type="number" name="harga" class="form-control" value="{{ $product->harga }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Kategori Database</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- pilih kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Tipe Kategori (Slug)</label>
                        <select name="kategori" class="form-control" required>
                            <option value="baju" {{ $product->kategori == 'baju' ? 'selected' : '' }}>baju</option>
                            <option value="celana" {{ $product->kategori == 'celana' ? 'selected' : '' }}>celana</option>
                            <option value="sepatu" {{ $product->kategori == 'sepatu' ? 'selected' : '' }}>sepatu</option>
                             <option value="jacket" {{ $product->kategori == 'jacket' ? 'selected' : '' }}>jacket</option>
                        </select>
                        <small class="text-muted">Gunakan untuk filter menu Navbar</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Brand</label>
                        <select name="brand_id" class="form-control" required>
                            <option value="">-- pilih brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->nama_brand }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row align-items-end">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Gambar Produk</label>
                        <input type="file" name="gambar" class="form-control">
                        @if($product->gambar)
                            <div class="mt-2 p-2 border rounded d-inline-block bg-light">
                                <img src="{{ Storage::url($product->gambar) }}" width="80" alt="Current Image">
                                <small class="d-block text-muted text-center">Gambar Saat Ini</small>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Status Produk</label>
                        <select name="status" class="form-control">
                            <option value="ready" {{ $product->status == 'ready' ? 'selected' : '' }}>Ready Stock</option>
                            <option value="sold out" {{ $product->status == 'sold out' ? 'selected' : '' }}>Sold Out</option>
                            <option value="sale" {{ $product->status == 'sale' ? 'selected' : '' }}>Promo/Sale</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label font-weight-bold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="5" required>{{ $product->deskripsi }}</textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success px-4">Update Produk</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light border px-4">Batal</a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
