@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0">Manajemen Kategori</h5>
                <small class="text-muted">Kelola semua kategori produk Anda</small>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3">
                <i class="ti ti-plus"></i> Tambah Kategori
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0d6efd !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10" style="width:48px; height:48px;">
                        <i class="ti ti-category fs-4 text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Total Kategori</div>
                        <div class="fw-bold fs-4">{{ $categories->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #198754 !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10" style="width:48px; height:48px;">
                        <i class="ti ti-circle-check fs-4 text-success"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Kategori Aktif</div>
                        <div class="fw-bold fs-4 text-success">{{ $categories->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0dcaf0 !important;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-info bg-opacity-10" style="width:48px; height:48px;">
                        <i class="ti ti-calendar fs-4 text-info"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Bulan Ini</div>
                        <div class="fw-bold fs-4 text-info">
                            {{ $categories->where('created_at', '>=', now()->startOfMonth())->count() }}
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
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 m-3" role="alert">
                            <i class="ti ti-circle-check fs-5"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="px-3 pt-3 pb-2 border-bottom">
                        <div class="input-group" style="max-width: 320px;">
                            <span class="input-group-text bg-light border-end-0"><i class="ti ti-search text-muted"></i></span>
                            <input type="text" id="searchCategory" class="form-control bg-light border-start-0" placeholder="Cari kategori...">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-muted fw-semibold" style="font-size:12px; width:60px;">NO</th>
                                    <th class="py-3 text-muted fw-semibold" style="font-size:12px;">NAMA KATEGORI</th>
                                    <th class="py-3 text-muted fw-semibold text-center" style="font-size:12px; width:100px;">STATUS</th>
                                    <th class="py-3 text-muted fw-semibold text-center pe-4" style="font-size:12px; width:180px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr class="category-row" data-name="{{ strtolower($category->nama_kategori) }}">
                                    <td class="ps-4 text-muted fw-semibold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10" style="width:40px; height:40px;">
                                                <i class="ti ti-tag text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-uppercase" style="font-size:14px;">{{ $category->nama_kategori }}</div>
                                                <div class="text-muted" style="font-size:11px;">ID: #{{ $category->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill" style="background:#EAF3DE; color:#3B6D11; padding:5px 10px;">Aktif</span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm" style="background:#FAEEDA; color:#633806; border:1px solid #FAC775;">
                                                <i class="ti ti-edit"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-sm" style="background:#FCEBEB; color:#791F1F; border:1px solid #F7C1C1;"
                                                    onclick="openModal({{ $category->id }}, '{{ $category->nama_kategori }}')">
                                                <i class="ti ti-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">Belum ada kategori.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
        <div class="modal-content border-0">
            <div class="modal-body p-4 text-center">
                <i class="ti ti-trash fs-1 text-danger mb-3"></i>
                <h6 class="fw-bold">Hapus Kategori?</h6>
                <p class="text-muted small">Kategori <strong id="deleteName"></strong> akan dihapus permanen.</p>
                <div class="d-flex gap-2">
                    <button class="btn btn-light flex-fill" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" class="flex-fill">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Search Function
    document.getElementById('searchCategory').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.category-row').forEach(row => {
            row.style.display = row.dataset.name.includes(q) ? '' : 'none';
        });
    });

    // Delete Modal Function
    function openModal(id, name) {
        document.getElementById('deleteName').textContent = name;
        // Pastikan URL action-nya benar
        document.getElementById('deleteForm').action = '/admin/categories/' + id;
        var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        myModal.show();
    }
</script>
@endsection
