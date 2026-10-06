@extends('layouts.app')
@section('title', 'Tarik Saldo')
@section('content')
<h2 class="fw-bold mb-4">Tarik Saldo Nasabah</h2>
<div class="card p-4 col-md-6">
    <form method="POST" action="{{ route('tarik.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nasabah</label>
            <select name="nasabah_id" class="form-select" required>
                <option value="">-- Pilih Nasabah --</option>
                @foreach($nasabahs as $n)
                    <option value="{{ $n->id }}">{{ $n->nama }} - Saldo: Rp {{ number_format($n->saldo, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Tanggal</label><input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Jumlah (Rp)</label><input type="number" name="jumlah" value="{{ old('jumlah') }}" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Keterangan</label><input name="keterangan" value="{{ old('keterangan') }}" class="form-control"></div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('tarik.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
