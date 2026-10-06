@extends('layouts.app')
@section('title', 'Catat Setoran')
@section('content')
<h2 class="fw-bold mb-4">Catat Setoran Sampah</h2>
<div class="card p-4 col-md-6">
    <form method="POST" action="{{ route('setor.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nasabah</label>
            <select name="nasabah_id" class="form-select" required>
                <option value="">-- Pilih Nasabah --</option>
                @foreach($nasabahs as $n)
                    <option value="{{ $n->id }}" {{ old('nasabah_id') == $n->id ? 'selected' : '' }}>{{ $n->nama }} ({{ $n->kode_nasabah }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Sampah</label>
            <select name="jenis_sampah_id" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                @foreach($jenis as $j)
                    <option value="{{ $j->id }}">{{ $j->nama }} - Rp {{ number_format($j->harga_per_kg, 0, ',', '.') }}/kg</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Tanggal</label><input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Berat (kg)</label><input type="number" step="0.01" name="berat_kg" value="{{ old('berat_kg') }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Keterangan</label><input name="keterangan" value="{{ old('keterangan') }}" class="form-control"></div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('setor.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
