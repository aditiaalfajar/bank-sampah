@extends('layouts.app')
@section('title', 'Laporan')
@section('content')
<h2 class="fw-bold mb-4">📄 Laporan</h2>
<div class="card p-4 mb-4">
    <form method="GET" class="row g-3">
        <div class="col-md-3">
            <label class="form-label">Jenis Laporan</label>
            <select name="jenis" class="form-select">
                <option value="setoran" {{ $jenis == 'setoran' ? 'selected' : '' }}>Setoran</option>
                <option value="tarik" {{ $jenis == 'tarik' ? 'selected' : '' }}>Tarik Saldo</option>
                <option value="rekap" {{ $jenis == 'rekap' ? 'selected' : '' }}>Rekap Saldo Nasabah</option>
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ $dari }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label class="form-label">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ $sampai }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Nasabah</label>
            <select name="nasabah_id" class="form-select">
                <option value="">-- Semua --</option>
                @foreach($nasabahs as $n)
                    <option value="{{ $n->id }}" {{ $nasabahId == $n->id ? 'selected' : '' }}>{{ $n->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-success w-100">Tampilkan</button>
        </div>
    </form>
</div>

<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Preview: {{ ucfirst($jenis) }}</h5>
        <a target="_blank" class="btn btn-outline-success" href="{{ route('laporan.cetak', request()->query()) }}"><i class="bi bi-printer"></i> Cetak</a>
    </div>
    <table class="table table-hover">
        @if($jenis == 'tarik')
            <thead><tr><th>Tanggal</th><th>Nasabah</th><th>Jumlah</th><th>Keterangan</th></tr></thead>
            <tbody>
            @forelse($data as $t)
                <tr><td>{{ $t->tanggal }}</td><td>{{ $t->nasabah->nama }}</td><td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td><td>{{ $t->keterangan }}</td></tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Tidak ada data</td></tr>
            @endforelse
            </tbody>
        @elseif($jenis == 'rekap')
            <thead><tr><th>Kode</th><th>Nama</th><th>Alamat</th><th>Saldo</th></tr></thead>
            <tbody>
            @forelse($data as $n)
                <tr><td>{{ $n->kode_nasabah }}</td><td>{{ $n->nama }}</td><td>{{ $n->alamat }}</td><td>Rp {{ number_format($n->saldo, 0, ',', '.') }}</td></tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Tidak ada data</td></tr>
            @endforelse
            </tbody>
        @else
            <thead><tr><th>Tanggal</th><th>Nasabah</th><th>Jenis</th><th>Berat</th><th>Total</th></tr></thead>
            <tbody>
            @forelse($data as $s)
                <tr><td>{{ $s->tanggal }}</td><td>{{ $s->nasabah->nama }}</td><td>{{ $s->jenisSampah->nama }}</td><td>{{ $s->berat_kg }} kg</td><td>Rp {{ number_format($s->harga_total, 0, ',', '.') }}</td></tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Tidak ada data</td></tr>
            @endforelse
            </tbody>
        @endif
    </table>
</div>
@endsection
