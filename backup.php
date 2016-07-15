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
                                            <li class="waves-effect waves-light hide-on-small-only"><a href="?page=bckp" class="judul"><i class="material-icons">storage</i> Backup Database Sistem</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- Secondary Nav END -->
                </div>
                <!-- Row END -->';

                // download file hasil backup
                if(isset($_REQUEST['nama_file'])){
                	$file = $back_dir.$_REQUEST['nama_file'];

                	if (file_exists($file)){
                		header('Content-Description: File Transfer');
                		header('Content-Type: application/octet-stream');
                		header('Content-Disposition: attachment; filename='.($file));
                		header('Content-Transfer-Encoding: binary');
                		header('Expires: 0');
                		header('Cache-Control: private');
                		header('Pragma: private');
                		header('Content-Length: ' . filesize($file));
                		ob_clean();
                		flush();
                		readfile($file);
                		exit;
                	} else {
                		echo "File {$_REQUEST['nama_file']} sudah tidak ada.";
                	}
                }

                // proses backup  database dilakukan oleh Fungsi
                function backup($host,$user,$pass,$name,$nama_file,$tables){

                    //untuk koneksi database
                    $return = "";
                    $link = mysqli_connect($host,$user,$pass,$name);

                    //backup semua tabel database
                    if($tables == '*'){
                        $tables = array();
                        $result = mysqli_query($link, 'SHOW TABLES');
                        while($row = mysqli_fetch_row($result)){
                            $tables[] = $row[0];
                        }
                    } else {

                        //backup tabel tertentu
                        $tables = is_array($tables) ? $tables : explode(',',$tables);
                    }

                    //looping table
                    foreach($tables as $table){
                        $result = mysqli_query($link, 'SELECT * FROM '.$table);
                        $num_fields = mysqli_num_fields($result);
                        $return.= 'DROP TABLE '.$table.';';
                        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
                        $return.= "\n\n".$row2[1].";\n\n";

                        //looping field table
                        for ($i = 0; $i < $num_fields; $i++){
                            while($row = mysqli_fetch_row($result)){
                                $return.= 'INSERT INTO '.$table.' VALUES(';
                                for($j=0; $j<$num_fields; $j++){
                                    $row[$j] = addslashes($row[$j]);
                                    $row[$j] = ereg_replace("\n","\\n",$row[$j]);
                                    if (isset($row[$j])){
                                        $return.= '"'.$row[$j].'"' ;
                                    } else {
                                        $return.= '""';
                                    }
                                    if ($j<($num_fields-1)){
                                        $return.= ',';
                                    }
                                }
                                $return.= ");\n";
                            }
                        }
                        $return.="\n\n\n";
                    }

                    //otomatis menyimpan hasil backup database dalam root folder aplikasi
                    $nama_file;
                    $handle = fopen($nama_file,'w+');
                    fwrite($handle,$return);
                    fclose($handle);
                }

                //nama database hasil backup
                $database = 'Backup';
                $file = $database.'_'.date("d_M_Y").'_'.time().'.sql';

                //backup database
                if(isset($_POST['backup'])){

                    //backup semua tabel
                    backup("localhost","root","","ams",$file,"*");

                    //backup hanya tabel tertentu
                    //backup("localhost","user_database","pass_database","nama_database",$file,"tabel1,tabel2,tabel3");

                  echo '<!-- Row form Start -->
                        <div class="row">
                            <div class="col m12">
                                <div class="card">
                                    <div class="card-content">
                                        <span class="card-title black-text"><div class="confirr green-text"><i class="material-icons md-36">done</i>
                                        SUKSES</div></span>
                                        <p class="kata">Database berhasil dibackup. </p>
                                    </div>
                                    <div class="card-action">
                                        <form method="post" name="postform" enctype="multipart/form-data" >
                                            <a href="?page=bkcp&nama_file='.$file.'" class="btn-large blue waves-effect waves-light white-text" name="backup">DOWNLOAD <i class="material-icons">file_download</i></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';
                } else {
                    echo '

                    <!-- Row form Start -->
                    <div class="row">
                        <div class="col m12">
                            <div class="card">
                                <div class="card-content">
                                    <span class="card-title black-text">Backup Database</span>
                                    <p class="kata">Lakukan backup database sistem secara berkala untuk membuat cadangan database yang bisa direstore kapan saja ketika dibutuhkan. Silakan klik tombol <strong>"backup"</strong> untuk memulai backup data. Setelah proses backup selesai, silakan download file backup database tersebut.</p>
                                </div>
                                <div class="card-action">
                                    <form method="post" name="postform" enctype="multipart/form-data" >
                                        <button type="submit" class="btn-large blue waves-effect waves-light" name="backup">BACKUP <i class="material-icons">backup</i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
?>
