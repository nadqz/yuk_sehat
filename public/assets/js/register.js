document.getElementById("registerForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const nama = document.getElementById("nama").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();
  const confirmPassword = document.getElementById("confirmPassword").value.trim();

  if (nama === "") {
    alert("Nama tidak boleh kosong");
    return;
  }

  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    alert("Format email tidak valid");
    return;
  }

  if (password.length < 6) {
    alert("Password minimal 6 karakter");
    return;
  }

  if (password !== confirmPassword) {
    alert("Konfirmasi password tidak cocok");
    return;
  }

  // ✅ Simpan data user
  const user = {
    nama: nama,
    email: email,
    password: password
  };

  localStorage.setItem("user", JSON.stringify(user));

  alert("Registrasi berhasil!");
  window.location.href = "index.html";
});
