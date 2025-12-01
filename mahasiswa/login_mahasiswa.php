    <?php
    session_start();
    include '../koneksi/loginmahasiswa.php';
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Kelas - Login Mahasiswa</title>
        <link rel="stylesheet" href="../asset/css/login.css">
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
                
                <!-- Login Form -->
                <div id="login-form" class="form-container" <?php echo (isset($_POST['register'])) ? 'style="display:none;"' : ''; ?>>
                    <h2 class="form-title">Masuk ke akun Mahasiswa</h2>
                    
                    <?php if ($error && !isset($_POST['register'])): ?>
                        <div class="error-message" style="color: #b00020; background: #fdecea; padding: 10px; border-radius: 5px; text-align:center; margin-bottom:15px;">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($success): ?>
                        <div class="success-message" style="color: #0b6623; background: #e8f5e9; padding: 10px; border-radius: 5px; text-align:center; margin-bottom:15px;">
                            <?php echo htmlspecialchars($success); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="email">Email atau NIM</label>
                            <input type="text" id="email" name="email" placeholder="Masukkan email atau NIM" required autocomplete="username">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <div class="password-container">
                                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required autocomplete="current-password">
                                <button type="button" class="show-password" id="showPassword">Tampilkan</button>
                            </div>
                        </div>
                        
                        <button type="submit" name="login" class="btn">Masuk</button>
                    </form>

                    <div class="register-link">
                        Lupa sandi akun? <a href="lupa_password.php">Ubah di sini</a>
                    </div>

                    <div class="divider"><span>atau</span></div>
                    
                    <div class="register-link">
                        Belum punya akun? <a href="#" id="goToRegister">Daftar di sini</a>
                    </div>
                    <div class="register-link">
                        <a href="../admin/login_admin.php">Login Admin</a>
                    </div>
                </div>
                
                <!-- Register Form -->
                <div id="register-form" class="form-container" <?php echo (isset($_POST['register'])) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                    <h2 class="form-title">Buat akun baru</h2>
                    
                    <?php if ($error && isset($_POST['register'])): ?>
                        <div class="error-message" style="color: #b00020; background: #fdecea; padding: 10px; border-radius: 5px; text-align:center; margin-bottom:15px;">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="user-type-selector">
                        <div class="user-type active" data-type="mahasiswa">Mahasiswa</div>
                    </div>
                    
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="reg-name">Nama Lengkap</label>
                            <input type="text" id="reg-name" name="name" placeholder="Masukkan nama lengkap" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg-nim">NIM</label>
                            <input type="text" id="reg-nim" name="nim" placeholder="Masukkan NIM" value="<?php echo isset($nim) ? htmlspecialchars($nim) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg-email">Email</label>
                            <input type="email" id="reg-email" name="email" placeholder="Masukkan email" value="<?php echo isset($remail) ? htmlspecialchars($remail) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg-password">Kata Sandi</label>
                            <div class="password-container">
                                <input type="password" id="reg-password" name="password" placeholder="Buat kata sandi (min. 6 karakter)" required autocomplete="new-password">
                                <button type="button" class="show-password" id="showRegPassword">Tampilkan</button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg-confirm-password">Konfirmasi Kata Sandi</label>
                            <div class="password-container">
                                <input type="password" id="reg-confirm-password" name="confirm-password" placeholder="Konfirmasi kata sandi" required autocomplete="new-password">
                                <button type="button" class="show-password" id="showRegConfirmPassword">Tampilkan</button>
                            </div>
                        </div>
                        
                        <button type="submit" name="register" class="btn">Daftar</button>
                    </form>
                    
                    <div class="divider"><span>atau</span></div>
                    
                    <div class="register-link">
                        Sudah punya akun? <a href="#" id="goToLogin">Masuk di sini</a>
                    </div>
                </div>
            </div>
        </main>
        
        <footer>
            <div class="container">
                <p>&copy; 2025 Kelompok-1</p>
            </div>
        </footer>
        
        <script src="../asset/js/login.js"></script>
    </body>
    </html>