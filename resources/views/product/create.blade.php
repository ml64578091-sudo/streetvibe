@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="card p-4 shadow-sm">
        <h4 class="mb-4">Tambah Produk Baru</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Vans Authentic Red Chili" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Harga (Rupiah)</label>
                    <input type="number" name="harga" class="form-control" placeholder="Contoh: 800000" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold">Kategori Database</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Pilih Relasi --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold">Tipe Kategori (Slug)</label>
                    <select name="kategori" class="form-control" required>
                        <option value="baju">baju</option>
                        <option value="celana">celana</option>
                        <option value="sepatu">sepatu</option>
                        <option value="jacket">jacket</option>
                    </select>
                    <small class="text-muted">Harus huruf kecil semua (untuk filter navbar)</small>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold">Brand</label>
                    <select name="brand_id" class="form-control" required>
                        <option value="">-- Pilih Brand --</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->nama_brand }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Foto Produk</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Status Stok/Promo</label>
                    <select name="status" class="form-control">
                        <option value="ready">Ready Stock (Tersedia)</option>
                        <option value="sold out">Sold Out (Habis)</option>
                        <option value="sale">Sale (Sedang Promo)</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label font-weight-bold">Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" rows="5" placeholder="Tuliskan detail ukuran, bahan, dan kondisi produk..." required></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success px-5">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>
@endsection
