<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 2){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.history.back();
                  </script>';
        } else {

        if(isset($_REQUEST['submit'])){

            $disposisi = $_REQUEST['id_surat'];
            $salt = md5('masrud.com');

            function decrypt($disposisi, $salt){
               return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($disposisi), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
            }

            $id_surat = decrypt($disposisi, $salt);

            //validasi form kosong
            if($_REQUEST['tujuan'] == "" || $_REQUEST['isi_disposisi'] == "" || $_REQUEST['sifat'] == "" || $_REQUEST['batas_waktu'] == ""
                || $_REQUEST['catatan'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $tujuan = $_REQUEST['tujuan'];
                $isi_disposisi = $_REQUEST['isi_disposisi'];
                $sifat = $_REQUEST['sifat'];
                $batas_waktu = $_REQUEST['batas_waktu'];
                $catatan = $_REQUEST['catatan'];

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $tujuan)){
                    $_SESSION['tujuan'] = 'Form Tujuan Disposisi hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,) minus(-). kurung() dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi_disposisi)){
                        $_SESSION['isi_disposisi'] = 'Form Isi Disposisi hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan(&), underscore(_), kurung(), persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[0-9 -]*$/", $batas_waktu)){
                            $_SESSION['batas_waktu'] = 'Form Batas Waktu hanya boleh mengandung karakter huruf dan minus(-)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,()%@\/ -]*$/", $catatan)){
                                $_SESSION['catatan'] = 'Form catatan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-) garis miring(/), dan kurung()';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0 ]*$/", $sifat)){
                                    $_SESSION['catatan'] = 'Form SIFAT hanya boleh mengandung karakter huruf dan spasi';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET tujuan='$tujuan', isi_disposisi='$isi_disposisi', sifat='$sifat', batas_waktu='$batas_waktu', catatan='$catatan' WHERE id_surat='$id_surat'");

                                    if($query == true){
                                        $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                        echo '<script language="javascript">
                                                window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'";
                                              </script>';
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {

            $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
            $query = mysqli_query($config, "SELECT tujuan, isi_disposisi, sifat, batas_waktu, catatan FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
            if(mysqli_num_rows($query) > 0){
                $no = 1;
                list($tujuan, $isi_disposisi, $sifat, $batas_waktu, $catatan) = mysqli_fetch_array($query);{?>

                <!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <nav class="secondary-nav">
                            <div class="nav-wrapper blue-grey darken-1">
                                <ul class="left">
                                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit Disposisi Surat</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- Secondary Nav END -->
                </div>
                <!-- Row END -->

                <?php
                    if(isset($_SESSION['errEmpty'])){
                        $errEmpty = $_SESSION['errEmpty'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card red lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errEmpty.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['errEmpty']);
                    }
                    if(isset($_SESSION['errQ'])){
                        $errQ = $_SESSION['errQ'];
                        echo '<div id="alert-message" class="row">
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
                ?>

                <!-- Row form Start -->
                <div class="row jarak-form">

                    <!-- Form START -->
                    <form class="col s12" method="post" action="">

                        <!-- Row in form START -->
                        <div class="row">
                            <div class="input-field col s6">
                                <?php
                                    $disposisi = $id_surat;
                                    $salt = md5('masrud.com');

                                    function encrypt($disposisi, $salt){
                                       return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $disposisi, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
                                    }
                                ?>
                                <input type="hidden" value="<?php echo encrypt($disposisi, $salt); ?>" name="id_surat">
                                <i class="material-icons prefix md-prefix">account_box</i>
                                <input id="tujuan" type="text" class="validate" name="tujuan" value="<?php echo $tujuan; ?>" required>
                                    <?php
                                        if(isset($_SESSION['tujuan'])){
                                            $tujuan = $_SESSION['tujuan'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tujuan.'</div>';
                                            unset($_SESSION['tujuan']);
                                        }
                                    ?>
                                <label for="tujuan">Tujuan Disposisi</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">alarm</i>
                                <input id="batas_waktu" type="text" name="batas_waktu" class="datepicker" value="<?php echo $batas_waktu; ?>"required>
                                    <?php
                                        if(isset($_SESSION['batas_waktu'])){
                                            $batas_waktu = $_SESSION['batas_waktu'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$batas_waktu.'</div>';
                                            unset($_SESSION['batas_waktu']);
                                        }
                                    ?>
                                <label for="batas_waktu">Batas Waktu</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">description</i>
                                <textarea id="isi_disposisi" class="materialize-textarea validate" name="isi_disposisi" required><?php echo $isi_disposisi; ?></textarea>
                                    <?php
                                        if(isset($_SESSION['isi_disposisi'])){
                                            $isi_disposisi = $_SESSION['isi_disposisi'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$isi_disposisi.'</div>';
                                            unset($_SESSION['isi_disposisi']);
                                        }
                                    ?>
                                <label for="isi_disposisi">Isi Disposisi</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">featured_play_list   </i>
                                <input id="catatan" type="text" class="validate" name="catatan" value="<?php echo $catatan; ?>" required>
                                    <?php
                                        if(isset($_SESSION['catatan'])){
                                            $catatan = $_SESSION['catatan'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$catatan.'</div>';
                                            unset($_SESSION['catatan']);
                                        }
                                    ?>
                                <label for="catatan">Catatan</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">low_priority</i><label>Pilih Sifat Disposisi</label><br/>
                                <div class="input-field col s11 right">
                                    <select class="browser-default validate" name="sifat" id="sifat" required>
                                        <option value="<?php echo $sifat; ?>"><?php echo $sifat; ?></option>
                                        <option value="Biasa">Biasa</option>
                                        <option value="Penting">Penting</option>
                                        <option value="Segera">Segera</option>
                                        <option value="Rahasia">Rahasia</option>
                                </select>
                            </div>
                                <?php
                                    if(isset($_SESSION['sifat'])){
                                        $sifat = $_SESSION['sifat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$sifat.'</div>';
                                        unset($_SESSION['sifat']);
                                    }
                                ?>
                        </div>
                        <!-- Row in form END -->

                        <div class="row">
                            <div class="col 6">
                                <button type="submit" name ="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                            </div>
                            <div class="col 6">
                                <a href="?page=tsm&act=disp&id_surat=<?php echo $row['id_surat']; ?>" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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
?>
