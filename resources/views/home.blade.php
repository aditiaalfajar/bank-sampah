<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah RT ♻️ - Jadi Tabungan dari Sampahmu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #0f1f17; color: #e8f5e9; }
        .hero {
            background: radial-gradient(circle at 20% 20%, #2e7d32 0%, transparent 50%),
                        radial-gradient(circle at 80% 0%, #00c853 0%, transparent 40%),
                        linear-gradient(135deg, #0f1f17, #1b3a2a);
            padding: 100px 0 80px; border-radius: 0 0 40px 40px;
        }
        .badge-pill { background: rgba(129,199,132,.2); color: #a5d6a7; border: 1px solid #388e3c; border-radius: 999px; padding: 6px 16px; }
        .glass {
            background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.12);
            border-radius: 20px; backdrop-filter: blur(8px); transition: .3s;
        }
        .glass:hover { transform: translateY(-6px); border-color: #66bb6a; }
        .stat-num { font-size: 2rem; font-weight: 800; color: #b9f6ca; }
        table { color: #e8f5e9 !important; }
        .card-dark { background:#16291f; border:1px solid #2e4d3b; border-radius:20px; }
        .btn-neon { background:#66ff99; color:#0f1f17; border:none; font-weight:700; border-radius:999px; padding:10px 26px; }
        .btn-neon:hover { background:#b9f6ca; color:#0f1f17; }
        h5 { font-weight: 800; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background:#0f1f17;">
    <div class="container py-2">
        <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">♻️ BankSampah<span style="color:#66ff99">.id</span></a>
        <a href="{{ route('login') }}" class="btn btn-neon btn-sm">Login Petugas</a>
    </div>
</nav>

<div class="hero">
    <div class="container text-center">
        <span class="badge-pill">💚 Go Green, Cuan Jalan</span>
        <h1 class="display-4 fw-bold mt-4">Sampah Jadi Cuan 💸<br>di Bank Sampah RT</h1>
        <p class="lead text-secondary mt-3">Setor sampahmu, dapatkan saldo. Yuk hidupkan lingkungan bareng-bareng 🌱</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-3 mb-5">
        <div class="col-6 col-md-3"><div class="glass p-4 text-center"><i class="bi bi-people fs-1" style="color:#66ff99"></i><div class="stat-num">{{ $totalNasabah }}</div><small class="text-secondary">Nasabah Aktif</small></div></div>
        <div class="col-6 col-md-3"><div class="glass p-4 text-center"><i class="bi bi-wallet2 fs-1" style="color:#4fc3f7"></i><div class="stat-num">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</div><small class="text-secondary">Total Saldo</small></div></div>
        <div class="col-6 col-md-3"><div class="glass p-4 text-center"><i class="bi bi-cash-coin fs-1" style="color:#ce93d8"></i><div class="stat-num">Rp {{ number_format($totalSetoran, 0, ',', '.') }}</div><small class="text-secondary">Nilai Setoran</small></div></div>
        <div class="col-6 col-md-3"><div class="glass p-4 text-center"><i class="bi bi-box-seam fs-1" style="color:#fff176"></i><div class="stat-num">{{ number_format($totalBerat, 1, ',', '.') }} kg</div><small class="text-secondary">Sampah Terkumpul</small></div></div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-7">
            <div class="card-dark p-4">
                <h5 style="color:#b9f6ca">📊 Setoran 6 Bulan Terakhir</h5>
                <canvas id="chartBulan"></canvas>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-dark p-4">
                <h5 style="color:#b9f6ca">🍩 Komposisi Sampah (kg)</h5>
                <canvas id="chartJenis"></canvas>
            </div>
        </div>
    </div>

    <div class="card-dark p-4">
        <h5 style="color:#b9f6ca">🕐 Setoran Terbaru</h5>
        <table class="table table-hover">
            <thead><tr><th>Tanggal</th><th>Jenis</th><th>Berat</th><th>Nilai</th></tr></thead>
            <tbody>
            @forelse($riwayatTerbaru as $s)
                <tr><td>{{ $s->tanggal }}</td><td>{{ $s->jenisSampah->nama }}</td><td>{{ $s->berat_kg }} kg</td><td style="color:#66ff99">Rp {{ number_format($s->harga_total, 0, ',', '.') }}</td></tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada data</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<footer class="text-center py-4 text-secondary">© {{ date('Y') }} BankSampah.id — Built with ♻️ & 💚</footer>

<script>
Chart.defaults.color = '#a5d6a7';
new Chart(document.getElementById('chartBulan'), {
    type: 'bar',
    data: { labels: @json($bulanLabels), datasets: [{ label: 'Nilai (Rp)', data: @json($bulanData), backgroundColor: '#66bb6a', borderRadius: 8 }] },
    options: { responsive: true, scales: { y: { grid: { color: 'rgba(255,255,255,.08)' } }, x: { grid: { display:false } } } }
});
new Chart(document.getElementById('chartJenis'), {
    type: 'doughnut',
    data: { labels: @json($jenisLabels), datasets: [{ data: @json($jenisData), backgroundColor: ['#66bb6a','#4fc3f7','#ce93d8','#fff176','#ff8a65','#a5d6a7'], borderWidth: 0 }] }
});
</script>
</body>
</html>
