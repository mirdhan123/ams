<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "_ams";

    $_config = mysqli_connect($host, $username, $password, $database);
    if(!$_config){
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
?>
