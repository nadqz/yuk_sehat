@extends('layouts.app')

@section('title', 'Dashboard')

@section('page_styles')
<style>
    /* CSS GLOBAL UNTUK PC */
    .dashboard-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-sizing: border-box;
    }

    .btn-input-full {
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Transisi halus */
    }

    .btn-input-full:hover {
        transform: translateY(-5px); /* Bergerak ke atas */
        background-color: #1a4d3e !important; /* Warna hijau lebih gelap */
        box-shadow: 0 12px 24px rgba(47, 127, 106, 0.3) !important; /* Bayangan lebih dalam */
    }

    .stats-card {
        transition: all 0.3s ease;
    }
    .stats-card:hover {
        transform: scale(1.02);
        border-color: #2f7f6a !important;
        box-shadow: 0 8px 30px rgba(0,0,0,0.05) !important;
    }

    /* Efek klik (ditekan) */
    .btn-input-full:active {
        transform: translateY(-2px);
    }

    /* --- LOGIKA PERBAIKAN MOBILE (NO ZOOM OUT) --- */
    @media (max-width: 768px) {
        .dashboard-wrapper {
            padding: 10px 15px !important;
            margin-left: 0 !important;
            width: 100% !important;
            overflow-x: hidden; /* Mencegah geser kanan-kiri */
        }

        /* Header: Perkecil font & Susun Vertikal */
        .dashboard-wrapper header {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 10px !important;
            margin-bottom: 20px !important;
        }

        .dashboard-wrapper header h2 {
            font-size: 20px !important;
            letter-spacing: -0.5px !important;
        }

        /* Stats Grid: Paksa 1 Kolom Vertikal */
        .stats-grid-mobile {
            grid-template-columns: 1fr !important;
            gap: 10px !important;
            width: 100% !important;
        }

        .stats-card {
            padding: 15px !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100% !important;
            box-sizing: border-box;
        }

        /* Perkecil angka besar agar tidak meluber di HP */
        .stats-card .val-text {
            font-size: 26px !important; 
        }

        /* Main Analysis: Paksa Vertikal */
        .main-analysis-grid {
            grid-template-columns: 1fr !important;
            display: flex !important;
            flex-direction: column !important;
            width: 100% !important;
            gap: 15px !important;
        }

        /* Container Grafik: Tinggi yang pas untuk HP */
        .chart-container-box {
            height: 320px !important; 
            padding: 15px !important;
            width: 100% !important;
            box-sizing: border-box;
        }

        .analysis-sidebar {
            width: 100% !important;
            gap: 15px !important;
        }

        /* Tombol: Lebar penuh agar mudah diklik jempol */
        .btn-input-full {
            width: 100% !important;
            display: block !important;
            text-align: center;
            box-sizing: border-box;
            padding: 12px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">
    
    {{-- HEADER --}}
    <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="color: #1a4d3e; font-weight: 800; font-size: 30px; margin: 0; letter-spacing: -1px;">Halo, {{ Auth::user()->name }}!</h2>
            <p style="color: #64748b; margin-top: 5px; font-size: 15px;">Pantau perkembangan kesehatan Anda.</p>
        </div>
        <a href="{{ route('input.data') }}" class="btn-input-full" style="background: #2f7f6a; color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(47, 127, 106, 0.2); display: inline-block;">
            + Input Data Baru
        </a>
    </header>

    @if($logs->isEmpty())
        <div style="background: white; border-radius: 24px; padding: 40px 20px; border: 2px dashed #e2e8f0; text-align: center;">
            <div style="font-size: 50px; margin-bottom: 15px;">✨</div>
            <h3 style="color: #334155; font-weight: 800;">Mulai Perjalanan Sehatmu</h3>
            <a href="{{ route('bmi') }}" style="background: #2f7f6a; color: white; padding: 14px 35px; border-radius: 14px; text-decoration: none; font-weight: 700;">Hitung BMI</a>
        </div>
    @else
        {{-- STATS CARDS --}}
        <div class="stats-grid-mobile" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 25px;">
            @php
                $latest = $logs->first();
                $avgSteps = $logs->avg('steps');
                $avgWater = $logs->avg('water_intake');
                $bmi = $latest->bmi_score ?? 0;
                $bmiCol = $bmi < 18.5 ? '#5dade2' : ($bmi < 25 ? '#2ecc71' : ($bmi < 30 ? '#f1c40f' : '#e74c3c'));

                // Logika Status Hidrasi (Pojok Kanan Bawah)
                if ($avgWater < 3) {
                    $waterStatus = 'Dehidrasi Tinggi';
                    $waterCol = '#e74c3c'; 
                } elseif ($avgWater < 6) {
                    $waterStatus = 'Dehidrasi';
                    $waterCol = '#f39c12'; 
                } elseif ($avgWater < 9) {
                    $waterStatus = 'Terhidrasi';
                    $waterCol = '#10b981'; 
                } else {
                    $waterStatus = 'Overhidrasi';
                    $waterCol = '#2980b9'; 
                }
            @endphp

            {{-- BMI --}}
            <div class="stats-card" style="background: white; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.02); padding: 20px;">
                <div>
                    <small style="color: #94a3b8; font-weight: 700; font-size: 10px; text-transform: uppercase;">Status BMI</small>
                    <div class="val-text" style="font-size: 32px; font-weight: 800; color: {{ $bmiCol }};">{{ $bmi ?: '--' }}</div>
                </div>
                <div style="text-align: right; font-size: 12px; color: #64748b; font-weight: 600;">{{ $latest->weight ?? '--' }} kg</div>
            </div>

            {{-- LANGKAH --}}
            <div class="stats-card" style="background: white; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.02); padding: 20px;">
                <div>
                    <small style="color: #94a3b8; font-weight: 700; font-size: 10px; text-transform: uppercase;">Rata Langkah</small>
                    <div class="val-text" style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ number_format($avgSteps, 0) }}</div>
                </div>
                <div style="color: {{ $avgSteps >= 7000 ? '#10b981' : '#f59e0b' }}; font-size: 12px; font-weight: 700;">{{ $avgSteps >= 7000 ? 'Aktif' : 'Sedenter' }}</div>
            </div>

            {{-- AIR --}}
            <div class="stats-card" style="background: white; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.02); padding: 20px;">
                <div>
                    <small style="color: #94a3b8; font-weight: 700; font-size: 10px; text-transform: uppercase;">Gelas Air</small>
                    <div class="val-text" style="font-size: 32px; font-weight: 800; color: #0ea5e9;">{{ round($avgWater, 1) }}</div>
                </div>
                <div style="text-align: right;">
                    <div style="color: {{ $waterCol }}; font-size: 11px; font-weight: 700;">{{ $waterStatus }}</div>
                </div>
            </div>
        </div>

        {{-- GRAFIK & ANALISIS --}}
        <div class="main-analysis-grid" style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 25px;">
            
            {{-- KOLOM GRAFIK --}}
            <div class="chart-container-box" style="background: white; padding: 25px; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                <h4 style="margin: 0 0 15px 0; font-size: 16px; color: #1e293b; font-weight: 700;">Tren Kesehatan</h4>
                <div style="height: 220px; position: relative; width: 100%;">
                    <canvas id="mainDashboardChart"></canvas>
                </div>
            </div>

            {{-- KOLOM ANALISIS & TIPS --}}
            <div class="analysis-sidebar" style="display: flex; flex-direction: column; gap: 20px;">
                {{-- Kotak Analisis AI --}}
                <div style="background: #f0f9ff; padding: 25px; border-radius: 24px; border: 1px solid #e0f2fe;">
                    <h5 style="margin: 0 0 10px 0; color: #0369a1; font-size: 16px; font-weight: 700;">Kesimpulan Analisis</h5>
                    <p style="margin: 0; font-size: 14px; color: #075985; line-height: 1.6;">
                        @if($bmi < 18.5)
                            BMI Anda ({{ $bmi }}) masuk kategori <strong>Kekurangan Berat Badan</strong>. 
                            Cobalah untuk meningkatkan asupan nutrisi seimbang.
                        @elseif($bmi >= 18.5 && $bmi < 25)
                            BMI Anda ({{ $bmi }}) berada dalam rentang <strong>Ideal</strong>. 
                            Pertahankan pola makan dan aktivitas fisik yang sudah berjalan dengan baik.
                        @elseif($bmi >= 25 && $bmi < 30)
                            BMI Anda ({{ $bmi }}) masuk kategori <strong>Berat Badan Berlebih</strong>. 
                            Disarankan untuk meningkatkan aktivitas kardio dan menjaga porsi makan.
                        @else
                            BMI Anda ({{ $bmi }}) masuk kategori <strong>Obesitas</strong>. 
                            Sangat disarankan untuk berkonsultasi dengan ahli gizi dan mulai rutin berolahraga.
                        @endif
                    </p>
                </div>

                {{-- Kotak Tips Kesehatan Dinamis (Ganti Motivasi) --}}
                <div style="background: #f0fdf4; padding: 25px; border-radius: 24px; border: 1px solid #dcfce7; flex-grow: 1;">
                    <h5 style="margin: 0 0 10px 0; color: #166534; font-size: 16px; font-weight: 700;">Tips Kesehatan Khusus</h5>
                    <p style="margin: 0; font-size: 14px; color: #14532d; line-height: 1.6; font-weight: 500;">
                        @if($bmi < 18.5)
                            💪 <strong>Tips:</strong> Tingkatkan asupan protein dan lakukan olahraga angkat beban ringan untuk membangun massa otot secara sehat.
                        @elseif($bmi >= 18.5 && $bmi < 25)
                            🌟 <strong>Tips:</strong> Fokus pada variasi makanan sehat dan cobalah meditasi atau yoga untuk menjaga kesehatan mental serta kebugaran tubuh.
                        @elseif($bmi >= 25 && $bmi < 30)
                            🥗 <strong>Tips:</strong> Kurangi konsumsi gula tambahan dan makanan olahan. Usahakan jalan cepat minimal 30 menit setiap hari.
                        @else
                            ⚠️ <strong>Tips:</strong> Kurangi karbohidrat berlebih dan lemak jenuh. Mulailah diet defisit kalori secara bertahap dan rutin minum air putih sebelum makan.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('page_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(!$logs->isEmpty())
    const ctx = document.getElementById('mainDashboardChart').getContext('2d');
    const chartLogs = {!! json_encode($logs->take(7)->reverse()->values()) !!}; 
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLogs.map(log => {
                const d = new Date(log.log_date);
                return d.getDate() + '/' + (d.getMonth()+1);
            }),
            datasets: [
                {
                    label: 'Berat',
                    data: chartLogs.map(log => log.weight),
                    borderColor: '#2ecc71',
                    borderWidth: 2,
                    tension: 0.4,
                    yAxisID: 'y',
                },
                {
                    label: 'Langkah',
                    data: chartLogs.map(log => log.steps),
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    fill: true,
                    tension: 0.4,
                    yAxisID: 'y1',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 8, font: { size: 10 } } } },
            scales: {
                y: { display: false }, 
                y1: { display: false },
                x: { ticks: { font: { size: 9 } } }
            }
        }
    });
    @endif
</script>
@endsection