<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan - Bank Sampah RT</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #222; }
        .kop { text-align: center; border-bottom: 3px double #333; padding-bottom: 10px; margin-bottom: 20px; }
        .kop h2 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #444; padding: 8px 10px; text-align: left; }
        th { background: #e8f5e9; }
        .ttd { margin-top: 60px; text-align: right; padding-right: 60px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
<div class="kop">
    <h2>♻️ BANK SAMPAH RT</h2>
    <p style="margin:4px 0;">Laporan {{ ucfirst($jenis) }} {{ $dari ? 'Periode ' . $dari . ' s/d ' . ($sampai ?: $dari) : '' }}</p>
</div>

<table>
    @if($jenis == 'tarik')
        <thead><tr><th>No</th><th>Tanggal</th><th>Nasabah</th><th>Jumlah</th><th>Keterangan</th></tr></thead>
        <tbody>
        @forelse($data as $i => $t)
            <tr><td>{{ $i+1 }}</td><td>{{ $t->tanggal }}</td><td>{{ $t->nasabah->nama }}</td><td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td><td>{{ $t->keterangan }}</td></tr>
        @empty
            <tr><td colspan="5" style="text-align:center;">Tidak ada data</td></tr>
        @endforelse
        <tr><th colspan="3">Total</th><th>Rp {{ number_format($data->sum('jumlah'), 0, ',', '.') }}</th><th></th></tr>
        </tbody>
    @elseif($jenis == 'rekap')
        <thead><tr><th>No</th><th>Kode</th><th>Nama</th><th>Alamat</th><th>Saldo</th></tr></thead>
        <tbody>
        @forelse($data as $i => $n)
            <tr><td>{{ $i+1 }}</td><td>{{ $n->kode_nasabah }}</td><td>{{ $n->nama }}</td><td>{{ $n->alamat }}</td><td>Rp {{ number_format($n->saldo, 0, ',', '.') }}</td></tr>
        @empty
            <tr><td colspan="5" style="text-align:center;">Tidak ada data</td></tr>
        @endforelse
        <tr><th colspan="4">Total Saldo</th><th>Rp {{ number_format($data->sum('saldo'), 0, ',', '.') }}</th></tr>
        </tbody>
    @else
        <thead><tr><th>No</th><th>Tanggal</th><th>Nasabah</th><th>Jenis</th><th>Berat</th><th>Total</th></tr></thead>
        <tbody>
        @forelse($data as $i => $s)
            <tr><td>{{ $i+1 }}</td><td>{{ $s->tanggal }}</td><td>{{ $s->nasabah->nama }}</td><td>{{ $s->jenisSampah->nama }}</td><td>{{ $s->berat_kg }} kg</td><td>Rp {{ number_format($s->harga_total, 0, ',', '.') }}</td></tr>
        @empty
            <tr><td colspan="6" style="text-align:center;">Tidak ada data</td></tr>
        @endforelse
        <tr><th colspan="4">Total</th><th>{{ $data->sum('berat_kg') }} kg</th><th>Rp {{ number_format($data->sum('harga_total'), 0, ',', '.') }}</th></tr>
        </tbody>
    @endif
</table>

<div class="ttd">
    <p>{{ date('d F Y') }}</p>
    <p>Petugas Bank Sampah RT</p>
    <br><br>
    <p><b>( ___________________ )</b></p>
</div>

<div class="no-print" style="margin-top:30px; text-align:center;">
    <button onclick="window.print()" style="padding:10px 24px; background:#2e7d32; color:#fff; border:none; border-radius:8px; cursor:pointer;">🖨️ Cetak / Simpan PDF</button>
</div>

<script>window.addEventListener('load', () => window.print());</script>
</body>
</html>
