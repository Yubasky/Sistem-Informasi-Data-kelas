<?php
// Sesuaikan path koneksi dengan struktur folder Anda
include 'koneksi.php';

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