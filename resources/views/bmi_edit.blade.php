@extends('layouts.app')

@section('title', 'Edit Analisis BMI')

@section('content')
<div class="edit-bmi-container">
    <header class="edit-header">
        <h2 class="edit-title">Edit Analisis BMI ⚖️</h2>
        <p class="edit-subtitle">Perbarui data fisik untuk rekaman tanggal <strong>{{ \Carbon\Carbon::parse($log->log_date)->translatedFormat('d M Y') }}</strong>.</p>
    </header>

    <div class="edit-grid-layout">
        {{-- SISI KIRI: FORM EDIT --}}
        <div class="edit-card form-section">
            <form action="{{ route('input.data.update', $log->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="input-group-plat">
                    <label>Tanggal Record</label>
                    <input type="date" name="log_date" value="{{ $log->log_date }}" class="form-control-plat">
                </div>

                <div class="input-row-mobile">
                    <div class="input-group-plat">
                        <label>Berat Badan (kg)</label>
                        <input type="number" name="weight" id="weight" class="form-control-plat" value="{{ $log->weight }}" step="0.1">
                    </div>

                    <div class="input-group-plat">
                        <label>Tinggi Badan (cm)</label>
                        <input type="number" name="height" id="height" class="form-control-plat" value="{{ auth()->user()->height ?? 170 }}">
                    </div>
                </div>

                {{-- Hidden input untuk menyimpan skor hasil kalkulasi JS --}}
                <input type="hidden" name="bmi_score" id="bmi_score_input" value="{{ $log->bmi_score }}">
                <input type="hidden" id="user_age" value="{{ auth()->user()->age ?? 25 }}">
                <input type="hidden" id="user_gender" value="{{ auth()->user()->gender ?? 'male' }}">

                <div class="action-buttons">
                    <button type="button" onclick="recalculateBMI()" class="btn-recalc">Kalkulasi Ulang</button>
                    <button type="submit" class="btn-save-edit">Simpan Perubahan</button>
                    <a href="{{ route('journal') }}" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>

        {{-- SISI KANAN: HASIL LENGKAP --}}
        <div id="result-box" class="edit-card result-display">
            <div id="analysis-content">
                <div class="result-header">
                    <div class="bmi-score-wrapper">
                        <small>Skor BMI Kamu</small>
                        <h1 id="bmi-val">{{ $log->bmi_score }}</h1>
                        <div id="bmi-badge" class="badge">--</div>
                    </div>
                    
                    <div class="bmi-stats-box">
                        <ul class="stats-list">
                            <li>✅ Rentang Ideal: <br><strong>18.5 - 25.0 kg/m²</strong></li>
                            <li>📍 Berat Ideal: <br><strong id="weight-target">-- kg</strong></li>
                            <li>🔥 Energi (BMR): <br><strong id="bmr-val">-- kkal</strong></li>
                            <li id="info-diff" class="diff-highlight"></li>
                        </ul>
                    </div>
                </div>

                {{-- Spektrum Bar Visual --}}
                <div class="spectrum-container">
                    <div class="spectrum-bar">
                        <div id="bmi-indicator"></div>
                    </div>
                    <div class="spectrum-labels">
                        <span>Kurus</span><span>Ideal</span><span>Berlebih</span><span>Obesitas</span>
                    </div>
                </div>

                <div class="advice-box">
                    <strong>💡 Rekomendasi:</strong>
                    <p id="advice-text">Klik "Kalkulasi Ulang" untuk memperbarui saran.</p>
                </div>

                <h5 class="table-title">Tabel Klasifikasi (WHO)</h5>
                <div class="table-responsive">
                    <table class="bmi-table">
                        <thead>
                            <tr>
                                <th>Klasifikasi</th>
                                <th>BMI ($kg/m^2$)</th>
                            </tr>
                        </thead>
                        <tbody id="bmi-table-body">
                            <tr id="row-severe"><td>Sangat Kurus</td><td>&lt; 16.0</td></tr>
                            <tr id="row-moderate"><td>Kurus Moderat</td><td>16.0 - 17.0</td></tr>
                            <tr id="row-mild"><td>Kurus Ringan</td><td>17.0 - 18.5</td></tr>
                            <tr id="row-normal"><td>Normal (Ideal)</td><td>18.5 - 25.0</td></tr>
                            <tr id="row-overweight"><td>Kelebihan BB</td><td>25.0 - 30.0</td></tr>
                            <tr id="row-obese1"><td>Obesitas I</td><td>30.0 - 35.0</td></tr>
                            <tr id="row-obese2"><td>Obesitas II</td><td>35.0 - 40.0</td></tr>
                            <tr id="row-obese3"><td>Obesitas III</td><td>&gt; 40.0</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_styles')
