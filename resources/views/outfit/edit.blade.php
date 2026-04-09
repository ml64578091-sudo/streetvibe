@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    {{-- Header Section --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0">Edit Referensi Outfit</h5>
                <small class="text-muted">Perbarui informasi inspirasi gaya</small>
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
                <div class="fw-semibold mb-1">Ada kesalahan input:</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li style="font-size:13px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.outfit.update', $outfit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- Kolom Kiri --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4 pb-2 border-bottom">
                            <div class="d-flex align-items-center justify-content-center rounded-2 bg-primary bg-opacity-10"
                                 style="width:32px;height:32px;">
                                <i class="ti ti-edit text-primary" style="font-size:16px;"></i>
                            </div>
                            <span class="fw-bold" style="font-size:14px;">Ubah Detail</span>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="font-size:13px;">Judul Look <span class="text-danger">*</span></label>
                            <input type="text" name="judul" value="{{ old('judul', $outfit->judul) }}"
                                   class="form-control form-control-lg @error('judul') is-invalid @enderror" required>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold" style="font-size:13px;">Username Instagram <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">@</span>
                                <input type="text" name="instagram_username" value="{{ old('instagram_username', $outfit->deskripsi) }}"
                                       class="form-control @error('instagram_username') is-invalid @enderror" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                            <div class="d-flex align-items-center justify-content-center rounded-2 bg-info bg-opacity-10"
                                 style="width:32px;height:32px;">
                                <i class="ti ti-camera text-info" style="font-size:16px;"></i>
                            </div>
                            <span class="fw-bold" style="font-size:14px;">Foto Outfit</span>
                        </div>

                        {{-- Preview --}}
                        <div id="previewWrap" class="mb-3">
                            <img id="imagePreview" src="{{ asset('storage/'.$outfit->gambar) }}"
                                 class="rounded-3 w-100" style="max-height:400px; object-fit:cover;">
                            <button type="button" class="btn btn-sm btn-outline-danger w-100 mt-2" onclick="resetUpload()">
                                <i class="ti ti-reload"></i> Ganti Foto Baru
                            </button>
                        </div>

                        <div id="dropzone" class="d-none border rounded-3 d-flex flex-column align-items-center justify-content-center text-center p-4"
                             style="border-style:dashed !important; cursor:pointer; min-height:250px; background:#f8f9fa;"
                             onclick="document.getElementById('fileInput').click()">
                            <i class="ti ti-cloud-upload fs-1 text-muted mb-2"></i>
                            <div class="fw-semibold" style="font-size:13px;">Upload Foto Baru</div>
                        </div>

                        <input type="file" name="gambar" id="fileInput" class="d-none" accept="image/*" onchange="previewImage(event)">
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold mb-2 shadow-sm">
                            <i class="ti ti-device-floppy me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.outfit.index') }}" class="btn btn-light border w-100 fw-semibold text-muted">
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
        document.getElementById('fileInput').click();
    }
</script>
@endsection
