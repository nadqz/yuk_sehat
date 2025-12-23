<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar | Yuk Sehat!!</title>
  
  <link rel="stylesheet" href="{{ secure_asset('assets/css/style.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />

  <style>
    :root {
      --emerald-deep: #2f7f6a;
      --emerald-soft: #cfeee4;
      --platinum-line: #c7ccd3;
      --text-muted: #7d8c85;
    }

    body { 
      font-family: 'Poppins', sans-serif; 
      background: linear-gradient(135deg, #f8fbfa 0%, #e8f3f0 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      padding: 20px;
    }

    .register-wrapper {
      width: 100%;
      display: flex;
      justify-content: center;
    }

    .register-card {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(15px);
      border: 1px solid white;
      box-shadow: 0 20px 40px rgba(0,0,0,0.05);
      padding: 40px;
      border-radius: 24px;
      width: 100%;
      max-width: 480px;
      text-align: center;
      box-sizing: border-box;
    }

    .error-container { 
      background: #fdf2f2;
      color: #b03a2e; 
      font-size: 13px; 
      padding: 12px 15px;
      border-radius: 12px;
      margin-bottom: 20px; 
      border: 1px solid #f9d6d6;
      text-align: left;
    }

    form input {
      width: 100%;
      padding: 14px 18px;
      margin-bottom: 16px;
      border-radius: 14px;
      border: 1px solid var(--platinum-line);
      background: white;
      font-family: 'Poppins', sans-serif;
      transition: 0.3s;
      outline: none;
      box-sizing: border-box;
      font-size: 14px; /* Mencegah auto-zoom di iOS */
    }

    form input:focus {
      border-color: var(--emerald-deep);
      box-shadow: 0 0 0 4px var(--emerald-soft);
    }

    .btn-main {
      width: 100%;
      padding: 14px;
      background: var(--emerald-deep);
      color: white;
      border: none;
      border-radius: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      font-size: 16px;
      margin-top: 10px;
    }

    .btn-main:hover {
      opacity: 0.9;
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(47, 127, 106, 0.2);
    }

    .login-invitation {
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px dashed var(--platinum-line);
    }

    .login-invitation p {
      font-size: 13px;
      color: var(--text-muted);
      margin-bottom: 12px;
    }

    .btn-secondary {
      display: inline-block;
      text-decoration: none;
      color: var(--emerald-deep);
      font-weight: 600;
      font-size: 14px;
      padding: 10px 24px;
      border: 2px solid var(--emerald-deep);
      border-radius: 999px;
      transition: 0.3s;
    }

    .btn-secondary:hover {
      background: var(--emerald-deep);
      color: white;
    }

    .logo img { width: 60px; margin-bottom: 10px; }
    .logo h1 { font-size: 22px; margin: 0 0 10px 0; color: var(--emerald-deep); }

    /* --- MOBILE RESPONSIVE --- */
    @media (max-width: 480px) {
      body {
        padding: 15px;
        align-items: flex-start; /* Memungkinkan scroll jika konten panjang */
        padding-top: 30px;
        padding-bottom: 30px;
      }

      .register-card {
        padding: 30px 20px;
        border-radius: 20px;
      }

      .logo h1 {
        font-size: 20px;
      }

      h2 {
        font-size: 18px !important;
      }

      p {
        font-size: 12px !important;
      }

      .btn-main {
        font-size: 14px;
        padding: 12px;
      }
    }
  </style>
</head>

<body>

  <div class="register-wrapper">
    <div class="register-card">
      <div class="logo">
        <img src="{{ secure_asset('assets/img/logo-yuk-sehat.png') }}" alt="Yuk Sehat!!" />
        <h1>Yuk Sehat!!</h1>
      </div>

      <h2 style="font-weight: 600; margin-bottom: 8px;">Daftar Akun Baru</h2>
      <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 25px;">Lengkapi data diri untuk memulai perjalanan sehatmu</p>

      <form method="POST" action="{{ route('register') }}">
        @csrf 
        
        @if ($errors->any())
            <div class="error-container">
                <ul style="margin:0; padding:0; list-style-position: inside;">
                    @foreach ($errors->all() as $error)
                        <li style="margin-bottom: 4px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="input-grid">
            <input name="name" type="text" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus autocomplete="name" />
            
            <input name="email" type="email" placeholder="Alamat Email" value="{{ old('email') }}" required autocomplete="email" />
            
            <input name="password" type="password" placeholder="Kata Sandi (Min. 8 Karakter)" required autocomplete="new-password" />
            
            <input name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" required autocomplete="new-password" />
        </div>
        
        <button type="submit" class="btn-main">Daftar Sekarang</button>
      </form>

      <div class="login-invitation">
        <p>Sudah menjadi bagian dari Yuk Sehat!!?</p>
        <a href="{{ route('login') }}" class="btn-secondary">Masuk ke Akun</a>
      </div>

    </div>
  </div>

  <script src="{{ secure_asset('assets/js/register.js') }}"></script>
</body>
</html>
