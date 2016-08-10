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
                    include "klasifikasi_add.php";
                    break;
                case 'edit':
                    include "klasifikasi_edit.php";
                    break;
                case 'del':
                    include "klasifikasi_delete.php";
                    break;
                case 'imp':
                    include "klasifikasi_import.php";
                    break;
                default:
                    header("Location: ?page=klas");
                    die();
                    break;
            }
        } else {

            if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 3){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                        window.history.back();
                      </script>';
            } else {

            $query = mysqli_query($_config, "SELECT klasifikasi FROM tbl_sett");
            list($klasifikasi) = mysqli_fetch_array($query);

            //pagging
            $limit = $klasifikasi;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }

                echo '<!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col m7">
                                        <ul class="left">
                                            <li class="waves-effect waves-light hide-on-small-only"><a href="?page=klas" class="judul"><i class="material-icons">class</i> Klasifikasi Surat</a></li>
                                            <li class="waves-effect waves-light"><a href="?page=klas&act=add"><i class="material-icons md-24">add_circle</i> Tambah Data</a></li>
                                            <li class="waves-effect waves-light"><a href="?page=klas&act=imp"><i class="material-icons md-24">file_upload</i> Import Data</a></li>
                                        </ul>
                                    </div>
                                    <div class="col m5 hide-on-med-and-down">
                                        <form method="post" action="">
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
                <!-- Row END -->';

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
                if(isset($_SESSION['succUpload'])){
                    $succUpload = $_SESSION['succUpload'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card green lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succUpload.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['succUpload']);
                }

                echo '
                <!-- Row form Start -->
                <div class="row jarak-form">';

                if(isset($_REQUEST['submit'])){
                $cari = mysqli_real_escape_string($_config, $_REQUEST['cari']);
                    echo '
                    <div class="col s12" style="margin-top: -18px;">
                        <div class="card blue lighten-5">
                            <div class="card-content">
                                <p class="description">Hasil pencarian untuk kata kunci <strong>"'.stripslashes($cari).'"</strong><span class="right"><a href="?page=klas"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col m12" id="colres">
                        <table class="bordered" id="tbl">
                            <thead class="blue lighten-4" id="head">
                                <tr>
                                    <th width="10%">Kode</th>
                                    <th width="38%">Nama</th>
                                    <th width="40%">Uraian</th>
                                    <th width="12%">Tindakan <span class="right"><i class="material-icons" style="color: #333;">settings</i></span></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>';

                            //script untuk menampilkan data
                            $query = mysqli_query($_config, "SELECT * FROM tbl_klasifikasi WHERE uraian LIKE '%$cari%' ORDER BY id_klasifikasi DESC LIMIT $curr, $limit");
                            if(mysqli_num_rows($query) > 0){
                                while($row = mysqli_fetch_array($query)){

                                    $string = $row['id_klasifikasi'];

                                    echo '
                                        <td>'.$row['kode'].'</td>
                                        <td>'.$row['nama'].'</td>
                                        <td>'.$row['uraian'].'</td>
                                        <td>
                                            <a class="btn small blue waves-effect waves-light" href="?page=klas&act=edit&id_klasifikasi='.urlencode(encrypt($string, $salt)).'"> <i class="material-icons">edit</i></a>
                                            <a class="btn small deep-orange waves-effect waves-light" href="?page=klas&act=del&id_klasifikasi='.urlencode(encrypt($string, $salt)).'"><i class="material-icons">delete</i></a>
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

                        $query = mysqli_query($_config, "SELECT * FROM tbl_klasifikasi");
                        $cdata = mysqli_num_rows($query);
                        $cpg = ceil($cdata/$limit);

                        echo '<!-- Pagination START -->
                              <ul class="pagination">';

                        if($cdata > $limit ){

                            //first and previous pagging
                            if($pg > 1){
                                $prev = $pg - 1;
                                echo '<li><a href="?page=klas&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                                      <li><a href="?page=klas&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                            } else {
                                echo '<li class="disabled"><a href=""><i class="material-icons md-48">first_page</i></a></li>
                                      <li class="disabled"><a href=""><i class="material-icons md-48">chevron_left</i></a></li>';
                            }

                            //looping pagging
                            for($i=1; $i <= $cpg; $i++)
                            if($i != $pg){
                                echo '<li class="waves-effect waves-dark"><a href="?page=klas&pg='.$i.'"> '.$i.' </a></li>';
                            } else {
                                echo '<li class="active waves-effect waves-dark"><a href="?page=klas&pg='.$i.'"> '.$i.' </a></li>';
                            }

                            //last and next pagging
                            if($pg < $cpg){
                                $next = $pg + 1;
                                echo '<li><a href="?page=klas&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                                      <li><a href="?page=klas&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
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

                        echo '<div class="col m12" id="colres">
                                <table class="bordered" id="tbl">
                                    <thead class="blue lighten-4" id="head">
                                        <tr>
                                            <th width="10%">Kode</th>
                                            <th width="38%">Nama</th>
                                            <th width="40%">Uraian</th>
                                            <th width="12%">Tindakan <span class="right tooltipped" data-position="left" data-tooltip="Atur jumlah data yang ditampilkan"><a class="modal-trigger" href="#modal"><i class="material-icons" style="color: #333;">settings</i></a></span></th>

                                                <div id="modal" class="modal">
                                                    <div class="modal-content white">
                                                        <h5>Jumlah data per halaman</h5>';

                                                    if(isset($_REQUEST['simpan'])){

                                                        $string = mysqli_real_escape_string($_config, $_REQUEST['id_sett']);
                                                        $id_sett = decrypt($string, $salt);
                                                        $klasifikasi = $_REQUEST['klasifikasi'];                                                                    $id_user = $_SESSION['id_user'];

                                                        if(!preg_match("/^[0-9]*$/", $klasifikasi)){
                                                            echo '<script language="javascript">window.history.back();</script>';
                                                        } else {

                                                            if($klasifikasi < 5){
                                                                header("Location: ?page=klas");
                                                                die();
                                                            } else {

                                                            $query = mysqli_query($_config, "UPDATE tbl_sett SET klasifikasi='$klasifikasi', id_user='$id_user' WHERE id_sett='$id_sett'");
                                                            if($query == true){
                                                                header("Location: ?page=klas");
                                                                die();
                                                            }
                                                            }
                                                        }
                                                    } else {

                                                        $query = mysqli_query($_config, "SELECT id_sett, klasifikasi FROM tbl_sett");
                                                        list($id_sett, $klasifikasi) = mysqli_fetch_array($query);
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
                                                                        <select class="browser-default validate" name="klasifikasi" required>
                                                                            <option value="'.$klasifikasi.'">'.$klasifikasi.'</option>
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

                                    <tbody>
                                        <tr>';

                                    //script untuk menampilkan data
                                    $query = mysqli_query($_config, "SELECT * FROM tbl_klasifikasi ORDER BY id_klasifikasi DESC LIMIT $curr, $limit");
                                    if(mysqli_num_rows($query) > 0){
                                        while($row = mysqli_fetch_array($query)){

                                            $string = $row['id_klasifikasi'];

                                          echo '<td>'.$row['kode'].'</td>
                                                <td>'.$row['nama'].'</td>
                                                <td>'.$row['uraian'].'</td>
                                                <td>
                                                    <a class="btn small blue waves-effect waves-light" href="?page=klas&act=edit&id_klasifikasi='.urlencode(encrypt($string, $salt)).'"> <i class="material-icons">edit</i></a>
                                                    <a class="btn small deep-orange waves-effect waves-light" href="?page=klas&act=del&id_klasifikasi='.urlencode(encrypt($string, $salt)).'"><i class="material-icons">delete</i></a>
                                                </td>
                                            </tr>
                                        </tbody>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan. <u><a href="?page=klas&act=add">Tambah data baru</a></u></p></center></td></tr>';
                                    }
                                  echo '</table><br/><br/>
                            </div>
                        </div>
                        <!-- Row form END -->';

                        $query = mysqli_query($_config, "SELECT * FROM tbl_klasifikasi");
                        $cdata = mysqli_num_rows($query);
                        $cpg = ceil($cdata/$limit);

                        echo '<!-- Pagination START -->
                              <ul class="pagination">';

                        if($cdata > $limit ){

                            //first and previous pagging
                            if($pg > 1){
                                $prev = $pg - 1;
                                echo '<li><a href="?page=klas&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                                      <li><a href="?page=klas&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                            } else {
                                echo '<li class="disabled"><a href=""><i class="material-icons md-48">first_page</i></a></li>
                                      <li class="disabled"><a href=""><i class="material-icons md-48">chevron_left</i></a></li>';
                            }

                            //looping pagging
                            for($i=1; $i <= $cpg; $i++)
                                if($i != $pg){
                                    echo '<li class="waves-effect waves-dark"><a href="?page=klas&pg='.$i.'"> '.$i.' </a></li>';
                                } else {
                                    echo '<li class="active waves-effect waves-dark"><a href="?page=klas&pg='.$i.'"> '.$i.' </a></li>';
                                }

                            //last and next pagging
                            if($pg < $cpg){
                                $next = $pg + 1;
                                echo '<li><a href="?page=klas&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                                      <li><a href="?page=klas&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
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
    }
?>