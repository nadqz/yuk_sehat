document.getElementById("loginForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (email === "" || password === "") {
    alert("Email dan password tidak boleh kosong");
    return;
  }

  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    alert("Format email tidak valid");
    return;
  }

  const userData = JSON.parse(localStorage.getItem("user"));

  if (!userData) {
    alert("Akun tidak ditemukan. Silakan daftar terlebih dahulu.");
    return;
  }

  if (email === userData.email && password === userData.password) {
    alert("Login berhasil!");

    // ✅ Simpan status login
    localStorage.setItem("isLoggedIn", "true");

    window.location.href = "dashboard.html";
  } else {
    alert("Email atau password salah");
  }
});
