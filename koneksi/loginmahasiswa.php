<?php
include 'koneksi.php';

$error = '';
$success = '';

/* =======================================================
   LOGIN
   ======================================================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $login_input = trim($_POST['email']); 
    $password = $_POST['password'];

    if (empty($login_input) || empty($password)) {
        $error = 'Email/NIM dan password harus diisi.';
    } else {

        $stmt = mysqli_prepare($koneksi,
            "SELECT id, nama, nim, email, password FROM user 
             WHERE email = ? OR nim = ? LIMIT 1"
        );

        mysqli_stmt_bind_param($stmt, 'ss', $login_input, $login_input);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {

            if ($password === $row['password']) {

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['nama'];
                $_SESSION['user_nim']  = $row['nim'];
                $_SESSION['user_email']= $row['email'];

                header("Location: ../mahasiswa/dashboard_mahasiswa.php");
                exit;

            } else {
                $error = "Email/NIM atau password salah.";
            }

        } else {
            $error = "Email/NIM atau password salah.";
        }

        mysqli_stmt_close($stmt);
    }
}

/* =======================================================
   REGISTRASI — TANPA HASH SESUAI PERMINTAAN YUU
   ======================================================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $nim = trim($_POST['nim']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm-password'];

    if (empty($name) || empty($nim) || empty($email) ||
        empty($password) || empty($confirm)) {

        $error = 'Semua field harus diisi.';

    } elseif ($password !== $confirm) {
        $error = 'Konfirmasi password tidak cocok.';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';

    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';

    } else {

        $check = mysqli_prepare($koneksi,
            "SELECT id FROM user WHERE email=? OR nim=? LIMIT 1"
        );

        mysqli_stmt_bind_param($check, 'ss', $email, $nim);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $error = 'Email atau NIM sudah terdaftar.';
        } else {

            $insert = mysqli_prepare($koneksi,
                "INSERT INTO user (nama, nim, email, password) 
                 VALUES (?, ?, ?, ?)"
            );

            mysqli_stmt_bind_param($insert, 'ssss',
                $name, $nim, $email, $password
            );

            if (mysqli_stmt_execute($insert)) {
                $success = "Pendaftaran berhasil! Silakan login.";
                $name = $nim = $email = "";
            } else {
                $error = 'Gagal menyimpan data.';
            }

            mysqli_stmt_close($insert);
        }

        mysqli_stmt_close($check);
    }
}
?>
