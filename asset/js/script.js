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
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        this.textContent = "Sembunyikan";
      } else {
        passwordInput.type = "password";
        this.textContent = "Tampilkan";
      }
    });
  
  document
    .getElementById("showRegConfirmPassword")
    .addEventListener("click", function () {
      const passwordInput = document.getElementById("reg-confirm-password");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        this.textContent = "Sembunyikan";
      } else {
        passwordInput.type = "password";
        this.textContent = "Tampilkan";
      }
    });
  
  // User type selector
  const userTypes = document.querySelectorAll(".user-type");
  userTypes.forEach((type) => {
    type.addEventListener("click", function () {
      userTypes.forEach((t) => t.classList.remove("active"));
      this.classList.add("active");
  
      // Update form fields based on user type
      if (this.dataset.type === "admin") {
        document.querySelector('label[for="email"]').textContent = "Email";
        document.querySelector('label[for="reg-nim"]').textContent = "ID Admin";
        document.getElementById("reg-nim").placeholder = "Masukkan ID Admin";
      } else {
        document.querySelector('label[for="email"]').textContent =
          "Email atau NIM";
        document.querySelector('label[for="reg-nim"]').textContent = "NIM";
        document.getElementById("reg-nim").placeholder = "Masukkan NIM";
      }
    });
  });
  
  // Form submission
  document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();
    alert("Login berhasil!");
    // Here you would typically send the data to your backend
  });
  
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
  
      alert("Pendaftaran berhasil!");
      // Here you would typically send the data to your backend
    });