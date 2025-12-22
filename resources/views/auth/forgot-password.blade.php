<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | Yuk Sehat!!</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --emerald-deep: #2f7f6a; --emerald-soft: #cfeee4; --text-muted: #7d8c85; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #f8fbfa 0%, #e8f3f0 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; padding: 20px; }
        .auth-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(15px); border-radius: 24px; padding: 40px; width: 100%; max-width: 400px; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        .instruction { font-size: 13px; color: var(--text-muted); margin-bottom: 25px; line-height: 1.6; }
        input { width: 100%; padding: 14px; margin-bottom: 15px; border-radius: 12px; border: 1px solid #c7ccd3; outline: none; box-sizing: border-box; }
        .btn-main { width: 100%; padding: 14px; background: var(--emerald-deep); color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-main:hover { transform: translateY(-2px); opacity: 0.9; }
        .status-message { background: #e6f6f1; color: #2f7f6a; padding: 10px; border-radius: 10px; font-size: 12px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="auth-card">
        <img src="{{ asset('assets/img/logo-yuk-sehat.png') }}" width="60" style="margin-bottom: 15px;">
        <h2 style="font-weight: 600; margin-bottom: 10px;">Lupa Password?</h2>
        <p class="instruction">Jangan khawatir. Masukkan alamat email kamu dan kami akan mengirimkan link reset password yang baru.</p>

        @if (session('status'))
            <div class="status-message">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" placeholder="Email Terdaftar" value="{{ old('email') }}" required autofocus>
            <button type="submit" class="btn-main">Kirim Link Reset</button>
        </form>
        <a href="{{ route('login') }}" style="display:block; margin-top:20px; font-size:13px; color: var(--emerald-deep); text-decoration:none;">Kembali ke Login</a>
    </div>
</body>
</html>