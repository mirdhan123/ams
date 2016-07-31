<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
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
                case 'addd':
                    include "tambah_disposisi.php";
                    break;
                case 'editd':
                    include "edit_disposisi.php";
                    break;
                }
            } else {

                $query = mysqli_query($config, "SELECT surat_masuk FROM tbl_sett");
                list($surat_masuk) = mysqli_fetch_array($query);

                //pagging
                $limit = $surat_masuk;
                $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }?>

                <!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col m7">
                                        <ul class="left">
                                            <?php
                                                if($_SESSION['admin'] == 2){
                                                    echo '
                                            <li class="waves-effect waves-light hide-on-small-only"><a href="?page=tsm" class="judul"><i class="material-icons">description</i> Disposisi Surat Masuk</a></li>
                                            <li class="waves-effect waves-light">';
                                                } else {
                                                    echo '
                                            <li class="waves-effect waves-light hide-on-small-only"><a href="?page=tsm" class="judul"><i class="material-icons">mail</i> Surat Masuk</a></li>
                                            <li class="waves-effect waves-light">';
                                                }

                                                if($_SESSION['admin'] == 2){
                                                    echo '';
                                                } else {
                                                    echo '<a href="?page=tsm&act=add"><i class="material-icons md-24">add_circle</i> Tambah Data</a>';
                                                }
                                            ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col m5 hide-on-med-and-down">
                                        <form method="post" action="?page=tsm">
                                            <div class="input-field round-in-box">
                                                <input id="search" type="search" name="cari" placeholder="Ketik dan tekan enter mencari data..." required>
                                                <label for="search"><i class="material-icons">search</i></label>
                                                <input type="submit" name="submit" class="hidden">
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

                <?php
                    if(isset($_SESSION['succAdd'])){
                        $succAdd = $_SESSION['succAdd'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succAdd.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succAdd']);
                    }
                    if(isset($_SESSION['succEdit'])){
                        $succEdit = $_SESSION['succEdit'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succEdit.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succEdit']);
                    }
                    if(isset($_SESSION['succDel'])){
                        $succDel = $_SESSION['succDel'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succDel.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succDel']);
                    }
                ?>

                <!-- Row form Start -->
                <div class="row jarak-form">

                <?php
                    if(isset($_REQUEST['submit'])){
                    $cari = mysqli_real_escape_string($config, $_REQUEST['cari']);
                        echo '
                        <div class="col s12" style="margin-top: -18px;">
                            <div class="card blue lighten-5">
                                <div class="card-content">
                                <p class="description">Hasil pencarian untuk kata kunci <strong>"'.stripslashes($cari).'"</strong><span class="right"><a href="?page=tsm"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                                </div>
                            </div>
                        </div>

                        <div class="col m12" id="colres">
                        <table class="bordered" id="tbl">
                            <thead class="blue lighten-4" id="head">
                                <tr>
                                    <th width="5%">No. Agenda<br/>Kode</th>
                                    <th width="28%">Isi Surat<br/> File</th>
                                    <th width="24%">Asal Surat</th>
                                    <th width="20%">No. Surat<br/>Tgl Surat</th>
                                    <th width="3%">Status</th>
                                    <th width="20%">Tindakan <span class="right"><i class="material-icons" style="color: #333;">settings</i></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>';

                            //script untuk mencari data
                            $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE isi LIKE '%$cari%' ORDER by id_surat DESC LIMIT $curr, $limit");
                            if(mysqli_num_rows($query) > 0){
                                $no = 1;
                                while($row = mysqli_fetch_array($query)){

                                $string = $row['id_surat'];

                                if($_SESSION['admin'] == 2 AND $row['status'] != 1 AND $row['status'] != 2){
                                    echo '<tr class="yellow lighten-3">';
                                } else {
                                    echo '<tr>';
                                }

                                  echo '
                                    <td>'.$row['no_agenda'].'<br/><hr/>'.$row['kode'].'</td>
                                    <td>'.substr($row['isi'],0,200).'<br/><br/><strong>File :</strong>';

                                    if(!empty($row['file'])){
                                        echo ' <strong><a href="?page=gsm&act=fsm&id_surat='.urlencode(encrypt($string, $salt)).'">'.$row['file'].'</a></strong>';
                                    } else {
                                        echo '<em>Tidak ada file yang di upload</em>';
                                    } echo '</td>
                                    <td>'.$row['asal_surat'].'</td>';

                                    $y = substr($row['tgl_surat'],0,4);
                                    $m = substr($row['tgl_surat'],5,2);
                                    $d = substr($row['tgl_surat'],8,2);

                                    if($m == "01"){
                                        $nm = "Januari";
                                    } elseif($m == "02"){
                                        $nm = "Februari";
                                    } elseif($m == "03"){
                                        $nm = "Maret";
                                    } elseif($m == "04"){
                                        $nm = "April";
                                    } elseif($m == "05"){
                                        $nm = "Mei";
                                    } elseif($m == "06"){
                                        $nm = "Juni";
                                    } elseif($m == "07"){
                                        $nm = "Juli";
                                    } elseif($m == "08"){
                                        $nm = "Agustus";
                                    } elseif($m == "09"){
                                        $nm = "September";
                                    } elseif($m == "10"){
                                        $nm = "Oktober";
                                    } elseif($m == "11"){
                                        $nm = "November";
                                    } elseif($m == "12"){
                                        $nm = "Desember";
                                    }
                                    echo '

                                    <td>'.$row['no_surat'].'<br/><hr/>'.$d." ".$nm." ".$y.'</td>
                                    <td>';

                                    if($row['status'] == 1 || $row['status'] == 2){
                                        echo '
                                            <button class="btn small light-green waves-effect waves-light"><i class="material-icons md-30">done</i></button>';
                                    } else {
                                        echo  '
                                        <button class="btn small yellow darken-2 waves-effect waves-light"><i class="material-icons md-30">error</i></button>';
                                    }

                                    echo '
                                    </td>
                                    <td>

                                        <a class="btn small indigo accent-2 waves-effect waves-light" href="?page=tsm&act=disp&id_surat='.urlencode(encrypt($string, $salt)).'"><i class="material-icons">description</i> LIHAT SURAT</a>

                                        <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=edit&id_surat='.urlencode(encrypt($string, $salt)).'"><i class="material-icons">edit</i> EDIT</a>

                                        <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=del&id_surat='.urlencode(encrypt($string, $salt)).'"><i class="material-icons">delete</i> HAPUS</a>';

                                    if(!empty($row['tujuan'])){
                                        echo '
                                            <a class="btn small yellow darken-3 waves-effect waves-light" href="?page=ctk&id_surat='.urlencode(encrypt($string, $salt)).'" target="_blank"><i class="material-icons">print</i> CETAK</a>';
                                    } else {
                                        echo '';
                                    }

                                    echo '

                                        </td>
                                    </tr>
                                </tbody>';
                                }
                            } else {
                                echo '<tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan</p></center></td></tr>';
                            }
                             echo '</table><br/><br/>
                        </div>
                    </div>
                    <!-- Row form END -->';

                    $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk");
                    $cdata = mysqli_num_rows($query);
                    $cpg = ceil($cdata/$limit);

                    echo '<!-- Pagination START -->
                          <ul class="pagination">';

                    if($cdata > $limit ){

                        //first and previous pagging
                        if($pg > 1){
                            $prev = $pg - 1;
                            echo '<li><a href="?page=tsm&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                                  <li><a href="?page=tsm&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href=""><i class="material-icons md-48">first_page</i></a></li>
                                  <li class="disabled"><a href=""><i class="material-icons md-48">chevron_left</i></a></li>';
                        }

                        //perulangan pagging
                        for($i=1; $i <= $cpg; $i++)
                            if($i != $pg){
                                echo '<li class="waves-effect waves-dark"><a href="?page=tsm&pg='.$i.'"> '.$i.' </a></li>';
                            } else {
                                echo '<li class="active waves-effect waves-dark"><a href="?page=tsm&pg='.$i.'"> '.$i.' </a></li>';
                            }

                        //last and next pagging
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

                    } else {

                        echo '
                        <div class="col m12" id="colres">
                            <table class="bordered" id="tbl">
                                <thead class="blue lighten-4" id="head">
                                    <tr>
                                        <th width="5%">No. Agenda<br/>Kode</th>
                                        <th width="28%">Isi Surat<br/> File</th>
                                        <th width="24%">Asal Surat</th>
                                        <th width="20%">No. Surat<br/>Tgl Surat</th>
                                        <th width="3%">Status</th>
                                        <th width="20%">Tindakan <span class="right tooltipped" data-position="left" data-tooltip="Atur jumlah data yang ditampilkan"><a class="modal-trigger" href="#modal"><i class="material-icons" style="color: #333;">settings</i></a></span></th>

                                            <div id="modal" class="modal">
                                                <div class="modal-content white">
                                                    <h5>Jumlah data yang ditampilkan per halaman</h5>';

                                                if(isset($_REQUEST['simpan'])){

                                                    $string = mysqli_real_escape_string($config, $_REQUEST['id_sett']);
                                                    $id_sett = decrypt($string, $salt);
                                                    $surat_masuk = $_REQUEST['surat_masuk'];                                                                    $id_user = $_SESSION['id_user'];

                                                    if(!preg_match("/^[0-9]*$/", $surat_masuk)){
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    } else {

                                                    if($surat_masuk < 5){
                                                        header("Location: ./admin.php?page=tsm");
                                                        die();
                                                    } else {

                                                        $query = mysqli_query($config, "UPDATE tbl_sett SET surat_masuk='$surat_masuk', id_user='$id_user' WHERE id_sett='$id_sett'");
                                                        if($query == true){
                                                            header("Location: ./admin.php?page=tsm");
                                                            die();
                                                        }
                                                    }
                                                    }
                                                } else {

                                                    $query = mysqli_query($config, "SELECT id_sett, surat_masuk FROM tbl_sett");
                                                    list($id_sett, $surat_masuk) = mysqli_fetch_array($query);
                                                    $string = $id_sett;
                                                    echo '
                                                    <div class="row">
                                                        <form method="post" action="">
                                                            <div class="input-field col s12">
                                                                    <input type="hidden" value="'.encrypt($string, $salt).'" name="id_sett">
                                                                <div class="input-field col s1" style="float: left;">
                                                                    <i class="material-icons prefix md-prefix">looks_one</i>
                                                                </div>
                                                                <div class="input-field col s11 right" style="margin: -5px 0 20px;">
                                                                    <select class="browser-default validate" name="surat_masuk" required>
                                                                        <option value="'.$surat_masuk.'">'.$surat_masuk.'</option>
                                                                        <option value="5">5</option>
                                                                        <option value="10">10</option>
                                                                        <option value="20">20</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer white">
                                                                    <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>
                                                                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>';
                                        }

                                        echo '
                                    </tr>
                                </thead>
                                <tbody>';

                                //script untuk menampilkan data
                                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk ORDER by id_surat DESC LIMIT $curr, $limit");
                                if(mysqli_num_rows($query) > 0){
                                    $no = 1;
                                    while($row = mysqli_fetch_array($query)){

                                    $string = $row['id_surat'];

                                    if($_SESSION['admin'] == 2 AND $row['status'] != 1 AND $row['status'] != 2){
                                        echo '<tr class="yellow lighten-3">';
                                    } else {
                                        echo '<tr>';
                                    }

                                      echo '
                                        <td>'.$row['no_agenda'].'<br/><hr/>'.$row['kode'].'</td>
                                        <td>'.substr($row['isi'],0,200).'<br/><br/><strong>File :</strong>';

                                        if(!empty($row['file'])){
                                            echo ' <strong><a href="?page=gsm&act=fsm&id_surat='.urlencode(encrypt($string, $salt)).'">'.$row['file'].'</a></strong>';
                                        } else {
                                            echo '<em>Tidak ada file yang di upload</em>';
                                        } echo '</td>
                                        <td>'.$row['asal_surat'].'</td>';

                                        $y = substr($row['tgl_surat'],0,4);
                                        $m = substr($row['tgl_surat'],5,2);
                                        $d = substr($row['tgl_surat'],8,2);

                                        if($m == "01"){
                                            $nm = "Januari";
                                        } elseif($m == "02"){
                                            $nm = "Februari";
                                        } elseif($m == "03"){
                                            $nm = "Maret";
                                        } elseif($m == "04"){
                                            $nm = "April";
                                        } elseif($m == "05"){
                                            $nm = "Mei";
                                        } elseif($m == "06"){
                                            $nm = "Juni";
                                        } elseif($m == "07"){
                                            $nm = "Juli";
                                        } elseif($m == "08"){
                                            $nm = "Agustus";
                                        } elseif($m == "09"){
                                            $nm = "September";
                                        } elseif($m == "10"){
                                            $nm = "Oktober";
                                        } elseif($m == "11"){
                                            $nm = "November";
                                        } elseif($m == "12"){
                                            $nm = "Desember";
                                        }
                                        echo '

                                        <td>'.$row['no_surat'].'<br/><hr/>'.$d." ".$nm." ".$y.'</td>
                                        <td>';

                                        if($row['status'] == 1 || $row['status'] == 2){
                                            echo '
                                                <button class="btn small light-green waves-effect waves-light"><i class="material-icons md-30">done</i></button>';
                                        } else {
                                            echo  '
                                            <button class="btn small yellow darken-2 waves-effect waves-light"><i class="material-icons md-30">error</i></button>';
                                        }

                                        echo '
                                        </td>
                                        <td>

                                            <a class="btn small indigo accent-2 waves-effect waves-light" href="?page=tsm&act=disp&id_surat='.urlencode(encrypt($string, $salt)).'"><i class="material-icons">description</i> LIHAT SURAT</a>

                                            <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=edit&id_surat='.urlencode(encrypt($string, $salt)).'"><i class="material-icons">edit</i> EDIT</a>

                                            <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=del&id_surat='.urlencode(encrypt($string, $salt)).'"><i class="material-icons">delete</i> HAPUS</a>';

                                        if(!empty($row['tujuan'])){
                                            echo '
                                                <a class="btn small yellow darken-3 waves-effect waves-light" href="?page=ctk&id_surat='.urlencode(encrypt($string, $salt)).'" target="_blank"><i class="material-icons">print</i> CETAK</a>';
                                        } else {
                                            echo '';
                                        }

                                        echo '
                                        </td>
                                    </tr>
                                </tbody>';
                                }
                            } else {
                                echo '<tr><td colspan="5"><center><p class="add">Tidak ada data untuk ditampilkan.';

                                if($_SESSION['admin'] == 2){
                                    echo '';
                                } else {
                                    echo '<u><a href="?page=tsm&act=add">Tambah data baru</a></u></p></center></td></tr>';
                                }
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

                        //first and previous pagging
                        if($pg > 1){
                            $prev = $pg - 1;
                            echo '<li><a href="?page=tsm&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                                  <li><a href="?page=tsm&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href=""><i class="material-icons md-48">first_page</i></a></li>
                                  <li class="disabled"><a href=""><i class="material-icons md-48">chevron_left</i></a></li>';
                        }

                        //perulangan pagging
                        for($i=1; $i <= $cpg; $i++)
                            if($i != $pg){
                                echo '<li class="waves-effect waves-dark"><a href="?page=tsm&pg='.$i.'"> '.$i.' </a></li>';
                            } else {
                                echo '<li class="active waves-effect waves-dark"><a href="?page=tsm&pg='.$i.'"> '.$i.' </a></li>';
                            }

                        //last and next pagging
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
        }
?>
