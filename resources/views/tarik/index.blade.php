@extends('layouts.app')
@section('title', 'Tarik Saldo')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Tarik Saldo</h2>
    <a href="{{ route('tarik.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tarik Saldo</a>
</div>
<div class="card p-3">
    <table class="table table-hover">
        <thead><tr><th>Tanggal</th><th>Nasabah</th><th>Jumlah</th><th>Keterangan</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($tariks as $t)
            <tr>
                <td>{{ $t->tanggal }}</td>
                <td>{{ $t->nasabah->nama }}</td>
                <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                <td>{{ $t->keterangan }}</td>
                <td>
                    <form action="{{ route('tarik.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data tarik ini? Saldo akan dikembalikan.')">
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
    {{ $tariks->links() }}
</div>
@endsection
