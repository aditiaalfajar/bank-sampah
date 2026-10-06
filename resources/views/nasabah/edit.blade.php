@extends('layouts.app')
@section('title', 'Edit Nasabah')
@section('content')
<h2 class="fw-bold mb-4">Edit Nasabah</h2>
<div class="card p-4 col-md-6">
    <form method="POST" action="{{ route('nasabah.update', $nasabah) }}">
        @csrf @method('PUT')
        <div class="mb-3"><label class="form-label">Kode Nasabah</label><input name="kode_nasabah" value="{{ old('kode_nasabah', $nasabah->kode_nasabah) }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Nama</label><input name="nama" value="{{ old('nama', $nasabah->nama) }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Alamat</label><input name="alamat" value="{{ old('alamat', $nasabah->alamat) }}" class="form-control"></div>
        <div class="mb-3"><label class="form-label">No HP</label><input name="no_hp" value="{{ old('no_hp', $nasabah->no_hp) }}" class="form-control"></div>
        <button class="btn btn-success">Perbarui</button>
        <a href="{{ route('nasabah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
