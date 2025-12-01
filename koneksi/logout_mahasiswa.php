<?php
session_start();
session_unset();
session_destroy();
header("Location: ../mahasiswa/login_mahasiswa.php");
exit;
?>
