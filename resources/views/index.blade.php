<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuk Sehat!! | Jurnal Kesehatan</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <link rel="icon" type="image/x-icon" href="{{ secure_asset('assets/img/favicon.ico') }}?v=1">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ secure_asset('assets/img/icon-192.png') }}?v=1">
    <link rel="apple-touch-icon" href="{{ secure_asset('assets/img/apple-touch-icon.png') }}?v=1">
    <link rel="manifest" href="{{ secure_asset('manifest.json') }}">
    <meta name="theme-color" content="#2f7f6a">
    
    <style>
    :root {
        --emerald-deep: #1a4d3e;
        --emerald-mid: #2f7f6a;
        --emerald-soft: #cfeee4;
        --platinum: #f8fafc;
        --text-main: #1e293b;
        --text-muted: #64748b;
    }

    html { scroll-behavior: smooth; font-size: 15px; } /* Mengecilkan skala dasar */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--platinum); color: var(--text-main); line-height: 1.5; overflow-x: hidden; }

    /* NAVBAR RAMPING */
    nav {
        padding: 15px 5%; /* Dikurangi dari 20px 8% */
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        background: rgba(248, 250, 252, 0.9);
        backdrop-filter: blur(10px);
        z-index: 1000;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    .logo img { height: 32px; transition: 0.3s; } /* Logo lebih proporsional */
    .nav-links a { text-decoration: none; color: var(--text-main); font-weight: 600; margin-left: 25px; font-size: 13px; transition: 0.3s; }
    
    .btn-login {
        background: var(--emerald-deep);
        color: white !important;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 13px;
    }

    /* HERO SECTION - PERBAIKAN SKALA */
    .hero {
        padding: 60px 5% 100px;
        max-width: 1200px; /* Membatasi agar tidak terlalu lebar di monitor besar */
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        align-items: center;
        gap: 40px;
    }
    .hero-text h1 { 
        font-size: 48px; /* Turun dari 64px */
        font-weight: 800; 
        line-height: 1.1; 
        color: var(--emerald-deep); 
        margin-bottom: 20px; 
        letter-spacing: -1px;
    }
    .hero-text p { font-size: 17px; color: var(--text-muted); margin-bottom: 30px; max-width: 480px; }
    
    .btn-primary { 
        background: var(--emerald-mid); 
        color: white; 
        padding: 16px 32px; 
        border-radius: 12px; 
        text-decoration: none; 
        font-weight: 700; 
        font-size: 15px;
        display: inline-block;
    }

    .main-mockup {
        width: 100%;
        border-radius: 25px; /* Lebih halus */
        box-shadow: 0 30px 60px rgba(0,0,0,0.08);
    }
    
    /* Floating Cards - Dikecilkan */
    .floating-card {
        position: absolute;
        background: white;
        padding: 10px 15px;
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.06);
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 2;
    }
    .floating-card strong { font-size: 13px; }
    .floating-card small { font-size: 11px; }

    /* FEATURES */
    .features { padding: 80px 5%; background: white; text-align: center; }
    .features h2 { font-size: 32px; margin-bottom: 50px; }
    
    .feature-grid { 
        display: grid; 
        grid-template-columns: repeat(3, 1fr); 
        gap: 25px; 
        max-width: 1100px; 
        margin: 0 auto; 
    }
    .feature-card { padding: 30px; border-radius: 25px; }

    /* RESPONSIVE MOBILE - PERBAIKAN TOTAL */
    @media (max-width: 768px) {
        nav { padding: 10px 20px; flex-direction: row; }
        .nav-links { display: none; } /* Sembunyikan link di mobile agar tidak berantakan */
        
        .hero {
            padding: 40px 20px;
            grid-template-columns: 1fr;
            text-align: center;
        }
        .hero-text h1 { font-size: 32px; }
        .hero-text p { font-size: 15px; margin: 0 auto 25px; }
        .btn-primary { width: 100%; padding: 14px; }

        .hero-image { order: -1; margin-bottom: 20px; } /* Gambar pindah ke atas di HP */
        .f-1, .f-2 { display: none; } /* Sembunyikan kartu melayang di HP agar bersih */

        .feature-grid { grid-template-columns: 1fr; }
        .feature-card { padding: 25px; }
        
        .about { 
            grid-template-columns: 1fr; 
            padding: 50px 20px;
            text-align: center;
        }
    }
