<?php
include 'koneksi.php';

if(isset($_POST['nim'])){
    $nim = $_POST['nim'];

    $query = mysqli_query($koneksi, "SELECT nama FROM user WHERE nim='$nim'");
    $data = mysqli_fetch_assoc($query);

    if($data){
        echo $data['nama'];
    } else {
        echo "";
    }
}
?>
