<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_SESSION['errQ'])){
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert-message" class="row jarak-card">
                    <div class="col m12">
                        <div class="card red lighten-5">
                            <div class="card-content notif">
                                <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                            </div>
                        </div>
                    </div>
                </div>';
            unset($_SESSION['errQ']);
        }

        $string = mysqli_real_escape_string($_config, $_REQUEST['id_surat']);
        $id_surat = decrypt($string, $salt);

        $query = mysqli_query($_config, "SELECT * FROM tbl_surat_keluar WHERE id_surat='$id_surat'");

        if(mysqli_num_rows($query) == 0){
            header("Location: ?page=tsk");
            die();
        }

            while($row = mysqli_fetch_array($query)){

            $string = $row['id_surat'];

            if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 3){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk menghapus data ini");
                        window.history.back();
                      </script>';
            } else {

    		  echo '
                <!-- Row form Start -->
				<div class="row jarak-card">
				    <div class="col m12">
                        <div class="card">
                            <div class="card-content">
        				        <table>
        				            <thead class="red lighten-5 red-text">
        				                <div class="confir red-text"><i class="material-icons md-36">error_outline</i>
        				                Apakah Anda yakin akan menghapus data ini?</div>
        				            </thead>

        				            <tbody>
        				                <tr>
        				                    <td width="13%">No. Agenda</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['no_agenda'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">Kode Klasifikasi</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['kode'].'</td>
        				                </tr>
                                        <tr>
                                            <td width="13%">Tujuan </td>
                                            <td width="1%">:</td>
                                            <td width="86%">'.$row['tujuan'].'</td>
                                        </tr>
        				                <tr>
        				                    <td width="13%">Isi Surat</td>
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
                                                echo ' <a class="blue-text" href="?page=gsk&act=fsk&id_surat='.urlencode(encrypt($string, $salt)).'">'.$row['file'].'</a>';
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
        		                <a href="?page=tsk&act=del&submit=yes&id_surat='.urlencode(encrypt($string, $salt)).'" class="btn-large deep-orange waves-effect waves-light white-text">HAPUS <i class="material-icons">delete</i></a>
        		                <a href="?page=tsk" class="btn-large blue waves-effect waves-light white-text">BATAL <i class="material-icons">clear</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row form END -->';

            	if(isset($_REQUEST['submit'])){
                    $string = mysqli_real_escape_string($_config, $_REQUEST['id_surat']);
                    $id_surat = urldecode(decrypt($string, $salt));

                    //jika ada file akan mengekseskusi script dibawah ini
                    if(!empty($row['file'])){

                        unlink("upload/surat_keluar/".$row['file']);
                        $query = mysqli_query($_config, "DELETE FROM tbl_surat_keluar WHERE id_surat='$id_surat'");

                		if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                            header("Location: ?page=tsk");
                            die();
                		} else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">window.history.back();</script>';
                		}
                	} else {

                        //jika tidak ada file akan mengekseskusi script dibawah ini
                        $query = mysqli_query($_config, "DELETE FROM tbl_surat_keluar WHERE id_surat='$id_surat'");

                        if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                            header("Location: ?page=tsk");
                            die();
                        } else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">window.history.back();</script>';
                        }
                    }
                }
		    }
	    }
    }
?>