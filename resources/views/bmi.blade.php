@extends('layouts.app')

@section('title', 'BMI Kalkulator')

@section('content')
<div class="bmi-container">
    
    <header class="bmi-header">
        <h2 class="bmi-title">Analisis Komposisi Tubuh</h2>
        <p class="bmi-subtitle">Dapatkan gambaran lengkap status kesehatan fisikmu secara akurat.</p>
    </header>

    <div class="bmi-grid-layout">
        
        {{-- SISI KIRI: INPUT DATA --}}
        <div class="bmi-card input-card">
            <h4 class="card-section-title">Data Fisik</h4>
            
            <div class="input-group">
                <label>Tanggal Record</label>
                <input type="date" id="log_date" class="form-control-plat" value="{{ date('Y-m-d') }}">
            </div>

            <div class="input-group">
                <label>Jenis Kelamin</label>
                <select id="gender" class="form-control-plat">
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                </select>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label>Berat (kg)</label>
                    <input type="number" id="weight" class="form-control-plat" placeholder="70" step="0.1">
                </div>
                <div class="input-group">
                    <label>Tinggi (cm)</label>
                    <input type="number" id="height" class="form-control-plat" placeholder="175">
                </div>
            </div>

            <div class="input-group">
                <label>Usia (Tahun)</label>
                <input type="number" id="age" class="form-control-plat" placeholder="25">
            </div>

            <button type="button" onclick="analyzeBody()" class="btn-primary-plat">Mulai Analisis</button>
        </div>

        {{-- SISI KANAN: HASIL --}}
        <div id="result-box" class="bmi-card result-card">
            
            <div id="placeholder-text" class="placeholder-box">
                <div class="placeholder-icon">⚖️</div>
                <h4>Belum Ada Analisis</h4>
                <p>Masukkan data fisik Anda untuk melihat klasifikasi BMI dan rekomendasi kesehatan.</p>
            </div>

            <div id="analysis-content" style="display: none;">
                <div class="result-header">
                    <div class="bmi-score-wrapper">
                        <small>Skor BMI Kamu</small>
                        <h1 id="bmi-val">--</h1>
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
                        <span>Kurus</span><span>Ideal</span><span>Berlebih</span><span>Obese</span>
                    </div>
                </div>

                <div class="advice-box">
                    <strong>💡 Rekomendasi:</strong>
                    <p id="advice-text"></p>
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

                <div class="action-footer">
                    <button type="button" onclick="saveToJournal()" class="btn-save-journal">
                        💾 Simpan ke Jurnal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Base Container */
    .bmi-container { max-width: 100%; margin: 0 auto; padding: 15px; font-family: 'Plus Jakarta Sans', sans-serif; }
    .bmi-title { color: #1a4d3e; font-weight: 800; font-size: 24px; margin: 0; }
    .bmi-subtitle { color: #64748b; font-size: 13px; margin-bottom: 20px; }

    /* Layout Grid */
    .bmi-grid-layout { display: grid; grid-template-columns: 1fr; gap: 20px; }

    /* Cards */
    .bmi-card { background: white; padding: 20px; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
    .card-section-title { margin-bottom: 15px; font-size: 16px; font-weight: 700; color: #1a4d3e; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px; }

    /* Inputs */
    .input-group { margin-bottom: 15px; }
    .input-group label { display: block; font-size: 12px; margin-bottom: 5px; font-weight: 600; color: #475569; }
    .input-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .form-control-plat { width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 14px; box-sizing: border-box; }

    /* Buttons */
    .btn-primary-plat { width: 100%; background: #2f7f6a; color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 700; cursor: pointer; }
    .btn-save-journal { width: 100%; background: transparent; border: 2px solid #2f7f6a; color: #2f7f6a; padding: 12px; border-radius: 10px; font-weight: 700; cursor: pointer; }

    /* Results */
    .result-header { display: flex; flex-direction: column; gap: 20px; }
    .bmi-score-wrapper { text-align: center; }
    #bmi-val { font-size: 56px; font-weight: 900; margin: 0; line-height: 1; }
    .badge { display: inline-block; padding: 5px 15px; border-radius: 20px; color: white; font-weight: 700; font-size: 13px; margin-top: 8px; }
    
    .bmi-stats-box { background: #f8fbfa; padding: 15px; border-radius: 12px; border: 1px solid #eef7f4; }
    .stats-list { list-style: none; padding: 0; margin: 0; font-size: 12px; }
    .stats-list li { margin-bottom: 10px; border-bottom: 1px solid #eef7f4; padding-bottom: 5px; }
    .diff-highlight { font-weight: 700; border-top: 1px dashed #cbd5e1; padding-top: 8px; }

    /* Spectrum Bar */
    .spectrum-container { margin: 30px 0; }
    .spectrum-bar { height: 10px; background: linear-gradient(to right, #5499c7, #2ecc71, #f1c40f, #943126); border-radius: 10px; position: relative; }
    #bmi-indicator { width: 4px; height: 18px; background: #1e293b; position: absolute; top: -4px; border-radius: 2px; border: 1px solid white; transition: 0.8s ease; }
    .spectrum-labels { display: flex; justify-content: space-between; font-size: 9px; color: #94a3b8; margin-top: 8px; font-weight: 700; text-transform: uppercase; }

    /* Advice & Table */
    .advice-box { padding: 15px; background: #f0fdf4; border-radius: 12px; border-left: 4px solid #2f7f6a; margin-bottom: 20px; }
    .advice-box p { margin-top: 5px; font-size: 13px; line-height: 1.5; color: #14532d; }
    .table-title { font-size: 14px; font-weight: 700; margin-bottom: 10px; }
    .bmi-table { width: 100%; border-collapse: collapse; font-size: 11px; }
    .bmi-table th, .bmi-table td { padding: 8px; border: 1px solid #f1f5f9; text-align: left; }
    .highlight-row { background: #f0fdf4 !important; font-weight: 700; color: #2f7f6a; }

    /* Placeholder */
    .placeholder-box { text-align: center; padding: 50px 0; }
    .placeholder-icon { font-size: 40px; margin-bottom: 10px; }
    .placeholder-box p { font-size: 13px; color: #94a3b8; }

    /* Desktop View Overrides */
    @media (min-width: 768px) {
        .bmi-container { padding: 20px 40px; }
        .bmi-title { font-size: 28px; }
        .bmi-grid-layout { grid-template-columns: 350px 1fr; }
        .result-header { flex-direction: row; justify-content: space-between; }
        .bmi-score-wrapper { text-align: left; }
        #bmi-val { font-size: 64px; }
        .bmi-stats-box { min-width: 250px; }
        .btn-save-journal { width: auto; }
        .action-footer { display: flex; justify-content: flex-end; }
    }
</style>
@endsection

@section('page_scripts')
<script>
    let currentAnalysis = null;

    function analyzeBody() {
        // Ambil Nilai Input
        const w = parseFloat(document.getElementById('weight').value);
        const hCm = parseFloat(document.getElementById('height').value);
        const a = parseInt(document.getElementById('age').value);
        const g = document.getElementById('gender').value;

        // Validasi
        if(!w || !hCm || !a) return alert("Harap lengkapi data fisikmu!");

        // Kalkulasi Dasar
        const hM = hCm / 100;
        const bmi = (w / (hM * hM)).toFixed(1);
        const minIdeal = (18.5 * hM * hM).toFixed(1);
        const maxIdeal = (25.0 * hM * hM).toFixed(1);
        
        // Kalkulasi BMR (Mifflin-St Jeor Equation)
        let bmr = (g === 'male') 
            ? (10 * w) + (6.25 * hCm) - (5 * a) + 5 
            : (10 * w) + (6.25 * hCm) - (5 * a) - 161;

        // Tampilkan Konten Hasil
        document.getElementById('placeholder-text').style.display = 'none';
        document.getElementById('analysis-content').style.display = 'block';
        
        // Update Angka BMI & Statistik
        const bmiValElement = document.getElementById('bmi-val');
        bmiValElement.innerText = bmi;
        document.getElementById('weight-target').innerText = `${minIdeal} kg - ${maxIdeal} kg`;
        document.getElementById('bmr-val').innerText = Math.round(bmr).toLocaleString() + " kkal";

        // Update Posisi Jarum Indikator (Spectrum)
        let pos = ((bmi - 10) / (45 - 10)) * 100;
        pos = Math.max(0, Math.min(100, pos));
        document.getElementById('bmi-indicator').style.left = pos + "%";

        // Inisialisasi Variabel Klasifikasi
        const diffInfo = document.getElementById('info-diff');
        const advice = document.getElementById('advice-text');
        const badge = document.getElementById('bmi-badge');
        let rowId, cat, col, adviceMsg;

        // LOGIKA KLASIFIKASI SESUAI TABEL WHO
        if(bmi < 16) { 
            rowId = "row-severe"; cat = "Sangat Kurus"; col = "#5499c7"; 
            adviceMsg = "Kondisi sangat kurus. Disarankan konsultasi medis segera untuk pemeriksaan nutrisi.";
        } else if(bmi < 17) { 
            rowId = "row-moderate"; cat = "Kurus Moderat"; col = "#5dade2";
            adviceMsg = "Tingkatkan asupan kalori melalui nutrisi protein dan lemak sehat secara bertahap.";
        } else if(bmi < 18.5) { 
            rowId = "row-mild"; cat = "Kurus Ringan"; col = "#aed6f1";
            adviceMsg = "Dekat dengan ideal. Tambahkan porsi makan dan imbangi dengan latihan kekuatan ringan.";
        } else if(bmi < 25) { 
            rowId = "row-normal"; cat = "Normal (Ideal)"; col = "#2ecc71";
            adviceMsg = "Sempurna! Komposisi tubuhmu sangat baik. Pertahankan pola makan dan hidrasi saat ini.";
        } else if(bmi < 30) { 
            rowId = "row-overweight"; cat = "Kelebihan BB"; col = "#f1c40f";
            adviceMsg = "Waspadai risiko metabolik. Mulailah rutin jalan kaki 30 menit dan kurangi konsumsi gula.";
        } else if(bmi < 35) { 
            rowId = "row-obese1"; cat = "Obesitas Kelas I"; col = "#e67e22";
            adviceMsg = "Risiko kesehatan meningkat. Fokus pada pengurangan lemak jenuh dan perbanyak serat.";
        } else if(bmi < 40) {
            rowId = "row-obese2"; cat = "Obesitas Kelas II"; col = "#e74c3c";
            adviceMsg = "Risiko penyakit degeneratif tinggi. Sangat disarankan mengatur pola makan dengan bantuan ahli.";
        } else {
            rowId = "row-obese3"; cat = "Obesitas Kelas III"; col = "#943126";
            adviceMsg = "Kondisi darurat kesehatan. Fokus utama pada penurunan berat badan demi kesehatan kardiovaskular.";
        }

        // Update Warna Text Skor BMI Utama
        bmiValElement.style.color = col;

        // Update Informasi Selisih Berat Badan
        if (bmi >= 25) {
            diffInfo.innerHTML = `⚠️ Turunkan <strong>${(w - maxIdeal).toFixed(1)} kg</strong> untuk mencapai BMI 25.0`;
            diffInfo.style.color = "#e11d48";
        } else if (bmi < 18.5) {
            diffInfo.innerHTML = `💡 Tambahkan <strong>${(minIdeal - w).toFixed(1)} kg</strong> untuk mencapai BMI 18.5`;
            diffInfo.style.color = "#0284c7";
        } else {
            diffInfo.innerHTML = `✨ Berat badanmu sudah ideal!`;
            diffInfo.style.color = "#2f7f6a";
        }

        // Update Badge & Teks Rekomendasi
        badge.innerText = cat;
        badge.style.background = col;
        advice.innerText = adviceMsg;

        // Highlight Baris pada Tabel
        document.querySelectorAll('#bmi-table-body tr').forEach(tr => tr.classList.remove('highlight-row'));
        const activeRow = document.getElementById(rowId);
        if(activeRow) activeRow.classList.add('highlight-row');

        // Simpan Data untuk fungsi simpan ke database
        currentAnalysis = { weight: w, bmi_score: bmi };
    }

    function saveToJournal() {
        if(!currentAnalysis) return alert("Hitung BMI kamu terlebih dahulu!");
        
        const selectedDate = document.getElementById('log_date').value;
        const saveBtn = event.currentTarget;
        const originalText = saveBtn.innerHTML;
        
        saveBtn.innerHTML = "Menyimpan...";
        saveBtn.disabled = true;

        fetch("{{ route('input.data.store') }}", {
            method: "POST",
            headers: { 
                "Content-Type": "application/json", 
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                weight: currentAnalysis.weight,
                bmi_score: currentAnalysis.bmi_score,
                log_date: selectedDate,
                mood: 'neutral'
            })
        })
        .then(async res => {
            if(res.ok) {
                alert("✨ Berhasil! Data BMI Anda telah dicatat.");
                window.location.href = "{{ route('journal') }}";
            } else {
                alert("Gagal menyimpan data.");
                saveBtn.innerHTML = originalText;
                saveBtn.disabled = false;
            }
        })
        .catch(err => {
            alert("Terjadi kesalahan koneksi.");
            saveBtn.innerHTML = originalText;
            saveBtn.disabled = false;
        });
    }
</script>
@endsection