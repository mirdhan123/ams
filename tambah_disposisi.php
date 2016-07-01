<?php
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

            if ($_REQUEST['tujuan'] == "" || $_REQUEST['isi_disposisi'] == "" || $_REQUEST['sifat'] == "" || $_REQUEST['batas_waktu'] == ""
                || $_REQUEST['catatan'] == ""){
                echo '<script language="javascript">
                        window.alert("ERROR! Semua form wajib diisi.");
                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                      </script>';
            } else {

                $tujuan = $_REQUEST['tujuan'];
                $isi_disposisi = $_REQUEST['isi_disposisi'];
                $sifat = $_REQUEST['sifat'];
                $batas_waktu = $_REQUEST['batas_waktu'];
                $catatan = $_REQUEST['catatan'];

                if(!preg_match("/^[a-zA-Z0-9.,\/ ]*$/", $tujuan)){
                    echo '<script language="javascript">
                            window.alert("ERROR! Form TUJUAN DISPOSISI hanya boleh mengandung huruf, angka, spasi tanda titik(.), koma(,) dan garis miring(/)");
                            window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                          </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/ ]*$/", $isi_disposisi)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form ISI DISPOSISI hanya boleh mengandung huruf, angka, spasi, tanda titik(.), koma(,), garis miring(/), kurung(), persen(%) dan at(@)");
                                window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                              </script>';
                    } else {

                        if(!preg_match("/^[0-9 -]*$/", $batas_waktu)){
                            echo '<script language="javascript">
                                    window.alert("ERROR! Form BATAS WAKTU hanya boleh mengandung angka dan tanda minus (-)");
                                    window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                                  </script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,()%@\/ ]*$/", $catatan)){
                                echo '<script language="javascript">
                                        window.alert("ERROR! Form CATATAN hanya boleh mengandung huruf, angka, spasi, tanda titik(.), koma(,), garis miring(/), dan kurung()");
                                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                                      </script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0 ]*$/", $sifat)){
                                    echo '<script language="javascript">
                                            window.alert("ERROR! Form SIFAT hanya boleh mengandung huruf dan spasi");
                                            window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                                          </script>';
                                } else {

                                    $query = mysqli_query($config, "INSERT INTO tbl_disposisi(tujuan,isi_disposisi,sifat,batas_waktu,catatan,id_surat)
                                        VALUES('$tujuan','$isi_disposisi','$sifat','$batas_waktu','$catatan','$id_surat')");

                                    if($query == true){
                                        echo '<script language="javascript">
                                                window.alert("SUKSES! Data berhasil ditambahkan");
                                                window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'";
                                              </script>';
                                    } else {
                                        echo '<script language="javascript">
                                                window.alert("ERROR! Periksa penulisan querynya");
                                                window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                                              </script>';
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
                    <li class="waves-effect waves-light tooltipped" data-position="right" data-tooltip="Mohon isi semua form agar tidak terjadi error."><a href="#" class="judul"><i class="material-icons">description</i> Tambah Disposisi Surat</a></li>
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
                <i class="material-icons prefix md-prefix">place</i>
                <input id="tujuan" type="text" class="validate" name="tujuan" required>
                <label for="tujuan">Tujuan Disposisi</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">date_range</i>
                <input id="batas_waktu" type="date" name="batas_waktu" class="datepicker" required>
                <label for="batas_waktu">Batas Waktu</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">description</i>
                <textarea id="isi_disposisi" class="materialize-textarea validate" name="isi_disposisi" required></textarea>
                <label for="isi_disposisi">Isi Disposisi</label>
            </div>

            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">featured_play_list   </i>
                <input id="catatan" type="text" class="validate" name="catatan" required>
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
?>
