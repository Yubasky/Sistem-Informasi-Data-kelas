<?php
include '../koneksi/koneksi.php';

$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');

$filename = "absensi_" . $tanggal . ".csv";
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=\"$filename\"");

$output = fopen("php://output", "w");

fputcsv($output, ["NIM", "Nama", "Tanggal", "Status", "Keterangan"]);

$stmt = mysqli_prepare($koneksi, "SELECT nim, nama, tanggal, status, keterangan FROM absensi WHERE tanggal = ? ORDER BY nim ASC");
mysqli_stmt_bind_param($stmt, "s", $tanggal);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
