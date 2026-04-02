@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Manajemen Brand</h5>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary shadow-sm">
                <i class="ti ti-plus"></i> Tambah Brand Baru
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card w-100 shadow-sm border-0">
                <div class="card-body p-4">

                    {{-- Notifikasi Sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead class="text-dark fs-4 bg-light">
                                <tr>
                                    <th class="border-bottom-0" style="width: 10%">No</th>
                                    <th class="border-bottom-0" style="width: 65%">Nama Brand</th>
                                    <th class="border-bottom-0 text-center" style="width: 25%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                <tr>
                                    <td class="fw-semibold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light-info rounded-circle p-2 me-3 text-info">
                                                <i class="ti ti-brand-appstore fs-6"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-semibold mb-0 text-uppercase">{{ $brand->nama_brand }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                               class="btn btn-sm btn-warning d-flex align-items-center gap-1 shadow-sm">
                                               <i class="ti ti-edit"></i> Edit
                                            </a>

                                            <form action="{{ route('admin.brands.destroy', $brand->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Menghapus Brand juga akan berpengaruh pada produk terkait. Lanjutkan?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center gap-1 shadow-sm">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <p class="text-muted mb-0">Belum ada brand yang terdaftar.</p>
                                    </td>
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
@endsection
