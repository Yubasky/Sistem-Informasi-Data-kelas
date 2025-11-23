<?php
// Sesuaikan path koneksi dengan struktur folder Anda
include '../koneksi/koneksi.php';
session_start();

$error = '';

// Proses Login Admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_admin'])) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi.';
    } else {
        // Query untuk mencari admin berdasarkan username
        $stmt = mysqli_prepare($koneksi, "SELECT id, username, password FROM admin WHERE username = ? LIMIT 1");
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($row = mysqli_fetch_assoc($result)) {
                // Cek apakah password di database sudah di-hash atau masih plain text
                $db_password = $row['password'];
                
                // Coba verifikasi dengan password_verify (jika password di-hash)
                $is_valid = password_verify($password, $db_password);
                
                // Jika tidak valid dengan hash, coba bandingkan langsung (untuk backward compatibility)
                if (!$is_valid && $password === $db_password) {
                    $is_valid = true;
                }
                
                if ($is_valid) {
                    // Login sukses
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_username'] = $row['username'];
                    $_SESSION['is_admin'] = true;
                    
                    // Redirect ke halaman admin
                    header('Location: ../admin/dashboard_admin.php');
                    exit;
                } else {
                    $error = 'Username atau password salah.';
                }
            } else {
                $error = 'Username atau password salah.';
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = 'Terjadi kesalahan pada server: ' . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas - Login Admin</title>
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
            
            <!-- Login Admin Form -->
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
                    <a href="../mahasiswa/login_mahasiswa.php">Login Mahasiswa</a>
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