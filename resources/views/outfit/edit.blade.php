@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h5 class="fw-semibold mb-0">Edit Referensi Outfit</h5>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.outfit.update', $outfit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Look</label>
                    <input type="text" name="judul" class="form-control" value="{{ $outfit->judul }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold d-block">Foto Saat Ini</label>
                    <img src="{{ asset('storage/' . $outfit->gambar) }}" alt="" width="150" class="rounded shadow-sm mb-2">
                    <input type="file" name="gambar" class="form-control">
                    <div class="form-text text-danger">*Kosongkan jika tidak ingin mengganti foto.</div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi / Tips Padu Padan</label>
                    <textarea name="deskripsi" class="form-control" rows="5">{{ $outfit->deskripsi }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Outfit</button>
                    <a href="{{ route('admin.outfit.index') }}" class="btn btn-light border">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
