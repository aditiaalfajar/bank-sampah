@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h2 class="fw-bold mb-4">Dashboard</h2>
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div><small class="text-muted">Total Nasabah</small><h3 class="mb-0">{{ $totalNasabah }}</h3></div>
                <i class="bi bi-people stat-icon text-success"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div><small class="text-muted">Total Saldo</small><h3 class="mb-0">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h3></div>
                <i class="bi bi-wallet2 stat-icon text-primary"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div><small class="text-muted">Setoran Bulan Ini</small><h3 class="mb-0">Rp {{ number_format($totalSetoranBulanIni, 0, ',', '.') }}</h3></div>
                <i class="bi bi-arrow-down-circle stat-icon text-info"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div><small class="text-muted">Tarik Bulan Ini</small><h3 class="mb-0">Rp {{ number_format($totalTarikBulanIni, 0, ',', '.') }}</h3></div>
                <i class="bi bi-cash-stack stat-icon text-warning"></i>
            </div>
        </div>
    </div>
</div>
<div class="row g-3">
    <div class="col-md-7">
        <div class="card p-3">
            <h5>Setoran Terbaru</h5>
            <table class="table table-hover">
                <thead><tr><th>Tanggal</th><th>Nasabah</th><th>Jenis</th><th>Berat</th><th>Total</th></tr></thead>
                <tbody>
                @forelse($setorTerbaru as $s)
                    <tr><td>{{ $s->tanggal }}</td><td>{{ $s->nasabah->nama }}</td><td>{{ $s->jenisSampah->nama }}</td><td>{{ $s->berat_kg }} kg</td><td>Rp {{ number_format($s->harga_total, 0, ',', '.') }}</td></tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Belum ada data</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card p-3">
            <h5>Saldo Nasabah Terbesar</h5>
            <table class="table">
                <thead><tr><th>Nama</th><th>Saldo</th></tr></thead>
                <tbody>
                @forelse($nasabahTop as $n)
                    <tr><td>{{ $n->nama }}</td><td>Rp {{ number_format($n->saldo, 0, ',', '.') }}</td></tr>
                @empty
                    <tr><td colspan="2" class="text-center text-muted">Belum ada data</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card p-3 mt-3">
            <h5>Daftar Jenis Sampah</h5>
            <ul class="list-group list-group-flush">
                @forelse($jenisSampah as $j)
                    <li class="list-group-item d-flex justify-content-between">{{ $j->nama }}<span>Rp {{ number_format($j->harga_per_kg, 0, ',', '.') }}/{{ $j->satuan }}</span></li>
                @empty
                    <li class="list-group-item text-muted">Belum ada data</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
