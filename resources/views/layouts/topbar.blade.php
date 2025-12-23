<header class="topbar" id="topbar">
    <div class="topbar-left">
        <a href="{{ route('dashboard') }}" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 12px;">
            
            {{-- Area Logo --}}
            <div class="topbar-logo-mobile" style="margin-top: 5px;">
                <img src="{{ secure_asset('assets/img/full-logo.png') }}" 
                     alt="Logo Yuk Sehat" 
                     class="main-logo-img">
            </div>

            {{-- Judul Halaman --}}
            <div class="topbar-title-desktop">
                <div class="title-wrapper">
                    <h1 class="main-page-title">@yield('title')</h1>
                    <span class="sub-page-title">Panel Kesehatan</span>
                </div>
            </div>
        </a>
    </div>

    <div class="user-box">
        <div class="user-info-trigger" onclick="toggleUserDropdown()">
            <div class="user-info">
                <span class="name">{{ Auth::user()->name }}</span>
                <span class="tagline">User Yuk Sehat!!</span>
            </div>
            
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>

        <div id="userDropdown" class="user-dropdown">
            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                <div class="item-content">
                    <span class="item-icon">
                        <i data-lucide="settings" style="width: 18px; color: var(--emerald-deep);"></i>
                    </span>
                    <div class="item-text">
                        <span class="item-title">Pengaturan Profil</span>
                        <span class="item-sub">Kelola akun & keamanan</span>
                    </div>
                </div>
            </a>
            
            <hr style="border: 0; border-top: 1px solid var(--platinum-line); margin: 8px 0;">
            
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>

            <a href="#" onclick="confirmLogout(event)" 
                class="logout-link">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i data-lucide="log-out" style="width: 16px;"></i>
                    <span>Log Out</span>
                </div>
            </a>
        </div>
    </div>
</header>

<style>
    /* TOPBAR RAMPING */
    .topbar {
        height: var(--topbar-height) !important; /* Mengikuti variabel 60px di app.blade */
        width: 100%; 
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--glass-strong);
        backdrop-filter: blur(var(--blur-soft));
        border-bottom: 1px solid var(--platinum-line);
        z-index: 90;
        padding: 0 25px 0 255px; /* Disesuaikan dengan lebar sidebar baru */
        transition: padding 0.3s ease;
    }

    .sidebar.collapsed + div .topbar {
        padding-left: 85px; /* Disesuaikan dengan sidebar collapsed baru */
    }

    /* Logo & Title */
    .main-logo-img {
        height: 35px; /* Perkecil dari 50px */
        width: auto; 
        object-fit: contain; 
    }

    .title-wrapper {
        display: flex; 
        flex-direction: column; 
        border-left: 2px solid var(--emerald-mid); 
        padding-left: 12px;
    }

    .main-page-title {
        margin: 0; 
        font-size: 18px; /* Perkecil dari 22px */
        font-weight: 700; 
        color: var(--emerald-deep); 
        letter-spacing: -0.3px;
        line-height: 1.2;
    }

    .sub-page-title {
        font-size: 10px; 
        color: var(--text-muted); 
        font-weight: 500; 
        text-transform: uppercase;
    }

    /* User Info */
    .user-info-trigger {
        display: flex; 
        align-items: center; 
        gap: 12px; 
        cursor: pointer; 
        padding: 4px 8px; 
        border-radius: 12px; 
        transition: 0.2s;
    }
    .user-info-trigger:hover { background: rgba(0,0,0,0.02); }

    .user-info { display: flex; flex-direction: column; align-items: flex-end; }
    .user-info .name { font-size: 13px; font-weight: 600; color: var(--text-main); }
    .user-info .tagline { font-size: 10px; color: var(--text-muted); }

    .user-avatar {
        width: 36px; height: 36px; /* Perkecil dari 48px */
        border-radius: 50%;
        background: #cfeee4; display: flex; align-items: center;
        justify-content: center; font-weight: 700; font-size: 14px;
        border: 1.5px solid var(--platinum-line);
        color: var(--emerald-deep);
    }

    /* Dropdown Lebih Padat */
    .user-dropdown {
        position: absolute; top: 110%; right: 0; width: 220px; /* Perkecil dari 260px */
        background: white;
        border: 1px solid var(--platinum-line);
        border-radius: 15px;
        box-shadow: var(--shadow-soft);
        padding: 8px;
        display: none;
        z-index: 1000;
    }
    .user-dropdown.show { display: block; }

    .dropdown-item {
        padding: 10px 12px;
        border-radius: 10px;
        text-decoration: none;
    }
    .item-title { font-size: 13px; }
    .item-sub { font-size: 10px; }

    .logout-link {
        display: block; 
        padding: 12px; 
        border-radius: 10px; 
        text-decoration: none; 
        color: #e11d48; 
        font-weight: 600; 
        font-size: 13px;
        transition: 0.2s;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .topbar {
            height: 60px !important;
            padding: 0 15px !important;
        }
        .main-logo-img { height: 32px; }
        .topbar-title-desktop, .user-info { display: none !important; }
        .user-avatar { width: 34px !important; height: 34px !important; }
    }
</style>
<script src="https://unpkg.com/lucide@latest"></script>

<script>

    lucide.createIcons();

    function confirmLogout(event) {
        event.preventDefault(); // Mencegah link pindah halaman

        Swal.fire({
            title: 'Anda yakin ingin keluar?',
            text: "Sesi Anda akan berakhir dan Anda perlu login kembali.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2f7f6a', // Warna Emerald Deep Anda
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal',
            borderRadius: '20px',
            customClass: {
                popup: 'swal-platinum-popup'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user klik Ya, jalankan form logout
                document.getElementById('logout-form').submit();
            }
        })
    }

    function toggleUserDropdown() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('show');
    }

    window.onclick = function(event) {
        if (!event.target.closest('.user-box')) {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown && dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    }
</script>