<style>
    /* Gunakan CSS yang sama dengan halaman Kalkulator sebelumnya agar konsisten */
    .edit-bmi-container { max-width: 100%; padding: 15px; font-family: 'Plus Jakarta Sans', sans-serif; }
    .edit-grid-layout { display: grid; grid-template-columns: 1fr; gap: 20px; }
    .edit-card { background: white; padding: 20px; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
    
    /* Form styling */
    .input-group-plat { margin-bottom: 15px; }
    .input-group-plat label { display: block; font-size: 12px; font-weight: 700; margin-bottom: 5px; }
    .form-control-plat { width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0; }
    .input-row-mobile { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    
    /* Button styling */
    .action-buttons { display: flex; flex-direction: column; gap: 10px; margin-top: 15px; }
    .btn-recalc { background: #f0fdf9; color: #2f7f6a; border: 1px solid #cfeee4; padding: 12px; border-radius: 12px; font-weight: 700; cursor: pointer; }
    .btn-save-edit { background: #2f7f6a; color: white; border: none; padding: 14px; border-radius: 12px; font-weight: 700; cursor: pointer; }
    .btn-cancel { text-align: center; text-decoration: none; font-size: 13px; color: #94a3b8; }

    /* Result styling */
    .result-header { display: flex; flex-direction: column; gap: 15px; }
    #bmi-val { font-size: 54px; font-weight: 900; margin: 0; line-height: 1; color: #2f7f6a; }
    .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; color: white; font-size: 12px; font-weight: 700; margin-top: 5px; }
    .bmi-stats-box { background: #f8fbfa; padding: 15px; border-radius: 15px; border: 1px solid #eef7f4; }
    .stats-list { list-style: none; padding: 0; margin: 0; font-size: 12px; }
    .stats-list li { margin-bottom: 8px; }

    /* Spectrum */
    .spectrum-container { margin: 25px 0; }
    .spectrum-bar { height: 10px; background: linear-gradient(to right, #5499c7, #2ecc71, #f1c40f, #e11d48); border-radius: 10px; position: relative; }
    #bmi-indicator { width: 4px; height: 18px; background: #1e293b; position: absolute; top: -4px; border-radius: 2px; border: 1px solid white; transition: 0.5s ease; }
    .spectrum-labels { display: flex; justify-content: space-between; font-size: 9px; color: #94a3b8; margin-top: 5px; font-weight: 700; }

    /* Advice & Table */
    .advice-box { padding: 12px; background: #f0fdf4; border-radius: 12px; border-left: 4px solid #2f7f6a; margin-bottom: 15px; }
    .bmi-table { width: 100%; border-collapse: collapse; font-size: 11px; }
    .bmi-table td { padding: 8px; border: 1px solid #f1f5f9; }
    .highlight-row { background: #f0fdf4 !important; font-weight: 700; color: #2f7f6a; }

    @media (min-width: 768px) {
        .edit-grid-layout { grid-template-columns: 350px 1fr; }
        .result-header { flex-direction: row; justify-content: space-between; }
    }
</style>
@endsection

@section('page_scripts')
<script>
    function recalculateBMI() {
        const w = parseFloat(document.getElementById('weight').value);
        const hCm = parseFloat(document.getElementById('height').value);
        const age = parseInt(document.getElementById('user_age').value);
        const gender = document.getElementById('user_gender').value;

        if(!w || !hCm) return;

        const hM = hCm / 100;
        const bmi = (w / (hM * hM)).toFixed(1);
        const minIdeal = (18.5 * hM * hM).toFixed(1);
        const maxIdeal = (25.0 * hM * hM).toFixed(1);
        let bmr = (gender === 'male') ? (10 * w) + (6.25 * hCm) - (5 * age) + 5 : (10 * w) + (6.25 * hCm) - (5 * age) - 161;

        document.getElementById('bmi-val').innerText = bmi;
        document.getElementById('bmi_score_input').value = bmi;
        document.getElementById('weight-target').innerText = `${minIdeal} kg - ${maxIdeal} kg`;
        document.getElementById('bmr-val').innerText = Math.round(bmr).toLocaleString() + " kkal";

        let pos = ((bmi - 10) / (45 - 10)) * 100;
        pos = Math.max(0, Math.min(100, pos));
        document.getElementById('bmi-indicator').style.left = pos + "%";

        const badge = document.getElementById('bmi-badge');
        const advice = document.getElementById('advice-text');
        const diffInfo = document.getElementById('info-diff');
        let rowId, cat, col, adviceMsg;

        // LOGIKA SESUAI PERMINTAAN USER (Sesuai Tabel WHO)
        if(bmi < 16) { 
            rowId = "row-severe"; cat = "Sangat Kurus"; col = "#5499c7"; 
            adviceMsg = "Kondisi sangat kurus. Disarankan konsultasi medis segera.";
        } else if(bmi < 17) { 
            rowId = "row-moderate"; cat = "Kurus Moderat"; col = "#5dade2";
            adviceMsg = "Tingkatkan asupan nutrisi protein dan lemak sehat.";
        } else if(bmi < 18.5) { 
            rowId = "row-mild"; cat = "Kurus Ringan"; col = "#aed6f1";
            adviceMsg = "Dekat dengan ideal. Tambahkan porsi makan secara bertahap.";
        } else if(bmi < 25) { 
            rowId = "row-normal"; cat = "Normal (Ideal)"; col = "#2ecc71";
            adviceMsg = "Sempurna! Pertahankan gaya hidup sehatmu.";
        } else if(bmi < 30) { 
            rowId = "row-overweight"; cat = "Kelebihan BB"; col = "#f1c40f";
            adviceMsg = "Waspadai risiko diabetes. Mulailah rutin jalan kaki.";
        } else if(bmi < 35) { 
            rowId = "row-obese1"; cat = "Obesitas Kelas I"; col = "#e67e22";
            adviceMsg = "Risiko kesehatan meningkat. Kurangi asupan gula dan lemak.";
        } else if(bmi < 40) {
            rowId = "row-obese2"; cat = "Obesitas Kelas II"; col = "#e74c3c";
            adviceMsg = "Risiko tinggi. Sangat disarankan mengatur pola makan ketat.";
        } else {
            rowId = "row-obese3"; cat = "Obesitas Kelas III"; col = "#943126";
            adviceMsg = "Kondisi darurat kesehatan. Segera konsultasikan dengan spesialis.";
        }

        if (bmi >= 25) {
            diffInfo.innerHTML = `⚠️ Turunkan <strong>${(w - maxIdeal).toFixed(1)} kg</strong> untuk ideal`;
            diffInfo.style.color = "#b03a2e";
        } else if (bmi < 18.5) {
            diffInfo.innerHTML = `💡 Tambahkan <strong>${(minIdeal - w).toFixed(1)} kg</strong> untuk ideal`;
            diffInfo.style.color = "#2e86c1";
        } else {
            diffInfo.innerHTML = `✨ Berat badanmu sudah ideal!`;
            diffInfo.style.color = "#2f7f6a";
        }

        badge.innerText = cat;
        badge.style.background = col;
        document.getElementById('bmi-val').style.color = col;
        advice.innerHTML = adviceMsg + " <br><small>Jangan lupa klik <b>Simpan Perubahan</b>.</small>";

        document.querySelectorAll('#bmi-table-body tr').forEach(tr => tr.classList.remove('highlight-row'));
        if(document.getElementById(rowId)) document.getElementById(rowId).classList.add('highlight-row');
    }

    window.onload = recalculateBMI;
</script>
@endsection