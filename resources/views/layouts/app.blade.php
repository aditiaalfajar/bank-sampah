<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bank Sampah RT')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { background: #f6f9f4; font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { width: 260px; min-height: 100vh; background: linear-gradient(180deg, #0f1f17, #1b3a2a); }
        .sidebar .nav-link { color: #a5d6a7; border-radius: 12px; margin-bottom: 6px; font-weight: 600; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #66ff99; color: #0f1f17; }
        .card { border: none; border-radius: 18px; box-shadow: 0 6px 18px rgba(0,0,0,.06); }
        .stat-icon { font-size: 2rem; }
        h1,h2,h3,h5 { font-weight: 800; color: #1b3a2a; }
        .btn-success { background: #2e7d32; border: none; border-radius: 999px; padding: 8px 20px; }
        .btn-success:hover { background: #43a047; }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar p-4 d-flex flex-column">
        <a href="{{ route('dashboard') }}" class="text-white text-decoration-none fs-4 fw-bold mb-4">
            ♻️ BankSampah<span style="color:#66ff99">.admin</span>
        </a>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-grid-1x2"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('nasabah.*') ? 'active' : '' }}" href="{{ route('nasabah.index') }}"><i class="bi bi-people"></i> Nasabah</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('jenis.*') ? 'active' : '' }}" href="{{ route('jenis.index') }}"><i class="bi bi-trash3"></i> Jenis Sampah</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('setor.*') ? 'active' : '' }}" href="{{ route('setor.index') }}"><i class="bi bi-arrow-down-circle"></i> Setoran</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('tarik.*') ? 'active' : '' }}" href="{{ route('tarik.index') }}"><i class="bi bi-cash-stack"></i> Tarik Saldo</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.index') }}"><i class="bi bi-file-earmark-text"></i> Laporan</a></li>
        </ul>
        <form action="{{ route('logout') }}" method="POST" class="mt-auto pt-3">
            @csrf
            <button class="btn btn-outline-light w-100" style="border-radius:999px;"><i class="bi bi-box-arrow-right"></i> Keluar</button>
        </form>
    </div>
    <div class="flex-grow-1 p-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" style="border-radius:14px;">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius:14px;"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
