<?php
include '../koneksi/koneksi.php';
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../logout/login_admin.php');
    exit;
}

$success = '';
$error = '';

// Proses update status absensi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_absensi'])) {
    $absensi_id = isset($_POST['absensi_id']) ? intval($_POST['absensi_id']) : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    
    $allowed_status = ['Hadir', 'Sakit', 'Izin', 'Alpa'];
    if (!in_array($status, $allowed_status)) {
        $error = 'Status tidak valid.';
    } else {
        $stmt = mysqli_prepare($koneksi, "UPDATE absensi SET status = ? WHERE id = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'si', $status, $absensi_id);
            if (mysqli_stmt_execute($stmt)) {
                $success = 'Status absensi berhasil diperbarui!';
            } else {
                $error = 'Gagal memperbarui status: ' . mysqli_error($koneksi);
            }
            mysqli_stmt_close($stmt);
        }
    }
}

// Proses hapus absensi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_absensi'])) {
    $absensi_id = isset($_POST['absensi_id']) ? intval($_POST['absensi_id']) : 0;
    
    $stmt = mysqli_prepare($koneksi, "DELETE FROM absensi WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $absensi_id);
        if (mysqli_stmt_execute($stmt)) {
            $success = 'Data absensi berhasil dihapus!';
        } else {
            $error = 'Gagal menghapus data: ' . mysqli_error($koneksi);
        }
        mysqli_stmt_close($stmt);
    }
}

// Ambil data absensi (filter berdasarkan tanggal jika ada)
$filter_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
$data_absensi = [];

$query = mysqli_prepare($koneksi, "SELECT id, nim, nama, tanggal, status, keterangan FROM absensi WHERE tanggal = ? ORDER BY nim ASC");
if ($query) {
    mysqli_stmt_bind_param($query, 's', $filter_tanggal);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    while ($row = mysqli_fetch_assoc($result)) {
        $data_absensi[] = $row;
    }
    mysqli_stmt_close($query);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi Kelas - Admin</title>
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

      <li class="active">
        <img src="../asset/img/clipboard-list.png" class="icon">
        Absensi Kelas
      </li>

      <li onclick="location.href='uang_kas.php'">
        <img src="../asset/img/wallet.png" class="icon">
        Uang Kas
      </li>

      <li class="logout" onclick="location.href='login_admin.php'">
        <img src="../asset/img/log-out.png" class="icon"> Logout
      </li>
    </ul>
  </div>

  <div class="main">
    <header>
      <h1>📋 Absensi Kelas</h1>
      <p>Kelola dan pantau kehadiran mahasiswa di kelas.</p>
    </header>

    <?php if ($success): ?>
      <div style="background: #e8f5e9; color: #0b6623; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        ✅ <?php echo htmlspecialchars($success); ?>
      </div>
    <?php endif; ?>
    
    <?php if ($error): ?>
      <div style="background: #fdecea; color: #b00020; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        ❌ <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <section class="absensi-section">
      <div class="table-header">
        <h2>Data Absensi Mahasiswa</h2>
        <div class="table-actions">
          <form method="GET" style="display: inline-block; margin-right: 10px;">
            <label for="tanggal">Pilih Tanggal: </label>
            <input type="date" name="tanggal" id="tanggal" value="<?php echo htmlspecialchars($filter_tanggal); ?>" onchange="this.form.submit()">
          </form>
          <button class="btn" onclick="window.print()">
            <i data-lucide="download"></i> Export Laporan
          </button>
        </div>
      </div>

      <table class="absensi-table">
        <thead>
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($data_absensi)): ?>
            <tr>
              <td colspan="7" style="text-align: center; padding: 20px; color: #999;">
                Tidak ada data absensi untuk tanggal <?php echo date('d-m-Y', strtotime($filter_tanggal)); ?>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($data_absensi as $index => $absen): ?>
            <tr>
              <td><?php echo $index + 1; ?></td>
              <td><?php echo htmlspecialchars($absen['nim']); ?></td>
              <td><?php echo htmlspecialchars($absen['nama']); ?></td>
              <td><?php echo date('d-m-Y', strtotime($absen['tanggal'])); ?></td>
              <td>
                <span class="status <?php echo strtolower($absen['status']); ?>">
                  <?php echo htmlspecialchars($absen['status']); ?>
                </span>
              </td>
              <td><?php echo htmlspecialchars($absen['keterangan'] ?: '-'); ?></td>
              <td>
                <button class="btn-edit" onclick="editAbsensi(<?php echo $absen['id']; ?>, '<?php echo $absen['status']; ?>')">
                  Edit
                </button>
                <button class="btn-delete" onclick="deleteAbsensi(<?php echo $absen['id']; ?>)">
                  Hapus
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
  </div>

  <!-- Form Hidden untuk Update Status -->
  <form id="updateForm" method="POST" style="display: none;">
    <input type="hidden" name="absensi_id" id="update_id">
    <input type="hidden" name="status" id="update_status">
    <input type="hidden" name="update_absensi" value="1">
  </form>

  <!-- Form Hidden untuk Delete -->
  <form id="deleteForm" method="POST" style="display: none;">
    <input type="hidden" name="absensi_id" id="delete_id">
    <input type="hidden" name="delete_absensi" value="1">
  </form>

  <script src="../asset/js/absensi_admin.js"></script>
</body>
</html>