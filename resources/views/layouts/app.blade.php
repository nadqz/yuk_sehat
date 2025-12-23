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
        --platinum-line: #e2e8f0; /* Lebih tipis warnanya */
        --text-main: #24332e;
        --text-muted: #7d8c85;
        --radius-xl: 16px; /* Perkecil dari 22px */
        --radius-lg: 12px; /* Perkecil dari 18px */
        --radius-md: 8px;  /* Perkecil dari 12px */
        --shadow-soft: 0 4px 20px rgba(0, 0, 0, 0.04);
        --shadow-subtle: 0 2px 10px rgba(0, 0, 0, 0.03);
        --blur-strong: 18px;
        --blur-soft: 10px;
        --topbar-height: 60px; /* Perkecil dari 77px */
        --sidebar-width: 240px; /* Perkecil dari 260px */
        --sidebar-collapsed: 70px; /* Perkecil dari 88px */
    }

    * { box-sizing: border-box; }
    
    html {
        -webkit-text-size-adjust: 100%;
        font-size: 14px; /* Standar Dashboard: 14px lebih proporsional daripada 16px */
    }

    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #f8fbfa;
        min-height: 100vh;
        overflow-x: hidden;
        color: var(--text-main);
        max-width: 100vw;
        letter-spacing: -0.01em; /* Membuat teks lebih tajam */
    }

    .orb {
        position: fixed; border-radius: 50%; filter: blur(60px);
        opacity: 0.4; pointer-events: none; z-index: 0;
    }
    .orb1 { width: 200px; height: 200px; background: #d8f3ea; top: -50px; left: -30px; }
    .orb2 { width: 250px; height: 250px; background: #e3f1ff; bottom: -80px; right: -40px; }

    /* TOPBAR - LEBIH RAMPING */
    .topbar {
        background: var(--glass-strong); 
        backdrop-filter: blur(var(--blur-soft));
        border-bottom: 1px solid var(--platinum-line); 
        width: 100% !important;
        position: fixed; 
        top: 0; left: 0 !important;
        height: var(--topbar-height);
        padding: 0 25px 0 85px; 
        display: flex; 
        justify-content: space-between;
        align-items: center; 
        z-index: 90;
        transition: none !important; 
    }

    /* SIDEBAR - LEBIH PADAT */
    .sidebar {
        width: var(--sidebar-width);
        background: var(--glass-strong);
        backdrop-filter: blur(var(--blur-strong));
        border-right: 1px solid var(--platinum-line);
        height: 100vh;
        padding: 20px 15px; /* Kurangi padding */
        position: fixed;
        left: 0; top: 0;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-soft);
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 100;
    }

    .sidebar.collapsed { width: var(--sidebar-collapsed); padding: 20px 10px; }

    .sidebar-header { 
        display: flex; align-items: center; gap: 12px; margin-bottom: 25px; 
        padding-bottom: 12px; border-bottom: 1px solid var(--platinum-line); 
    }

    .sidebar-logo { 
        width: 38px; height: 38px; border-radius: 10px; /* Perkecil Logo */
        background: linear-gradient(135deg, #fafffd, #cfeee4); 
        display: flex; align-items: center; justify-content: center; 
        font-weight: 700; color: var(--emerald-deep); font-size: 16px; 
        box-shadow: var(--shadow-subtle); flex-shrink: 0;
    }

    .sidebar.collapsed .sidebar-title-box { display: none; }

    .sidebar-toggle { 
        position: absolute; top: 25px; right: -12px; 
        width: 24px; height: 24px; border-radius: 50%; /* Tombol toggle lebih kecil */
        border: 1px solid var(--platinum-line); background: #ffffff; 
        display: flex; align-items: center; justify-content: center; 
        cursor: pointer; box-shadow: var(--shadow-subtle); z-index: 101;
        font-size: 10px;
    }

    /* NAVIGATION - RAMPING */
    .sidebar nav ul { list-style: none; padding: 0; margin: 0; }
    .sidebar nav li { margin-bottom: 6px; } /* Jarak menu lebih rapat */
    .sidebar nav a { 
        text-decoration: none; font-size: 0.95rem; font-weight: 500; 
        padding: 10px 14px; border-radius: 10px; display: flex; 
        align-items: center; gap: 12px; color: var(--text-main); transition: 0.2s; 
    }
    .sidebar nav a:hover { background: rgba(207, 238, 228, 0.5); transform: translateX(3px); }
    .sidebar nav a.active { background: #cfeee4; color: var(--emerald-deep); font-weight: 600; }
    
    .sidebar.collapsed .label { display: none; }

    /* MAIN CONTENT - PENYESUAIAN RUANG */
    .main-content {
        margin-left: var(--sidebar-width); 
        margin-top: var(--topbar-height); 
        padding: 25px; /* Kurangi dari 40px agar konten lebih luas */
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        position: relative; z-index: 1; 
        width: calc(100% - var(--sidebar-width));
    }
    .main-content.collapsed { 
        margin-left: var(--sidebar-collapsed); 
        width: calc(100% - var(--sidebar-collapsed)); 
    }

    /* FOOTER */
    footer.desktop-footer {
        padding: 15px 0;
        margin-left: var(--sidebar-width) !important;
    }

    /* MOBILE ADJUSTMENTS */
    @media (max-width: 768px) {
        .topbar { padding: 0 15px !important; }
        .sidebar-header, .sidebar-toggle { display: none !important; }

        .sidebar {
            width: 100% !important; height: 60px !important;
            top: auto !important; bottom: 0 !important;
            flex-direction: row !important; border-right: none !important;
            border-top: 1px solid var(--platinum-line);
            border-radius: 15px 15px 0 0; padding: 0 !important;
        }

        .sidebar nav ul { 
            display: flex !important; flex-direction: row !important; 
            justify-content: space-around; align-items: center; height: 100%; 
        }
        .sidebar nav a { 
            flex-direction: column !important; gap: 2px !important; 
            font-size: 9px !important; padding: 5px !important; 
        }
        .main-content {
            margin-left: 0 !important; width: 100% !important;
            margin-bottom: 70px; padding: 15px;
        }
        footer.desktop-footer {
            margin-left: 0 !important;
            padding-bottom: 80px !important;
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
