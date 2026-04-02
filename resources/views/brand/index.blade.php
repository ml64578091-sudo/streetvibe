@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0">Manajemen Brand</h5>
                <small class="text-muted">Kelola semua brand produk Anda</small>
            </div>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3">
                <i class="ti ti-plus"></i> Tambah Brand Baru
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0d6efd !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-10"
                         style="width:48px; height:48px; flex-shrink:0">
                        <i class="ti ti-brand-appstore fs-4 text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Total Brand</div>
                        <div class="fw-bold fs-4">{{ $brands->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #198754 !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10"
                         style="width:48px; height:48px; flex-shrink:0">
                        <i class="ti ti-circle-check fs-4 text-success"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Brand Aktif</div>
                        <div class="fw-bold fs-4 text-success">{{ $brands->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0dcaf0 !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-info bg-opacity-10"
                         style="width:48px; height:48px; flex-shrink:0">
                        <i class="ti ti-calendar fs-4 text-info"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Bulan Ini</div>
                        <div class="fw-bold fs-4 text-info">
                            {{ $brands->filter(fn($b) => $b->created_at->isCurrentMonth())->count() }}
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

                    {{-- Search Bar --}}
                    <div class="px-3 pt-3 pb-2 border-bottom">
                        <div class="input-group" style="max-width: 320px;">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="ti ti-search text-muted"></i>
                            </span>
                            <input type="text" id="searchBrand" class="form-control bg-light border-start-0 ps-0"
                                   placeholder="Cari brand..." style="outline: none; box-shadow: none;">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="brandTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-muted fw-semibold" style="font-size:12px; width:60px;">NO</th>
                                    <th class="py-3 text-muted fw-semibold" style="font-size:12px;">NAMA BRAND</th>
                                    <th class="py-3 text-muted fw-semibold text-center" style="font-size:12px; width:100px;">STATUS</th>
                                    <th class="py-3 text-muted fw-semibold text-center pe-4" style="font-size:12px; width:180px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                <tr class="brand-row" data-name="{{ strtolower($brand->nama_brand) }}">
                                    <td class="ps-4 text-muted fw-semibold" style="font-size:13px;">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10"
                                                 style="width:40px; height:40px; flex-shrink:0;">
                                                <i class="ti ti-brand-appstore text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-uppercase" style="font-size:14px; letter-spacing:.3px;">{{ $brand->nama_brand }}</div>
                                                <div class="text-muted" style="font-size:11px;">ID: #{{ $brand->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill d-inline-flex align-items-center gap-1"
                                              style="background:#EAF3DE; color:#3B6D11; font-size:11px; padding: 5px 10px;">
                                            <span style="width:6px;height:6px;border-radius:50%;background:#3B6D11;display:inline-block;"></span>
                                            Aktif
                                        </span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                               class="btn btn-sm d-flex align-items-center gap-1"
                                               style="background:#FAEEDA; color:#633806; border:1px solid #FAC775; font-size:12px;">
                                                <i class="ti ti-edit"></i> Edit
                                            </a>
                                            <button type="button"
                                                    class="btn btn-sm d-flex align-items-center gap-1"
                                                    style="background:#FCEBEB; color:#791F1F; border:1px solid #F7C1C1; font-size:12px;"
                                                    onclick="openModal({{ $brand->id }}, '{{ $brand->nama_brand }}')">
                                                <i class="ti ti-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="ti ti-inbox fs-1 text-muted d-block mb-2"></i>
                                        <span class="text-muted">Belum ada brand yang terdaftar.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Footer --}}
                    <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between">
                        <small class="text-muted">Menampilkan {{ $brands->count() }} brand</small>
                        @if(method_exists($brands, 'links'))
                            {{ $brands->links('pagination::bootstrap-5') }}
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-body p-4">
                <div class="d-flex align-items-center justify-content-center rounded-3 mb-3"
                     style="width:48px;height:48px;background:#FCEBEB;">
                    <i class="ti ti-trash fs-4" style="color:#A32D2D;"></i>
                </div>
                <h6 class="fw-bold mb-1">Hapus Brand?</h6>
                <p class="text-muted mb-4" style="font-size:13px;">
                    Brand <strong id="deleteName"></strong> akan dihapus permanen dan berpengaruh pada produk terkait. Tindakan ini tidak dapat dibatalkan.
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
    // Search
    document.getElementById('searchBrand').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.brand-row').forEach(row => {
            row.style.display = row.dataset.name.includes(q) ? '' : 'none';
        });
    });

    // Modal hapus
    function openModal(id, name) {
        document.getElementById('deleteName').textContent = name;
        document.getElementById('deleteForm').action = '/admin/brands/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endsection
