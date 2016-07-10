<?php
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_surat_masuk.php";
                    break;
                case 'edit':
                    include "edit_surat_masuk.php";
                    break;
                case 'disp':
                    include "disposisi.php";
                    break;
                case 'print':
                    include "cetak_disposisi.php";
                    break;
                case 'del':
                    include "hapus_surat_masuk.php";
                    break;
            }
        } else {

            $limit = 5;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }

                    $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk LIMIT $curr, $limit");

echo '<!-- Row Start -->
<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <div class="z-depth-1">
            <nav class="secondary-nav">
                <div class="nav-wrapper blue-grey darken-1">
                    <div class="col m7">
                        <ul class="left">
                            <li class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">mail</i> Surat Masuk</a></li>
                            <li class="waves-effect waves-light">
                                <a href="?page=tsm&act=add"><i class="material-icons md-24">add_circle</i> Tambah Data</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col m5 hide-on-med-and-down">
                        <form>
                            <div class="input-field round-in-box">
                                <input id="search" type="search" placeholder="Ketik dan tekan enter mencari data..." required>
                                <label for="search"><i class="material-icons">search</i></label>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Secondary Nav END -->
</div>
<!-- Row END -->

<!-- Row form Start -->
<div class="row jarak-form">

    <div class="col m12" id="colres">
        <table class="bordered" id="tbl">
            <thead class="blue lighten-4" id="head">
                <tr>
                    <th width="10%">No. Agenda<br/>Kode</th>
                    <th width="30%">Isi Ringkas<br/> File</th>
                    <th width="24%">Asal Surat</th>
                    <th width="18%">No. Surat<br/>Tgl Surat</th>
                    <th width="18%">Tindakan</th>
                </tr>
            </thead>

            <tbody>
                <tr>';

        if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){
              echo '<td>'.$row['no_agenda'].'<br/>'.$row['kode'].'</td>
                    <td>'.$row['isi'].'<br/><br/><strong>File :</strong>';
                    if(!empty($row['file'])){
                        echo ' <strong><a href="upload/surat_masuk/'.$row['file'].'" target="_blank">'.$row['file'].'</a></strong>';
                    } else {
                        echo '<em>Tidak ada file yang di upload</em>';
                    } echo '</td>
                    <td>'.$row['asal_surat'].'</td>
                    <td>'.$row['no_surat'].'<br/>'.date('d M Y', strtotime($row['tgl_surat'])).'</td>
                    <td>';

                    if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                        echo '<a class="btn small yellow darken-3 waves-effect waves-light" href="?page=sett&sub=usr&act=edit&id_user='.$row['id_user'].'">
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
  echo '</table>
    </div>

</div>
<!-- Row form END -->';

        $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk");
        $cdata = mysqli_num_rows($query);
        $cpg = ceil($cdata/$limit);

        echo '<br/><!-- Pagination START -->
              <ul class="pagination">';

        if($cdata > $limit ){

        if($pg > 1){
            $prev = $pg - 1;
            echo '<li><a href="?page=tsm&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                  <li><a href="?page=tsm&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
        } else {
            echo '<li class="disabled"><a href=""><i class="material-icons md-48">first_page</i></a></li>
                  <li class="disabled"><a href=""><i class="material-icons md-48">chevron_left</i></a></li>';
        }

        for($i=1; $i <= $cpg; $i++)
            if($i != $pg){
                echo '<li class="waves-effect waves-dark"><a href="?page=tsm&pg='.$i.'"> '.$i.' </a></li>';
            } else {
                echo '<li class="active waves-effect waves-dark"><a href="?page=tsm&pg='.$i.'"> '.$i.' </a></li>';
            }

        if($pg < $cpg){
            $next = $pg + 1;
            echo '<li><a href="?page=tsm&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                  <li><a href="?page=tsm&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
        } else {
            echo '<li class="disabled"><a href=""><i class="material-icons md-48">chevron_right</i></a></li>
                  <li class="disabled"><a href=""><i class="material-icons md-48">last_page</i></a></li>';
        }
        echo '
        </ul>
        <!-- Pagination END -->';
    } else {
        echo '';
    }
}
}
?>
