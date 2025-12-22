<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password | Yuk Sehat!!</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --emerald-deep: #2f7f6a; --emerald-soft: #cfeee4; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #f8fbfa 0%, #e8f3f0 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; padding: 20px; }
        .auth-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(15px); border-radius: 24px; padding: 40px; width: 100%; max-width: 400px; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        input { width: 100%; padding: 14px; margin-bottom: 15px; border-radius: 12px; border: 1px solid #c7ccd3; outline: none; box-sizing: border-box; }
        .btn-main { width: 100%; padding: 14px; background: var(--emerald-deep); color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; }
    </style>
</head>
<body>
    <div class="auth-card">
        <h2 style="font-weight: 600; margin-bottom: 25px;">Atur Ulang Password</h2>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="email" name="email" value="{{ old('email', $request->email) }}" required readonly>
            <input type="password" name="password" placeholder="Password Baru" required autofocus>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" required>
            <button type="submit" class="btn-main">Update Password</button>
        </form>
    </div>
</body>
</html>