@extends('layouts.backend')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">📸 Gallery "Follow The Own"</h4>
            <small class="text-muted">Foto yang ditambahkan akan otomatis muncul di halaman utama.</small>
        </div>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">

        {{-- ============ FORM UPLOAD ============ --}}
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h6 class="mb-0 fw-bold">➕ Upload Foto Baru</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Preview gambar sebelum upload --}}
                        <div id="preview-container" class="mb-3" style="display:none;">
                            <div id="preview-grid" style="display:grid; grid-template-columns: repeat(3,1fr); gap:6px;"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Foto <span class="text-danger">*</span></label>
                            <input type="file" name="foto[]" id="foto-input" class="form-control" accept="image/*" multiple required>
                            <small class="text-muted">Bisa pilih beberapa foto sekaligus. Maks 3MB/foto.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Caption <span class="text-muted">(opsional)</span></label>
                            <input type="text" name="caption" class="form-control" placeholder="Contoh: Street Style 2026" maxlength="100">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control" value="0" min="0">
                            <small class="text-muted">Angka kecil = tampil lebih dulu. (0 = paling atas)</small>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 fw-bold">
                            Upload Foto
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ============ DAFTAR FOTO ============ --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-dark text-white rounded-top-4 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">🖼️ Foto Tersimpan ({{ $photos->count() }} foto)</h6>
                </div>
                <div class="card-body p-3">

                    @if($photos->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <div style="font-size:48px;">📂</div>
                        <p class="mt-2">Belum ada foto. Upload foto pertamamu!</p>
                    </div>
                    @else
                    <div class="row g-3">
                        @foreach($photos as $photo)
                        <div class="col-6 col-md-4">
                            <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">

                                {{-- Foto --}}
                                <div style="height:180px; overflow:hidden;">
                                    <img src="{{ asset('storage/' . $photo->foto) }}"
                                         alt="{{ $photo->caption ?? 'Gallery' }}"
                                         style="width:100%; height:100%; object-fit:cover;">
                                </div>

                                <div class="card-body p-2">
                                    {{-- Caption --}}
                                    <p class="mb-1 text-truncate" style="font-size:12px; font-weight:600;">
                                        {{ $photo->caption ?? '—' }}
                                    </p>
                                    <p class="mb-2 text-muted" style="font-size:11px;">
                                        Urutan: <strong>{{ $photo->urutan }}</strong>
                                    </p>

                                    {{-- Tombol Urutan & Hapus --}}
                                    <div class="d-flex gap-1">
                                        {{-- Naik --}}
                                        <form action="{{ route('admin.gallery.moveUp', $photo->id) }}" method="POST" class="flex-fill">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary w-100" title="Pindah ke atas">
                                                ▲
                                            </button>
                                        </form>

                                        {{-- Turun --}}
                                        <form action="{{ route('admin.gallery.moveDown', $photo->id) }}" method="POST" class="flex-fill">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary w-100" title="Pindah ke bawah">
                                                ▼
                                            </button>
                                        </form>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.gallery.destroy', $photo->id) }}" method="POST" class="flex-fill"
                                              onsubmit="return confirm('Hapus foto ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger w-100" title="Hapus">
                                                🗑
                                            </button>
                                        </form>
                                    </div>
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

{{-- Script preview gambar sebelum upload --}}
<script>
document.getElementById('foto-input').addEventListener('change', function(e) {
    const files   = Array.from(e.target.files);
    const grid    = document.getElementById('preview-grid');
    const container = document.getElementById('preview-container');

    grid.innerHTML = '';

    if (files.length === 0) {
        container.style.display = 'none';
        return;
    }

    container.style.display = 'block';

    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = function(ev) {
            const div = document.createElement('div');
            div.style.cssText = 'border-radius:8px; overflow:hidden; aspect-ratio:1/1;';
            div.innerHTML = `<img src="${ev.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endsection
