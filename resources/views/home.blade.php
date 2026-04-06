@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">Total Produk</h5>
                    <h2 class="fw-bold text-white">{{ $total_produk }}</h2>
                    <p class="mb-0">Produk terdaftar di sistem</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Recent Products</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">No</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Kategori</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Brand</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Produk</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Harga</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Deskripsi</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Gambar</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $index => $p)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $index + 1 }}</h6></td>
                                    <td class="border-bottom-0">
                                        {{-- Gunakan 'category' (tunggal) sesuai saran sebelumnya --}}
                                        <h6 class="fw-semibold mb-1">{{ $p->category->nama_kategori ?? '-' }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $p->brand->nama_brand ?? '-' }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $p->nama_produk }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ Str::limit($p->deskripsi, 30) }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        @if($p->gambar)
                                            <img src="{{ Storage::url($p->gambar) }}" width="50" class="rounded">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data produk.</td>
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
