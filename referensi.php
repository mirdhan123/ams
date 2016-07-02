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
                    include "tambah_klasifikasi.php";
                    break;
                case 'edit':
                    include "edit_klasifikasi.php";
                    break;
                case 'del':
                    include "hapus_klasifikasi.php";
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

                    $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi ORDER BY id_klasifikasi DESC LIMIT $curr, $limit");

                    echo '<!-- Row Start -->
                    <div class="row">
                        <!-- Secondary Nav START -->
                        <div class="col s12">
                            <div class="z-depth-1">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <div class="col m7">
                                            <ul class="left">
                                                <li class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">class</i> Klasifikasi Surat</a></li>';
                                                if($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2){
                                                    echo '<li class="waves-effect waves-light"><a href="?page=ref&act=add"><i class="material-icons md-24">add_circle</i> Tambah Data</a>';
                                                } else {
                                                    echo '';
                                                } echo '</li>
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
                                        <th width="7%">No</th>
                                        <th width="10%">Kode</th>
                                        <th width="25%">Nama</th>
                                        <th width="40%">Uraian</th>
                                        <th width="18%">Tindakan</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>';

                            if(mysqli_num_rows($query) > 0){
                                $no = 0;
                                while($row = mysqli_fetch_array($query)){
                                    $no++;
                                  echo '<td>'.$no.'</td>
                                        <td>'.$row['kode'].'</td>
                                        <td>'.$row['nama'].'</td>
                                        <td>'.$row['uraian'].'</td>
                                        <td>';

                                        if($_SESSION['admin'] != 2 AND $_SESSION['admin'] != 1){
                                            echo '<a class="btn small blue-grey waves-effect waves-light"><i class="material-icons">error</i> NO ACTION</a>';
                                        } else {
                                          echo '<a class="btn small blue waves-effect waves-light" href="?page=ref&act=edit&id_klasifikasi='.$row['id_klasifikasi'].'">
                                                    <i class="material-icons">edit</i> EDIT</a>
                                                <a class="btn small deep-orange waves-effect waves-light" href="?page=ref&act=del&id_klasifikasi='.$row['id_klasifikasi'].'">
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

                    $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi");
                    $cdata = mysqli_num_rows($query);
                    $cpg = ceil($cdata/$limit);

                    echo '<br/><!-- Pagination START -->
                          <ul class="pagination">';

                    if($cdata > $limit ){

                    if($pg > 1){
                        $prev = $pg - 1;
                        echo '<li><a href="?page=ref&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                              <li><a href="?page=ref&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                    } else {
                        echo '<li class="disabled"><a href=""><i class="material-icons md-48">first_page</i></a></li>
                              <li class="disabled"><a href=""><i class="material-icons md-48">chevron_left</i></a></li>';
                    }

                    for($i=1; $i <= $cpg; $i++)
                        if($i != $pg){
                            echo '<li class="waves-effect waves-dark"><a href="?page=ref&pg='.$i.'"> '.$i.' </a></li>';
                        } else {
                            echo '<li class="active waves-effect waves-dark"><a href="?page=ref&pg='.$i.'"> '.$i.' </a></li>';
                        }

                    if($pg < $cpg){
                        $next = $pg + 1;
                        echo '<li><a href="?page=ref&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                              <li><a href="?page=ref&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
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
