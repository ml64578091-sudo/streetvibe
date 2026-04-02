@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="fw-semibold mb-0">Edit Produk</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
          @csrf
                @method('PUT')


                <!-- NAMA PRODUK -->
                <div class="mb-3">
                    <label>Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control"
                        value="{{ $category->nama_kategori }}">
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>

            </form>
        </div>
    </div>

</div>
@endsection
