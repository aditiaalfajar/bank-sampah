@extends('layouts.app')
@section('title', 'Edit Jenis Sampah')
@section('content')
<h2 class="fw-bold mb-4">Edit Jenis Sampah</h2>
<div class="card p-4 col-md-6">
    <form method="POST" action="{{ route('jenis.update', $jenis) }}">
        @csrf @method('PUT')
        <div class="mb-3"><label class="form-label">Nama</label><input name="nama" value="{{ old('nama', $jenis->nama) }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Harga per Kg (Rp)</label><input type="number" name="harga_per_kg" value="{{ old('harga_per_kg', $jenis->harga_per_kg) }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Satuan</label><input name="satuan" value="{{ old('satuan', $jenis->satuan) }}" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Keterangan</label><input name="keterangan" value="{{ old('keterangan', $jenis->keterangan) }}" class="form-control"></div>
        <button class="btn btn-success">Perbarui</button>
        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
