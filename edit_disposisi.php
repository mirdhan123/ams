<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){

            $id_surat = $_REQUEST['id_surat'];
            $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
            $no = 1;
            list($id_surat) = mysqli_fetch_array($query);

            //validasi form kosong
            if ($_REQUEST['tujuan'] == "" || $_REQUEST['isi_disposisi'] == "" || $_REQUEST['sifat'] == "" || $_REQUEST['batas_waktu'] == ""
                || $_REQUEST['catatan'] == ""){
                echo '<script language="javascript">
                        window.alert("ERROR! Semua form wajib diisi.");
                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                      </script>';
            } else {

                $id_disposisi = $_REQUEST['id_disposisi'];
                $tujuan = $_REQUEST['tujuan'];
                $isi_disposisi = $_REQUEST['isi_disposisi'];
                $sifat = $_REQUEST['sifat'];
                $batas_waktu = $_REQUEST['batas_waktu'];
                $catatan = $_REQUEST['catatan'];

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9.,\/ ]*$/", $tujuan)){
                    echo '<script language="javascript">
                            window.alert("ERROR! Form TUJUAN DISPOSISI hanya boleh mengandung huruf, angka, spasi titik(.), koma(,) dan garis miring(/)");
                            window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=edit&id_disposisi='.$id_disposisi.'";
                          </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/\r\n ]*$/", $isi_disposisi)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form ISI DISPOSISI hanya boleh mengandung huruf, angka, spasi, titik(.), koma(,), garis miring(/), kurung(), persen(%) dan at(@)");
                                window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=edit&id_disposisi='.$id_disposisi.'";
                              </script>';
                    } else {

                        if(!preg_match("/^[0-9 -]*$/", $batas_waktu)){
                            echo '<script language="javascript">
                                    window.alert("ERROR! Form BATAS WAKTU hanya boleh mengandung angka dan minus (-)");
                                    window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=edit&id_disposisi='.$id_disposisi.'";
                                  </script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,()%@\/ ]*$/", $catatan)){
                                echo '<script language="javascript">
                                        window.alert("ERROR! Form CATATAN hanya boleh mengandung huruf, angka, spasi, titik(.), koma(,), garis miring(/), dan kurung()");
                                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=edit&id_disposisi='.$id_disposisi.'";
                                      </script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0 ]*$/", $sifat)){
                                    echo '<script language="javascript">
                                            window.alert("ERROR! Form SIFAT hanya boleh mengandung huruf dan spasi");
                                            window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=edit&id_disposisi='.$id_disposisi.'";
                                          </script>';
                                } else {

                                    $query = mysqli_query($config, "UPDATE tbl_disposisi SET tujuan='$tujuan', isi_disposisi='$isi_disposisi', sifat='$sifat', batas_waktu='$batas_waktu' WHERE id_disposisi='$id_disposisi'");

                                    if($query == true){
                                        echo '<script language="javascript">
                                                window.alert("SUKSES! Data berhasil diupdate");
                                                window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'";
                                              </script>';
                                    } else {
                                        echo '<script language="javascript">
                                                window.alert("ERROR! Periksa penulisan querynya");
                                                window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=edit&id_disposisi='.$id_disposisi.'";
                                              </script>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {

            $id_disposisi = $_REQUEST['id_disposisi'];
            $query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");
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
                                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit Disposisi Surat</a></li>
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
                    <form class="col s12" method="post" action="">

                        <!-- Row in form START -->
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="hidden" value="<?php echo $row['id_disposisi'] ;?>">
                                <i class="material-icons prefix md-prefix">account_box</i>
                                <input id="tujuan" type="text" class="validate" name="tujuan" value="<?php echo $row['tujuan'] ;?>" required>
                                <label for="tujuan">Tujuan Disposisi</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">date_range</i>
                                <input id="batas_waktu" type="date" name="batas_waktu" class="datepicker" value="<?php echo $row['batas_waktu']; ?>"required>
                                <label for="batas_waktu">Batas Waktu</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">description</i>
                                <textarea id="isi_disposisi" class="materialize-textarea validate" name="isi_disposisi" required><?php echo $row['isi_disposisi'] ;?></textarea>
                                <label for="isi_disposisi">Isi Disposisi</label>
                            </div>

                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">featured_play_list   </i>
                                <input id="catatan" type="text" class="validate" name="catatan" value="<?php echo $row['catatan'] ;?>" required>
                                <label for="catatan">Catatan</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">supervisor_account</i><label>Pilih Sifat Disposisi</label><br/>
                                <div class="input-field col s11 right">
                                    <select class="browser-default validate" name="sifat" id="sifat" required>
                                        <option value="Biasa">Biasa</option>
                                        <option value="Penting">Penting</option>
                                        <option value="Segera">Segera</option>
                                        <option value="Perlu Perhatian Khusus">Perlu Perhatian Khusus</option>
                                        <option value="Perhatian Batas Waktu">Perhatian Batas Waktu</option>
                                </select>
                            </div>
                        </div>
                        <!-- Row in form END -->
                        <br/>
                        <div class="row">
                            <div class="col 6">
                                <button type="submit" name ="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                            </div>
                            <div class="col 6">
                                <button type="reset" onclick="window.history.back();" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></button>
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
