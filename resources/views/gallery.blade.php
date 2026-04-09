@extends('layouts.backend')

@section('content')
<style>
    .gallery-card { transition: all 0.3s ease; border: 1px solid #eee; }
    .gallery-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
    .btn-action { width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: 0.2s; }
    .btn-action:hover { background-color: #f8f9fa; color: #0d6efd !important; }
    .preview-img { border-radius: 12px; object-fit: cover; aspect-ratio: 1/1; border: 2px solid #f8f9fa; }
    .dropzone-area { border: 2px dashed #dfe3e7; background: #f9fbfe; transition: 0.3s; cursor: pointer; }
    .dropzone-area:hover { border-color: #0d6efd; background: #f0f5ff; }
    .badge-order { position: absolute; top: 10px; left: 10px; background: rgba(0,0,0,0.7); color: white; padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; backdrop-filter: blur(4px); z-index: 2; }
    .backdrop-blur { backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); }
    .input-instagram-icon { background-color: #f8f9fa; border-radius: 10px 0 0 10px; border: none; }
</style>

{{-- Pastikan FontAwesome terpanggil untuk logo Instagram --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h3 class="fw-bold text-dark mb-1">Gallery Master</h3>
            <p class="text-muted small">Kelola media dan link Instagram profil "Follow The Own".</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
             <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-4 py-2 rounded-pill shadow-sm" style="font-size: 13px;">
                <i class="fa-solid fa-image me-1"></i> {{ $photos->count() }} Total Media
             </span>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 bg-success text-white rounded-3" role="alert">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-circle-check me-2 fs-4"></i>
            <div><strong>Berhasil!</strong> {{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-4">
        {{-- ============ FORM UPLOAD (KIRI) ============ --}}
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 d-flex align-items-center gap-2">
                        <i class="fa-brands fa-instagram text-primary"></i> Add New Media
                    </h5>

                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Dropzone Area --}}
                        <div class="mb-4 text-center">
                            <div id="dropzone" class="dropzone-area p-4 rounded-4" onclick="document.getElementById('foto-input').click()">
                                <i class="fa-solid fa-cloud-arrow-up fs-1 text-primary mb-2"></i>
                                <h6 class="fw-bold mb-1">Pilih atau Tarik Foto</h6>
                                <p class="text-muted small mb-0">Format: JPG, PNG, WEBP (Max 3MB)</p>
                            </div>
                            <input type="file" name="foto[]" id="foto-input" class="d-none" accept="image/*" multiple required onchange="handlePreview(this)">
                        </div>

                        {{-- Preview Container - INI YANG TADI GAADA --}}
                        <div id="preview-container" class="mb-4 p-3 bg-light rounded-4 border" style="display:none;">
                            <label class="form-label small fw-bold text-muted mb-2">PREVIEW FOTO</label>
                            <div id="preview-grid" class="row g-2"></div>
                        </div>

                        {{-- Input Instagram Username --}}
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">INSTAGRAM USERNAME</label>
                            <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                                <span class="input-group-text input-instagram-icon">
                                    <i class="fa-solid fa-at text-muted"></i>
                                </span>
                                <input type="text" name="caption" class="form-control form-control-lg bg-light border-0 ps-0" style="font-size: 14px;" placeholder="Contoh: @username" required>
                            </div>
                        </div>

                        {{-- Input Urutan --}}
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">PRIORITAS URUTAN</label>
                            <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                                <span class="input-group-text border-0 bg-light">
                                    <i class="fa-solid fa-arrow-down-1-9 text-muted"></i>
                                </span>
                                @php
                                    $nextUrutan = $photos->isEmpty() ? 1 : $photos->max('urutan') + 1;
                                @endphp
                                <input type="number" name="urutan" class="form-control form-control-lg border-0 bg-light ps-0" value="{{ $nextUrutan }}" min="0" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm" style="border-radius: 12px; transition: 0.3s;">
                            <i class="fa-solid fa-paper-plane me-1"></i> Publikasikan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ============ GRID DAFTAR FOTO (KANAN) ============ --}}
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Media Library</h5>

                    @if($photos->isEmpty())
                    <div class="text-center py-5">
                        <i class="fa-solid fa-image-slash text-muted mb-3" style="font-size: 48px;"></i>
                        <h6 class="fw-bold">Belum ada koleksi foto</h6>
                    </div>
                    @else
                    <div class="row g-4">
                        @foreach($photos as $photo)
                        <div class="col-sm-6 col-md-4">
                            <div class="card gallery-card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                                <div class="position-relative" style="height: 220px;">
                                    <span class="badge-order shadow-sm">#{{ $photo->urutan }}</span>
                                    <img src="{{ Storage::url($photo->foto) }}" class="w-100 h-100" style="object-fit:cover;">

                                    <div class="position-absolute bottom-0 start-0 w-100 p-2 d-flex justify-content-center gap-2 bg-dark bg-opacity-25 backdrop-blur">
                                        <form action="{{ route('admin.gallery.moveUp', $photo->id) }}" method="POST">@csrf
                                            <button class="btn btn-light btn-action shadow-sm"><i class="fa-solid fa-chevron-up"></i></button>
                                        </form>
                                        <form action="{{ route('admin.gallery.moveDown', $photo->id) }}" method="POST">@csrf
                                            <button class="btn btn-light btn-action shadow-sm"><i class="fa-solid fa-chevron-down"></i></button>
                                        </form>
                                        <form action="{{ route('admin.gallery.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Hapus permanent?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-action shadow-sm"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>

                                <div class="card-body p-3 bg-white">
                                    <div class="d-flex align-items-center text-primary fw-bold mb-1" style="font-size: 13px;">
                                        <i class="fa-brands fa-instagram me-1"></i>
                                        {{ str_starts_with($photo->caption, '@') ? $photo->caption : '@' . $photo->caption }}
                                    </div>
                                    <p class="text-muted mb-0" style="font-size: 11px;">
                                        <i class="fa-solid fa-calendar-days me-1"></i> {{ $photo->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script untuk Preview --}}
<script>
function handlePreview(input) {
    const grid = document.getElementById('preview-grid');
    const container = document.getElementById('preview-container');

    grid.innerHTML = '';

    if (input.files && input.files.length > 0) {
        container.style.display = 'block';

        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-4';
                col.innerHTML = `<img src="${e.target.result}" class="w-100 preview-img shadow-sm" style="border: 1px solid #ddd;">`;
                grid.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    } else {
        container.style.display = 'none';
    }
}
</script>
@endsection
