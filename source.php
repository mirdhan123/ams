<?php
    $host = "localhost";
    $username = "root";
    $password = "root";
    $database = "_ams";

    $_config = mysqli_connect($host, $username, $password, $database);
    if(!$_config){
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    $query = "SELECT * from tbl_surat_masuk where status = '0'";
    $result = mysqli_query($_config, $query);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    echo $count;
?>
