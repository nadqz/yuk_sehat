@extends('layouts.app')

@section('title', 'Edit Jurnal Kesehatan')

@section('content')
<div class="edit-jurnal-container">
    
    <header class="edit-header">
        <h2 class="edit-title">Edit Catatan Jurnal</h2>
        <p class="edit-subtitle">Perbarui rekaman kesehatan Anda untuk tanggal <strong>{{ \Carbon\Carbon::parse($log->log_date)->translatedFormat('d F Y') }}</strong>.</p>
    </header>

    <form action="{{ route('input.data.update', $log->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- SECTION 0: TANGGAL --}}
        <div class="form-card-platinum date-card">
            <div class="date-input-wrapper">
                <label class="input-label-caps">Tanggal Catatan</label>
                <input type="date" name="log_date" value="{{ $log->log_date }}" class="plat-input" required>
            </div>
        </div>

        {{-- SECTION 1: BODY (FISIK) --}}
        <div class="form-card-platinum">
            <div class="card-badge primary">Body</div>
            <h3 class="section-card-title">Aktivitas Fisik</h3>
            <div class="platinum-grid">
                <div class="form-group-platinum">
                    <label>Langkah Kaki</label>
                    <input type="number" name="steps" value="{{ $log->steps }}" placeholder="cth: 8000" class="plat-input">
                </div>
                <div class="form-group-platinum">
                    <label>Olahraga (Menit)</label>
                    <input type="number" name="exercise" value="{{ $log->exercise_minutes }}" placeholder="cth: 30" class="plat-input">
                </div>
                <div class="form-group-platinum">
                    <label>Hidrasi (Gelas Air)</label>
                    <input type="number" name="water" value="{{ $log->water_intake }}" placeholder="cth: 8" class="plat-input">
                </div>
            </div>
        </div>

        {{-- SECTION 2: MIND (MENTAL) --}}
        <div class="form-card-platinum">
            <div class="card-badge secondary">Mind</div>
            <h3 class="section-card-title">Kesehatan Mental</h3>
            <div class="platinum-grid">
                <div class="form-group-platinum">
                    <label>Mood</label>
                    <select name="mood" class="plat-input">
                        <option value="happy" {{ $log->mood == 'happy' ? 'selected' : '' }}>Sangat Baik 😊</option>
                        <option value="neutral" {{ $log->mood == 'neutral' ? 'selected' : '' }}>Biasa Saja 😐</option>
                        <option value="tired" {{ $log->mood == 'tired' ? 'selected' : '' }}>Lelah 🥱</option>
                        <option value="stressed" {{ $log->mood == 'stressed' ? 'selected' : '' }}>Tertekan/Stres 😰</option>
                    </select>
                </div>
                <div class="form-group-platinum">
                    <label>Tingkat Stres (1-5)</label>
                    <input type="range" name="stress" min="1" max="5" value="{{ $log->stress_level }}" class="plat-range">
                </div>
                <div class="form-group-platinum">
                    <label>Fokus Kerja (1-5)</label>
                    <input type="range" name="focus" min="1" max="5" value="{{ $log->focus_level }}" class="plat-range">
                </div>
            </div>
            <div class="form-group-platinum gratitude-wrapper">
                <label>Satu hal yang disyukuri hari ini:</label>
                <textarea name="gratitude" class="plat-input" rows="3" placeholder="Tuliskan di sini...">{{ $log->gratitude_note }}</textarea>
            </div>
        </div>

        {{-- SECTION 3: REST (ISTIRAHAT) --}}
        <div class="form-card-platinum">
            <div class="card-badge tertiary">Rest</div>
            <h3 class="section-card-title">Kualitas Tidur</h3>
            <div class="platinum-grid">
                <div class="form-group-platinum">
                    <label>Jam Tidur</label>
                    <input type="time" name="sleep_time" value="{{ $log->sleep_time }}" class="plat-input">
                </div>
                <div class="form-group-platinum">
                    <label>Jam Bangun</label>
                    <input type="time" name="wake_time" value="{{ $log->wake_time }}" class="plat-input">
                </div>
                <div class="form-group-platinum">
                    <label>Kualitas Bangun</label>
                    <select name="sleep_quality" class="plat-input">
                        <option value="Segar Bugar" {{ $log->sleep_quality == 'Segar Bugar' ? 'selected' : '' }}>Segar Bugar ⚡</option>
                        <option value="Cukup" {{ $log->sleep_quality == 'Cukup' ? 'selected' : '' }}>Cukup 🆗</option>
                        <option value="Masih Ngantuk" {{ $log->sleep_quality == 'Masih Ngantuk' ? 'selected' : '' }}>Masih Ngantuk 😴</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-actions-mobile">
            <a href="{{ route('journal') }}" class="btn-cancel-mobile">Batal</a>
            <button type="submit" class="save-btn-platinum">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<style>
    .edit-jurnal-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 15px 15px 60px 15px;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .edit-header { margin-bottom: 25px; }
    .edit-title { font-size: 24px; font-weight: 800; color: #1a4d3e; margin: 0; letter-spacing: -1px; }
    .edit-subtitle { color: #64748b; font-size: 14px; margin-top: 5px; }

    .form-card-platinum {
        background: white;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        margin-bottom: 20px;
        position: relative;
    }

    .section-card-title { color: #1a4d3e; font-weight: 700; font-size: 18px; margin-bottom: 20px; }

    .card-badge {
        position: absolute; 
        top: 15px; 
        right: 20px;
        padding: 4px 12px; 
        border-radius: 999px;
        font-size: 10px; 
        font-weight: 800;
        text-transform: uppercase; 
        letter-spacing: 1px;
    }
    .card-badge.primary { background: #cfeee4; color: #2f7f6a; }
    .card-badge.secondary { background: #dcefff; color: #2e5f7f; }
    .card-badge.tertiary { background: #ffe8f0; color: #7f2e51; }

    .platinum-grid { 
        display: grid; 
        grid-template-columns: 1fr; 
        gap: 15px; 
    }

    .input-label-caps {
        display: block; font-size: 11px; font-weight: 800; 
        color: #1a4d3e; text-transform: uppercase; 
        margin-bottom: 8px; letter-spacing: 1px;
    }

    .form-group-platinum label { 
        display: block; font-size: 13px; font-weight: 600; 
        margin-bottom: 8px; color: #475569; 
    }

    .plat-input {
        width: 100%; padding: 12px; border-radius: 12px;
        border: 1px solid #e2e8f0; background: #f8fafc;
        font-family: inherit; font-size: 14px; outline: none; 
        transition: 0.3s; box-sizing: border-box;
    }
    .plat-input:focus { border-color: #2f7f6a; background: white; box-shadow: 0 0 0 3px rgba(47, 127, 106, 0.1); }
    
    .plat-range { width: 100%; accent-color: #2f7f6a; cursor: pointer; }

    .gratitude-wrapper { margin-top: 15px; }

    .form-actions-mobile {
        margin-top: 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .save-btn-platinum {
        background: #2f7f6a; 
        color: white; 
        padding: 16px;
        border-radius: 14px; 
        border: none; 
        font-size: 16px; 
        font-weight: 700;
        cursor: pointer; 
        box-shadow: 0 8px 15px rgba(47, 127, 106, 0.2);
    }

    .btn-cancel-mobile {
        text-align: center;
        text-decoration: none;
        color: #64748b;
        font-weight: 600;
        font-size: 14px;
        padding: 10px;
    }

    /* Tablet & Desktop Adjustments */
    @media (min-width: 768px) {
        .edit-jurnal-container { padding: 40px 20px; }
        .edit-title { font-size: 28px; }
        .form-card-platinum { padding: 40px; margin-bottom: 30px; }
        .card-badge { top: 25px; right: 40px; }
        .platinum-grid { grid-template-columns: repeat(3, 1fr); gap: 30px; }
        .form-actions-mobile { flex-direction: row; justify-content: flex-end; align-items: center; }
        .save-btn-platinum { width: auto; padding: 16px 45px; order: 2; }
        .btn-cancel-mobile { order: 1; }
    }
</style>
@endsection