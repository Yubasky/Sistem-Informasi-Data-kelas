<?php
include '../koneksi/koneksi.php';

// Nama file CSV
$filename = "uang_kas.csv";

// Header untuk download file
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=\"$filename\"");

$output = fopen("php://output", "w");

// Tulis header kolom
fputcsv($output, ["NIM", "Nama", "Jumlah", "Keterangan"]);

// Ambil data tabel uang_kas
$query = mysqli_query($koneksi, "SELECT nim, nama, jumlah, keterangan FROM uang_kas ORDER BY id ASC");

while ($row = mysqli_fetch_assoc($query)) {
    // Format jumlah agar tidak pakai titik
    $row['jumlah'] = $row['jumlah'];

    fputcsv($output, $row);
}

fclose($output);
exit();
?>
