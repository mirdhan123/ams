<?php
//cek session
if(empty($_SESSION['admin'])){

    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header("Location: ./");
    die();
} else {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "ams";
    $config = mysqli_connect($host, $username, $password, $database);

    $searchTerm = $_GET['term'];
    $query = mysqli_query($config, "SELECT kode, nama FROM tbl_klasifikasi WHERE kode LIKE '%".$searchTerm."%' ORDER BY kode ASC");
    while(list($kode, $nama) = mysqli_fetch_array($query)){
        $data[] = $kode."                                                                                                                                                                                                                                                       ".$nama;
    }

    echo json_encode($data);
}
?>
