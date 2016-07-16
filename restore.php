<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 2){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.location.href="./logout.php";
                  </script>';
        } else {

          echo '<!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col m12">
                                        <ul class="left">
                                            <li class="waves-effect waves-light"><a href="?page=rest" class="judul"><i class="material-icons">storage</i> Restore Database</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- Secondary Nav END -->
                </div>
                <!-- Row END -->';

                // proses restore database dilakukan oleh fungsi
                function restore($file){
                	global $rest_dir;

                    //konfigurasi database
                	$koneksi=mysqli_connect("localhost","root","","ams");

                	$nama_file	= $file['name'];
                	$ukrn_file	= $file['size'];
                	$tmp_file	= $file['tmp_name'];

                	if($nama_file == ""){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form FILE tidak boleh kosong");
                                window.location.href="./admin.php?page=rest";
                              </script>';
                    } else {
                		$alamatfile	= $rest_dir.$nama_file;
                		$templine	= array();

                        $ekstensi = array('sql');
                        $nama_file	= $file['name'];
                        $x = explode('.', $nama_file);
                        $eks = strtolower(end($x));

                        //validasi tipe file
                        if(in_array($eks, $ekstensi) == true){

                    		if(move_uploaded_file($tmp_file , $alamatfile)){

                    			$templine	= '';
                    			$lines		= file($alamatfile);

                    			foreach ($lines as $line){
                    				if(substr($line, 0, 2) == '--' || $line == '')
                    					continue;

                    				$templine .= $line;

                    				if(substr(trim($line), -1, 1) == ';'){
                    					mysqli_query($koneksi, $templine);
                    					$templine = '';
                    				}
                    			}
                                echo '<script language="javascript">
                                        window.alert("SUKSES! Database berhasil direstore");
                                        window.location.href="./admin.php?page=rest";
                                      </script>';
                    		} else {
                            echo '<script language="javascript">
                                    window.alert("ERROR! Proses upload gagal, kode error = '.$file['error'].'");
                                    window.location.href="./admin.php?page=rest";
                                  </script>';
                		    }
                        } else {
                            echo '<script language="javascript">
                                    window.alert("ERROR! File yang diupload buka database SQL");
                                    window.location.href="./admin.php?page=rest";
                                  </script>';
                        }
                	}
                }

                //restore database
                if(isset($_POST['restore'])){

                    restore($_FILES['file']);

                } else {
                    echo '

                    <!-- Row form Start -->
                    <div class="row">
                        <div class="col m12">
                            <div class="card">
                                <div class="card-content">
                                    <span class="card-title black-text">Restore Database</span>
                                    <p class="kata">Silakan pilih file database lalu klik tombol <strong>"restore"</strong> untuk melakukan restore database dari hasil backup yang telah dibuat sebelumnya. Jika belum ada database hasil backup, silakan lakukan backup terlebih dahulu melalui menu <strong>"Backup Database"</strong>.</p><br/>

                                    <p class="kata"><strong>CATATAN PENTING!</strong><br/> Data yang ada akan diganti dengan data yang baru.</p>
                                </div>
                                <div class="card-action">
                                    <form method="post" name="postform" enctype="multipart/form-data">
                                        <div class="file-field input-field col m6 tooltipped" data-position="top" data-tooltip="Format file database yang diperbolehkan hanya *.SQL">
                                            <div class="btn light-green darken-1">
                                                <span>File</span>
                                                <input type="file" name="file" accept=".sql" required>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" placeholder="Upload file database sql" type="text">
                                             </div>
                                        </div>&nbsp;&nbsp;
                                        <button type="submit" class="btn-large blue waves-effect waves-light" name="restore">RESTORE <i class="material-icons">restore</i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
?>
