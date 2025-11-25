<?php
include '../koneksi/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM uang_kas WHERE id='$id'"));
?>

<form method="POST" action="../koneksi/update_kas.php">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <input type="text" name="nim" value="<?= $data['nim'] ?>" required>
    <input type="text" name="nama" value="<?= $data['nama'] ?>" required>
    <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" required>
    <input type="text" name="keterangan" value="<?= $data['keterangan'] ?>">
    <button type="submit">Simpan</button>
</form>
