<?php
include 'koneksi.php';

$id = $_POST['id'];
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$ket = $_POST['keterangan'];

$query = "UPDATE uang_kas SET 
            nim='$nim',
            nama='$nama',
            jumlah='$jumlah',
            keterangan='$ket'
          WHERE id='$id'";

mysqli_query($koneksi, $query);

header("Location: ../admin/uang_kas.php");
exit;
