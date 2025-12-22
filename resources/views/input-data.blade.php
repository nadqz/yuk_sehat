@extends('layouts.app')

@section('title', 'Evaluasi Harian')

@section('content')
<div class="journal-input-container">
    
    <header class="journal-header">
        <h2 class="header-title">Refleksi Harian</h2>
        <p class="header-subtitle">Luangkan 2 menit untuk mencatat perjalanan kesehatanmu hari ini.</p>
    </header>

    <form action="{{ route('input.data.store') }}" method="POST">
        @csrf
        
        {{-- SECTION 0: TANGGAL --}}
        <div class="form-card-platinum date-section">
            <div class="date-flex-wrapper">
                <div class="date-input-box">
                    <label class="input-label-caps">Tanggal Catatan</label>
                    <input type="date" name="log_date" value="{{ date('Y-m-d') }}" class="plat-input" required>
                </div>
                <div class="date-info">
                    Pilih tanggal hari ini atau tanggal sebelumnya jika Anda lupa mencatat.
                </div>
            </div>
        </div>

        {{-- SECTION 1: BODY (FISIK) --}}
        <div class="form-card-platinum">
            <div class="card-badge primary">Body</div>
            <h3 class="section-title">Aktivitas Fisik</h3>
            <div class="platinum-grid">
                <div class="form-group-platinum">
                    <label>Langkah Kaki</label>
                    <input type="number" name="steps" placeholder="cth: 8000" class="plat-input">
                </div>
                <div class="form-group-platinum">
                    <label>Olahraga (Menit)</label>
                    <input type="number" name="exercise" placeholder="cth: 30" class="plat-input">
                </div>
                <div class="form-group-platinum">
                    <label>Hidrasi (Gelas Air)</label>
                    <input type="number" name="water" placeholder="cth: 8" class="plat-input">
                </div>
            </div>
        </div>

        {{-- SECTION 2: MIND (MENTAL) --}}
        <div class="form-card-platinum">
            <div class="card-badge secondary">Mind</div>
            <h3 class="section-title">Kesehatan Mental</h3>
            <div class="platinum-grid">
                <div class="form-group-platinum">
                    <label>Mood</label>
                    <select name="mood" class="plat-input">
                        <option value="happy">Sangat Baik 😊</option>
                        <option value="neutral" selected>Biasa Saja 😐</option>
                        <option value="tired">Lelah 🥱</option>
                        <option value="stressed">Tertekan/Stres 😰</option>
                    </select>
                </div>
                <div class="form-group-platinum">
                    <label>Tingkat Stres (1-5)</label>
                    <input type="range" name="stress" min="1" max="5" class="plat-range">
                </div>
                <div class="form-group-platinum">
                    <label>Fokus Kerja (1-5)</label>
                    <input type="range" name="focus" min="1" max="5" class="plat-range">
                </div>
            </div>
            <div class="form-group-platinum gratitude-box">
                <label>Satu hal yang disyukuri hari ini:</label>
                <textarea name="gratitude" class="plat-input" rows="3" placeholder="Tuliskan di sini..."></textarea>
            </div>
        </div>

        {{-- SECTION 3: REST (ISTIRAHAT) --}}
        <div class="form-card-platinum">
            <div class="card-badge tertiary">Rest</div>
            <h3 class="section-title">Kualitas Tidur</h3>
            <div class="platinum-grid">
                <div class="form-group-platinum">
                    <label>Jam Tidur</label>
                    <input type="time" name="sleep_time" class="plat-input">
                </div>
                <div class="form-group-platinum">
                    <label>Jam Bangun</label>
                    <input type="time" name="wake_time" class="plat-input">
                </div>
                <div class="form-group-platinum">
                    <label>Kualitas Bangun</label>
                    <select name="sleep_quality" class="plat-input">
                        <option>Segar Bugar ⚡</option>
                        <option selected>Cukup 🆗</option>
                        <option>Masih Ngantuk 😴</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="submit-wrapper">
            <button type="submit" class="save-btn-platinum">
                Simpan & Dapatkan Insight
            </button>
        </div>
    </form>
