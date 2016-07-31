<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "ams";
    $config = mysqli_connect($host, $username, $password, $database);

    if(!$config){
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    $query = "SELECT * from tbl_surat_masuk where status = '0'";
    $result = mysqli_query($config, $query);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    echo $count;
?>
