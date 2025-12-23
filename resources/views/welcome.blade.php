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
        min-height: 100vh; /* Gunakan min-height agar tidak terpotong di HP */
        text-align: center;
        color: var(--text-main);
        padding: 20px; /* Jarak aman agar hero tidak nempel pinggir layar */
    }

    .hero {
        padding: 30px 20px; /* Perkecil padding */
        background: rgba(255, 255, 255, 0.78);
        backdrop-filter: blur(15px);
        border-radius: 24px; /* Sedikit diperhalus */
        border: 1px solid rgba(199, 204, 211, 0.5);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
        width: 100%;
        max-width: 450px; /* Batasi lebar agar tetap ramping di desktop */
    }

    /* LOGO */
    .hero img {
        width: 60px; /* Kecilkan sedikit */
        height: auto;
        margin-bottom: 15px;
    }

    /* JUDUL - DIBUAT RESPONSIF */
    h1 { 
        font-size: 2rem; /* Turunkan dari 3rem ke 2rem */
        margin-bottom: 12px; 
        color: var(--emerald-deep); 
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    /* PARAGRAF */
    p { 
        font-size: 0.95rem; /* Turunkan dari 1.1rem ke 0.95rem */
        color: #5d6c65; 
        margin-bottom: 25px; 
        line-height: 1.6;
        padding: 0 10px;
    }

    /* TOMBOL */
    .btn-start {
        display: inline-block;
        padding: 12px 35px; /* Lebih ramping */
        background: var(--emerald-deep);
        color: white;
        text-decoration: none;
        border-radius: 12px; /* Sesuaikan dengan style dashboard sebelumnya */
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-start:hover { 
        opacity: 0.95; 
        transform: translateY(-2px); 
        box-shadow: 0 5px 15px rgba(47, 127, 106, 0.3);
    }

    /* KHUSUS MOBILE (Layar sangat kecil) */
    @media (max-width: 480px) {
        h1 { font-size: 1.75rem; }
        p { font-size: 0.85rem; }
        .hero { padding: 25px 15px; }
    }
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
