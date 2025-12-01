<?php
    session_start();
    include '../koneksi/loginadmin.php';

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas - Login Admin</title>
    <link rel="icon" href="../asset/img/bookshelf.png">
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
            
            <div id="login-form" class="form-container">
                <h2 class="form-title">Masuk sebagai Admin</h2>

                <?php if ($error): ?>
                    <div class="error-message" style="color: #b00020; background: #fdecea; padding: 10px; border-radius: 5px; text-align:center; margin-bottom:15px;">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Masukkan username admin" required autocomplete="username">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required autocomplete="current-password">
                            <button type="button" class="show-password" id="showPassword">Tampilkan</button>
                        </div>
                    </div>
                    
                    <button type="submit" name="login_admin" class="btn">Masuk sebagai Admin</button>
                </form>
                
                <div class="divider"><span>atau</span></div>
                
                <div class="register-link">
                    <a href="login_mahasiswa.php">Login Mahasiswa</a>
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