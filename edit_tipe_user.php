<?php

    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if($_REQUEST['id_user'] == 1){
            echo '<script language="javascript">
                    window.alert("ERROR! Super Admin tidak boleh diedit");
                    window.location.href="./admin.php?page=sett&sub=usr";
                  </script>';
        } else {

            if($_REQUEST['id_user'] == $_SESSION['id_user']){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak diperbolehkan mengedit tipe akun Anda sendiri. Hubungi super admin untuk mengeditnya");
                        window.location.href="./admin.php?page=sett&sub=usr";
                      </script>';
            } else {

                if(isset($_REQUEST['submit'])){

                    $id_user = $_REQUEST['id_user'];
                    $admin = $_REQUEST['admin'];

                    if($id_user == $_SESSION['id_user']){
                        echo '<script language="javascript">
                                window.alert("ERROR! Anda tidak boleh mengedit akun Anda sendiri. Hubungi super admin untuk mengeditnya");
                                window.location.href="./admin.php?page=sett&sub=usr";
                              </script>';
                    } else {

                        $query = mysqli_query($config, "UPDATE tbl_user SET admin='$admin' WHERE id_user='$id_user'");

                        if($query == true){
                            echo '<script language="javascript">
                                    window.alert("SUKSES! Tipe User berhasil diupdate");
                                    window.location.href="./admin.php?page=sett&sub=usr";
                                  </script>';
                        } else {
                            echo '<script language="javascript">
                                    window.alert("ERROR! Periksa penulisan querynya");
                                    window.location.href="./admin.php?page=sett&sub=usr";
                                  </script>';
                        }
                    }
                } else {

                    $id_user = $_REQUEST['id_user'];
                    $query = mysqli_query($config, "SELECT * FROM tbl_user WHERE id_user='$id_user'");
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
                                            <li class="waves-effect waves-light  tooltipped" data-position="right" data-tooltip="Menu ini hanya untuk mengedit tipe user. Username dan password bisa diganti lewat menu profil"><a href="#" class="judul"><i class="material-icons">mode_edit</i> Edit Tipe User</a></li>
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
                            <form class="col s12" method="post" action="?page=sett&sub=usr&act=edit">

                                <!-- Row in form START -->
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input type="hidden" value="<?php echo $row['id_user'] ;?>" name="id_user">
                                        <i class="material-icons prefix md-prefix">account_circle</i>
                                        <input id="username" type="text" value="<?php echo $row['username'] ;?>" readonly class="grey-text">
                                        <label  for="username">Username</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">text_fields</i>
                                        <input id="username" type="text" value="<?php echo $row['nama'] ;?>" readonly class="grey-text">
                                        <label for="username">Nama</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">supervisor_account</i><label>Pilih tipe user</label><br/>
                                        <div class="input-field col s11 right">
                                            <select class="browser-default" name="admin" id="admin" required>
                                                <option value="3">User Biasa</option>
                                                <option value="2">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row in form END -->
                                <br/>
                                <div class="row">
                                    <div class="col 6">
                                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                                    </div>
                                    <div class="col 6">
                                        <a href="?page=sett&sub=usr" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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
