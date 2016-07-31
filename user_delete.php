<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 1){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.history.back();
                  </script>';
        } else {

        $string = mysqli_real_escape_string($_config, $_REQUEST['id_user']);
        $id_user = urldecode(decrypt($string, $salt));

        if($id_user == 1){
            echo '<script language="javascript">
                    window.alert("ERROR! Administrator tidak boleh dihapus");
                    window.location.href="?page=sett&sub=usr";
                  </script>';
        } else {

            if($id_user == 2 || $id_user == 3){
                echo '<script language="javascript">
                        window.alert("ERROR! Akun ini tidak boleh dihapus");
                        window.location.href="?page=sett&sub=usr";
                      </script>';
            } else {

                if(isset($_REQUEST['submit'])){

                    $query = mysqli_query($_config, "DELETE FROM tbl_user WHERE id_user='$id_user'");
                    if($query == true){
                        $_SESSION['succDel'] = 'SUKSES! User berhasil dihapus<br/>';
                        header("Location: ?page=sett&sub=usr");
                        die();
                    } else {
                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                        echo '<script language="javascript">window.history.back();</script>';
                    }
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

                    $query = mysqli_query($_config, "SELECT * FROM tbl_user WHERE id_user='$id_user'");

                    if(mysqli_num_rows($query) == 0){
                        header("Location: ?page=sett&sub=usr");
                        die();
                    }

                    while($row = mysqli_fetch_array($query)){

            		 echo '
                        <!-- Row form Start -->
        				<div class="row jarak-card">
        				    <div class="col m12">
                                <div class="card">
                                    <div class="card-content">
                				        <table>
                				            <thead class="red lighten-5 red-text">
                				                <div class="confir red-text"><i class="material-icons md-36">error_outline</i>
                				                Apakah Anda yakin akan menghapus user ini?</div>
                				            </thead>

                				            <tbody>
                				                <tr>
                				                    <td width="13%">Username</td>
                				                    <td width="1%">:</td>
                				                    <td width="86%">'.$row['username'].'</td>
                				                </tr>
                				                <tr>
                				                    <td width="13%">Nama</td>
                				                    <td width="1%">:</td>
                				                    <td width="86%">'.$row['nama'].'</td>
                				                </tr>
                				                <tr>
                				                    <td width="13%">NIP</td>
                				                    <td width="1%">:</td>
                				                    <td width="86%">'.$row['nip'].'</td>
                				                </tr>
                				                <tr>
                				                    <td width="13%">Tipe User</td>
                				                    <td width="1%">:</td>';
                                                    if($row['admin'] == 2){
                                                        $row['admin'] = "Pimpinan Instansi";
                                                    } else {
                                                        if($row['admin'] == 3){
                                                        $row['admin'] = "User Biasa";
                                                    }
                                                } echo '
                				                    <td width="86%">'.$row['admin'].'</td>
                				                </tr>
                				            </tbody>
                				   		</table>
        				            </div>
                                    <div class="card-action">';

                                    $string = $row['id_user'];
                                    echo '

                		                <a href="?page=sett&sub=usr&act=del&submit=yes&id_user='.urlencode(encrypt($string, $salt)).'" class="btn-large deep-orange waves-effect waves-light white-text">HAPUS <i class="material-icons">delete</i></a>
                		                <a href="?page=sett&sub=usr" class="btn-large blue waves-effect waves-light white-text">BATAL <i class="material-icons">clear</i></a>
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