</div>
@endsection

@section('page_styles')
<style>
    :root {
        --emerald-deep: #1a4d3e;
        --emerald-mid: #2f7f6a;
        --emerald-soft: #cfeee4;
        --text-main: #334155;
        --text-muted: #64748b;
        --platinum-line: #e2e8f0;
        --glass: rgba(255, 255, 255, 0.8);
        --radius-xl: 24px;
        --shadow-soft: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .journal-input-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px 15px 80px 15px;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .header-title { font-size: 24px; font-weight: 800; color: var(--emerald-deep); margin: 0; letter-spacing: -0.5px; }
    .header-subtitle { color: var(--text-muted); font-size: 14px; margin-top: 5px; margin-bottom: 25px; }

    .form-card-platinum {
        background: var(--glass);
        backdrop-filter: blur(10px);
        border-radius: var(--radius-xl);
        padding: 25px;
        border: 1px solid var(--platinum-line);
        box-shadow: var(--shadow-soft);
        margin-bottom: 20px;
        position: relative;
    }

    .section-title { margin: 0 0 20px 0; font-size: 18px; font-weight: 700; color: var(--emerald-deep); }

    /* Badge Positioning */
    .card-badge {
        position: absolute; top: 20px; right: 20px;
        padding: 5px 12px; border-radius: 999px;
        font-size: 10px; font-weight: 800;
        text-transform: uppercase; letter-spacing: 1px;
    }
    .card-badge.primary { background: #cfeee4; color: #2f7f6a; }
    .card-badge.secondary { background: #dcefff; color: #2e5f7f; }
    .card-badge.tertiary { background: #ffe8f0; color: #7f2e51; }

    /* Grid Layout */
    .platinum-grid { display: grid; grid-template-columns: 1fr; gap: 15px; }

    .input-label-caps {
        display: block; font-size: 11px; font-weight: 800; 
        color: var(--emerald-deep); text-transform: uppercase; 
        margin-bottom: 8px; letter-spacing: 1px;
    }

    .date-flex-wrapper { display: flex; flex-direction: column; gap: 15px; }
    .date-info {
        color: var(--text-muted); font-size: 12px; font-style: italic;
        border-left: 2px solid var(--emerald-soft); padding-left: 12px;
    }

    .form-group-platinum label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px; color: var(--text-main); }
    .gratitude-box { margin-top: 20px; }

    .plat-input {
        width: 100%; padding: 12px 14px; border-radius: 12px;
        border: 1px solid var(--platinum-line); background: #fff;
        font-family: inherit; font-size: 14px; outline: none; transition: 0.3s;
        box-sizing: border-box;
    }
    .plat-input:focus { border-color: var(--emerald-mid); box-shadow: 0 0 0 3px rgba(47, 127, 106, 0.1); }
    
    .plat-range { width: 100%; accent-color: var(--emerald-mid); height: 6px; border-radius: 5px; }

    .submit-wrapper { margin-top: 30px; }
    .save-btn-platinum {
        width: 100%; /* Mobile first */
        background: var(--emerald-deep); color: white; padding: 16px 20px;
        border-radius: 16px; border: none; font-size: 15px; font-weight: 700;
        cursor: pointer; transition: 0.3s;
    }

    /* Tablet & Desktop Adjustments */
    @media (min-width: 768px) {
        .journal-input-container { padding: 40px 20px; }
        .header-title { font-size: 32px; }
        .form-card-platinum { padding: 40px; margin-bottom: 30px; }
        .platinum-grid { grid-template-columns: repeat(3, 1fr); gap: 25px; }
        .date-flex-wrapper { flex-direction: row; align-items: center; gap: 30px; }
        .save-btn-platinum { width: auto; padding: 16px 45px; border-radius: 999px; }
        .submit-wrapper { text-align: right; }
        .card-badge { top: 35px; right: 40px; font-size: 11px; }
    }
</style>
@endsection