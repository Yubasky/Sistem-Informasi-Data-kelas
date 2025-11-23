<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Uang Kas Kelas - Admin</title>
  <link rel="stylesheet" href="../asset/css/uang_kas.css"/>
  <link rel="stylesheet" href="../asset/css/admin.css"/>
</head>

<body>
  <div class="sidebar">
    <h2 class="logo">Data Kelas</h2>
    <ul class="menu">
      <li onclick="location.href='dashboard_admin.php'">
        <img src="../asset/img/layout-dashboard.png" class="icon">
        Dashboard
      </li>

      <li onclick="location.href='absensi_admin.php'">
        <img src="../asset/img/clipboard-list.png" class="icon">
        Absensi Kelas
      </li>

      <li class="active">
        <img src="../asset/img/wallet.png" class="icon">
        Uang Kas
      </li>

      <li onclick="location.href='login_admin.php'" class="logout">
        <img src="../asset/img/log-out.png" class="icon">
        Logout
      </li>
    </ul>
  </div>

  <div class="main">
    <header>
      <h1>💰 Uang Kas Kelas</h1>
      <p>Kelola semua data pembayaran uang kas mahasiswa.</p>
    </header>

    <!-- FORM INPUT -->
    <section class="form-section">
      <h2>Tambah Pembayaran</h2>

      <div class="form-container">
        <input type="text" id="nimInput" placeholder="NIM Mahasiswa">
        <input type="text" id="namaInput" placeholder="Nama Mahasiswa">
        <input type="number" id="jumlahInput" placeholder="Jumlah Bayar (Rp)">
        <input type="text" id="ketInput" placeholder="Keterangan (minggu/bulan)">
        <button class="btn" id="addBtn">Tambah Pembayaran</button>
      </div>
    </section>
    <br>

    <!-- TABEL DATA -->
    <section class="absensi-section">
      <div class="table-header">
        <h2>Data Pembayaran Uang Kas</h2>
        <div class="table-actions">
          <button class="btn" id="exportBtn">Export Laporan</button>
        </div>
      </div>

      <table class="absensi-table">
        <thead>
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jumlah (Rp)</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody id="kasBody">
          <!-- DATA DINAMIS -->
        </tbody>
      </table>
    </section>
  </div>

  <!-- PANGGIL FILE JS -->
  <script src="../asset/js/uang_kas.js"></script>
</body>
</html>
