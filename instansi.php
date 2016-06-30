<?php
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['submit'])){

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

                $logo = $_FILES['logo']['name'];
                $target_dir = "upload/";
                $imageFileType = pathinfo($logo, PATHINFO_EXTENSION);

                move_uploaded_file($_FILES['logo']['tmp_name'], 'upload/'.$logo);

                $query = mysqli_query($config, "UPDATE tbl_instansi SET nama='$nama',alamat='$alamat',kepsek='$kepsek',nip='$nip',website='$website',email='$email',logo='$logo' WHERE id_instansi='$id_instansi'");

                if($query == true){
                    echo '<script language="javascript">
                            window.alert("SUKSES! Data berhasil diupdate.");
                            window.location.href="./admin.php?page=sett&sub=ins";
                          </script>';
                } else {
                    echo '<script language="javascript">
                            window.alert("ERROR! Periksa penulisan querynya.");
                            window.location.href="./admin.php?page=sett&sub=ins";
                          </script>';
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
                                    <li class="waves-effect waves-light tooltipped" data-position="right" data-tooltip="Kelola nama instansi, alamat dan logo instansi pada aplikasi. Mohon isi semua form agar tidak terjadi error"><a href="#" class="judul"><i class="material-icons">work</i> Manajemen Instansi</a></li>
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
                    <form class="col s12" method="post" action="?page=sett&sub=ins">

                        <!-- Row in form START -->
                        <div class="row">
                            <div class="input-field col s6">
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
                            <div class="input-field col s6">
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
?>
