@extends('layouts.app')
@section('title', 'Detail Nasabah')
@section('content')
<h2 class="fw-bold mb-4">{{ $nasabah->nama }}</h2>
<div class="card p-3 mb-3 col-md-6">
    <p class="mb-1"><strong>Kode:</strong> {{ $nasabah->kode_nasabah }}</p>
    <p class="mb-1"><strong>Alamat:</strong> {{ $nasabah->alamat }}</p>
    <p class="mb-1"><strong>No HP:</strong> {{ $nasabah->no_hp }}</p>
    <p class="mb-0"><strong>Saldo:</strong> Rp {{ number_format($nasabah->saldo, 0, ',', '.') }}</p>
</div>
<div class="row g-3">
    <div class="col-md-6">
        <div class="card p-3">
            <h5>Riwayat Setoran</h5>
            <table class="table table-sm">
                <thead><tr><th>Tanggal</th><th>Jenis</th><th>Berat</th><th>Total</th></tr></thead>
                <tbody>
                @forelse($setorans as $s)
                    <tr><td>{{ $s->tanggal }}</td><td>{{ $s->jenisSampah->nama }}</td><td>{{ $s->berat_kg }} kg</td><td>Rp {{ number_format($s->harga_total, 0, ',', '.') }}</td></tr>
                @empty
                    <tr><td colspan="4" class="text-muted text-center">Belum ada</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3">
            <h5>Riwayat Tarik Saldo</h5>
            <table class="table table-sm">
                <thead><tr><th>Tanggal</th><th>Jumlah</th><th>Keterangan</th></tr></thead>
                <tbody>
                @forelse($tariks as $t)
                    <tr><td>{{ $t->tanggal }}</td><td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td><td>{{ $t->keterangan }}</td></tr>
                @empty
                    <tr><td colspan="3" class="text-muted text-center">Belum ada</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
