<?php
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['sub'])){

            $id_user = $_SESSION['id_user'];

            if(isset($_REQUEST['submit'])){

                if($_REQUEST['username'] == "" || $_REQUEST['password'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['nip'] == ""){
                    echo '<script language="javascript">
                            window.alert("ERROR! Semua form wajib diisi.");
                            window.location.href="./admin.php?page=pro&sub=pass";
                          </script>';
                } else {

                    $username = $_REQUEST['username'];
                    $password_lama = $_REQUEST['password_lama'];
                    $password = $_REQUEST['password'];
                    $nama = $_REQUEST['nama'];
                    $nip = $_REQUEST['nip'];

                    if(!preg_match("/^[a-zA-Z0-9_]*$/", $username)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form USERNAME hanya boleh mengandung karakter huruf, angka dan underscore (_)");
                                window.location.href="./admin.php?page=pro&sub=pass";
                              </script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z. ]*$/", $nama)){
                            echo '<script language="javascript">
                                    window.alert("ERROR! Form NAMA hanya boleh mengandung karakter huruf, spasi dan titik (.)");
                                    window.location.href="./admin.php?page=pro&sub=pass";
                                  </script>';
                        } else {

                            if(!preg_match("/^[0-9. -]*$/", $nip)){
                                echo '<script language="javascript">
                                        window.alert("ERROR! Form NIP hanya boleh mengandung karakter angka, spasi dan titik (.)");
                                        window.location.href="./admin.php?page=pro&sub=pass";
                                      </script>';
                            } else {

                                if(strlen($username) < 5){
                                    echo '<script language="javascript">
                                            window.alert("ERROR! USERNAME minimal 5 karakter.");
                                            window.location.href="./admin.php?page=pro&sub=pass";
                                          </script>';
                                } else {

                                    if(strlen($password) < 5){
                                        echo '<script language="javascript">
                                                window.alert("ERROR! PASSWORD minimal 5 karakter.");
                                                window.location.href="./admin.php?page=pro&sub=pass";
                                              </script>';
                                    } else {

                                        $query = mysqli_query($config, "SELECT password FROM tbl_user WHERE id_user='$id_user'
                                            AND password=MD5('$password_lama')");
                                        if(mysqli_num_rows($query) > 0){
                                            $do = mysqli_query($config, "UPDATE tbl_user SET username='$username',
                                                password=MD5('$password'), nama='$nama', nip='$nip' WHERE id_user='$id_user'");
                                                if($query == true){
                                                    echo '<script language="javascript">
                                                            window.location.href="./logout.php";
                                                          </script>';
                                                } else {
                                                    echo '<script language="javascript">
                                                            window.alert("ERROR! Ada yang salah dengan querynya.");
                                                            window.location.href="./admin.php?page=pro&sub=pass";
                                                          </script>';
                                                }
                                            } else {
                                                echo '<script language="javascript">
                                                        window.alert("ERROR! Password lama tidak sesuai. Anda mungkin tidak memiliki akses ke halaman ini");
                                                        window.location.href="./logout.php";
                                                      </script>';
                                            }

                                    }
                                }
                            }
                        }
                    }
                }
            } else {?>

                <!-- UPDATE PROFIL PAGE START-->
                <!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <nav class="secondary-nav">
                            <div class="nav-wrapper blue-grey darken-1">
                                <ul class="left">
                                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">mode_edit</i> Edit Profil</a></li>
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
                    <form class="col s12" method="post" action="?page=pro&sub=pass">

                        <!-- Row in form START -->
                        <div class="row">
                            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Username minimal 5 karakter">
                                <i class="material-icons prefix md-prefix">account_circle</i>
                                <input id="username" type="text" class="validate" name="username" value="<?php echo $_SESSION['username']; ?>" required>
                                <label for="username">Username</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">text_fields</i>
                                <input id="nama" type="text" class="validate" name="nama" value="<?php echo $_SESSION['nama']; ?>" required>
                                <label for="nama">Nama</label>
                            </div>
                            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Isikan password lama Anda.">
                                <i class="material-icons prefix md-prefix">lock_open</i>
                                <input id="password_lama" type="password" class="validate" name="password_lama" required>
                                <label for="password_lama">Password Lama</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">looks_one</i>
                                <input id="nip" type="text" class="validate" name="nip" value="<?php echo $_SESSION['nip']; ?>" required>
                                <label for="nip">NIP</label>
                            </div>
                            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Password minimal 5 karakter">
                                <i class="material-icons prefix md-prefix">lock</i>
                                <input id="password" type="password" class="validate" name="password" required>
                                <label for="password">Password Baru</label>
                                <small class="red-text" style="margin-left: 40px;">*Setelah menekan tombol "Simpan", Anda akan diminta melakukan Login ulang.</small>
                            </div>
                        </div>
                        <!-- Row in form END -->
                        <br/><br/>
                        <div class="row">
                            <div class="col 6">
                                <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                            </div>
                            <div class="col 6">
                                <a href="?page=pro" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
                            </div>
                        </div>

                    </form>
                    <!-- Form END -->

                </div>
                <!-- Row form END -->
                <!-- UPDATE PROFIL PAGE END-->

<?php
                    }
        } else {
?>

            <!-- SHOW PROFIL PAGE START-->
            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">person</i> Profil User</a></li>
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
                <form class="col s12" method="post" action="save.php">

                    <!-- Row in form START -->
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">account_circle</i>
                            <input id="username" type="text" value="<?php echo $_SESSION['username']; ?>" readonly disable>
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">text_fields</i>
                            <input id="nama" type="text" value="<?php echo $_SESSION['nama']; ?>" readonly disable>
                            <label for="nama">Nama</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">lock</i>
                            <input id="password" type="text" value="*" readonly disable>
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">looks_one</i>
                            <input id="nip" type="text" value="<?php echo $_SESSION['nip']; ?>" readonly disable>
                            <label for="nip">NIP</label>
                        </div>
                    </div>
                    <!-- Row in form END -->
                    <br/><br/>
                    <div class="row">
                        <div class="col m12">
                            <a href="?page=pro&sub=pass" class="btn-large blue waves-effect waves-light">EDIT PROFIL<i class="material-icons">mode_edit</i></a>
                        </div>
                    </div>

                </form>
                <!-- Form END -->

            </div>
            <!-- Row form END -->
            <!-- SHOW PROFIL PAGE START-->

<?php
                }
            }
?>
