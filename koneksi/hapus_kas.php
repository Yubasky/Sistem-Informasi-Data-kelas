<?php
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM uang_kas WHERE id='$id'");

header("Location: ../admin/uang_kas.php");
exit;
?>
