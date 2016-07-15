<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
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
                                            <li class="waves-effect waves-light hide-on-small-only"><a href="?page=rest" class="judul"><i class="material-icons">storage</i> Restore Database Sistem</a></li>
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
                function restore($file) {
                	global $rest_dir;
                	$koneksi=mysqli_connect("localhost","root","","ams");

                	$nama_file	= $file['name'];
                	$ukrn_file	= $file['size'];
                	$tmp_file	= $file['tmp_name'];

                	if ($nama_file == ""){
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

                        if(in_array($eks, $ekstensi) == true){

                		if (move_uploaded_file($tmp_file , $alamatfile)){

                			$templine	= '';
                			$lines		= file($alamatfile);

                			foreach ($lines as $line){
                				if (substr($line, 0, 2) == '--' || $line == '')
                					continue;

                				$templine .= $line;

                				if (substr(trim($line), -1, 1) == ';'){
                					mysqli_query($koneksi, $templine);
                					$templine = '';
                				}
                			}
                            echo '<!-- Row form Start -->
                                  <div class="row">
                                      <div class="col m12">
                                          <div class="card">
                                              <div class="card-content">
                                                  <span class="card-title black-text"><div class="confirr green-text"><i class="material-icons md-36">done</i>
                                                  SUKSES</div></span>
                                                  <p class="kata">Database berhasil direstore, silakan dicek.</p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>';
                		} else {
                            echo '<!-- Row form Start -->
                                  <div class="row">
                                      <div class="col m12">
                                          <div class="card">
                                              <div class="card-content">
                                                  <span class="card-title black-text"><div class="confir red-text"><i class="material-icons md-36">error_outline</i>
                                                  ERROR</div></span>
                                                  <p class="kata">Proses upload gagal, kode error = '.$file['error'].'</p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>';
                		}
                    } else {
                            echo '<script language="javascript">
                                    window.alert("ERROR! File yang diupload buka database sql");
                                    window.location.href="./admin.php?page=rest";
                                  </script>';
                        }
                	}
                }

                //restore database
                if(isset($_POST['restore'])){

                    restore($_FILES['datafile']);

                } else {
                    echo '

                    <!-- Row form Start -->
                    <div class="row">
                        <div class="col m12">
                            <div class="card">
                                <div class="card-content">
                                    <span class="card-title black-text">Restore Database</span>
                                    <p class="kata">Silakan pilih file database lalu klik tombol <strong>"restore"</strong> untuk melakukan restore database dari hasil backup yang telah dibuat sebelumnya. Jika belum ada database hasil backup, silakan lakukan backup terlebih dahulu melalui menu <strong>"Backup Database"</strong>.</p>

                                </div>
                                <div class="card-action">
                                    <form method="post" name="postform" enctype="multipart/form-data">
                                        <div class="file-field input-field col m6 tooltipped" data-position="top" data-tooltip="Format file database yang diperbolehkan hanya *.SQL">
                                            <div class="btn light-green darken-1">
                                                <span>File</span>
                                                <input type="file" name="datafile">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
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
?>
