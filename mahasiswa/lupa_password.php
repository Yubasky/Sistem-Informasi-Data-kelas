<?php
session_start();
include '../koneksi/koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = trim($_POST['nim']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    if (empty($nim) || empty($password) || empty($confirm)) {
        $error = "Semua field harus diisi.";
    } elseif ($password !== $confirm) {
        $error = "Konfirmasi password tidak cocok.";
    } elseif (strlen($password) < 6) {
        $error = "Password minimal 6 karakter.";
    } else {

        // cek apakah NIM ada
        $cek = mysqli_prepare($koneksi, "SELECT id FROM user WHERE nim=?  LIMIT 1");
        mysqli_stmt_bind_param($cek, 's', $nim);
        mysqli_stmt_execute($cek);
        mysqli_stmt_store_result($cek);

        if (mysqli_stmt_num_rows($cek) === 0) {
            $error = "NIM tidak ditemukan.";
        } else {

            $hashed = password_hash($password, PASSWORD_BCRYPT);

            $update = mysqli_prepare($koneksi,
                "UPDATE user SET password=? WHERE nim=? LIMIT 1"
            );
            mysqli_stmt_bind_param($update, 'ss', $hashed, $nim);

            if (mysqli_stmt_execute($update)) {
                $success = "Password berhasil direset! Silakan login dengan password baru.";
            } else {
                $error = "Gagal mengupdate password.";
            }

            mysqli_stmt_close($update);
        }

        mysqli_stmt_close($cek);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Mahasiswa</title>
    <link rel="icon" href="bookshelf.png">
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
        <div class="form-container" style="max-width:650px;">

            <h2 class="form-title">Silahkan Reset Password Akun Anda</h2>

            <?php if ($error): ?>
                <div class="error-message" style="color:#b00020; background:#fdecea; padding:10px; border-radius:5px; text-align:center; margin-bottom:15px;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="success-message" style="color:#0b6623; background:#e8f5e9; padding:10px; border-radius:5px; text-align:center; margin-bottom:15px;">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" id="nim" name="nim" placeholder="Masukkan NIM terdaftar" required>
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>
                        <button type="button" class="show-password">Tampilkan</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm">Konfirmasi Password</label>
                    <div class="password-container">
                        <input type="password" id="confirm" name="confirm" placeholder="Ulangi password baru" required>
                        <button type="button" class="show-password">Tampilkan</button>
                    </div>
                </div>

                <button type="submit" class="btn">Reset Password</button>
            </form>

            <div class="divider"><span>atau</span></div>

            <div class="register-link">
                <a href="login_mahasiswa.php">Kembali ke Login</a>
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
