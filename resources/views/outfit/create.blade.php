@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h5 class="fw-semibold mb-0">Tambah Referensi Outfit</h5>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.outfit.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Look</label>
                    <input type="text" name="judul" class="form-control" placeholder="Misal: Casual Streetwear Style" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Upload Foto Outfit</label>
                    <input type="file" name="gambar" class="form-control" required>
                    <div class="form-text">Gunakan foto potrait agar tampilan di gallery lebih estetik.</div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi / Tips Padu Padan</label>
                    <textarea name="deskripsi" class="form-control" rows="5" placeholder="Tuliskan detail pakaian yang digunakan..."></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Outfit</button>
                    <a href="{{ route('admin.outfit.index') }}" class="btn btn-light border">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
