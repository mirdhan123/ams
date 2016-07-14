<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){

                $id_klasifikasi = $_REQUEST['id_klasifikasi'];
                $kode = $_REQUEST['kode'];
                $nama = $_REQUEST['nama'];
                $uraian = $_REQUEST['uraian'];
                $id_user = $_SESSION['admin'];

                //validasi form kosong
                if($_REQUEST['kode'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['uraian'] == ""){
                    echo '<script language="javascript">
                            window.alert("ERROR! Semua form wajib diisi");
                            window.location.href="./admin.php?page=ref&act=edit&id_klasifikasi='.$id_klasifikasi.'";
                          </script>';
                } else {

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9. ]*$/", $kode)){
                    echo '<script language="javascript">
                            window.alert("ERROR! Form KODE hanya boleh mengandung karakter huruf, angka, spasi dan titik (.)");
                            window.location.href="./admin.php?page=ref&act=edit&id_klasifikasi='.$id_klasifikasi.'";
                          </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,\/ ]*$/", $nama)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form NAMA hanya boleh mengandung karakter huruf, spasi, titik (.) dan koma (,)");
                                window.location.href="./admin.php?page=ref&act=edit&id_klasifikasi='.$id_klasifikasi.'";
                              </script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9.,()\/\r\n  ]*$/", $uraian)){
                            echo '<script language="javascript">
                                    window.alert("ERROR! Form URAIAN hanya boleh mengandung huruf, angka, spasi, tanda titik(.), koma(,), garis miring(/), dan kurung()");
                                    window.location.href="./admin.php?page=ref&act=edit&id_klasifikasi='.$id_klasifikasi.'";
                                  </script>';
                        } else {

                            $query = mysqli_query($config, "UPDATE tbl_klasifikasi SET kode='$kode', nama='$nama', uraian='$uraian', id_user='$id_user' WHERE id_klasifikasi='$id_klasifikasi'");

                            if($query != false){
                                echo '<script language="javascript">
                                        window.alert("SUKSES! Data berhasil diupdate");
                                        window.location.href="./admin.php?page=ref";
                                      </script>';
                            } else {
                                echo '<script language="javascript">
                                        window.alert("ERROR! Periksa penulisan querynya");
                                        window.location.href="./admin.php?page=ref&act=edit&id_klasifikasi='.$id_klasifikasi.'";
                                      </script>';
                            }
                        }
                    }
                }
            }
        } else {

            $id_klasifikasi = mysqli_real_escape_string($config, $_REQUEST['id_klasifikasi']);
            $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");
            if(mysqli_num_rows($query) > 0){
                $no = 1;
                while($row = mysqli_fetch_array($query))
                if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 2){
                    echo '<script language="javascript">
                            window.alert("ERROR! Anda tidak memiliki hak akses untuk mengedit data ini");
                            window.location.href="./admin.php?page=ref";
                          </script>';
                } else {?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit Klasifikasi Surat</a></li>
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
                <form class="col s12" method="post" action="?page=ref&act=edit">

                    <!-- Row in form START -->
                    <div class="row">
                        <div class="input-field col s3">
                            <input type="hidden" value="<?php echo $row['id_klasifikasi']; ?>" name="id_klasifikasi">
                            <i class="material-icons prefix md-prefix">font_download</i>
                            <input id="kd" type="text" class="validate" name="kode" maxlength="30" value="<?php echo $row['kode']; ?>" required>
                            <label for="kd">Kode</label>
                        </div>
                        <div class="input-field col s9">
                            <i class="material-icons prefix md-prefix">text_fields</i>
                            <input id="nama" type="text" class="validate" name="nama" value="<?php echo $row['nama']; ?>" required>
                            <label for="nama">Nama</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">subject</i>
                            <textarea id="uraian" class="materialize-textarea" name="uraian" required><?php echo $row['uraian']; ?></textarea>
                            <label for="uraian">Uraian</label>
                        </div>
                    </div>
                    <!-- Row in form END -->
                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <a href="?page=ref" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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
