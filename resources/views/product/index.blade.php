@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Product Catalog</h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Produk
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body p-4">
                    {{-- Alert Success --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead class="text-dark fs-4 bg-light">
                                <tr>
                                    <th class="border-bottom-0" style="width: 5%">No</th>
                                    <th class="border-bottom-0" style="width: 15%">Kategori</th>
                                    <th class="border-bottom-0" style="width: 15%">Brand</th>
                                    <th class="border-bottom-0" style="width: 25%">Nama Produk</th>
                                    <th class="border-bottom-0" style="width: 15%">Harga</th>
                                    <th class="border-bottom-0" style="width: 10%">Gambar</th>
                                    <th class="border-bottom-0" style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary fw-semibold">
                                            {{ $product->category->nama_kategori ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ $product->brand->nama_brand ?? '-' }}</td>
                                    <td>
                                        <h6 class="fw-semibold mb-1">{{ $product->nama_produk }}</h6>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-bold text-dark">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        @if($product->gambar)
                                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="" width="70" class="rounded shadow-sm">
                                        @else
                                            <span class="text-muted small italic">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning shadow-sm">
                                                <i class="ti ti-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Data produk masih kosong.</td>
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
