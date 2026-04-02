@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Outfit Reference Catalog</h5>
            <a href="{{ route('admin.outfit.create') }}" class="btn btn-primary shadow-sm">
                <i class="ti ti-plus"></i> Tambah Referensi
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card w-100 shadow-sm">
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="text-dark fs-4 bg-light">
                                <tr>
                                    <th class="border-bottom-0" style="width: 5%">No</th>
                                    <th class="border-bottom-0" style="width: 20%">Gambar</th>
                                    <th class="border-bottom-0" style="width: 25%">Judul Look</th>
                                    <th class="border-bottom-0" style="width: 35%">Deskripsi</th>
                                    <th class="border-bottom-0" style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($outfits as $outfit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $outfit->gambar) }}" alt="" width="80" class="rounded shadow-sm">
                                    </td>
                                    <td>
                                        <h6 class="fw-semibold mb-0">{{ $outfit->judul }}</h6>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-muted small">{{ Str::limit($outfit->deskripsi, 100) }}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('admin.outfit.edit', $outfit->id) }}" class="btn btn-sm btn-warning shadow-sm">
                                                <i class="ti ti-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.outfit.destroy', $outfit->id) }}" method="POST" onsubmit="return confirm('Hapus referensi outfit ini?')">
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
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada referensi outfit.</td>
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
