@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    {{-- Page Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0">Manajemen Kategori</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size: 12px;">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Kategori</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm px-3 d-flex align-items-center gap-2">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                {{-- Card Header --}}
                <div class="card-header bg-white py-3 border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-2 bg-success bg-opacity-10 p-2">
                            <i class="ti ti-plus text-success" style="font-size: 18px;"></i>
                        </div>
                        <h6 class="fw-bold mb-0">Tambah Kategori Baru</h6>
                    </div>
                </div>

                <div class="card-body p-4 pt-0">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        {{-- Input Group --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted mb-2" style="font-size: 13px;">NAMA KATEGORI</label>
                            <input type="text"
                                   name="nama_kategori"
                                   class="form-control form-control-lg @error('nama_kategori') is-invalid @enderror"
                                   placeholder="Contoh: Sepatu, Pakaian, Aksesoris..."
                                   required
                                   style="font-size: 15px; border-radius: 8px; background-color: #fcfcfc;">

                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="form-text mt-2" style="font-size: 11px; color: #a0a0a0;">
                                <i class="ti ti-info-circle"></i> Gunakan nama yang singkat dan jelas untuk filter produk.
                            </div>
                        </div>

                        <hr class="border-light my-4">

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-light px-4 fw-medium" style="font-size: 14px;">Reset</button>
                            <button type="submit" class="btn btn-primary px-4 fw-bold" style="font-size: 14px; border-radius: 8px;">
                                <i class="ti ti-device-floppy me-1"></i> Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Info Box (Optional tapi bikin keren) --}}
        <div class="col-lg-4">
            <div class="card border-0 bg-primary bg-opacity-10 shadow-none" style="border-radius: 12px; border: 1px dashed #0d6efd !important;">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-primary mb-3">Panduan Singkat</h6>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-3" style="font-size: 13px;">
                        <li class="d-flex gap-2">
                            <i class="ti ti-check text-primary"></i>
                            <span>Nama kategori akan muncul di menu navigasi utama.</span>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="ti ti-check text-primary"></i>
                            <span>Pastikan tidak ada duplikasi nama kategori.</span>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="ti ti-check text-primary"></i>
                            <span>Kategori yang aktif akan langsung terlihat oleh customer.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling agar input terlihat lebih modern saat fokus */
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        background-color: #fff !important;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: "•";
        color: #ccc;
    }
</style>
@endsection
