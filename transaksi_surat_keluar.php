<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_surat_keluar.php";
                    break;
                case 'edit':
                    include "edit_surat_keluar.php";
                    break;
                case 'del':
                    include "hapus_surat_keluar.php";
                    break;
            }
        } else {

            //pagging
            $limit = 5;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }

                $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar ORDER by id_surat DESC LIMIT $curr, $limit");
                    echo '<!-- Row Start -->
                    <div class="row">
                        <!-- Secondary Nav START -->
                        <div class="col s12">
                            <div class="z-depth-1">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <div class="col m7">
                                            <ul class="left">
                                                <li class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">drafts</i> Surat Keluar</a></li>
                                                <li class="waves-effect waves-light">
                                                    <a href="?page=tsk&act=add"><i class="material-icons md-24">add_circle</i> Tambah Data</a>
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
                                        <th width="31%">Isi Ringkas<br/> File</th>
                                        <th width="24%">Tujuan</th>
                                        <th width="19%">No. Surat<br/>Tgl Surat</th>
                                        <th width="16%">Tindakan</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>';

                            if(mysqli_num_rows($query) > 0){
                                $no = 1;
                                while($row = mysqli_fetch_array($query)){
                                  echo '<td>'.$row['no_agenda'].'<br/><br/>'.$row['kode'].'</td>
                                        <td>'.$row['isi'].'<br/><br/><strong>File :</strong>';
                                        if(!empty($row['file'])){
                                            echo ' <strong><a href="upload/surat_keluar/'.$row['file'].'" target="_blank">'.$row['file'].'</a></strong>';
                                        } else {
                                            echo ' <em>Tidak ada file yang diupload</em>';
                                        } echo '</td>
                                        <td>'.$row['tujuan'].'</td>
                                        <td>'.$row['no_surat'].'<br/><br/>'.date('d M Y', strtotime($row['tgl_surat'])).'</td>
                                        <td>';

                                        if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                                            echo '<button class="btn small blue-grey waves-effect waves-light"><i class="material-icons">error</i> No Action</button>';
                                        } else {
                                          echo '<a class="btn small blue waves-effect waves-light" href="?page=tsk&act=edit&id_surat='.$row['id_surat'].'">
                                                <i class="material-icons">edit</i> EDIT</a>
                                                <a class="btn small deep-orange waves-effect waves-light" href="?page=tsk&act=del&id_surat='.$row['id_surat'].'">
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

                $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar");
                $cdata = mysqli_num_rows($query);
                $cpg = ceil($cdata/$limit);

                echo '<br/><!-- Pagination START -->
                      <ul class="pagination">';

                if($cdata > $limit ){

                //first and previous pagging
                if($pg > 1){
                    $prev = $pg - 1;
                    echo '<li><a href="?page=tsk&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                          <li><a href="?page=tsk&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                } else {
                    echo '<li class="disabled"><a href=""><i class="material-icons md-48">first_page</i></a></li>
                          <li class="disabled"><a href=""><i class="material-icons md-48">chevron_left</i></a></li>';
                }

                //perulangan pagging
                for($i=1; $i <= $cpg; $i++)
                    if($i != $pg){
                        echo '<li class="waves-effect waves-dark"><a href="?page=tsk&pg='.$i.'"> '.$i.' </a></li>';
                    } else {
                        echo '<li class="active waves-effect waves-dark"><a href="?page=tsk&pg='.$i.'"> '.$i.' </a></li>';
                    }

                //last and next pagging
                if($pg < $cpg){
                    $next = $pg + 1;
                    echo '<li><a href="?page=tsk&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                          <li><a href="?page=tsk&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
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
