<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Keamanan | Yuk Sehat!!</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --emerald-deep: #2f7f6a; --text-muted: #7d8c85; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #f8fbfa 0%, #e8f3f0 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; }
        .auth-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(15px); border-radius: 24px; padding: 40px; width: 100%; max-width: 400px; text-align: center; }
        input { width: 100%; padding: 14px; margin-bottom: 15px; border-radius: 12px; border: 1px solid #c7ccd3; outline: none; }
        .btn-main { width: 100%; padding: 14px; background: var(--emerald-deep); color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; }
    </style>
</head>
<body>
    <div class="auth-card">
        <h2 style="font-weight: 600; margin-bottom: 10px;">Konfirmasi Password</h2>
        <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 25px;">Ini adalah area aman. Harap konfirmasi password kamu sebelum melanjutkan.</p>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <input type="password" name="password" placeholder="Masukkan Password" required autocomplete="current-password">
            <button type="submit" class="btn-main">Konfirmasi</button>
        </form>
    </div>
</body>
</html>