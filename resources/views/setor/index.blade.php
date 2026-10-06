@extends('layouts.app')
@section('title', 'Setoran Sampah')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Setoran Sampah</h2>
    <a href="{{ route('setor.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Catat Setoran</a>
</div>
<div class="card p-3">
    <table class="table table-hover">
        <thead><tr><th>Tanggal</th><th>Nasabah</th><th>Jenis</th><th>Berat (kg)</th><th>Total</th><th>Keterangan</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($setorans as $s)
            <tr>
                <td>{{ $s->tanggal }}</td>
                <td>{{ $s->nasabah->nama }}</td>
                <td>{{ $s->jenisSampah->nama }}</td>
                <td>{{ $s->berat_kg }}</td>
                <td>Rp {{ number_format($s->harga_total, 0, ',', '.') }}</td>
                <td>{{ $s->keterangan }}</td>
                <td>
                    <form action="{{ route('setor.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus setoran ini? Saldo akan disesuaikan.')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center text-muted">Belum ada data</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $setorans->links() }}
</div>
@endsection
