@extends('layouts.app')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="profile-page-wrapper">
    {{-- Header Halaman --}}
    <div class="profile-header-box">
        <h1 class="page-title">Pengaturan Akun</h1>
        <p class="page-subtitle">Kelola informasi pribadi, keamanan kata sandi, dan privasi akun Anda.</p>
    </div>

    <div class="profile-grid">
        {{-- Kiri: Update Informasi & Password --}}
        <div class="profile-main-col">
            <div class="profile-section-card shadow-card">
                <div class="card-header">
                    <i data-lucide="user" class="header-icon"></i>
                    <h2>Informasi Profil</h2>
                </div>
                <div class="form-inner">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="profile-section-card shadow-card">
                <div class="card-header">
                    <i data-lucide="lock" class="header-icon"></i>
                    <h2>Keamanan Kata Sandi</h2>
                </div>
                <div class="form-inner">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        {{-- Kanan: Sidebar Informasi --}}
        <div class="profile-side-col">
            <div class="tips-card animate-fade">
                <div class="tips-header">
                    <i data-lucide="shield-check" style="width: 20px;"></i>
                    <h3>Tips Keamanan</h3>
                </div>
                <p>Gunakan kombinasi simbol dan angka untuk kata sandi yang lebih kuat guna melindungi data kesehatan Anda.</p>
            </div>

            <div class="profile-section-card danger-zone">
                <div class="card-header">
                    <i data-lucide="alert-triangle" class="header-icon red"></i>
                    <h2 style="color: #b03a2e;">Hapus Akun</h2>
                </div>
                <div class="form-inner">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_styles')
<style>
    /* Reset & Page Wrapper */
    .profile-page-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding-bottom: 120px;
        animation: fadeIn 0.5s ease-out;
    }

    .profile-header-box { margin-bottom: 35px; }
    .page-title { font-size: 32px; font-weight: 800; color: var(--emerald-deep); margin: 0; letter-spacing: -1px; }
    .page-subtitle { color: var(--text-muted); font-size: 16px; margin-top: 8px; }

    /* --- GRID SYSTEM REBORN --- */
    .profile-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr; /* Memastikan kolom utama lebih dominan */
        gap: 30px;
        align-items: start;
    }

    .profile-section-card {
        background: #ffffff; /* Menggunakan putih solid agar form terlihat jelas */
        border-radius: 24px;
        padding: 40px;
        border: 1px solid var(--platinum-line);
        margin-bottom: 30px;
        position: relative;
    }

    .shadow-card {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .shadow-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.07);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .header-icon { width: 24px; color: var(--emerald-deep); }
    .header-icon.red { color: #b03a2e; }

    .profile-section-card h2 {
        font-size: 22px;
        font-weight: 700;
        margin: 0;
        color: var(--text-main);
    }

    /* Info Side Card */
    .tips-card {
        background: linear-gradient(135deg, var(--emerald-soft), #e3f8f1);
        padding: 30px;
        border-radius: 24px;
        margin-bottom: 30px;
        border-left: 6px solid var(--emerald-mid);
    }
    
    .tips-header { display: flex; align-items: center; gap: 10px; color: var(--emerald-deep); margin-bottom: 12px; }
    .tips-card h3 { font-size: 18px; font-weight: 700; margin: 0; }
    .tips-card p { font-size: 14px; margin: 0; color: var(--emerald-deep); line-height: 1.6; opacity: 0.9; }

    /* Danger Zone */
    .danger-zone {
        border: 1px solid rgba(176, 58, 46, 0.2);
        background: #fff5f5;
    }

    .form-inner form div.flex.items-center.gap-4 {
        margin-top: 20px !important; /* Kita paksa dengan !important */
        padding-top: 10px;           /* Tambahan ruang jika margin saja tidak cukup */
        border-top: 1px solid #f1f5f9; /* Opsional: garis tipis agar lebih mewah */
    }

    /* Animasi */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- RESPONSIVE MOBILE --- */
    @media (max-width: 1024px) {
        .profile-grid {
            grid-template-columns: 1fr; /* Jadi satu kolom di Tablet/HP */
            gap: 20px;
        }
        .profile-page-wrapper { padding: 0 20px 100px 20px; }
        .page-title { font-size: 26px; }
        .profile-section-card { padding: 25px; }
    }
</style>
@endsection