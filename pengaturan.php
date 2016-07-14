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

            if(isset($_REQUEST['sub'])){
                $sub = $_REQUEST['sub'];
                switch ($sub) {
                    case 'usr':
                        include "user.php";
                        break;
                    }
            } else {

                if(isset($_REQUEST['submit'])){

                    //validasi form kosong
                    if ($_REQUEST['nama'] == "" || $_REQUEST['alamat'] == "" || $_REQUEST['kepsek'] == "" || $_REQUEST['nip'] == ""
                        || $_REQUEST['website'] == "" || $_REQUEST['email'] == ""){
                        echo '<script language="javascript">
                                window.alert("ERROR! Semua form wajib diisi.");
                                window.location.href="./admin.php?page=sett&sub=ins";
                              </script>';
                    } else {

                        $id_instansi = "1";
                        $nama = $_REQUEST['nama'];
                        $alamat = $_REQUEST['alamat'];
                        $kepsek = $_REQUEST['kepsek'];
                        $nip = $_REQUEST['nip'];
                        $website = $_REQUEST['website'];
                        $email = $_REQUEST['email'];

                        //validasi input data
                        if(!preg_match("/^[a-zA-Z0-9.() -]*$/", $nama)){
                            echo '<script language="javascript">
                                    window.alert("ERROR! Form NAMA hanya boleh mengandung huruf, angka, spasi, titik (.) dan minus (-)");
                                    window.location.href="./admin.php?page=sett";
                                  </script>';
                        } else {
                            if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $alamat)){
                                echo '<script language="javascript">
                                        window.alert("ERROR! Form ALAMAT hanya boleh mengandung huruf, angka, spasi, titik (.), koma (,), minus (-), garis miring (/), dan kurung ()");
                                        window.location.href="./admin.php?page=sett";
                                      </script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z., ]*$/", $kepsek)){
                                    echo '<script language="javascript">
                                            window.alert("ERROR! Form NAMA hanya boleh mengandung huruf, spasi, titik (.) dan koma (,)");
                                            window.location.href="./admin.php?page=sett";
                                          </script>';
                                } else {
                                    if(!preg_match("/^[0-9 -]*$/", $nip)){
                                        echo '<script language="javascript">
                                                window.alert("ERROR! Form NIP hanya boleh mengandung angka, spasi, dan minus (-)");
                                                window.location.href="./admin.php?page=sett";
                                              </script>';
                                    } else {

                                        //validasi url website
                                        if (!filter_var($website, FILTER_VALIDATE_URL)) {
                                            echo '<script language="javascript">
                                                    window.alert("ERROR! Format URL WEBSITE tidak valid");
                                                    window.location.href="./admin.php?page=sett";
                                                  </script>';
                                        } else {

                                            //validasi email
                                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                echo '<script language="javascript">
                                                        window.alert("ERROR! Format EMAIL tidak valid");
                                                        window.location.href="./admin.php?page=sett";
                                                      </script>';
                                            } else {

                                                $ekstensi = array('png','jpg');
                                                $logo = $_FILES['logo']['name'];
                                                $x = explode('.', $logo);
                                                $eks = strtolower(end($x));
                                                $ukuran = $_FILES['logo']['size'];
                                                $target_dir = "upload/";

                                                //jika form logo tidak kosong akan mengeksekusi script dibawah ini
                                                if(!empty($logo)){

                                                    $nlogo = $logo;
                                                    //validasi gambar
                                                    if(in_array($eks, $ekstensi) == true){
                                                        if($ukuran < 2000000){

                                                            $query = mysqli_query($config, "SELECT logo FROM tbl_instansi");
                                                            list($logo) = mysqli_fetch_array($query);

                                                            unlink($target_dir.$logo);

                                                            move_uploaded_file($_FILES['logo']['tmp_name'], $target_dir.$nlogo);

                                                            $query = mysqli_query($config, "UPDATE tbl_instansi SET nama='$nama',alamat='$alamat',kepsek='$kepsek',nip='$nip',website='$website',email='$email',logo='$nlogo' WHERE id_instansi='$id_instansi'");

                                                            if($query == true){
                                                                echo '<script language="javascript">
                                                                        window.alert("SUKSES! Data berhasil diupdate");
                                                                        window.location.href="./admin.php?page=sett";
                                                                      </script>';
                                                            } else {
                                                                echo '<script language="javascript">
                                                                        window.alert("ERROR! Periksa penulisan querynya");
                                                                        window.location.href="./admin.php?page=sett";
                                                                      </script>';
                                                            }
                                                        } else {
                                                            echo '<script language="javascript">
                                                                    window.alert("ERROR! Ukuran file yang diupload maksimal 2 MB");
                                                                    window.location.href="./admin.php?page=sett";
                                                                  </script>';
                                                        }
                                                    } else {
                                                        echo '<script language="javascript">
                                                                window.alert("ERROR! File yang diupload bukan gambar. Format file gambar yang diperbolehkan hanya *.JPG dan *.PNG");
                                                                window.location.href="./admin.php?page=sett";
                                                              </script>';
                                                    }
                                                } else {

                                                    //jika form logo kosong akan mengeksekusi script dibawah ini
                                                    $query = mysqli_query($config, "UPDATE tbl_instansi SET nama='$nama',alamat='$alamat',kepsek='$kepsek',nip='$nip',website='$website',email='$email' WHERE id_instansi='$id_instansi'");

                                                    if($query == true){
                                                        echo '<script language="javascript">
                                                                window.alert("SUKSES! Data berhasil diupdate");
                                                                window.location.href="./admin.php?page=sett";
                                                              </script>';
                                                    } else {
                                                        echo '<script language="javascript">
                                                                window.alert("ERROR! Periksa penulisan querynya");
                                                                window.location.href="./admin.php?page=sett";
                                                              </script>';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {

                    $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
                    if(mysqli_num_rows($query) > 0){
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){?>

                        <!-- Row Start -->
                        <div class="row">
                            <!-- Secondary Nav START -->
                            <div class="col s12">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <ul class="left">
                                            <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">work</i> Manajemen Instansi</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <!-- Secondary Nav END -->
                        </div>
                        <!-- Row END -->

                        <!-- Row form Start -->
                        <div class="row jarak-form">

                            <!-- Form START -->
                            <form class="col s12" method="post" action="?page=sett" enctype="multipart/form-data">

                                <!-- Row in form START -->
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input type="hidden" value="<?php echo $id_instansi; ?>" name="id_instansi">
                                        <i class="material-icons prefix md-prefix">school</i>
                                        <input id="nama" type="text" class="validate" name="nama" value="<?php echo $row['nama']; ?>" required>
                                        <label for="nama">Nama Instansi</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">account_box</i>
                                        <input id="kepsek" type="text" class="validate" name="kepsek" value="<?php echo $row['kepsek']; ?>" required>
                                        <label for="kepsek">Nama Kepala Sekolah</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">place</i>
                                        <input id="alamat" type="text" class="validate" name="alamat" value="<?php echo $row['alamat']; ?>" required>
                                        <label for="alamat">Alamat</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">looks_one</i>
                                        <input id="nip" type="text" class="validate" name="nip" value="<?php echo $row['nip']; ?>" required>
                                        <label for="nip">NIP Kepala Sekolah</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">language</i>
                                        <input id="website" type="url" class="validate" name="website" value="<?php echo $row['website']; ?>" required>
                                        <label for="website">Website</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <div class="file-field input-field">
                                            <div class="btn light-green darken-1">
                                                <span>File</span>
                                                <input type="file" id="logo" name="logo">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Upload Logo instansi">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-field col s2">
                                        <img class="logo" src="upload/<?php echo $row['logo']; ?>"/>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">mail</i>
                                        <input id="email" type="email" class="validate" name="email" value="<?php echo $row['email']; ?>" required>
                                        <label for="email">Email Instansi</label>
                                    </div>
                                </div>
                                <!-- Row in form END -->

                                <div class="row">
                                    <div class="col 6">
                                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                                    </div>
                                    <div class="col 6">
                                        <a href="./admin.php" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
                                    </div>
                                </div>

                            </form>
                            <!-- Form END -->

                        </div>
                        <!-- Row form END -->
<?php
                        }
                    }
                }
            }
        }
    }
?>
