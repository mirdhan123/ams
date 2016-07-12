<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'ams';
//connect with the database
$config = mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);

    $searchTerm = $_GET['term'];
    $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi WHERE kode LIKE '%".$searchTerm."%' ORDER BY kode ASC");
    while($row = mysqli_fetch_assoc($query)){
        $data[] = $row['kode'];
    }

    echo json_encode($data);
?>
