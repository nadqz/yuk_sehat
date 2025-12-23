<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="manifest" href="{{ secure_asset('manifest.json') }}" crossorigin="use-credentials">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="YukSehat">
    
    {{-- Icon standar untuk Tab Browser --}}
    <link rel="icon" type="image/x-icon" href="{{ secure_asset('assets/img/favicon.ico') }}">
    
    {{-- Icon untuk perangkat Apple (iPhone/iPad) --}}
    <link rel="apple-touch-icon" href="{{ secure_asset('assets/img/apple-touch-icon.png') }}">
    
    {{-- Icon untuk Android/PWA --}}
    <link rel="icon" type="image/png" sizes="192x192" href="{{ secure_asset('assets/img/icon-192.png') }}">

    <meta name="theme-color" content="#2f7f6a">
    <meta name="msapplication-navbutton-color" content="#2f7f6a">
    <meta name="apple-mobile-web-app-status-bar-style" content="#2f7f6a">

    <title>Yuk Sehat!! | @yield('title', 'Dashboard')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --bg-main: #f6f9f8;
            --bg-soft: #fbfdfc;
            --glass: rgba(255, 255, 255, 0.78);
            --glass-strong: rgba(255, 255, 255, 0.94);
            --emerald-soft: #cfeee4;
            --emerald-mid: #a8d8c8;
            --emerald-deep: #2f7f6a;
            --platinum-line: #c7ccd3;
            --text-main: #24332e;
            --text-muted: #7d8c85;
            --radius-xl: 22px;
            --radius-lg: 18px;
            --radius-md: 12px;
            --shadow-soft: 0 12px 32px rgba(0, 0, 0, 0.06);
            --shadow-subtle: 0 6px 20px rgba(0, 0, 0, 0.04);
            --blur-strong: 22px;
            --blur-soft: 14px;
            --topbar-height: 77px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #f8fbfa, #f3f7f6);
            min-height: 100vh;
            overflow-x: hidden;
            color: var(--text-main);

        }

        .orb {
            position: fixed; border-radius: 50%; filter: blur(40px);
            opacity: 0.55; pointer-events: none; z-index: 0;
        }
        .orb1 { width: 260px; height: 260px; background: #d8f3ea; top: -80px; left: -40px; }
        .orb2 { width: 320px; height: 320px; background: #e3f1ff; bottom: -120px; right: -60px; }

        /* TOPBAR - DIAM TOTAL (YouTube Style) */
        .topbar {
            background: var(--glass-strong); 
            backdrop-filter: blur(var(--blur-soft));
            border-bottom: 1px solid var(--platinum-line); 
            width: 100% !important;
            position: fixed; 
            top: 0; left: 0 !important;
            height: var(--topbar-height);
            padding: 0 35px 0 100px; /* Padding kiri agar logo tak tertutup sidebar saat ciut */
            display: flex; 
            justify-content: space-between;
            align-items: center; 
            z-index: 90; /* Dibawah Sidebar */
            transition: none !important; 
        }

        /* SIDEBAR - LAPISAN TERATAS */
        .sidebar {
            width: 180px;
            background: var(--glass-strong);
            backdrop-filter: blur(var(--blur-strong));
            border-right: 1px solid var(--platinum-line);
            height: 100vh;
            padding: 15px 25px;
            position: fixed;
            left: 0; top: 0;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-soft);
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 100; /* Diatas Topbar */
        }

        .sidebar.collapsed { width: 88px; padding: 30px 15px; }

        .sidebar-header { 
            display: flex; align-items: center; gap: 15px; margin-bottom: 40px; 
            padding-bottom: 15px; border-bottom: 1px solid var(--platinum-line); 
        }

        .sidebar-logo { 
            width: auto; height: 35px; border-radius: 16px; 
            background: linear-gradient(135deg, #fafffd, #cfeee4); 
            display: flex; align-items: center; justify-content: center; 
            font-weight: 700; color: var(--emerald-deep); 
            box-shadow: var(--shadow-subtle); flex-shrink: 0;
        }

        .sidebar.collapsed .sidebar-title-box { display: none; }
        .sidebar.collapsed { 
            width: 60px; 
            padding: 30px 10px; /* Padding dikurangi agar icon tetap di tengah */
        }

        .sidebar-toggle { 
            position: absolute; top: 35px; right: -15px; 
            width: 32px; height: 32px; border-radius: 50%; 
            border: 1px solid var(--platinum-line); background: #ffffff; 
            display: flex; align-items: center; justify-content: center; 
            cursor: pointer; box-shadow: var(--shadow-subtle); z-index: 101;
        }

        /* NAVIGATION */
        .sidebar nav ul { list-style: none; padding: 0; margin: 0; }
        .sidebar nav li { margin-bottom: 12px; }
        .sidebar nav a { 
            text-decoration: none; font-size: 12px; font-weight: 500; 
            padding: 12px 16px; border-radius: 14px; display: flex; 
            align-items: center; gap: 15px; color: var(--text-main); transition: 0.25s; 
        }
        .sidebar nav a:hover { background: rgba(207, 238, 228, 0.5); transform: translateX(5px); }
        .sidebar nav a.active { background: #cfeee4; color: var(--emerald-deep); font-weight: 600; }
        
        .sidebar.collapsed .label { display: none; }

        .sidebar nav a .icon svg {
            width: 16px;
            height: 16px;
            transition: 0.3s;
        }

        /* Opsional: Jika ingin icon lebih kecil lagi saat sidebar dikolaps (collapsed) */
        .sidebar.collapsed nav a .icon i,
        .sidebar.collapsed nav a .icon svg {
            width: 18px;
            height: 18px;
        }

        /* MAIN CONTENT - BERGESER SINKRON DENGAN SIDEBAR */
        .main-content {
            margin-left: 260px; 
            margin-top: var(--topbar-height); 
            padding: 40px;
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            position: relative; z-index: 1; 
            width: calc(100% - 260px);
        }
        .main-content.collapsed { margin-left: 88px; width: calc(100% - 88px); }
        .sidebar.collapsed ~ div footer.desktop-footer {
            margin-left: 88px !important;
        }

        /* ========================================= */
        /* --- RESPONSIVE MOBILE (BOTTOM MENU) ---   */
        /* ========================================= */
        @media (max-width: 768px) {
            .topbar { padding: 0 20px !important; }
            .sidebar-header, .sidebar-toggle { display: none !important; }

            .sidebar {
                width: 100% !important; height: 60px !important;
                top: auto !important; bottom: 0 !important;
                flex-direction: row !important; border-right: none !important;
                border-top: 1px solid var(--platinum-line);
                border-radius: 20px 20px 0 0; padding: 0 !important;
            }

            .sidebar nav { width: 100%; }
            .sidebar nav ul { 
                display: flex !important; flex-direction: row !important; 
                justify-content: space-around; align-items: center; height: 100%; 
            }
            .sidebar nav li { margin-bottom: 0; }
            .sidebar nav a { 
                flex-direction: column !important; gap: 2px !important; 
                font-size: 10px !important; padding: 10px !important; 
            }
            .sidebar nav a .label { display: block !important; }
            .sidebar nav a:hover { transform: none; }

            .main-content {
                margin-left: 0 !important; width: 100% !important;
                margin-bottom: 80px; padding: 20px;
            }

            footer.desktop-footer {
                margin-left: 0 !important;
                padding-bottom: 90px !important; /* Jarak agar tidak tertutup menu mobile */
            }
            
        }

        @yield('page_styles')
    </style>
</head>
<body>
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>

    @include('layouts.sidebar')

    <div style="flex: 1; display: flex; flex-direction: column;">
        @include('layouts.topbar')

        <main class="main-content" id="mainContent">
            @yield('content')
        </main>

        <footer class="desktop-footer" style="padding: 20px 0; text-align: center; border-top: 1px solid #f1f5f9; margin-left: 260px; transition: 0.3s;">
            <p style="font-size: 12px; color: #94a3b8; margin: 0;">
                &copy; {{ date('Y') }} <span style="color: var(--emerald-deep); font-weight: 700;"> Yuk Sehat!!</span> 
                <span class="desktop-only">• v1.0.1 Beta</span>
            </p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
            
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const toggleIcon = document.getElementById("toggleIcon");

            if(sidebarToggle) {
                sidebarToggle.addEventListener("click", () => {
                    // Hanya toggle di desktop
                    if(window.innerWidth > 768) {
                        sidebar.classList.toggle("collapsed");
                        if(mainContent) mainContent.classList.toggle("collapsed");
                        toggleIcon.textContent = sidebar.classList.contains("collapsed") ? "⮞" : "⮜";
                    }
                });
            }
        });
    </script>
    @stack('scripts')
    @yield('page_scripts')
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register("{{ secure_asset('service-worker.js') }}").then(function(registration) {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, function(err) {
                console.log('ServiceWorker registration failed: ', err);
            });
        });
    }
</script>
</body>
</html>
