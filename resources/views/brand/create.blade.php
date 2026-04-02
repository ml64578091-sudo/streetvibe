@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Brand</h4>

    <form action="{{ route('admin.brands.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Brand</label>
            <input type="text" name="nama_brand" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
