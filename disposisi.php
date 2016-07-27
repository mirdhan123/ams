<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['sub'])){
            $sub = $_REQUEST['sub'];
            switch ($sub) {
                case 'add':
                    include "tambah_disposisi.php";
                    break;
                case 'edit':
                    include "edit_disposisi.php";
                    break;
                case 'del':
                    include "hapus_disposisi.php";
                    break;
            }
        } else {

            if($_SESSION['admin'] != 2){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                        window.history.back();
                      </script>';
            } else {

                $id_surat = $_REQUEST['id_surat'];

                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

                if(mysqli_num_rows($query) > 0){
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){

                    if($_SESSION['admin'] != 2){
                        echo '<script language="javascript">
                                window.alert("ERROR! Anda tidak memiliki hak akses untuk melihat data ini");
                                window.location.href="./admin.php?page=tsm";
                              </script>';
                    } else {

                      echo '<!-- Row Start -->
                            <div class="row jarak-form">
                                <a class="btn-large blue waves-effect waves-light" href="?page=tsm"><i class="material-icons">arrow_back</i>  Kembali</a>
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
                            <div class="row" style="margin-top: -20px">
                                <div class="col l6">
                                <div class="card">
                                    <div class="card-content">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td width="13%">No. Agenda</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['no_agenda'].'</td>
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td width="13%">Asal Surat</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['asal_surat'].'</td>
                                            </tr>
                                            <td width="13%">Perihal</td>
                                            <td width="1%">:</td>
                                            <td width="86%">'.$row['isi'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">No. Surat</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['no_surat'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">Tanggal Surat</td>
                                                <td width="1%">:</td>';

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

                                                <td width="86%">'.$d." ".$nm." ".$y.'</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">File</td>
                                                <td width="1%">:</td>
                                                <td width="86%">';
                                                if(!empty($row['file'])){
                                                    echo ' <a class="blue-text" href="?page=gsm&act=fsm&id_surat='.$row['id_surat'].'">'.$row['file'].'</a>';
                                                } else {
                                                    echo ' Tidak ada file yang diupload';
                                                } echo '</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">Keterangan</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['keterangan'].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="card-action">
                                        <a href="?page=tsm&act=del&submit=yes&id_surat='.$row['id_surat'].'" class="btn-large deep-orange waves-effect waves-light white-text">HAPUS <i class="material-icons">delete</i></a>
                                        <a href="?page=tsm" class="btn-large blue waves-effect waves-light white-text">BATAL <i class="material-icons">clear</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row form END -->';
                        }
                    }
                }
            }
        }
    }
?>
