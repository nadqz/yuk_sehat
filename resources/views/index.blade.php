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

        html { scroll-behavior: smooth; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--platinum); color: var(--text-main); line-height: 1.6; overflow-x: hidden; }

        /* ANIMATIONS */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* NAVBAR */
        nav {
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(15px);
            z-index: 1000;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .logo img { height: 40px; transition: 0.3s; }
        .nav-links a { text-decoration: none; color: var(--text-main); font-weight: 600; margin-left: 35px; font-size: 14px; transition: 0.3s; }
        .nav-links a:hover { color: var(--emerald-mid); }
        
        .btn-login {
            background: var(--emerald-deep);
            color: white !important;
            padding: 12px 28px;
            border-radius: 14px;
            box-shadow: 0 10px 20px rgba(26, 77, 62, 0.15);
            transition: 0.3s;
        }
        .btn-login:hover { transform: translateY(-3px); box-shadow: 0 15px 25px rgba(26, 77, 62, 0.25); }

        /* HERO SECTION */
        .hero {
            padding: 80px 8% 120px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 60px;
            animation: fadeIn 1s ease-out;
        }
        .hero-text h1 { font-size: 64px; font-weight: 800; line-height: 1.1; color: var(--emerald-deep); margin-bottom: 25px; }
        .hero-text p { font-size: 19px; color: var(--text-muted); margin-bottom: 40px; max-width: 520px; }
        
        .btn-primary { 
            background: var(--emerald-mid); 
            color: white; 
            padding: 20px 40px; 
            border-radius: 18px; 
            text-decoration: none; 
            font-weight: 700; 
            box-shadow: 0 15px 30px rgba(47, 127, 106, 0.2); 
            transition: 0.3s; 
            display: inline-block;
        }
        .btn-primary:hover { transform: scale(1.05); background: var(--emerald-deep); }

        .hero-image { position: relative; }
        .main-mockup {
            width: 100%;
            border-radius: 40px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.1);
            animation: float 6s infinite ease-in-out;
        }
        
        /* Floating Cards on Hero */
        .floating-card {
            position: absolute;
            background: white;
            padding: 15px 20px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: float 5s infinite ease-in-out;
            z-index: 2;
        }
        .f-1 { top: 10%; left: -10%; animation-delay: 0s; }
        .f-2 { bottom: 20%; right: -5%; animation-delay: 1s; }

        /* FEATURES SECTION */
        .features { padding: 120px 8%; background: white; text-align: center; }
        .section-tag { color: var(--emerald-mid); font-weight: 800; text-transform: uppercase; font-size: 12px; letter-spacing: 2px; margin-bottom: 12px; display: block; }
        .features h2 { font-size: 42px; font-weight: 800; color: var(--emerald-deep); margin-bottom: 70px; }
        
        .feature-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; }
        .feature-card {
            padding: 40px;
            border-radius: 35px;
            background: var(--platinum);
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-align: left;
            border: 1px solid transparent;
            overflow: hidden;
        }
        .feature-card:hover { 
            transform: translateY(-15px); 
            background: white; 
            border-color: var(--emerald-soft);
            box-shadow: 0 30px 60px rgba(0,0,0,0.05);
        }
        .feature-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 20px;
            margin-bottom: 25px;
        }
        .icon-circle { 
            background: var(--emerald-soft); 
            width: 50px; height: 50px; 
            display: flex; align-items: center; justify-content: center; 
            border-radius: 50%; color: var(--emerald-mid); margin-bottom: 20px;
        }

        /* ABOUT SECTION */
        .about { padding: 120px 8%; display: grid; grid-template-columns: 1fr 1fr; align-items: center; gap: 80px; }
        .about-image img { 
            width: 100%; 
            border-radius: 40px; 
            transition: 0.5s;
        }
        .about-image:hover img { transform: rotate(-2deg) scale(1.02); }
        .about-text h2 { font-size: 42px; font-weight: 800; color: var(--emerald-deep); margin-bottom: 25px; }

        /* FOOTER */
        footer { padding: 80px 8% 40px; background: var(--emerald-deep); color: white; text-align: center; }
        .footer-links { margin: 30px 0; display: flex; justify-content: center; gap: 30px; flex-wrap: wrap; }
        .footer-links a { color: rgba(255,255,255,0.6); text-decoration: none; transition: 0.3s; }
        .footer-links a:hover { color: white; }

      /* RESPONSIVE UPDATE FOR MOBILE */
        @media (max-width: 768px) {
            /* Navbar Mobile */
            nav {
                padding: 15px 0;
                flex-direction: column;
                gap: 15px;
            }
            .nav-links {
                width: 100%;
                justify-content: center;
                padding: 0 15%;
            }
            .nav-links a {
                margin-left: 0;
                margin: 0 10px;
                font-size: 13px;
            }
            .btn-login {
                padding: 8px 18px;
                font-size: 13px;
            }

            /* Hero Section Mobile */
            .hero {
                padding: 40px 5% 60px;
                grid-template-columns: 1fr;
                text-align: center;
                gap: 30px;
            }
            .hero-text h1 {
                font-size: 36px; /* Font dikecilkan agar tidak patah */
                line-height: 1.2;
            }
            .hero-text p {
                font-size: 16px;
                margin: 0 auto 30px;
            }
            .cta-group {
                flex-direction: column; /* Tombol jadi tumpuk atas-bawah */
                gap: 15px;
            }
            .btn-primary {
                width: 100%; /* Tombol memenuhi lebar layar */
                padding: 16px;
            }

            /* Features Mobile */
            .features {
                padding: 60px 5%;
            }
            .features h2 {
                font-size: 28px;
                margin-bottom: 40px;
            }
            .feature-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .feature-card {
                padding: 30px 20px;
            }

            /* About Mobile */
            .about {
                padding: 60px 5%;
                grid-template-columns: 1fr;
                text-align: center;
                gap: 40px;
            }
            .about-image img {
                box-shadow: none; /* Hilangkan bayangan tebal agar tidak memakan ruang */
                border-radius: 20px;
            }
            .about-text h2 {
                font-size: 28px;
            }
            .stats-grid {
                grid-template-columns: 1fr; /* Statistik tumpuk satu-satu */
                gap: 20px;
            }

            /* Footer Mobile */
            footer {
                padding: 40px 5%;
            }
            .footer-links {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }
            .footer-links a {
                margin: 0;
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
