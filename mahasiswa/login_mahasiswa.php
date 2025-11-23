<?php
include '../koneksi/koneksi.php';
session_start();

$error = '';
$success = '';

// Proses Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        $error = 'Email/NIM dan password harus diisi.';
    } else {
        // Query untuk mencari user berdasarkan email atau NIM
        $stmt = mysqli_prepare($koneksi, "SELECT id, nama, nim, email, password FROM user WHERE email = ? OR nim = ? LIMIT 1");
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ss', $email, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($row = mysqli_fetch_assoc($result)) {
                // Verifikasi password
                if (password_verify($password, $row['password'])) {
                    // Login sukses
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['nama'];
                    $_SESSION['user_nim'] = $row['nim'];
                    $_SESSION['user_email'] = $row['email'];
                    
                    // Redirect ke halaman user - sesuaikan dengan struktur folder Anda
                    header('Location: dashboard_mahasiswa.php');
                    exit;
                } else {
                    $error = 'Email/NIM atau password salah.';
                }
            } else {
                $error = 'Email/NIM atau password salah.';
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = 'Terjadi kesalahan pada server: ' . mysqli_error($koneksi);
        }
    }
}

// Proses Registrasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $nim = isset($_POST['nim']) ? trim($_POST['nim']) : '';
    $remail = isset($_POST['email']) ? trim($_POST['email']) : '';
    $rpassword = isset($_POST['password']) ? $_POST['password'] : '';
    $rconfirm = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';

    // Validasi input
    if (empty($name) || empty($nim) || empty($remail) || empty($rpassword) || empty($rconfirm)) {
        $error = 'Semua field pendaftaran harus diisi.';
    } elseif ($rpassword !== $rconfirm) {
        $error = 'Password dan konfirmasi tidak cocok.';
    } elseif (strlen($rpassword) < 6) {
        $error = 'Password minimal 6 karakter.';
    } elseif (!filter_var($remail, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } else {
        // Cek apakah email atau NIM sudah terdaftar
        $check = mysqli_prepare($koneksi, "SELECT id FROM user WHERE email = ? OR nim = ? LIMIT 1");
        
        if ($check) {
            mysqli_stmt_bind_param($check, 'ss', $remail, $nim);
            mysqli_stmt_execute($check);
            mysqli_stmt_store_result($check);
            
            if (mysqli_stmt_num_rows($check) > 0) {
                $error = 'Email atau NIM sudah terdaftar.';
            } else {
                // Hash password
                $hash = password_hash($rpassword, PASSWORD_DEFAULT);
                
                // Insert data user baru
                $ins = mysqli_prepare($koneksi, "INSERT INTO user (nama, nim, email, password) VALUES (?, ?, ?, ?)");
                
                if ($ins) {
                    mysqli_stmt_bind_param($ins, 'ssss', $name, $nim, $remail, $hash);
                    
                    if (mysqli_stmt_execute($ins)) {
                        $success = 'Pendaftaran berhasil! Silakan login dengan akun Anda.';
                        // Reset form values
                        $name = $nim = $remail = '';
                    } else {
                        $error = 'Gagal menyimpan data: ' . mysqli_error($koneksi);
                    }
                    mysqli_stmt_close($ins);
                } else {
                    $error = 'Terjadi kesalahan pada server: ' . mysqli_error($koneksi);
                }
            }
            mysqli_stmt_close($check);
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
    
    <script src="../asset/js/login_mahasiswa.js"></script>
</body>
</html>