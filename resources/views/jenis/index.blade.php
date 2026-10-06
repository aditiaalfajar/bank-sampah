@extends('layouts.app')
@section('title', 'Jenis Sampah')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Jenis Sampah</h2>
    <a href="{{ route('jenis.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah</a>
</div>
<div class="card p-3">
    <table class="table table-hover">
        <thead><tr><th>Nama</th><th>Harga/Kg</th><th>Satuan</th><th>Keterangan</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($jenis as $j)
            <tr>
                <td>{{ $j->nama }}</td>
                <td>Rp {{ number_format($j->harga_per_kg, 0, ',', '.') }}</td>
                <td>{{ $j->satuan }}</td>
                <td>{{ $j->keterangan }}</td>
                <td>
                    <a href="{{ route('jenis.edit', $j) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('jenis.destroy', $j) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jenis ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted">Belum ada data</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $jenis->links() }}
</div>
@endsection
