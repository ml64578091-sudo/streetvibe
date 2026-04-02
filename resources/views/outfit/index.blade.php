@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0">Outfit Reference Catalog</h5>
                <small class="text-muted">Kelola semua referensi outfit Anda</small>
            </div>
            <a href="{{ route('admin.outfit.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3">
                <i class="ti ti-plus"></i> Tambah Referensi
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0d6efd !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10"
                         style="width:48px; height:48px; flex-shrink:0">
                        <i class="ti ti-hanger fs-4 text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Total Referensi</div>
                        <div class="fw-bold fs-4">{{ $outfits->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #198754 !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10"
                         style="width:48px; height:48px; flex-shrink:0">
                        <i class="ti ti-circle-check fs-4 text-success"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Outfit Aktif</div>
                        <div class="fw-bold fs-4 text-success">{{ $outfits->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0dcaf0 !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-info bg-opacity-10"
                         style="width:48px; height:48px; flex-shrink:0">
                        <i class="ti ti-calendar fs-4 text-info"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Bulan Ini</div>
                        <div class="fw-bold fs-4 text-info">
                            {{ $outfits->filter(fn($o) => $o->created_at->isCurrentMonth())->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">

                    {{-- Notifikasi --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 m-3 mb-0" role="alert">
                            <i class="ti ti-circle-check fs-5"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Search --}}
                    <div class="px-3 pt-3 pb-2 border-bottom">
                        <div class="input-group" style="max-width: 320px;">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="ti ti-search text-muted"></i>
                            </span>
                            <input type="text" id="searchOutfit" class="form-control bg-light border-start-0 ps-0"
                                   placeholder="Cari outfit..." style="outline:none; box-shadow:none;">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="outfitTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-muted fw-semibold" style="font-size:12px; width:55px;">NO</th>
                                    <th class="py-3 text-muted fw-semibold" style="font-size:12px; width:110px;">GAMBAR</th>
                                    <th class="py-3 text-muted fw-semibold" style="font-size:12px;">JUDUL LOOK</th>
                                    <th class="py-3 text-muted fw-semibold" style="font-size:12px;">DESKRIPSI</th>
                                    <th class="py-3 text-muted fw-semibold text-center pe-4" style="font-size:12px; width:180px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($outfits as $outfit)
                                <tr class="outfit-row" data-name="{{ strtolower($outfit->judul) }}">
                                    <td class="ps-4 text-muted fw-semibold" style="font-size:13px;">{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $outfit->gambar) }}"
                                             alt="{{ $outfit->judul }}"
                                             class="rounded-3 shadow-sm"
                                             style="width:72px; height:72px; object-fit:cover;">
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="font-size:14px;">{{ $outfit->judul }}</div>
                                        <div class="text-muted" style="font-size:11px;">ID: #{{ $outfit->id }}</div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-muted" style="font-size:13px; line-height:1.5;">
                                            {{ Str::limit($outfit->deskripsi, 100) }}
                                        </p>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.outfit.edit', $outfit->id) }}"
                                               class="btn btn-sm d-flex align-items-center gap-1"
                                               style="background:#FAEEDA; color:#633806; border:1px solid #FAC775; font-size:12px;">
                                                <i class="ti ti-edit"></i> Edit
                                            </a>
                                            <button type="button"
                                                    class="btn btn-sm d-flex align-items-center gap-1"
                                                    style="background:#FCEBEB; color:#791F1F; border:1px solid #F7C1C1; font-size:12px;"
                                                    onclick="openModal({{ $outfit->id }}, '{{ $outfit->judul }}')">
                                                <i class="ti ti-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="ti ti-inbox fs-1 text-muted d-block mb-2"></i>
                                        <span class="text-muted">Belum ada referensi outfit.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Footer --}}
                    <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between">
                        <small class="text-muted">Menampilkan {{ $outfits->count() }} referensi</small>
                        @if(method_exists($outfits, 'links'))
                            {{ $outfits->links('pagination::bootstrap-5') }}
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-body p-4">
                <div class="d-flex align-items-center justify-content-center rounded-3 mb-3"
                     style="width:48px;height:48px;background:#FCEBEB;">
                    <i class="ti ti-trash fs-4" style="color:#A32D2D;"></i>
                </div>
                <h6 class="fw-bold mb-1">Hapus Referensi Outfit?</h6>
                <p class="text-muted mb-4" style="font-size:13px;">
                    Outfit <strong id="deleteName"></strong> akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="d-flex gap-2">
                    <button class="btn btn-light flex-fill" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" class="flex-fill">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-100" style="background:#A32D2D; color:#fff;">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchOutfit').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.outfit-row').forEach(row => {
            row.style.display = row.dataset.name.includes(q) ? '' : 'none';
        });
    });

    function openModal(id, name) {
        document.getElementById('deleteName').textContent = name;
        document.getElementById('deleteForm').action = '/admin/outfit/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endsection
