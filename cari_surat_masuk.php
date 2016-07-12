<?php
include("./include/config.php");

$limit = 5;
$pg = @$_GET['pg'];
    if(empty($pg)){
        $curr = 0;
        $pg = 1;
    } else {
        $curr = ($pg - 1) * $limit;

if(isset($_REQUEST['cari'])){
    $cari = $_REQUEST['cari'];
    $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE isi LIKE '%".$cari."%' LIMIT $curr, $limit");
    if(mysqli_num_rows($query) > 0){
        $no = 1;
        while($row = mysqli_fetch_array($query)){
          echo '<td>'.$row['no_agenda'].'<br/><br/>'.$row['kode'].'</td>
                <td>'.$row['isi'].'<br/><br/><strong>File :</strong>';
                if(!empty($row['file'])){
                    echo ' <strong><a href="upload/surat_masuk/'.$row['file'].'" target="_blank">'.$row['file'].'</a></strong>';
                } else {
                    echo '<em>Tidak ada file yang di upload</em>';
                } echo '</td>
                <td>'.$row['asal_surat'].'</td>
                <td>'.$row['no_surat'].'<br/><br/>'.date('d M Y', strtotime($row['tgl_surat'])).'</td>
                <td>';

                if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                    echo '<a class="btn small yellow darken-3 waves-effect waves-light" href="?page=ctk&id_surat='.$row['id_surat'].'" target="_blank">
                        <i class="material-icons">print</i> PRINT</a>';
                } else {
                  echo '<a class="btn small blue waves-effect waves-light" href="?page=tsm&act=edit&id_surat='.$row['id_surat'].'">
                            <i class="material-icons">edit</i> EDIT</a>
                        <a class="btn small light-green waves-effect waves-light tooltipped" data-position="left" data-tooltip="Klik DISP untuk menambahkan disposisi" href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'">
                            <i class="material-icons">description</i> DISP</a>
                        <a class="btn small yellow darken-3 waves-effect waves-light" href="?page=ctk&id_surat='.$row['id_surat'].'" target="_blank">
                            <i class="material-icons">print</i> PRINT</a>
                        <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=del&id_surat='.$row['id_surat'].'">
                            <i class="material-icons">delete</i> DEL</a>';
                } echo '
                </td>
            </tr>
        </tbody>';
        }
    } else {
        echo '<tr><td colspan="5"><center><h5>Tidak ada data untuk ditampilkan</h5></center></td></tr>';
    }
}
}
?>
