@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    {{-- Header Section --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0">Tambah Referensi Outfit</h5>
                <small class="text-muted">Buat inspirasi gaya baru untuk galeri outfit</small>
            </div>
            <a href="{{ route('admin.outfit.index') }}" class="btn btn-light d-flex align-items-center gap-2 border">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Error Handling --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start gap-2 mb-4" role="alert">
            <i class="ti ti-alert-circle fs-5 mt-1"></i>
            <div>
                <div class="fw-semibold mb-1">Wah, ada yang kurang nih:</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li style="font-size:13px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.outfit.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            {{-- Kolom Kiri: Detail Konten --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4 pb-2 border-bottom">
                            <div class="d-flex align-items-center justify-content-center rounded-2 bg-primary bg-opacity-10"
                                 style="width:32px;height:32px;">
                                <i class="ti ti-pencil text-primary" style="font-size:16px;"></i>
                            </div>
                            <span class="fw-bold" style="font-size:14px;">Detail Outfit</span>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="font-size:13px;">Judul Look <span class="text-danger">*</span></label>
                            <input type="text" name="judul" value="{{ old('judul') }}"
                                   class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                   placeholder="Misal: Casual Streetwear Style" required>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold" style="font-size:13px;">Deskripsi / Tips Padu Padan</label>
                            <textarea name="deskripsi" rows="8"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Tuliskan detail pakaian yang digunakan, perpaduan warna, atau tips lainnya...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Media & Action --}}
            <div class="col-lg-4">
                {{-- Card Upload --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                            <div class="d-flex align-items-center justify-content-center rounded-2 bg-info bg-opacity-10"
                                 style="width:32px;height:32px;">
                                <i class="ti ti-camera text-info" style="font-size:16px;"></i>
                            </div>
                            <span class="fw-bold" style="font-size:14px;">Foto Outfit</span>
                        </div>

                        {{-- Preview Area --}}
                        <div id="previewWrap" class="d-none mb-3">
                            <img id="imagePreview" src="#" alt="Preview"
                                 class="rounded-3 w-100" style="max-height:400px; object-fit:cover;">
                            <button type="button" class="btn btn-sm btn-danger w-100 mt-2" onclick="resetUpload()">
                                <i class="ti ti-trash"></i> Ganti Foto
                            </button>
                        </div>

                        <div id="dropzone"
                             class="border rounded-3 d-flex flex-column align-items-center justify-content-center text-center p-4"
                             style="border-style:dashed !important; border-color:#dee2e6; cursor:pointer; min-height:250px; background:#f8f9fa;"
                             onclick="document.getElementById('fileInput').click()">
                            <i class="ti ti-cloud-upload fs-1 text-muted mb-2"></i>
                            <div class="fw-semibold" style="font-size:13px;">Upload Foto Potrait</div>
                            <div class="text-muted" style="font-size:11px;">Klik atau seret file ke sini</div>
                        </div>

                        <input type="file" name="gambar" id="fileInput"
                               class="d-none @error('gambar') is-invalid @enderror"
                               accept="image/*" onchange="previewImage(event)" required>
                        <div class="form-text mt-2" style="font-size: 11px;">
                            <i class="ti ti-info-circle"></i> Gunakan rasio 3:4 atau 9:16 untuk hasil estetik.
                        </div>
                        @error('gambar')<div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Action Button --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold mb-2">
                            <i class="ti ti-device-floppy me-1"></i> Simpan Outfit
                        </button>
                        <a href="{{ route('admin.outfit.index') }}" class="btn btn-light border w-100 fw-semibold">
                            Batal
                        </a>
                    </div>
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
            document.getElementById('previewWrap').classList.remove('d-none');
            document.getElementById('dropzone').classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }

    function resetUpload() {
        document.getElementById('fileInput').value = '';
        document.getElementById('previewWrap').classList.add('d-none');
        document.getElementById('dropzone').classList.remove('d-none');
    }
</script>
@endsection
