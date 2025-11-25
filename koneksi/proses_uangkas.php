<?php
include 'koneksi.php';

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$ket = $_POST['keterangan'];

$query = "INSERT INTO uang_kas (nim, nama, jumlah, keterangan)
          VALUES ('$nim', '$nama', '$jumlah', '$ket')";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../admin/uang_kas.php");
    exit;
} else {
    echo "Gagal menambahkan data!";
}
?>
