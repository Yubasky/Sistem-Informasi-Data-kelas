<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Kelas - Login</title>
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">Data Kelas</div>
        </div>
    </header>
    <main class="main-content">
        <div class="container">
            <div class="welcome-text">
                <h1>Selamat datang di sistem manajemen data kelas</h1>
            </div>
            
            <div id="login-form" class="form-container">
                <h2 class="form-title">Masuk ke akun Anda</h2>
                
                <div class="user-type-selector">
                    <div class="user-type active" data-type="mahasiswa">Mahasiswa</div>
                    <div class="user-type" data-type="admin">Admin</div>
                </div>
                
                <form id="loginForm">
                    <div class="form-group">
                        <label for="email">Email atau NIM</label>
                        <input type="text" id="email" name="email" placeholder="Masukkan email atau NIM" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
                            <button type="button" class="show-password" id="showPassword">Tampilkan</button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn">Masuk</button>
                </form>
                
                <div class="divider"><span>atau</span></div>
                
                <div class="register-link">
                    Belum punya akun? <a href="#" id="goToRegister">Daftar di sini</a>
                </div>
                <div class="register-link">
                  <a href="loginadmin.php" id="goToLogin">Login Admin</a>
                </div>
            </div>
            
            <!-- Register Form (Initially Hidden) -->
            <div id="register-form" class="form-container" style="display: none;">
                <h2 class="form-title">Buat akun baru</h2>
                
                <div class="user-type-selector">
                    <div class="user-type active" data-type="mahasiswa">Mahasiswa</div>
                </div>
                
                <form id="registerForm">
                    <div class="form-group">
                        <label for="reg-name">Nama Lengkap</label>
                        <input type="text" id="reg-name" name="name" placeholder="Masukkan nama lengkap" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="reg-nim">NIM</label>
                        <input type="text" id="reg-nim" name="nim" placeholder="Masukkan NIM" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="reg-email">Email</label>
                        <input type="email" id="reg-email" name="email" placeholder="Masukkan email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="reg-password">Kata Sandi</label>
                        <div class="password-container">
                            <input type="password" id="reg-password" name="password" placeholder="Buat kata sandi" required>
                            <button type="button" class="show-password" id="showRegPassword">Tampilkan</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="reg-confirm-password">Konfirmasi Kata Sandi</label>
                        <div class="password-container">
                            <input type="password" id="reg-confirm-password" name="confirm-password" placeholder="Konfirmasi kata sandi" required>
                            <button type="button" class="show-password" id="showRegConfirmPassword">Tampilkan</button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn">Daftar</button>
                </form>
                
                <div class="divider"><span>atau</span></div>
                
                <div class="register-link">
                    Sudah punya akun? <a href="login.php" id="goToLogin">Masuk di sini</a>
                </div>
            </div>
        </div>
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; 2025 Kelompok-1</p>
        </div>
    </footer>
    <script src="asset/js/script.js"></script>
</body>
</html>