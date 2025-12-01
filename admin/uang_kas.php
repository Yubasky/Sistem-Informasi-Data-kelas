<?php
session_start();
include '../koneksi/koneksi.php';

// Jika mode edit dijalankan
$editMode = false;
$editData = null;

if (isset($_GET['edit'])) {
    $editMode = true;
    $id = $_GET['edit'];
    $result = mysqli_query($koneksi, "SELECT * FROM uang_kas WHERE id='$id'");
    $editData = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Uang Kas Kelas - Admin</title>
  <link rel="stylesheet" href="../asset/css/uang_kas.css">
  <link rel="stylesheet" href="../asset/css/admin.css">
</head>

<body>

<div class="sidebar">
    <h2 class="logo">Data Kelas</h2>
    <ul class="menu">
      <li onclick="location.href='dashboard_admin.php'">
        <img src="../asset/img/layout-dashboard.png" class="icon"> Dashboard
      </li>
      <li onclick="location.href='absensi_admin.php'">
        <img src="../asset/img/clipboard-list.png" class="icon"> Absensi Kelas
      </li>
      <li class="active">
        <img src="../asset/img/wallet.png" class="icon"> Uang Kas
      </li>
      <li onclick="location.href='logout.php'" class="logout">
        <img src="../asset/img/log-out.png" class="icon"> Logout
      </li>
    </ul>
</div>

<div class="main">
    <header>
      <h1>💰 Uang Kas Kelas</h1>
      <p>Kelola semua data pembayaran uang kas mahasiswa.</p>
    </header>

    <!-- FORM INPUT / EDIT -->
    <section class="form-section">
      <h2><?= $editMode ? "Edit Pembayaran" : "Tambah Pembayaran" ?></h2>

      <form class="form-container" method="POST" action="<?= $editMode ? '../koneksi/update_kas.php' : '../koneksi/proses_uangkas.php' ?>">
        
        <?php if ($editMode): ?>
            <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <?php endif; ?>

        <input type="text" name="nim" placeholder="NIM Mahasiswa" required
               value="<?= $editMode ? $editData['nim'] : '' ?>">

        <input type="text" name="nama" placeholder="Nama Mahasiswa" required
               value="<?= $editMode ? $editData['nama'] : '' ?>">

        <input type="number" name="jumlah" placeholder="Jumlah Bayar (Rp)" required
               value="<?= $editMode ? $editData['jumlah'] : '' ?>">

        <input type="text" name="keterangan" placeholder="Keterangan"
               value="<?= $editMode ? $editData['keterangan'] : '' ?>">

        <button class="btn" type="submit">
            <?= $editMode ? "Update Data" : "Submit Data Uang Kas" ?>
        </button>

        <?php if ($editMode): ?>
            <a href="uang_kas.php" class="btn" style="background:#888">Batal</a>
        <?php endif; ?>

      </form>
    </section>

    <br>

    <!-- TABEL DATA -->
    <section class="absensi-section">
      <div class="table-header">
        <h2>Data Pembayaran Uang Kas</h2>

        <div class="table-actions">
        <a href="export_kas.php" class="btn">
            Export CSV
        </a>
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

        <tbody>
<?php
$query = mysqli_query($koneksi, "SELECT * FROM uang_kas ORDER BY id DESC");
$no = 1;

while ($row = mysqli_fetch_assoc($query)) :
?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nim'] ?></td>
    <td><?= htmlspecialchars($row['nama']) ?></td>
    <td><?= number_format($row['jumlah'], 0, ',', '.') ?></td>
    <td><?= htmlspecialchars($row['keterangan']) ?></td>
    <td>
      <a href="uang_kas.php?edit=<?= $row['id'] ?>" class="btn">Edit</a>

      <a href="../koneksi/hapus_kas.php?id=<?= $row['id'] ?>"
         class="btn deleteBtn"
         onclick="return confirm('Yakin ingin menghapus data ini?');">
         Hapus
      </a>
    </td>
  </tr>

<?php endwhile; ?>
        </tbody>
      </table>

    </section>
</div>

</body>
</html>
