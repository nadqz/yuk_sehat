@extends('layouts.app')

@section('title', 'Tips Kesehatan')

@section('content')
<div class="wellness-wrapper">
    
    {{-- HEADER DENGAN ANIMASI --}}
    <header class="wellness-header" data-aos="fade-down">
        <div class="title-container">
            <h2 class="wellness-title">Tips Kesehatan<span class="emoji-bounce"></span></h2>
            <div class="title-underline"></div>
        </div>
        <p class="wellness-subtitle">Inspirasi harian untuk kesehatan tubuh dan ketenangan pikiran Anda.</p>
    </header>

    {{-- HIGHLIGHT CARD PREMIUM DENGAN BACKGROUND IMAGE --}}
    <section class="premium-highlight-card" data-aos="zoom-in" style="background-image: url('https://images.unsplash.com/photo-1490818387583-1baba5e638af?auto=format&fit=crop&w=1200&q=80'); background-size: cover; background-position: center;">
        {{-- Glass Overlay untuk kontras teks --}}
        <div class="glass-overlay"></div>
        
        <div class="content-rel">
            <div class="badge-new">Insight Hari Ini</div>
            <div class="quote-symbol">“</div>
            <h3 id="tipsHighlightText" class="main-tip-text">Memuat inspirasi cerdas untukmu...</h3>
            <button onclick="nextTip()" class="btn-modern">
                <span>Eksplorasi Tips</span>
                <i class="icon-refresh">↻</i>
            </button>
        </div>
        
        {{-- Elemen Dekorasi Bergerak --}}
        <div class="blob-1"></div>
        <div class="blob-2"></div>
    </section>

    {{-- GRID CATEGORIES DENGAN GAMBAR KECIL --}}
    <div class="wellness-grid">
        <div class="tip-card" data-aos="fade-up" data-aos-delay="100">
            <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1548839140-29a749e1cf4d?auto=format&fit=crop&w=400&q=80')"></div>
            <div class="card-inner">
                <div class="icon-box water">💧</div>
                <div class="text-box">
                    <h4>Optimalkan Hidrasi</h4>
                    <p>Tubuh manusia terdiri dari <b>60% air</b>. Minumlah 8 gelas per hari untuk metabolisme prima.</p>
                </div>
            </div>
        </div>

        <div class="tip-card" data-aos="fade-up" data-aos-delay="200">
            <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?auto=format&fit=crop&w=400&q=80')"></div>
            <div class="card-inner">
                <div class="icon-box sleep">🌙</div>
                <div class="text-box">
                    <h4>Prioritas Tidur</h4>
                    <p>Fase <i>reboot</i> alami. Tidur 7-9 jam memperkuat sistem imun dan daya ingat maksimal.</p>
                </div>
            </div>
        </div>

        <div class="tip-card" data-aos="fade-up" data-aos-delay="300">
            <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=400&q=80')"></div>
            <div class="card-inner">
                <div class="icon-box move">🚶</div>
                <div class="text-box">
                    <h4>Micro-Movement</h4>
                    <p>Aktifkan sirkulasi darah. Stretching 2 menit setiap jam efektif menjaga kesehatan jantung.</p>
                </div>
            </div>
        </div>

        <div class="tip-card" data-aos="fade-up" data-aos-delay="400">
            <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1490474418585-ba9bad8fd0ea?auto=format&fit=crop&w=400&q=80')"></div>
            <div class="card-inner">
                <div class="icon-box sugar">🍎</div>
                <div class="text-box">
                    <h4>Kontrol Gula</h4>
                    <p>Pilih energi stabil. Kurangi gula tambahan untuk menghindari inflamasi dan kelelahan kronis.</p>
                </div>
            </div>
        </div>

        <div class="tip-card" data-aos="fade-up" data-aos-delay="500">
            <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=400&q=80')"></div>
            <div class="card-inner">
                <div class="icon-box stress">🧘</div>
                <div class="text-box">
                    <h4>Manajemen Stres</h4>
                    <p>Teknik <i>box breathing</i> 5 menit dapat menenangkan sistem saraf pusat Anda seketika.</p>
                </div>
            </div>
        </div>

        <div class="tip-card" data-aos="fade-up" data-aos-delay="600">
            <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=400&q=80')"></div>
            <div class="card-inner">
                <div class="icon-box food">🥗</div>
                <div class="text-box">
                    <h4>Piring Pelangi</h4>
                    <p>Kombinasi warna sayur dan buah memberikan perlindungan terbaik terhadap radikal bebas.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, rgba(47, 127, 106, 0.9) 0%, rgba(26, 77, 62, 0.95) 100%);
        --accent-color: #2f7f6a;
    }

    .wellness-wrapper { padding: 20px 15px 80px; max-width: 1200px; margin: 0 auto; font-family: 'Plus Jakarta Sans', sans-serif; }

    /* Header Styling */
    .wellness-header { text-align: left; margin-bottom: 35px; }
    .wellness-title { font-size: 28px; font-weight: 800; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; }
    .title-underline { width: 50px; height: 4px; background: var(--accent-color); margin-top: 8px; border-radius: 2px; }
    .wellness-subtitle { color: #64748b; font-size: 14px; margin-top: 10px; line-height: 1.5; }

    /* Premium Highlight Card */
    .premium-highlight-card {
        border-radius: 30px; padding: 50px 30px; position: relative; overflow: hidden;
        color: white; margin-bottom: 40px; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }
    .glass-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: var(--primary-gradient); backdrop-filter: blur(2px);
    }
    .content-rel { position: relative; z-index: 5; text-align: center; }
    .quote-symbol { font-size: 60px; line-height: 0; margin-bottom: 20px; font-family: serif; opacity: 0.6; }
    .badge-new {
        background: rgba(255, 255, 255, 0.2); display: inline-block; padding: 6px 15px; 
        border-radius: 50px; font-size: 11px; font-weight: 700; text-transform: uppercase;
        margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.3);
    }
    .main-tip-text { font-size: 20px; font-weight: 700; line-height: 1.6; margin-bottom: 30px; min-height: 80px; transition: all 0.4s ease; }
    .btn-modern {
        background: white; color: #1a4d3e; border: none; padding: 15px 30px; border-radius: 16px; 
        font-weight: 800; display: flex; align-items: center; gap: 10px; cursor: pointer; transition: 0.3s; margin: 0 auto;
    }
    .btn-modern:hover { transform: scale(1.05); }

    /* Grid & Cards */
    .wellness-grid { display: grid; grid-template-columns: 1fr; gap: 25px; }
    .tip-card { 
        background: white; border-radius: 24px; overflow: hidden; 
        transition: 0.4s; border: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .tip-card:hover { transform: translateY(-10px); }
    .card-img-top { height: 160px; background-size: cover; background-position: center; }
    .card-inner { padding: 25px; display: flex; align-items: flex-start; gap: 20px; }
    .icon-box { width: 50px; height: 50px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
    
    /* Icon Box Colors */
    .water { background: #e0f2fe; } .sleep { background: #eef2ff; } .move { background: #ecfdf5; }
    .sugar { background: #fff1f2; } .stress { background: #fdf4ff; } .food { background: #fff7ed; }

    .text-box h4 { margin: 0 0 8px 0; font-size: 17px; color: #1e293b; font-weight: 700; }
    .text-box p { margin: 0; font-size: 13.5px; color: #64748b; line-height: 1.6; }

    /* Animated Blobs */
    .blob-1, .blob-2 {
        position: absolute; width: 150px; height: 150px;
        background: rgba(255, 255, 255, 0.1); border-radius: 50%;
        filter: blur(40px); animation: move 10s infinite alternate;
    }
    .blob-1 { top: -50px; right: -50px; } .blob-2 { bottom: -50px; left: -20px; }
    @keyframes move { from { transform: translate(0,0); } to { transform: translate(40px, 40px); } }

    /* Responsiveness */
    @media (min-width: 768px) {
        .wellness-grid { grid-template-columns: repeat(2, 1fr); }
        .wellness-title { font-size: 34px; }
        .main-tip-text { font-size: 24px; }
        .content-rel { text-align: left; }
        .btn-modern { margin: 0; }
    }
    @media (min-width: 1024px) { .wellness-grid { grid-template-columns: repeat(3, 1fr); } }
</style>
@endsection

@section('page_scripts')
<script>
    const tipsList = [
        "Minum air putih minimal 6–8 gelas per hari untuk menjaga hidrasi dan konsentrasi.",
        "Usahakan tidur 7–9 jam setiap malam agar tubuh dan pikiran benar-benar pulih.",
        "Bergeraklah setiap 30–60 menit untuk mengurangi risiko sakit punggung dan penyakit metabolik.",
        "Batasi konsumsi gula tambahan dan pilih makanan utuh seperti buah, sayur, dan biji-bijian.",
        "Luangkan waktu 5–10 menit setiap hari untuk bernapas dalam dan menenangkan pikiran.",
        "Kurangi waktu menatap layar sebelum tidur agar kualitas tidur lebih baik.",
        "Perbanyak warna di piringmu: kombinasi sayur dan buah berwarna kaya antioksidan.",
        "Latihan ringan seperti jalan kaki 20–30 menit sudah cukup membantu kesehatan jantung.",
        "Tersenyum dan berinteraksi dengan orang lain dapat membantu menurunkan stres.",
        "Biasakan mencuci tangan sebelum makan untuk menjaga kebersihan sistem pencernaan."
    ];

    function nextTip() {
        const el = document.getElementById("tipsHighlightText");
        const btn = document.querySelector(".btn-modern i");
        
        btn.style.transition = "0.5s";
        btn.style.transform = "rotate(360deg)";
        el.style.opacity = "0";
        el.style.transform = "translateY(10px)";
        
        setTimeout(() => {
            const randomIndex = Math.floor(Math.random() * tipsList.length);
            el.textContent = tipsList[randomIndex];
            el.style.opacity = "1";
            el.style.transform = "translateY(0)";
            btn.style.transform = "rotate(0deg)";
        }, 400);
    }

    document.addEventListener('DOMContentLoaded', nextTip);
</script>
@endsection