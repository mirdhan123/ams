<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "ams"; 

//Buat koneksi
$conn = mysqli_connect($server, $username, $password, $database);

//Cek koneksi ke database
if (!$conn){
    die("Gagal terhubung ke database. Periksa kembali konfigurasi." . mysqli_connect_error());
}
?>