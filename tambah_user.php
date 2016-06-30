<?php
    //Cek session user yang login. Jika tidak ditemukan user yang login akan menampilkan pesan error
    if(empty($_SESSION['admin'])){

        //Menampilkan pesan error dan mengarahkan ke halaman login
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){

            if($_REQUEST['username'] == "" || $_REQUEST['password'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['nip'] == "" || $_REQUEST['admin'] == ""){
                echo '<script language="javascript">
                        window.alert("ERROR! Semua form wajib diisi.");
                        window.location.href="./admin.php?page=sett&sub=usr&act=add";
                      </script>';
            } else {

                $username = $_REQUEST['username'];
                $password = $_REQUEST['password'];
                $nama = $_REQUEST['nama'];
                $nip = $_REQUEST['nip'];
                $admin = $_REQUEST['admin'];

                if(!preg_match("/^[a-zA-Z0-9_]*$/", $username)){
                    echo '<script language="javascript">
                            window.alert("ERROR! Form USERNAME hanya boleh mengandung karakter huruf, angka dan underscore (_)");
                            window.location.href="./admin.php?page=sett&sub=usr&act=add";
                          </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z. ]*$/", $nama)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form NAMA hanya boleh mengandung karakter huruf, spasi dan titik (.)");
                                window.location.href="./admin.php?page=sett&sub=usr&act=add";
                              </script>';
                    } else {

                        if(!preg_match("/^[0-9. -]*$/", $nip)){
                            echo '<script language="javascript">
                                    window.alert("ERROR! Form NIP hanya boleh mengandung karakter angka, spasi dan titik (.)");
                                    window.location.href="./admin.php?page=sett&sub=usr&act=add";
                                  </script>';
                        } else {

                            if(!preg_match("/^[1-2]*$/", $admin)){
                                echo '<script language="javascript">
                                        window.alert("ERROR! TIPE USER hanya boleh mengandung angka 1 atau 2");
                                        window.location.href="./admin.php?page=sett&sub=usr&act=add";
                                      </script>';
                            } else {

                                $cek = mysqli_query($config, "SELECT * FROM tbl_user WHERE username='$username'");
                                $result = mysqli_num_rows($cek);

                                if($result > 0){
                                    echo '<script language="javascript">
                                            window.alert("ERROR! USERNAME sudah terpakai. Gunakan lainnya.");
                                            window.location.href="./admin.php?page=sett&sub=usr&act=add";
                                          </script>';
                                } else {

                                    if(strlen($username) < 5){
                                        echo '<script language="javascript">
                                                window.alert("ERROR! USERNAME minimal 5 karakter.");
                                                window.location.href="./admin.php?page=sett&sub=usr&act=add";
                                              </script>';
                                    } else {

                                        if(strlen($password) < 5){
                                            echo '<script language="javascript">
                                                    window.alert("ERROR! PASSWORD minimal 5 karakter.");
                                                    window.location.href="./admin.php?page=sett&sub=usr&act=add";
                                                  </script>';
                                        } else {

                                            $query = mysqli_query($config, "INSERT INTO tbl_user(username,password,nama,nip,admin) VALUES('$username',MD5('$password'),'$nama','$nip','$admin')");

                                            if($query != false){
                                                echo '<script language="javascript">
                                                        window.alert("SUKSES! User baru berhasil ditambahkan.");
                                                        window.location.href="./admin.php?page=sett&sub=usr";
                                                      </script>';
                                            } else {
                                                echo '<script language="javascript">
                                                        window.alert("ERROR! Periksa penulisan querynya.");
                                                        window.location.href="./admin.php?page=sett&sub=usr&act=add";
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
?>
<!-- Row Start -->
<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <nav class="secondary-nav">
            <div class="nav-wrapper blue-grey darken-1">
                <ul class="left">
                    <li class="waves-effect waves-light  tooltipped" data-position="right" data-tooltip="Mohon isi semua form agar tidak terjadi error. Jika belum memiliki NIP, bisa diisi dengan tanda minus (-)"><a href="#" class="judul"><i class="material-icons">person_add</i> Tambah User</a></li>
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
    <form class="col s12" method="POST" action="?page=sett&sub=usr&act=add">

        <!-- Row in form START -->
        <div class="row">
            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Username minimal 5 karakter dan hanya boleh mengandung karakter huruf, angka dan underscore (_)">
                <i class="material-icons prefix md-prefix">account_circle</i>
                <input id="username" type="text" class="validate" name="username">
                <label for="username">Username</label>
            </div>
            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Nama hanya boleh mengandung karakter huruf, spasi dan titik (.)">
                <i class="material-icons prefix md-prefix">text_fields</i>
                <input id="nama" type="text" class="validate" name="nama">
                <label for="nama">Nama</label>
            </div>
            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Password minimal 5 karakter dan akan dienkripsi secara otomatis.">
                <i class="material-icons prefix md-prefix">lock</i>
                <input id="password" type="password" class="validate" name="password">
                <label for="password">Password</label>
            </div>
            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="NIP hanya boleh mengandung karakter angka, spasi, titik (.) dan minus (-)">
                <i class="material-icons prefix md-prefix">looks_one</i>
                <input id="nip" type="text" class="validate" name="nip">
                <label for="nip">NIP</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">supervisor_account</i><label>Pilih Tipe User</label><br/>
                <div class="input-field col s11 right">
                    <select class="browser-default validate" name="admin" id="admin">
                        <option value="1">Admin</option>
                        <option value="2">User Biasa</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- Row in form END -->
        <br/><br/>
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
?>
