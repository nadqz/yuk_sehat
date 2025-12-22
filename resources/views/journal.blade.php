@extends('layouts.app')

@section('title', 'Jurnal Harian')

@section('content')
{{-- Kontainer Utama --}}
<div class="journal-container">
    
    <header class="journal-header">
        <div class="header-text">
            <h2 class="header-title">Evaluasi Kesehatan</h2>
            <p class="header-subtitle">Analisis mendalam dan saran medis untuk gaya hidup sehat Anda.</p>
        </div>
        @if(!$logs->isEmpty())
        <button type="button" class="btn-clear-all" id="btn-clear-all">
            Kosongkan
        </button>
        <form id="clear-all-form" action="{{ route('journal.clear') }}" method="POST" style="display: none;">
            @csrf @method('DELETE')
        </form>
        @endif
    </header>

    @if($logs->count() > 0)
    <div class="journal-grid">
        @foreach($logs as $log)
            @php
                $isBmiLog = ($log->bmi_score && !$log->steps);
                $bmi = $log->bmi_score;
                $weight = $log->weight;
                $heightM = (auth()->user()->height ?? 170) / 100;
                
                $bmiStatus = ''; $bmiColor = ''; $bmiAdvice = ''; $bmiMotivation = ''; $scoreColor = '#1e293b'; 
                
                // Logika Penentuan Tips Berdasarkan Kondisi
                $healthTip = "";
                $tipColor = "#166534"; // Default hijau
                $tipBg = "#f0fdf4";

                if($isBmiLog) {
                    if($bmi < 18.5) {
                        $healthTip = "💡 Tips Nutrisi: Konsumsi protein hewani/nabati lebih banyak dan tambahkan cemilan sehat seperti kacang-kacangan di sela jam makan.";
                        $tipColor = "#0369a1"; $tipBg = "#f0f9ff";
                    } elseif($bmi >= 25) {
                        $healthTip = "💡 Tips Diet: Gunakan piring lebih kecil untuk kontrol porsi dan pastikan 50% isi piring adalah sayuran hijau.";
                        $tipColor = "#9a3412"; $tipBg = "#fff7ed";
                    } else {
                        $healthTip = "💡 Tips Maintenance: Variasikan jenis olahraga Anda antara cardio dan latihan beban untuk menjaga kepadatan tulang.";
                    }
                } else {
                    if($log->steps < 5000) {
                        $healthTip = "💡 Tips Gerak: Gunakan tangga alih-alih lift, atau sempatkan jalan santai 10 menit setelah makan siang.";
                        $tipColor = "#991b1b"; $tipBg = "#fef2f2";
                    } elseif($log->water_intake < 8) {
                        $healthTip = "💡 Tips Hidrasi: Pasang pengingat di ponsel atau sediakan botol minum 1 liter di meja kerja agar target air terpenuhi.";
                        $tipColor = "#075985"; $tipBg = "#f0f9ff";
                    } else {
                        $healthTip = "💡 Tips Umum: Kualitas tidur sangat baik untuk pemulihan otot. Pertahankan jadwal tidur yang konsisten.";
                    }
                }

                if($bmi) {
                    if($bmi < 16) { $bmiStatus = 'Severe Thinness'; $bmiColor = '#5499c7'; }
                    elseif($bmi < 17) { $bmiStatus = 'Moderate Thinness'; $bmiColor = '#5dade2'; }
                    elseif($bmi < 18.5) { $bmiStatus = 'Mild Thinness'; $bmiColor = '#aed6f1'; }
                    elseif($bmi < 25) { $bmiStatus = 'Ideal (Normal)'; $bmiColor = '#2ecc71'; }
                    elseif($bmi < 30) { $bmiStatus = 'Overweight'; $bmiColor = '#f1c40f'; }
                    elseif($bmi < 35) { $bmiStatus = 'Obesitas I'; $bmiColor = '#e67e22'; $scoreColor = '#e11d48'; }
                    elseif($bmi < 40) { $bmiStatus = 'Obesitas II'; $bmiColor = '#e74c3c'; $scoreColor = '#e11d48'; }
                    else { $bmiStatus = 'Obesitas III'; $bmiColor = '#943126'; $scoreColor = '#e11d48'; }

                    if($bmi >= 25) {
                        $diff = number_format($weight - (24.9 * $heightM * $heightM), 1);
                        $bmiAdvice = "Catatan: Berat badan melebihi batas aman. Sistem mendeteksi risiko metabolik. Saran: Kurangi gula & lemak. Target: -$diff kg.";
                        $bmiMotivation = "Menyayangi tubuh berarti memberikannya nutrisi terbaik, bukan beban.";
                    } elseif($bmi < 18.5) {
                        $diff = number_format((18.5 * $heightM * $heightM) - $weight, 1);
                        $bmiAdvice = "Catatan: Defisit massa tubuh. Saran: Tingkatkan asupan kalori sehat & protein. Target: +$diff kg.";
                        $bmiMotivation = "Kekuatan tubuh bergantung pada asupan energi harian.";
                    } else {
                        $bmiAdvice = "Status: Proporsional. Saran: Pertahankan ritme nutrisi dan fokus massa otot.";
                        $bmiMotivation = "Konsistensi adalah kunci kesehatan jangka panjang.";
                    }
                }

                $water = $log->water_intake;
                $steps = $log->steps;
                $waterAdvice = ($water < 8) ? "Hidrasi kurang optimal." : "Hidrasi terjaga baik.";
            @endphp

            <div class="journal-card-platinum">
                {{-- HEADER KARTU --}}
                <div class="card-header-flex" style="background: {{ $isBmiLog ? '#f0f9f6' : '#ffffff' }}">
                    <div class="header-left">
                        <div class="date-box">
                            <span class="date-month">{{ \Carbon\Carbon::parse($log->log_date)->translatedFormat('M') }}</span>
                            <span class="date-day">{{ \Carbon\Carbon::parse($log->log_date)->format('d') }}</span>
                        </div>
                        <h4 class="card-title">
                            {{ $isBmiLog ? 'Analisis BMI' : 'Jurnal Harian' }}
                        </h4>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('input.data.edit', $log->id) }}" class="btn-action-edit">Edit</a>
                        <button type="button" class="btn-action-delete btn-delete-confirm" data-id="{{ $log->id }}">
                            Hapus
                        </button>
                        <form id="delete-form-{{ $log->id }}" action="{{ route('journal.destroy', $log->id) }}" method="POST" style="display: none;">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-content-grid">
                        {{-- KOLOM METRIK --}}
                        <div class="metric-section">
                            <h5 class="section-label">Detail Kondisi</h5>
                            @if($isBmiLog)
                                <div style="margin-bottom: 12px;">
                                    <div class="bmi-badge" style="background: {{ $bmiColor }};">
                                        {{ $bmiStatus }}
                                    </div>
                                    <div class="bmi-score" style="color: {{ $scoreColor }};">{{ $bmi }} <small>BMI</small></div>
                                </div>
                                <div class="weight-box">
                                    <small>BERAT BADAN:</small>
                                    <div class="weight-value">{{ $log->weight }} <span>kg</span></div>
                                </div>
                            @else
                                <div class="metric-item">
                                    <small>LANGKAH:</small>
                                    <div class="metric-value">{{ number_format($steps) }} <span>Langkah</span></div>
                                </div>
                                <div class="metric-item">
                                    <small>HIDRASI:</small>
                                    <div class="metric-value" style="color: #0ea5e9;">{{ $water }} <span>Gelas</span></div>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h5 style="color: #94a3b8; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; margin-bottom: 15px; font-weight: 800;">Analisis & Kesimpulan Sistem</h5>
                            
                            <div style="background: #f0f9ff; padding: 15px; border-radius: 16px; margin-bottom: 15px; border: 1px solid #e0f2fe;">
                                <p style="margin: 0; font-size: 13px; color: #334155; line-height: 1.6;">
                                    @if($isBmiLog)
                                        {{ $bmiAdvice }}
                                    @else
                                        @if($log->steps < 5000) Catatan: Lakukan lebih banyak langkah kaki untuk melatih kekuatan jantung Anda.
                                        @elseif($log->steps < 10000) Catatan: Tambahkan sedikit aktivitas untuk stimulasi jantung Anda.
                                        @else Aktivitas hari ini memberikan dampak yang luar biasa bagi kesehatan kardiovaskular Anda. @endif
                                        {{ $waterAdvice }}
                                        @if($log->sleep_time && $log->wake_time)
                                            @php $duration = \Carbon\Carbon::parse($log->sleep_time)->diffInHours(\Carbon\Carbon::parse($log->wake_time)); @endphp
                                            Durasi istirahat {{ $duration }} jam. 
                                            {{ $duration < 7 ? 'Saran: istirahat lebih awal agar pemulihan hormon tubuh berjalan sempurna.' : 'Kualitas waktu istirahat cukup baik.' }}
                                        @endif
                                    @endif
                                </p>
                            </div>
                            {{-- BAGIAN TIPS TERPERSONALISASI --}}
                            <div class="tip-box" style="background: {{ $tipBg }}; border: 1px solid {{ $tipColor }}33;">
                                <p style="margin: 0; font-size: 12px; color: {{ $tipColor }}; font-weight: 600; line-height: 1.5;">
                                    {!! $healthTip !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">✨</div>
            <h3>Belum Ada Analisis</h3>
            <p>Input data BMI atau Jurnal harian Anda.</p>
            <a href="{{ route('bmi') }}" class="btn-start">Mulai Analisis</a>
        </div>
    @endif
</div>

<style>
    /* Reset & Base */
    .journal-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 15px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #334155;
    }

    /* Header */
    .journal-header {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 10px;
    }
    .header-title { color: #1a4d3e; font-weight: 800; font-size: 22px; margin: 0; }
    .header-subtitle { color: #64748b; font-size: 13px; margin-top: 4px; }
    .btn-clear-all {
        background: #fff1f2; color: #ef4444; border: 1px solid #fecdd3; 
        padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 12px; cursor: pointer;
    }

    /* Grid System */
    .journal-grid {
        display: grid;
        grid-template-columns: 1fr; /* Default mobile: 1 kolom */
        gap: 16px;
    }

    /* Card Styling */
    .journal-card-platinum {
        background: white; border-radius: 16px; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
        border: 1px solid #f1f5f9; overflow: hidden;
        transition: transform 0.3s ease;
    }

    .card-header-flex {
        padding: 12px 15px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-left { display: flex; align-items: center; gap: 10px; }
    .date-box {
        background: #2f7f6a; color: white; padding: 5px; border-radius: 10px;
        min-width: 42px; text-align: center;
    }
    .date-month { display: block; font-size: 9px; text-transform: uppercase; font-weight: 700; }
    .date-day { font-size: 16px; font-weight: 800; }
    .card-title { margin: 0; font-size: 14px; font-weight: 700; color: #1e293b; }

    .header-actions { display: flex; gap: 6px; }

    /* Card Body */
    .card-body { padding: 15px; }
    .card-content-grid {
        display: grid;
        grid-template-columns: 1fr; /* Tumpuk ke bawah di mobile */
        gap: 15px;
    }

    .section-label {
        color: #94a3b8; text-transform: uppercase; font-size: 10px; 
        letter-spacing: 1px; margin: 0 0 10px 0; font-weight: 800;
    }

    /* Metrics */
    .bmi-badge { color: white; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 11px; display: inline-block; }
    .bmi-score { font-size: 24px; font-weight: 800; margin-top: 5px; }
    .weight-box { background: #f8fafc; padding: 10px; border-radius: 10px; border-left: 3px solid #2f7f6a; }
    .weight-value { font-size: 18px; font-weight: 800; }
    
    .metric-item { margin-bottom: 10px; }
    .metric-value { font-size: 18px; font-weight: 800; }
    .metric-value span { font-size: 12px; font-weight: 500; color: #64748b; }

    /* Analysis */
    .analysis-bubble {
        background: #f0f9ff; padding: 12px; border-radius: 12px; 
        margin-bottom: 10px; border: 1px solid #e0f2fe;
    }
    .analysis-bubble p { margin: 0; font-size: 12px; line-height: 1.5; color: #334155; }
    
    .motivation-bubble {
        padding: 10px; border-radius: 10px; background: #f0fdf4; border: 1px solid #dcfce7;
    }
    .motivation-bubble p { margin: 0; font-size: 11px; color: #166534; font-style: italic; }
    .tip-box { padding: 12px; border-radius: 12px; margin-top: 10px; }

    /* Empty State */
    .empty-state {
        text-align: center; padding: 60px 20px; background: white; 
        border-radius: 20px; border: 2px dashed #e2e8f0;
    }
    .empty-icon { font-size: 50px; margin-bottom: 15px; }
    .btn-start {
        display: inline-block; background: #2f7f6a; color: white; 
        padding: 12px 30px; border-radius: 12px; text-decoration: none; font-weight: 700;
    }

    /* Buttons */

    .btn-action-edit {
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid #cfeee4;
        background: #f0fdf9;
        color: #2f7f6a;
        transition: all 0.3s ease; /* Transisi halus */
        display: inline-block;
    }

    .btn-action-edit:hover {
        background: #2f7f6a;
        color: white;
        transform: translateY(-2px); /* Bergerak sedikit ke atas */
        box-shadow: 0 4px 10px rgba(47, 127, 106, 0.2);
    }

    /* GAYA TOMBOL HAPUS */
    .btn-action-delete {
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 700;
        border: 1px solid #fecdd3;
        background: #fff1f2;
        color: #e11d48;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-action-delete:hover {
        background: #e11d48;
        color: white;
        border-color: #e11d48;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(225, 29, 72, 0.2);
    }

    /* GAYA TOMBOL KOSONGKAN (HEADER) */
    .btn-clear-all {
        background: #fff1f2;
        color: #ef4444;
        border: 1px solid #fecdd3; 
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-clear-all:hover {
        background: #ef4444;
        color: white;
        transform: scale(1.05); /* Sedikit membesar */
    }

    /* Tambahkan sedikit interaksi saat ditekan */
    .btn-action-edit:active, .btn-action-delete:active {
        transform: translateY(0);
    }

    .journal-card-platinum {
        background: white; 
        border-radius: 16px; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
        border: 1px solid #f1f5f9; 
        overflow: hidden;
        
        /* TRANSISI HALUS */
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        cursor: pointer;
    }

    /* EFEK SAAT KURSOR DI ATAS KARTU (HOVER) */
    .journal-card-platinum:hover {
        transform: translateY(-8px); /* Bergerak ke atas */
        box-shadow: 0 12px 24px rgba(47, 127, 106, 0.12); /* Bayangan lebih dalam & berwarna emerald */
        border-color: #cfeee4; /* Warna border berubah sedikit hijau */
    }

    /* EFEK SAAT KARTU DITEKAN (MOBILE FRIENDLY) */
    .journal-card-platinum:active {
        transform: translateY(-4px) scale(0.98); /* Efek membal saat diklik */
    }

    /* MENAMBAHKAN SEDIKIT ANIMASI MASUK SAAT HALAMAN DIBUKA */
    .journal-grid {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- MEDIA QUERIES UNTUK TABLET & DESKTOP --- */
    @media (min-width: 768px) {
        .journal-container { padding: 20px 40px; }
        .header-title { font-size: 28px; }
        .journal-grid { grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); }
        .card-content-grid { grid-template-columns: 1fr 1.5fr; gap: 20px; }
        .metric-section { border-right: 1px solid #f1f5f9; padding-right: 20px; }
        .card-title { font-size: 16px; }

        .swal2-title {
            font-size: 1.2rem !important;
            font-weight: 800 !important;
        }
        .swal2-html-container {
            font-size: 0.9rem !important;
        }
        .swal2-confirm, .swal2-cancel {
            font-size: 0.8rem !important;
            border-radius: 12px !important;
        }
    }
</style>
@endsection

@section('page_scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pop-up untuk Hapus Satuan
        const deleteButtons = document.querySelectorAll('.btn-delete-confirm');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const logId = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'Hapus Catatan?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2f7f6a', // Warna Emerald
                    cancelButtonColor: '#e11d48', // Warna Rose
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    borderRadius: '20px',
                    background: '#ffffff',
                    customClass: {
                        popup: 'animated fadeInDown'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + logId).submit();
                    }
                });
            });
        });

        // Pop-up untuk Kosongkan Semua
        const clearBtn = document.getElementById('btn-clear-all');
        if(clearBtn) {
            clearBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Kosongkan Seluruh Riwayat?',
                    text: "Tindakan ini akan menghapus SEMUA data jurnal Anda selamanya.",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Kosongkan Semua!',
                    cancelButtonText: 'Batal',
                    borderRadius: '24px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('clear-all-form').submit();
                    }
                });
            });
        }
    });
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000,
            borderRadius: '20px'
        });
    @endif
</script>


@endsection