</style>
</head>
<body>

    <nav>
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/full-logo.png') }}" style="width: 120px; height: auto; object-fit: contain;" alt="Logo Yuk Sehat">
            </a>
        </div>
        <div class="nav-links">
            <a href="#fitur">Fitur</a>
            <a href="#tentang">Tentang Kami</a>
            <a href="{{ route('login') }}" class="btn-login">Masuk Sekarang</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-text">
            <h1>Mulai Hidup Sehat <span style="color: var(--emerald-mid)">Hari Ini.</span></h1>
            <p>Platform pintar untuk mencatat aktivitas harian, menghitung BMI secara akurat, dan menjaga hidrasi tubuh Anda tetap optimal.</p>
            <a href="/register" class="btn-primary">Gabung Sekarang — Gratis</a>
        </div>
        <div class="hero-image">
            {{-- Image of a modern health dashboard interface showing heart rate, steps, and water intake --}}
            
            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80" class="main-mockup" alt="Dashboard Health">
            
            <div class="floating-card f-1">
                <i data-lucide="flame" style="color: #ef4444;"></i>
                <div>
                    <strong style="display:block; font-size: 14px;">540 kkal</strong>
                    <small style="color: #64748b;">Bakar lemak hari ini</small>
                </div>
            </div>
            <div class="floating-card f-2">
                <i data-lucide="droplets" style="color: #0ea5e9;"></i>
                <div>
                    <strong style="display:block; font-size: 14px;">8/8 Gelas</strong>
                    <small style="color: #64748b;">Target Air Tercapai</small>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="fitur">
        <span class="section-tag">Fitur Utama</span>
        <h2>Semua yang Anda Butuhkan untuk Sehat</h2>
        <div class="feature-grid">
            <div class="feature-card">
                {{-- Image of a medical scale and measuring tape representing body mass index calculation --}}
                
                <img src="https://www.beliteweight.com/blog/wp-content/uploads/2024/03/BMI-calculator.jpg" class="feature-img" alt="BMI Scale">
                <div class="icon-circle"><i data-lucide="scale"></i></div>
                <h3>Analisis BMI</h3>
                <p>Pantau komposisi tubuh secara berkala. Simpan riwayat berat badan Anda dan lihat grafiknya meningkat.</p>
            </div>
            
            <div class="feature-card">
                {{-- Image of a pair of running shoes on a running track representing active lifestyle --}}
                
                <img src="https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&w=600&q=80" class="feature-img" alt="Running Shoes">
                <div class="icon-circle"><i data-lucide="footprints"></i></div>
                <h3>Jurnal Aktivitas</h3>
                <p>Catat langkah kaki dan durasi olahraga. Bagikan progres harian Anda untuk menjaga motivasi tetap tinggi.</p>
            </div>

            <div class="feature-card">
                {{-- Image of a reusable glass water bottle with fresh lemon slices inside representing hydration --}}
                
                <img src="https://dr-owl.com/cdn/shop/articles/water-5767178_1920.png?v=1724325828" class="feature-img" alt="Hydration">
                <div class="icon-circle"><i data-lucide="glass-water"></i></div>
                <h3>Pantau Hidrasi</h3>
                <p>Pastikan tubuh mendapatkan asupan air yang cukup. Log setiap gelas air yang Anda minum dengan satu sentuhan.</p>
            </div>
        </div>
    </section>

    <section class="about" id="tentang">
        <div class="about-image">
            {{-- Image of a person happily jogging in a green park during sunrise --}}
            
            <img src="https://images.unsplash.com/photo-1444491741275-3747c53c99b4?auto=format&fit=crop&w=1000&q=80" alt="Active Life">
        </div>
        <div class="about-text">
            <span class="section-tag">Tentang Kami</span>
            <h2>Pendamping Digital Untuk Gaya Hidup Sehat.</h2>
            <p>Kami percaya kesehatan dimulai dari konsistensi mencatat hal-hal kecil. Dengan <strong>Yuk Sehat!!</strong>, Anda tidak perlu lagi menebak-nebak progres kesehatan Anda.</p>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px;">
                <div>
                    <h4 style="color: var(--emerald-mid); font-size: 24px;">Simple</h4>
                    <p style="font-size: 14px;">Input data hanya butuh waktu 30 detik.</p>
                </div>
                <div>
                    <h4 style="color: var(--emerald-mid); font-size: 24px;">Personal</h4>
                    <p style="font-size: 14px;">Insight yang disesuaikan dengan kondisi tubuh Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <h2 style="margin-bottom: 20px;">Yuk Sehat!!</h2>
        <p style="opacity: 0.7;">Investasi terbaik bukan emas, tapi tubuh yang sehat.</p>
        <div class="footer-links">
            <a href="#fitur">Fitur</a>
            <a href="#tentang">Tentang Kami</a>
            <a href="/login">Dashboard</a>
            <a href="#">Privasi</a>
        </div>
        <p style="font-size: 12px; opacity: 0.5; margin-top: 40px;">&copy; 2025 Yuk Sehat!! Digital Labs. Seluruh hak cipta dilindungi.</p>
    </footer>

    <script>
        lucide.createIcons();
    </script>

    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register("{{ secure_asset('service-worker.js') }}");
        });
    }
    </script>
</body>
</html>
