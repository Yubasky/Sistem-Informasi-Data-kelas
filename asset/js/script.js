// Toggle between login and register forms
document.getElementById("goToRegister").addEventListener("click", function (e) {
  e.preventDefault();
  document.getElementById("login-form").style.display = "none";
  document.getElementById("register-form").style.display = "block";
});

document.getElementById("goToLogin").addEventListener("click", function (e) {
  e.preventDefault();
  document.getElementById("register-form").style.display = "none";
  document.getElementById("login-form").style.display = "block";
});

// Toggle password visibility
document.getElementById("showPassword").addEventListener("click", function () {
  const passwordInput = document.getElementById("password");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    this.textContent = "Sembunyikan";
  } else {
    passwordInput.type = "password";
    this.textContent = "Tampilkan";
  }
});

document
  .getElementById("showRegPassword")
  .addEventListener("click", function () {
    const passwordInput = document.getElementById("reg-password");
    passwordInput.type =
      passwordInput.type === "password" ? "text" : "password";
    this.textContent =
      passwordInput.type === "text" ? "Sembunyikan" : "Tampilkan";
  });

document
  .getElementById("showRegConfirmPassword")
  .addEventListener("click", function () {
    const passwordInput = document.getElementById("reg-confirm-password");
    passwordInput.type =
      passwordInput.type === "password" ? "text" : "password";
    this.textContent =
      passwordInput.type === "text" ? "Sembunyikan" : "Tampilkan";
  });

// User type selector (LOGIN ONLY)
const userTypes = document.querySelectorAll(".user-type");
userTypes.forEach((type) => {
  type.addEventListener("click", function () {
    userTypes.forEach((t) => t.classList.remove("active"));
    this.classList.add("active");

    // Update label ONLY for login
    if (this.dataset.type === "admin") {
      document.querySelector('label[for="email"]').textContent = "Email";
    } else {
      document.querySelector('label[for="email"]').textContent =
        "Email atau NIM";
    }
  });
});

// Login submit
document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();
  // nanti tinggal arahkan ke file dashboard
});

// Register submit
document
  .getElementById("registerForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    const password = document.getElementById("reg-password").value;
    const confirmPassword = document.getElementById(
      "reg-confirm-password"
    ).value;

    if (password !== confirmPassword) {
      alert("Kata sandi tidak cocok!");
      return;
    }

    // proses register mahasiswa
  });