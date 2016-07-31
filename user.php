<?php
    //session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "user_add.php";
                    break;
                case 'edit':
                    include "user_edit_type.php";
                    break;
                case 'del':
                    include "user_delete.php";
                    break;
            }
        } else {

            if($_SESSION['admin'] != 1){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                        window.history.back();
                      </script>';
            } else {

                $query = mysqli_query($_config, "SELECT * FROM tbl_user");
                echo '<!-- Row Start -->
                    <div class="row">
                        <!-- Secondary Nav START -->
                        <div class="col s12">
                            <div class="z-depth-1">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <div class="col m12">
                                            <ul class="left">
                                                <li class="waves-effect waves-light hide-on-small-only"><a href="?page=sett&sub=usr" class="judul"><i class="material-icons">people</i> Manajemen User</a></li>
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

                echo '
                    <!-- Row form Start -->
                    <div class="row jarak-form">

                        <div class="col m12" id="colres">
                            <!-- Table START -->
                            <table class="bordered" id="tbl">
                                <thead class="blue lighten-4" id="head">
                                    <tr>
                                        <th width="8%">No</th>
                                        <th width="22%">Username</th>
                                        <th width="30%">Nama<br/>NIP</th>
                                        <th width="25%">Level</th>
                                        <th width="15%">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>';

                                if(mysqli_num_rows($query) > 0){
                                    $no = 1;
                                    while($row = mysqli_fetch_array($query)){
                                    echo '<td>'.$no++.'</td>';

                                    if($row['admin'] == 1){
                                        $row['admin'] = 'Administrator';
                                    } elseif($row['admin'] == 2){
                                        $row['admin'] = 'Pimpinan Instansi';
                                    } else {
                                        $row['admin'] = 'User Biasa';
                                    } echo '<td>'.$row['username'].'</td>
                                            <td>'.$row['nama'].'<br/>'.$row['nip'].'</td>
                                            <td>'.$row['admin'].'</td>
                                            <td>';

                                    if($row['id_user'] == 1 || $row['id_user'] == 2 || $row['id_user'] == 3){
                                        echo '<button class="btn small blue-grey waves-effect waves-light"><i class="material-icons">error</i> No Action</button>';
                                    } else {

                                        $string = $row['id_user'];
                                        echo '

                                            <a class="btn small blue waves-effect waves-light" href="?page=sett&sub=usr&act=edit&id_user='.urlencode(encrypt($string, $salt)).'"><i class="material-icons">edit</i></a>

                                            <a class="btn small deep-orange waves-effect waves-light" href="?page=sett&sub=usr&act=del&id_user='.urlencode(encrypt($string, $salt)).'"><i class="material-icons">delete</i></a>';
                                    }
                                    echo '

                                        </td>
                                    </tr>
                                </tbody>';
                                    }
                                } else {
                        echo '<tr><td colspan="5"><center><p class="add">Tidak ada data untuk ditampilkan</p></center></td></tr>';
                                }
                      echo '</table>
                            <!-- Table END -->
                        </div>

                    </div>
                    <!-- Row form END -->';
                }
            }
        }
?>
