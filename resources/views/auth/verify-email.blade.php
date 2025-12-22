<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email | Yuk Sehat!!</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --emerald-deep: #2f7f6a; --text-muted: #7d8c85; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #f8fbfa 0%, #e8f3f0 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; padding: 20px; }
        .auth-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(15px); border-radius: 24px; padding: 40px; width: 100%; max-width: 450px; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        
        .btn-main { padding: 14px 24px; background: var(--emerald-deep); color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; transition: 0.3s; width: 100%; font-size: 15px; }
        .btn-main:disabled { background: #ccc; cursor: not-allowed; transform: none; }
        
        .status-success { background: #dcfce7; color: #166534; padding: 12px; border-radius: 12px; font-size: 13px; margin-bottom: 20px; border: 1px solid #bbf7d0; }
        .timer-text { font-size: 13px; color: var(--text-muted); margin-top: 15px; display: block; }
        .btn-logout { background: transparent; color: #b03a2e; border: none; cursor: pointer; font-size: 13px; margin-top: 25px; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="auth-card">
        <img src="{{ asset('assets/img/logo-yuk-sehat.png') }}" width="65" style="margin-bottom: 15px;">
        <h2 style="font-weight: 600; margin-bottom: 10px;">Verifikasi Email</h2>
        
        <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 25px; line-height: 1.6;">
            Terima kasih telah bergabung! Silakan klik link verifikasi yang baru saja kami kirimkan ke email kamu untuk memulai.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="status-success">
                Link verifikasi baru telah dikirim ke alamat email kamu.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" id="resend-form">
            @csrf
            <button type="submit" id="resend-button" class="btn-main">Kirim Ulang Email</button>
            <span id="timer-label" class="timer-text" style="display: none;">
                Tunggu <span id="countdown">60</span> detik untuk mengirim ulang
            </span>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Keluar (Log Out)</button>
        </form>
    </div>

    <script>
        const resendBtn = document.getElementById('resend-button');
        const timerLabel = document.getElementById('timer-label');
        const countdownEl = document.getElementById('countdown');
        let timeLeft = 60; // 60 detik jeda
        let timerId;

        function startTimer() {
            resendBtn.disabled = true;
            timerLabel.style.display = 'block';
            
            timerId = setInterval(() => {
                timeLeft--;
                countdownEl.textContent = timeLeft;
                
                if (timeLeft <= 0) {
                    clearInterval(timerId);
                    resendBtn.disabled = false;
                    timerLabel.style.display = 'none';
                    timeLeft = 60;
                }
            }, 1000);
        }

        // Jalankan timer jika baru saja mengirim email
        @if (session('status') == 'verification-link-sent')
            startTimer();
        @endif

        document.getElementById('resend-form').onsubmit = function() {
            // Mencegah double klik saat proses submit
            if(resendBtn.disabled) return false;
        };
    </script>
</body>
</html>