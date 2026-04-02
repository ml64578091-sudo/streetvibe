@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Category List</h5>
            {{-- PERBAIKAN: Tambahkan admin. --}}
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="ti ti-plus"></i> Tambah Kategori
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">No</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Kategori</h6></th>
                            <th class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="border-bottom-0">{{ $loop->iteration }}</td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{ $category->nama_kategori }}</h6>
                            </td>
                            <td class="border-bottom-0 text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    {{-- PERBAIKAN: Gunakan admin.categories.edit --}}
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="btn btn-sm btn-warning d-flex align-items-center gap-1 shadow-sm">
                                       <i class="ti ti-edit"></i> Edit
                                    </a>

                                    {{-- PERBAIKAN: Gunakan admin.categories.destroy --}}
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus kategori ini juga akan berdampak pada produk di dalamnya. Yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center gap-1 shadow-sm">
                                            <i class="ti ti-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
