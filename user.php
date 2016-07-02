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
                    include "tambah_user.php";
                    break;
                case 'edit':
                    include "edit_tipe_user.php";
                    break;
                case 'del':
                    include "hapus_user.php";
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

                $query = mysqli_query($config, "SELECT * FROM tbl_user LIMIT $curr, $limit");
                echo '<!-- Row Start -->
                    <div class="row">
                        <!-- Secondary Nav START -->
                        <div class="col s12">
                            <div class="z-depth-1">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <div class="col m12">
                                            <ul class="left">
                                                <li class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">people</i> Manajemen User</a></li>
                                                <li class="waves-effect waves-light">
                                                    <a href="?page=sett&sub=usr&act=add"><i class="material-icons md-24">person_add</i> Tambah User</a>
                                                </li>
                                            </ul>
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
                            <!-- Table START -->
                            <table class="bordered" id="tbl">
                                <thead class="blue lighten-4" id="head">
                                    <tr>
                                        <th width="8%">No</th>
                                        <th width="23%">Username</th>
                                        <th width="30%">Nama<br/>NIP</th>
                                        <th width="22%">Level</th>
                                        <th width="16%">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>';

                                if(mysqli_num_rows($query) > 0){
                                    $no = 1;
                                    while($row = mysqli_fetch_array($query)){
                                    echo '<td>'.$no++.'</td>';

                                    if($row['admin'] == 1){
                                        $row['admin'] = 'Super Admin';
                                    } elseif($row['admin'] == 2){
                                        $row['admin'] = 'Administrator';
                                    } else {
                                        $row['admin'] = 'User Biasa';
                                    } echo '<td>'.$row['username'].'</td>
                                            <td>'.$row['nama'].'<br/>'.$row['nip'].'</td>
                                            <td>'.$row['admin'].'</td>
                                            <td>';

                                    if($_SESSION['username'] == $row['username']){
                                        echo '<button class="btn small blue-grey waves-effect waves-light"><i class="material-icons">error</i> No Action</button>';
                                    } else {

                                        if($row['id_user'] == 1){
                                            echo '<button class="btn small blue-grey waves-effect waves-light"><i class="material-icons">error</i> No Action</button>';
                                        } else {
                                          echo ' <a class="btn small blue waves-effect waves-light" href="?page=sett&sub=usr&act=edit&id_user='.$row['id_user'].'">
                                                 <i class="material-icons">edit</i> EDIT</a>
                                                 <a class="btn small deep-orange waves-effect waves-light" href="?page=sett&sub=usr&act=del&id_user='.$row['id_user'].'"><i class="material-icons">delete</i> DEL</a>';
                                        }
                                    } echo '</td>
                                    </tr>
                                </tbody>';
                                        }
                                } else {
                        echo '<tr><td colspan="5"><center><h5>Tidak ada data untuk ditampilkan</h5></center></td></tr>';
                                    }
                      echo '</table>
                            <!-- Table END -->
                        </div>

                    </div>
                    <!-- Row form END -->';

                    $query = mysqli_query($config, "SELECT * FROM tbl_user");
                    $cdata = mysqli_num_rows($query);
                    $cpg = ceil($cdata/$limit);

                    echo '<br/><!-- Pagination START -->
                          <ul class="pagination">';

                    if($cdata > $limit){

                        if($pg > 1){
                            $prev = $pg - 1;
                            echo '<li><a href="?page=sett&sub=usr&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                                  <li><a href="?page=sett&sub=usr&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href=""><i class="material-icons md-48">first_page</i></a></li>
                                  <li class="disabled"><a href=""><i class="material-icons md-48">chevron_left</i></a></li>';
                        }

                            for($i=1; $i <= $cpg; $i++)
                                if($i != $pg){
                                    echo '<li class="waves-effect waves-dark"><a href="?page=sett&sub=usr&pg='.$i.'"> '.$i.' </a></li>';
                                } else {
                                    echo '<li class="active waves-effect waves-dark"><a href="?page=sett&sub=usr&pg='.$i.'"> '.$i.' </a></li>';
                                }

                            if($pg < $cpg){
                                $next = $pg + 1;
                                echo '<li><a href="?page=sett&sub=usr&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                                      <li><a href="?page=sett&sub=usr&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
                            } else {
                                echo '<li class="disabled"><a href=""><i class="material-icons md-48">chevron_right</i></a></li>
                                      <li class="disabled"><a href=""><i class="material-icons md-48">last_page</i></a></li>';
                            }
                                echo ' </ul>
                                       <br/>
                                       <!-- Pagination END -->';
                    } else {
                        echo '';
                    }
                }
    }
?>
