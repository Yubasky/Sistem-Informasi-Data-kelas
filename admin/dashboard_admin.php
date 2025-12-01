<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header('Location: login_admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Data Kelas</title>
  <link rel="icon" href="bookshelf.png">
  <link rel="stylesheet" href="../asset/css/admin.css">
</head>
<body>
  <div class="sidebar">
    <h2 class="logo">Data Kelas</h2>
    <ul class="menu">
      <li class="active">
        <img src="../asset/img/layout-dashboard.png" class="icon">
        Dashboard
      </li>
      <li onclick="location.href='absensi_admin.php'">
        <img src="../asset/img/clipboard-list.png" class="icon">
        Absensi Kelas
      </li>
      <li onclick="location.href='uang_kas.php'">
        <img src="../asset/img/wallet.png" class="icon">
        Uang Kas
      </li>

      <!-- Arahkan ke logout.php yang benar -->
      <li onclick="location.href='logout_admin.php'" class="logout">
        <img src="../asset/img/log-out.png" class="icon">
        Logout
      </li>
    </ul>
  </div>

  <div class="main">
    <header>
      <h1>Selamat Datang, Admin <?php echo $_SESSION['admin_username']; ?></h1>
      <br>
    </header>

    <section class="cards">
      <div class="card">
        <h2>📋 Absensi Kelas</h2>
        <p>Lihat & ubah status kehadiran mahasiswa.</p>
        <a href="absensi_admin.php" class="btn">Kelola Absensi</a>
      </div>

      <div class="card">
        <h2>💰 Uang Kas</h2>
        <p>Atur dan catat pembayaran uang kas mahasiswa.</p>
        <a href="uang_kas.php" class="btn">Kelola Kas</a>
      </div>
    </section>
  </div>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>
