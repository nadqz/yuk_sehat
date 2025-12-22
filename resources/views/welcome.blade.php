<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuk Sehat!! – Soft Wellness Platinum</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --emerald-deep: #2f7f6a;
            --emerald-soft: #cfeee4;
            --text-main: #24332e;
        }
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #f8fbfa, #f3f7f6);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
            color: var(--text-main);
        }
        .hero {
            padding: 40px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            border: 1px solid #c7ccd3;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.06);
            max-width: 600px;
        }
        h1 { font-size: 3rem; margin-bottom: 10px; color: var(--emerald-deep); }
        p { font-size: 1.1rem; color: #7d8c85; margin-bottom: 30px; }
        .btn-start {
            padding: 15px 40px;
            background: var(--emerald-deep);
            color: white;
            text-decoration: none;
            border-radius: 999px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-start:hover { opacity: 0.9; transform: scale(1.05); }
    </style>
</head>
<body>
    <div class="hero">
        <img src="{{ asset('assets/img/logo-yuk-sehat.png') }}" width="80" alt="Logo">
        <h1>Yuk Sehat!!</h1>
        <p>Solusi cerdas untuk memantau kesehatan harianmu dengan pendekatan yang menenangkan.</p>
        
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-start">Ke Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-start">Mulai Sekarang</a>
                @endauth
            </div>
        @endif
    </div>
</body>
</html>