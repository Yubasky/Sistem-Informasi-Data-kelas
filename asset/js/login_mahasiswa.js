// =======================
//  SHOW / HIDE PASSWORD
// =======================
document.getElementById("showPassword")?.addEventListener("click", function () {
  const passwordInput = document.getElementById("password");
  if (!passwordInput) return;

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
  ?.addEventListener("click", function () {
    const input = document.getElementById("reg-password");
    if (!input) return;

    if (input.type === "password") {
      input.type = "text";
      this.textContent = "Sembunyikan";
    } else {
      input.type = "password";
      this.textContent = "Tampilkan";
    }
  });

document
  .getElementById("showRegConfirmPassword")
  ?.addEventListener("click", function () {
    const input = document.getElementById("reg-confirm-password");
    if (!input) return;

    if (input.type === "password") {
      input.type = "text";
      this.textContent = "Sembunyikan";
    } else {
      input.type = "password";
      this.textContent = "Tampilkan";
    }
  });

// =======================
//  TOGGLE LOGIN <-> REGISTER
// =======================
const loginFormDiv = document.getElementById("login-form");
const registerFormDiv = document.getElementById("register-form");

document
  .getElementById("goToRegister")
  ?.addEventListener("click", function (e) {
    e.preventDefault();
    if (loginFormDiv) loginFormDiv.style.display = "none";
    if (registerFormDiv) registerFormDiv.style.display = "block";
  });

document.getElementById("goToLogin")?.addEventListener("click", function (e) {
  e.preventDefault();
  if (registerFormDiv) registerFormDiv.style.display = "none";
  if (loginFormDiv) loginFormDiv.style.display = "block";
});

// =======================
//  FORM SUBMIT — PHP HANDLE
// =======================
// Tidak ada preventDefault!
// Biarkan PHP memproses POST.