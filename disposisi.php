<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 2){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.history.back();
                  </script>';
        } else {

            if(isset($_REQUEST['simpan'])){
                $status = $_REQUEST['status'];
                $id_surat = $_REQUEST['id_surat'];

                if($status == 1){

                    $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET status='$status' WHERE id_surat='$id_surat'");
                    if($query == true){
                        echo '<script language="javascript">
                                window.alert("SUKSES! Data berhasil diupdate");
                                window.location.href="./admin.php?page=tsm&act=addd&id_surat='.$id_surat.'";
                              </script>';
                    }
                } else {
                    $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET status='$status' WHERE id_surat='$id_surat'");
                    if($query == true){
                        echo '<script language="javascript">
                                window.alert("SUKSES! Data berhasil diupdate");
                                window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'";
                              </script>';
                    }
                }
            }

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

                        if(isset($_REQUEST['arsip'])){
                            header("location: ./");
                            die();
                        } else {

                        echo '
                            <!-- Row Start -->
                            <div class="row jarak-form">
                                <div class="col 12">
                                    <a class="btn-large blue waves-effect waves-light" href="?page=tsm"><i class="material-icons">arrow_back</i>  Kembali</a>
                                </div>';

                                if($row['status'] == 1){
                                    echo '
                                    <div class="col 12" style="margin-top: -8px">
                                        <div class="card green lighten-5">
                                            <div class="card-content">
                                                <p class="green-text bold" style="margin: -12px 0!important;font-size: 1.6rem;">                                             <i class="material-icons md-36">info</i> Surat ini sudah diperiksa dan disposisi sudah dibuat
                                              </p>
                                            </div>
                                        </div>
                                    </div>';
                                } elseif($row['status'] == 2){
                                    echo '
                                    <div class="col 12" style="margin-top: -8px">
                                        <div class="card green lighten-5">
                                            <div class="card-content">
                                                <p class="green-text bold" style="margin: -12px 0!important;font-size: 1.6rem;"><i class="material-icons md-36">info</i> Surat ini sudah diperiksa namun disposisi tidak dibuat
                                              </p>
                                            </div>
                                        </div>
                                    </div>';
                                } else {
                                    echo '
                                    <div class="col 12" style="margin-top: -8px">
                                        <div class="card yellow lighten-4">
                                            <div class="card-content">
                                                <p class="orange-text bold" style="margin: -12px 0!important;font-size: 1.6rem;"><i class="material-icons md-36">info</i> Surat ini belum diperiksa
                                              </p>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }

                            if(isset($_SESSION['succAdd'])){
                                $succAdd = $_SESSION['succAdd'];
                                echo '<br/><div id="alert-message" class="row">
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
                                echo '<br/><div id="alert-message" class="row">
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
                                echo '<br/><div id="alert-message" class="row">
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

                            </div>
                            <!-- Row END -->

                            <!-- Row form Start -->
                            <div class="row" style="margin-top: -15px">';

                                if($row['status'] == 1){
                                    echo '
                                    <div class="col s6">
                                        <div class="card">
                                            <div class="card-content">
                                                <table>
                                                    <thead>
                                                        <h5>Data surat masuk</h5><hr/>
                                                    </thead>
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
                                                            <td width="13%">File Lampiran</td>
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
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col s6">
                                        <div class="card">
                                            <div class="card-content">
                                                <table>
                                                    <thead>
                                                        <h5>Data disposisi surat</h5><hr/>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td width="13%">Tujuan</td>
                                                            <td width="1%">:</td>
                                                            <td width="86%">'.$row['tujuan'].'</td>
                                                        </tr>
                                                        <tr>
                                                        <tr>
                                                            <td width="13%">Isi Disposisi</td>
                                                            <td width="1%">:</td>
                                                            <td width="86%">'.$row['isi_disposisi'].'</td>
                                                        </tr>
                                                        <td width="13%">Sifat</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['sifat'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="13%">Batas Waktu</td>
                                                            <td width="1%">:</td>';

                                                            $y = substr($row['batas_waktu'],0,4);
                                                            $m = substr($row['batas_waktu'],5,2);
                                                            $d = substr($row['batas_waktu'],8,2);

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
                                                            <td width="13%">Catatan</td>
                                                            <td width="1%">:</td>
                                                            <td width="86%">'.$row['catatan'].'</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <div class="card-action">
                                            <a href="?page=tsm&act=editd&id_surat='.$row['id_surat'].'" class="btn-large deep-orange waves-effect waves-light white-text">EDIT<i class="material-icons">edit</i></a>
                                        </div>
                                    </div>
                                </div>';

                            } elseif($row['status'] == 2) {

                                echo '
                                <div class="col s12">
                                    <div class="card">
                                        <div class="card-content">
                                            <table>
                                                <thead>
                                                    <h5>Data surat masuk</h5><hr/>
                                                </thead>
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
                                                        <td width="13%">File Lampiran</td>
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
                                            <a href="?page=tsm&act=addd&id_surat='.$row['id_surat'].'" class="btn-large deep-orange waves-effect waves-light white-text">BUAT DISPOSISI <i class="material-icons">edit</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                            } else {

                                echo '
                                <div class="col s12">
                                    <div class="card">
                                        <div class="card-content">
                                            <table>
                                                <thead>
                                                    <h5>Data surat masuk</h5><hr/>
                                                </thead>
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
                                                        <td width="13%">File Lampiran</td>
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
                                            <div class="col s12">
                                                <form method="post" enctype="multipart/form-data">
                                                    <input class="with-gap" name="status" type="radio" id="setuju" value="1" required/>
                                                    <label for="setuju" style="color: #444;font-size: 1.2rem">Setuju dan buat disposisi</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <input class="with-gap" name="status" type="radio" id="arsip" value="2" required/>
                                                    <label for="arsip" style="color: #444;font-size: 1.2rem">Arsipkan saja</label></div><br/><br/><br/>

                                                    <button type="submit" name="simpan" class="btn-large deep-orange waves-effect waves-light white-text">SIMPAN <i class="material-icons">done</i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }

                            echo '
                        </div>
                        <!-- Row form END -->';
                        }
                    }
                }
            }
        }
?>
