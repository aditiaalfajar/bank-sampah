@extends('layouts.app')
@section('title', 'Tambah Jenis Sampah')
@section('content')
<h2 class="fw-bold mb-4">Tambah Jenis Sampah</h2>
<div class="card p-4 col-md-6">
    <form method="POST" action="{{ route('jenis.store') }}">
        @csrf
        <div class="mb-3"><label class="form-label">Nama</label><input name="nama" value="{{ old('nama') }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Harga per Kg (Rp)</label><input type="number" name="harga_per_kg" value="{{ old('harga_per_kg') }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Satuan</label><input name="satuan" value="{{ old('satuan', 'kg') }}" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Keterangan</label><input name="keterangan" value="{{ old('keterangan') }}" class="form-control"></div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
