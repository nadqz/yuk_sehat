<header class="topbar" id="topbar">
    <div class="topbar-left">
        <a href="{{ route('dashboard') }}" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 15px;">
            
            {{-- Area Logo --}}
            <div class="topbar-logo-mobile">
                {{-- DIUBAH: Menggunakan secure_asset agar logo muncul di jalur HTTPS --}}
                <img src="{{ secure_asset('assets/img/full-logo.png') }}" 
                     alt="Logo Yuk Sehat" 
                     class="main-logo-img"
                     style="height: 40px; width: auto; object-fit: contain; padding-left: 10px">
            </div>

            {{-- Judul Halaman --}}
            <div class="topbar-title-desktop">
                <div class="title-wrapper">
                    <h4 class="main-page-title">@yield('title')</h4>
                    <span class="sub-page-title">Panel Kesehatan</span>
                </div>
            </div>
        </a>
    </div>

    <div class="user-box">
        {{-- Area User Info & Dropdown tetap sama karena tidak menggunakan fungsi asset() --}}
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
            
            <hr style="border: 0; border-top: 1px solid var(--platinum-line);">
            
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>

            <a href="#" onclick="confirmLogout(event)" 
                style="display: block; padding-left: 20px; border-radius: 15px; text-decoration: none; color: #e11d48; font-weight: 600; transition: 0.2s;" 
                onmouseover="this.style.background='#fff1f2'" 
                onmouseout="this.style.background='transparent'">
                <div style="display: flex; align-items: left; gap: 15px;">
                    <i data-lucide="log-out" style="width: 14px;"></i>
                    <span class="logout-text" style="font-size: 12px;">Log Out</span>
                </div>
            </a>
        </div>
    </div>
</header>

<style>
    .topbar {
        height: 70px !important;
        width: 100%; 
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--glass-strong);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--platinum-line);
        z-index: 90;
        padding: 0 40px 0 280px; /* Padding kiri default Desktop */
        transition: padding 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* User Dropdown Skala Besar */
    .user-dropdown {
        position: absolute;
        top: 120%;
        right: 0;
        background: var(--glass-strong);
        backdrop-filter: blur(20px);
        border: 1px solid var(--platinum-line);
        border-radius: 20px;
        box-shadow: var(--shadow-soft);
        padding: 12px;
        width: 260px; /* Diperlebar agar lebih mewah */
        display: none;
        z-index: 1000;
        animation: slideDown 0.3s cubic-bezier(0.18, 0.89, 0.32, 1.28);
    }
    
    .user-dropdown.show { display: block; }
    
    .dropdown-item {
        display: block;
        padding: 12px 16px;
        border-radius: 14px;
        text-decoration: none;
        transition: 0.2s;
    }
    
    .dropdown-item:hover { background: rgba(207, 238, 228, 0.6); }
    
    .item-content {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .item-icon { font-size: 16px; }
    
    .item-text { display: flex; flex-direction: column; }
    
    .item-title {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-main);
    }
    
    .item-sub {
        font-size: 10px;
        color: var(--text-muted);
    }

    .sidebar.collapsed + div .topbar {
    padding-left: 108px;
}

/* Desktop Element Styles */
.main-logo-img {
    height: 50px; 
    width: auto; 
    object-fit: contain; 
}

.title-wrapper {
    display: flex; 
    flex-direction: column; 
    border-left: 3px solid var(--emerald-mid); 
    padding-left: 15px;
}

.main-page-title {
    margin: 0; 
    font-size: 20px; 
    font-weight: 700; 
    color: var(--emerald-deep); 
    letter-spacing: -0.5px;
}

.sub-page-title {
    font-size: 10px; 
    color: var(--text-muted); 
    font-weight: 500; 
    text-transform: uppercase;
}

/* User & Avatar Styling */
.user-box { position: relative; z-index: 95; }
.user-info-trigger {
    display: flex; 
    align-items: center; 
    gap: 18px; 
    cursor: pointer; 
    padding: 5px 10px; 
    border-radius: 15px; 
    transition: 0.3s;
}

.user-info { display: flex; flex-direction: column; align-items: flex-end; }
.user-info .name { font-size: 14px; font-weight: 600; color: var(--text-main); }
.user-info .tagline { font-size: 10px; color: var(--text-muted); }

.user-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: #cfeee4; display: flex; align-items: center;
    justify-content: center; font-weight: 700; font-size: 16px;
    border: 2px solid var(--platinum-line); box-shadow: var(--shadow-subtle);
    color: var(--emerald-deep);
}

/* Dropdown Animation */
.user-dropdown {
    position: absolute; top: 120%; right: 0; width: 260px;
    background: var(--glass-strong); backdrop-filter: blur(20px);
    border: 1px solid var(--platinum-line); border-radius: 20px;
    box-shadow: var(--shadow-soft); padding: 12px; display: none;
    z-index: 1000; animation: slideDown 0.3s cubic-bezier(0.18, 0.89, 0.32, 1.28);
}
.user-dropdown.show { display: block; }
.swal2-popup {
    font-family: 'Poppins', sans-serif !important;
    border-radius: 22px !important;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-15px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

/* --- LOGIKA RESPONSIVE MOBILE (PENTING) --- */
@media (max-width: 768px) {
    .topbar {
        height: 60px !important;
        padding: 0 20px !important; /* Reset padding di Mobile */
    }

    .topbar-title-desktop, .user-info {
        display: none !important; /* Hilangkan teks di HP */
    }

    .main-logo-img { height: 14px; }

    .user-info-trigger { gap: 0 !important; padding: 0 !important; }

    .user-avatar {
        width: 30px !important;
        height: 30px !important;
        font-size: 14px !important;
    }

    .swal2-popup.small-mobile-swal {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    .swal2-html-container {
        font-size: 12px !important;
        color: #64748b !important;
    }

    /* Ukuran Tombol yang lebih kecil dan rapi */
    .swal2-confirm, .swal2-cancel {
        font-size: 12px !important;
        font-weight: 700 !important;
        padding: 10px 20px !important;
        border-radius: 5px !important;
    }

    .swal2-icon {
        transform: scale(0.7); /* Mengecilkan ikon peringatan agar tidak dominan */
        margin: 5px auto !important;
    }
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
