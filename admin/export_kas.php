<?php
include '../koneksi/koneksi.php';

$date = date("Y-m-d_H-i-s");
$filename = "uang_kas_$date.csv";

ob_clean();

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

$output = fopen("php://output", "w");

fputcsv($output, ["NIM", "Nama", "Jumlah", "Keterangan"]);

$query = mysqli_query($koneksi, "SELECT nim, nama, jumlah, keterangan FROM uang_kas ORDER BY id ASC");

while ($row = mysqli_fetch_assoc($query)) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
