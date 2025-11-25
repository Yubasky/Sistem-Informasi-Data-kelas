<?php
include '../koneksi/koneksi.php';
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../logout/loginmahasiswa.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_nim = $_SESSION['user_nim'];

$success = '';
$error = '';

// Proses submit absensi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_absensi'])) {
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $keterangan = isset($_POST['keterangan']) ? trim($_POST['keterangan']) : '';
    $tanggal = date('Y-m-d'); // Tanggal hari ini
    
    // Validasi status
    $allowed_status = ['Hadir', 'Sakit', 'Izin', 'Alpa'];
    if (!in_array($status, $allowed_status)) {
        $error = 'Status absensi tidak valid.';
    } else {
        // Cek apakah sudah absen hari ini
        $check = mysqli_prepare($koneksi, "SELECT id FROM absensi WHERE user_id = ? AND tanggal = ? LIMIT 1");
        if ($check) {
            mysqli_stmt_bind_param($check, 'is', $user_id, $tanggal);
            mysqli_stmt_execute($check);
            mysqli_stmt_store_result($check);
            
            if (mysqli_stmt_num_rows($check) > 0) {
                $error = 'Anda sudah melakukan absensi hari ini.';
            } else {
                // Insert absensi baru
                $stmt = mysqli_prepare($koneksi, "INSERT INTO absensi (user_id, nim, nama, tanggal, status, keterangan) VALUES (?, ?, ?, ?, ?, ?)");
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'isssss', $user_id, $user_nim, $user_name, $tanggal, $status, $keterangan);
                    
                    if (mysqli_stmt_execute($stmt)) {
                        $success = 'Absensi berhasil dikirim!';
                    } else {
                        $error = 'Gagal menyimpan absensi: ' . mysqli_error($koneksi);
                    }
                    mysqli_stmt_close($stmt);
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

// Ambil riwayat absensi mahasiswa (5 terakhir)
$riwayat = [];
$query = mysqli_prepare($koneksi, "SELECT tanggal, status, keterangan FROM absensi WHERE user_id = ? ORDER BY tanggal DESC LIMIT 5");
if ($query) {
    mysqli_stmt_bind_param($query, 'i', $user_id);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    while ($row = mysqli_fetch_assoc($result)) {
        $riwayat[] = $row;
    }
    mysqli_stmt_close($query);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi Kelas - Mahasiswa</title>
  <link rel="stylesheet" href="../asset/css/mahasiswa.css">
</head>
<body>

  <aside class="sidebar">
    <div>
      <div class="logo">Data Kelas</div>
      <ul class="menu">
        <li onclick="location.href='dashboard_mahasiswa.php'">
          <img src="../asset/img/layout-dashboard.png" class="icon"> Dashboard
        </li>
        <li class="active">
          <img src="../asset/img/clipboard-list.png" class="icon"> Absensi Kelas
        </li>
      </ul>
    </div>
  
    <ul class="menu">
        <li class="logout" onclick="location.href='login_mahasiswa.php'">
          <img src="../asset/img/log-out.png" class="icon"> Logout
        </li>
    </ul>
  </aside>
  
  <main class="main">
    <header>
      <h1>Absensi Kelas 🎓</h1>
      <p>Halo, <strong><?php echo htmlspecialchars($user_name); ?></strong> (<?php echo htmlspecialchars($user_nim); ?>)</p>
    </header>

    <section class="absensi-section">
      <?php if ($success): ?>
        <div class="success-message" style="display: block; background: #e8f5e9; color: #0b6623; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
          ✅ <?php echo htmlspecialchars($success); ?>
        </div>
      <?php endif; ?>
      
      <?php if ($error): ?>
        <div class="error-message" style="display: block; background: #fdecea; color: #b00020; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
          ❌ <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="absensi">
          <label><input type="radio" name="status" value="Hadir" required> Hadir</label>
          <label><input type="radio" name="status" value="Sakit"> Sakit</label>
          <label><input type="radio" name="status" value="Izin"> Izin</label>
          <label><input type="radio" name="status" value="Alpa"> Alpa</label>
        </div>

        <div class="form-group">
          <label for="keterangan">Keterangan</label>
          <textarea id="keterangan" name="keterangan" placeholder="Tulis keterangan tambahan (opsional)..."></textarea>
        </div>

        <button type="submit" name="submit_absensi" class="btn">Kirim Absensi</button>
      </form>
    </section>

    <!-- Riwayat Absensi -->
    <?php if (!empty($riwayat)): ?>
    <section class="riwayat-section" style="margin-top: 30px;">
      <h2 style="margin-bottom: 15px;">📜 Riwayat Absensi Terakhir</h2>
      <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden;">
        <thead>
          <tr style="background: #f5f5f5;">
            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Tanggal</th>
            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Status</th>
            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($riwayat as $item): ?>
          <tr>
            <td style="padding: 12px; border-bottom: 1px solid #eee;">
              <?php echo date('d-m-Y', strtotime($item['tanggal'])); ?>
            </td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;">
              <span class="status <?php echo strtolower($item['status']); ?>">
                <?php echo htmlspecialchars($item['status']); ?>
              </span>
            </td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;">
              <?php echo htmlspecialchars($item['keterangan'] ?: '-'); ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
    <?php endif; ?>
  </main>

  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    lucide.createIcons();
  </script>

</body>
</html>