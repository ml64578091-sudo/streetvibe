@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0">Tambah Produk Baru</h5>
                <small class="text-muted">Isi semua informasi produk dengan lengkap</small>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-light d-flex align-items-center gap-2 border">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Error --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start gap-2 mb-4" role="alert">
            <i class="ti ti-alert-circle fs-5 mt-1"></i>
            <div>
                <div class="fw-semibold mb-1">Terdapat kesalahan input:</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li style="font-size:13px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">

            {{-- Kolom Kiri --}}
            <div class="col-lg-8">

                {{-- Info Dasar --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                            <div class="d-flex align-items-center justify-content-center rounded-2 bg-primary bg-opacity-10"
                                 style="width:32px;height:32px;flex-shrink:0;">
                                <i class="ti ti-info-circle text-primary" style="font-size:16px;"></i>
                            </div>
                            <span class="fw-bold" style="font-size:14px;">Informasi Dasar</span>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-semibold" style="font-size:13px;">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                                       class="form-control @error('nama_produk') is-invalid @enderror"
                                       placeholder="Contoh: Vans Authentic Red Chili">
                                @error('nama_produk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold" style="font-size:13px;">Harga (Rp) <span class="text-danger">*</span></label>
                                <input type="number" name="harga" value="{{ old('harga') }}"
                                       class="form-control @error('harga') is-invalid @enderror"
                                       placeholder="Contoh: 800000">
                                @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-semibold" style="font-size:13px;">Deskripsi Produk <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" rows="5"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Tuliskan detail ukuran, bahan, dan kondisi produk...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- Klasifikasi --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                            <div class="d-flex align-items-center justify-content-center rounded-2 bg-success bg-opacity-10"
                                 style="width:32px;height:32px;flex-shrink:0;">
                                <i class="ti ti-tags text-success" style="font-size:16px;"></i>
                            </div>
                            <span class="fw-bold" style="font-size:14px;">Klasifikasi Produk</span>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold" style="font-size:13px;">Kategori <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold" style="font-size:13px;">
                                    Tipe Slug
                                    <span class="text-danger">*</span>
                                    <i class="ti ti-help-circle text-muted ms-1" style="font-size:12px;"
                                       title="Digunakan untuk filter navbar"></i>
                                </label>
                                <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                                    @foreach(['baju','celana','sepatu','jacket'] as $slug)
                                        <option value="{{ $slug }}" {{ old('kategori') == $slug ? 'selected' : '' }}>
                                            {{ ucfirst($slug) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-muted mt-1" style="font-size:11px;">Untuk filter navbar (huruf kecil)</div>
                                @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold" style="font-size:13px;">Brand <span class="text-danger">*</span></label>
                                <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror">
                                    <option value="">-- Pilih Brand --</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->nama_brand }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan --}}
            <div class="col-lg-4">

                {{-- Upload Gambar --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                            <div class="d-flex align-items-center justify-content-center rounded-2 bg-info bg-opacity-10"
                                 style="width:32px;height:32px;flex-shrink:0;">
                                <i class="ti ti-photo text-info" style="font-size:16px;"></i>
                            </div>
                            <span class="fw-bold" style="font-size:14px;">Foto Produk</span>
                        </div>

                        {{-- Preview --}}
                        <div id="imagePreviewWrap" class="d-none mb-3">
                            <img id="imagePreview" src="#" alt="Preview"
                                 class="rounded-3 w-100" style="height:200px; object-fit:cover;">
                        </div>

                        <div id="imageDropzone"
                             class="border rounded-3 d-flex flex-column align-items-center justify-content-center text-center p-4"
                             style="border-style:dashed !important; border-color:#dee2e6; cursor:pointer; min-height:160px; background:#f8f9fa;"
                             onclick="document.getElementById('gambarInput').click()">
                            <i class="ti ti-cloud-upload fs-1 text-muted mb-2"></i>
                            <div class="fw-semibold" style="font-size:13px;">Klik untuk upload foto</div>
                            <div class="text-muted" style="font-size:11px;">PNG, JPG, WEBP maks. 2MB</div>
                        </div>

                        <input type="file" name="gambar" id="gambarInput"
                               class="d-none @error('gambar') is-invalid @enderror"
                               accept="image/*" onchange="previewImage(event)">
                        @error('gambar')<div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                            <div class="d-flex align-items-center justify-content-center rounded-2 bg-warning bg-opacity-10"
                                 style="width:32px;height:32px;flex-shrink:0;">
                                <i class="ti ti-toggle-right text-warning" style="font-size:16px;"></i>
                            </div>
                            <span class="fw-bold" style="font-size:14px;">Status Produk</span>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            @foreach([
                                ['value' => 'ready',    'label' => 'Ready Stock',  'desc' => 'Produk tersedia',     'color' => '#EAF3DE', 'text' => '#3B6D11'],
                                ['value' => 'sold out', 'label' => 'Sold Out',     'desc' => 'Stok habis',          'color' => '#FCEBEB', 'text' => '#791F1F'],
                                ['value' => 'sale',     'label' => 'Sale',         'desc' => 'Sedang promo',        'color' => '#FAEEDA', 'text' => '#633806'],
                            ] as $s)
                            <label class="d-flex align-items-center gap-3 p-3 rounded-3 border"
                                   style="cursor:pointer; transition: background .1s;"
                                   onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background=''">
                                <input type="radio" name="status" value="{{ $s['value'] }}"
                                       {{ old('status', 'ready') == $s['value'] ? 'checked' : '' }}
                                       style="accent-color:#0d6efd;">
                                <div class="flex-fill">
                                    <div class="fw-semibold" style="font-size:13px;">{{ $s['label'] }}</div>
                                    <div class="text-muted" style="font-size:11px;">{{ $s['desc'] }}</div>
                                </div>
                                <span class="badge rounded-pill"
                                      style="background:{{ $s['color'] }}; color:{{ $s['text'] }}; font-size:11px; padding:4px 10px;">
                                    {{ $s['label'] }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary py-2 fw-semibold">
                        <i class="ti ti-device-floppy me-1"></i> Simpan Produk
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light border fw-semibold">
                        Batal
                    </a>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('imagePreviewWrap').classList.remove('d-none');
            document.getElementById('imageDropzone').classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }
</script>
@endsection
