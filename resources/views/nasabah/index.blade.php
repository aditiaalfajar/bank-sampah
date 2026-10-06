@extends('layouts.app')
@section('title', 'Data Nasabah')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Data Nasabah</h2>
    <a href="{{ route('nasabah.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Nasabah</a>
</div>
<div class="card p-3">
    <form class="mb-3" method="GET">
        <div class="input-group">
            <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Cari nama / kode nasabah...">
            <button class="btn btn-outline-success">Cari</button>
        </div>
    </form>
    <table class="table table-hover align-middle">
        <thead><tr><th>Kode</th><th>Nama</th><th>Alamat</th><th>No HP</th><th>Saldo</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($nasabahs as $n)
            <tr>
                <td>{{ $n->kode_nasabah }}</td>
                <td><a href="{{ route('nasabah.show', $n) }}">{{ $n->nama }}</a></td>
                <td>{{ $n->alamat }}</td>
                <td>{{ $n->no_hp }}</td>
                <td>Rp {{ number_format($n->saldo, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('nasabah.edit', $n) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('nasabah.destroy', $n) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus nasabah ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Belum ada data</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $nasabahs->links() }}
</div>
@endsection
