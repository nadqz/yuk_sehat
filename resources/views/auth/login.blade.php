<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Yuk Sehat!!</title>
  
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
      padding: 20px; /* Jarak aman agar card tidak nempel layar di HP */
    }

    .login-wrapper {
      width: 100%;
      display: flex;
      justify-content: center;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(15px);
      border: 1px solid white;
      box-shadow: 0 20px 40px rgba(0,0,0,0.05);
      padding: 40px;
      border-radius: 24px;
      width: 100%;
      max-width: 400px;
      text-align: center;
      box-sizing: border-box;
    }

    /* Styling pesan error */
    .error-container { 
      background: #fdf2f2;
      color: #b03a2e; 
      font-size: 13px; 
      padding: 12px;
      border-radius: 12px;
      margin-bottom: 20px; 
      border: 1px solid #f9d6d6;
      text-align: left;
    }

    .error-container ul { margin: 0; padding-left: 20px; }

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
      font-size: 14px; /* Standar mobile agar tidak zoom otomatis di iOS */
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
    }

    .btn-main:hover {
      opacity: 0.9;
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(47, 127, 106, 0.2);
    }

    .register-invitation {
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px dashed var(--platinum-line);
    }

    .register-invitation p {
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

    .logo img { width: 70px; margin-bottom: 10px; }
    .logo h1 { font-size: 24px; margin: 0 0 25px 0; color: var(--emerald-deep); }
    
    .forgot-link {
        display: block;
        margin-top: -10px;
        margin-bottom: 20px;
        text-align: right;
        font-size: 12px;
        color: var(--emerald-deep);
        text-decoration: none;
    }

    /* --- MOBILE RESPONSIVE --- */
    @media (max-width: 480px) {
      body {
        padding: 15px;
        align-items: flex-start; /* Card mulai dari atas jika layar sangat kecil */
        padding-top: 50px;
      }

      .login-card {
        padding: 30px 20px; /* Padding lebih kecil agar ruang input lebih luas */
        border-radius: 20px;
      }

      .logo h1 {
        font-size: 20px;
      }

      .btn-main, .btn-secondary {
        font-size: 14px;
      }

      h2 {
        font-size: 18px;
      }
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <div class="login-card">
      <div class="logo">
        <img src="{{ secure_asset('assets/img/logo-yuk-sehat.png') }}" alt="Yuk Sehat!!" />
        <h1>Yuk Sehat!!</h1>
      </div>

      <h2 style="font-weight: 600; margin-bottom: 8px;">Selamat Datang</h2>
      <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 25px;">Silakan masuk untuk memantau kesehatanmu</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf 
        
        @if ($errors->any())
            <div class="error-container">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input name="email" type="email" placeholder="Alamat Email" value="{{ old('email') }}" required autofocus autocomplete="username" />
        
        <input name="password" type="password" placeholder="Password" required autocomplete="current-password" />

        @if (Route::has('password.request'))
            <a class="forgot-link" href="{{ route('password.request') }}">
                Lupa password?
            </a>
        @endif
        
        <button type="submit" class="btn-main">Masuk ke Dashboard</button>
      </form>

      <div class="register-invitation">
        <p>Belum memiliki akun Yuk Sehat!!?</p>
        <a href="{{ route('register') }}" class="btn-secondary">Registrasi & Buat Akun</a>
      </div>
    </div>
  </div>

  <script src="{{ secure_asset('assets/js/login.js') }}"></script>
</body>
</html>
