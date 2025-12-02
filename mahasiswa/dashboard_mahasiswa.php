<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard User - Data Kelas</title>
  <link rel="icon" href="../asset/img/bookshelf.png">
  <link rel="stylesheet" href="../asset/css/mahasiswa.css">
</head>
<body>

  <div class="sidebar">
    <h2 class="logo">Data Kelas</h2>
    <ul class="menu">
      <li class="active" onclick="location.href='dashboard_mahasiswa.php'">
        <img src="../asset/img/layout-dashboard.png" class="icon"> Dashboard
      </li>
      <li onclick="location.href='absensi_mahasiswa.php'">
        <img src="../asset/img/clipboard-list.png" class="icon"> Absensi Kelas
      </li>
      <li class="logout" onclick="location.href='../koneksi/logout_mahasiswa.php'">
        <img src="../asset/img/log-out.png" class="icon"> Logout
      </li>
    </ul>
  </div>
  

  <main class="main">
    <header>
      <h1>Selamat Datang, <span id="username"><?php echo htmlspecialchars(
        isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Mahasiswa'
      ); ?></span> 🎓</h1>
    </header>
    <br><br>

    <section class="cards">
      <div class="card">
        <h2>📋 Absensi Kelas</h2>
        <p>Isi kehadiran kamu untuk hari ini, dan pastikan datanya tersimpan dengan benar.</p>
        <a href="absensi_mahasiswa.php" class="btn">Isi Absensi</a>
      </div>

      <div class="card">
        <h2>👋 Logout</h2>
        <p>Terima kasih sudah menggunakan sistem Data Kelas.</p>
        <a href="../login_mahasiswa.php" class="btn btn-danger">Logout</a>
      </div>
    </section>
  </main>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    lucide.createIcons();
  </script>

</body>
</html>
