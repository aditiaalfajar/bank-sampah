<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank Sampah RT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; background: radial-gradient(circle at 20% 20%, #2e7d32, transparent 50%), radial-gradient(circle at 80% 80%, #00c853, transparent 40%), #0f1f17; }</style>
</head>
<body>
<div class="d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="p-5" style="width: 400px; background: rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.15); border-radius: 24px; backdrop-filter: blur(10px);">
        <div class="text-center mb-4">
            <div style="font-size:3rem;">♻️</div>
            <h3 class="fw-bold text-white">BankSampah<span style="color:#66ff99">.id</span></h3>
            <p class="text-secondary">Login petugas & admin</p>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label text-white">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" style="border-radius:12px;" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label text-white">Password</label>
                <input type="password" name="password" class="form-control" style="border-radius:12px;" required>
            </div>
            <div class="form-check mb-3 text-white">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <button class="btn w-100 fw-bold" style="background:#66ff99; color:#0f1f17; border-radius:999px; padding:10px;">Masuk 🚀</button>
        </form>
    </div>
</div>
</body>
</html>
