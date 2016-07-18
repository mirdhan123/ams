<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){

            //validasi form kosong
            if ($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['asal_surat'] == "" || $_REQUEST['isi'] == ""
                || $_REQUEST['kode'] == "" || $_REQUEST['indeks'] == "" || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['keterangan'] == ""){
                echo '<script language="javascript">
                        window.alert("ERROR! Semua form wajib diisi");
                        window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                      </script>';
            } else {

                $id_surat = $_REQUEST['id_surat'];
                $no_agenda = $_REQUEST['no_agenda'];
                $no_surat = $_REQUEST['no_surat'];
                $asal_surat = $_REQUEST['asal_surat'];
                $isi = $_REQUEST['isi'];
                $kode = substr($_REQUEST['kode'],0,30);
                $nkode = trim($kode);
                $indeks = $_REQUEST['indeks'];
                $tgl_surat = $_REQUEST['tgl_surat'];
                $keterangan = $_REQUEST['keterangan'];
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[0-9]*$/", $no_agenda)){
                    echo '<script language="javascript">
                            window.alert("ERROR! Form NOMOR AGENDA harus diisi angka");
                            window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                          </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form NOMOR SURAT hanya boleh mengandung huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)");
                                window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                              </script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9., \/]*$/", $asal_surat)){
                            echo '<script language="javascript">
                                    window.alert("ERROR! Form ASAL SURAT hanya boleh mengandung huruf, angka, spasi, titik(.), koma(,) dan garis miring(/)");
                                    window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                                  </script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi)){
                                echo '<script language="javascript">
                                        window.alert("ERROR! Form ISI RINGKAS hanya boleh mengandung huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), underscore(_), dan(&), kurung(), persen(%) dan at(@)");
                                        window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                                      </script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0-9., ]*$/", $nkode)){
                                    echo '<script language="javascript">
                                            window.alert("ERROR! Form KODE KLASIFIKASI hanya boleh mengandung huruf, angka, spasi, titik(.) dan koma(,)");
                                            window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                                          </script>';
                                } else {

                                    if(!preg_match("/^[a-zA-Z0-9., -]*$/", $indeks)){
                                        echo '<script language="javascript">
                                                window.alert("ERROR! Form INDEKS hanya boleh mengandung huruf, angka, spasi, titik(.) koma(,) dan minus (-)");
                                                window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                                              </script>';
                                    } else {

                                        if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                                            echo '<script language="javascript">
                                                    window.alert("ERROR! Form TANGGAL SURAT hanya boleh mengandung angka dan minus(-)");
                                                    window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                                                  </script>';
                                        } else {

                                            if(!preg_match("/^[a-zA-Z0-9.,()%@\/ -]*$/", $keterangan)){
                                                echo '<script language="javascript">
                                                        window.alert("ERROR! Form KETERANGAN hanya boleh mengandung huruf, angka, spasi, titik(.), koma(,), garis miring(/), minus(-) dan kurung()");
                                                        window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                                                      </script>';
                                            }

                                            $ekstensi = array('jpg','png','jpeg','doc','docx','pdf');
                                            $file = $_FILES['file']['name'];
                                            $x = explode('.', $file);
                                            $eks = strtolower(end($x));
                                            $ukuran = $_FILES['file']['size'];
                                            $target_dir = "upload/surat_masuk/";

                                            //jika form file tidak kosong akan mengeksekusi script dibawah ini
                                            if($file != ""){

                                                $rand = rand(1,10000);
                                                $nfile = $rand."-".$file;

                                                //validasi file
                                                if(in_array($eks, $ekstensi) == true){
                                                    if($ukuran < 2300000){

                                                        $id_surat = $_REQUEST['id_surat'];
                                                        $query = mysqli_query($config, "SELECT file FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
                                                        list($file) = mysqli_fetch_array($query);

                                                        //jika file tidak kosong akan mengeksekusi script dibawah ini
                                                        if(!empty($file)){
                                                            unlink($target_dir.$file);

                                                            move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                            $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET no_agenda='$no_agenda',no_surat='$no_surat',asal_surat='$asal_surat',isi='$isi',kode='$nkode',indeks='$indeks',tgl_surat='$tgl_surat',file='$nfile',keterangan='$keterangan',id_user='$id_user' WHERE id_surat='$id_surat'");

                                                            if($query == true){
                                                                echo '<script language="javascript">
                                                                        window.alert("SUKSES! Data berhasil diupdate");
                                                                        window.location.href="./admin.php?page=tsm";
                                                                      </script>';
                                                            } else {
                                                                echo '<script language="javascript">
                                                                        window.alert("ERROR! Periksa penulisan querynya");
                                                                        window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                                                                      </script>';
                                                            }
                                                        } else {

                                                            //jika file kosong akan mengeksekusi script dibawah ini
                                                            move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                            $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET no_agenda='$no_agenda',no_surat='$no_surat',asal_surat='$asal_surat',isi='$isi',kode='$nkode',indeks='$indeks',tgl_surat='$tgl_surat',file='$nfile',keterangan='$keterangan',id_user='$id_user' WHERE id_surat='$id_surat'");

                                                            if($query == true){
                                                                echo '<script language="javascript">
                                                                        window.alert("SUKSES! Data berhasil diupdate");
                                                                        window.location.href="./admin.php?page=tsm";
                                                                      </script>';
                                                            } else {
                                                                echo '<script language="javascript">
                                                                        window.alert("ERROR! Periksa penulisan querynya");
                                                                        window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                                                                      </script>';
                                                            }
                                                        }
                                                    } else {
                                                        echo '<script language="javascript">
                                                                window.alert("ERROR! Ukuran file yang diupload maksimal 2 MB");
                                                                window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                                                              </script>';
                                                    }
                                                } else {
                                                        echo '<script language="javascript">
                                                                window.alert("ERROR! File yang diupload harus berformat *.JPG, *.PNG, *.DOC, *.DOCX atau *.PDF");
                                                                window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
                                                              </script>';
                                                }
                                            } else {

                                                //jika form file kosong akan mengeksekusi script dibawah ini
                                                $id_surat = $_REQUEST['id_surat'];

                                                $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET no_agenda='$no_agenda',no_surat='$no_surat',asal_surat='$asal_surat',isi='$isi',kode='$nkode',indeks='$indeks',tgl_surat='$tgl_surat',keterangan='$keterangan',id_user='$id_user' WHERE id_surat='$id_surat'");

                                                if($query == true){
                                                    echo '<script language="javascript">
                                                            window.alert("SUKSES! Data berhasil diupdate");
                                                            window.location.href="./admin.php?page=tsm";
                                                          </script>';
                                                } else {
                                                    echo '<script language="javascript">
                                                            window.alert("ERROR! Periksa penulisan querynya");
                                                            window.location.href="./admin.php?page=tsm&act=edit&id_surat='.$id_surat.'";
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
            }
        } else {

            $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
            $query = mysqli_query($config, "SELECT id_surat, no_agenda, no_surat, asal_surat, isi, kode, indeks, tgl_surat, file, keterangan, id_user FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
            list($id_surat, $no_agenda, $no_surat, $asal_surat, $isi, $kode, $indeks, $tgl_surat, $file, $keterangan, $id_user) = mysqli_fetch_array($query);

            if($_SESSION['id_user'] != $id_user AND $_SESSION['id_user'] != 1){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk mengedit data ini");
                        window.location.href="./admin.php?page=tsm";
                      </script>';
            } else {?>

        <!-- Row Start -->
        <div class="row">
            <!-- Secondary Nav START -->
            <div class="col s12">
                <nav class="secondary-nav">
                    <div class="nav-wrapper blue-grey darken-1">
                        <ul class="left">
                            <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit Data Surat Masuk</a></li>
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
            <form class="col s12" method="POST" action="?page=tsm&act=edit" enctype="multipart/form-data">

                <!-- Row in form START -->
                <div class="row">
                    <div class="input-field col s6">
                        <input type="hidden" name="id_surat" value="<?php echo $id_surat ;?>">
                        <i class="material-icons prefix md-prefix">looks_one</i>
                        <input id="no_agenda" type="number" class="validate" value="<?php echo $no_agenda ;?>" name="no_agenda" required>
                        <label for="no_agenda">Nomor Agenda</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">bookmark</i>
                        <input id="kode" type="text" class="validate" name="kode" value="<?php echo $kode ;?>" required>
                        <label for="kode">Kode Klasifikasi</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">place</i>
                        <input id="asal_surat" type="text" class="validate" name="asal_surat" value="<?php echo $asal_surat ;?>" required>
                        <label for="asal_surat">Asal Surat</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">storage</i>
                        <input id="indeks" type="text" class="validate" name="indeks" value="<?php echo $indeks ;?>" required>
                        <label for="indeks">Indeks Berkas</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">looks_two</i>
                        <input id="no_surat" type="text" class="validate" name="no_surat" value="<?php echo $no_surat ;?>" required>
                        <label for="no_surat">Nomor Surat</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">date_range</i>
                        <input id="tgl_surat" type="text" name="tgl_surat" class="datepicker" value="<?php echo $tgl_surat ;?>" required>
                        <label for="tgl_surat">Tanggal Surat</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">description</i>
                        <textarea id="isi" class="materialize-textarea validate" name="isi" required><?php echo $isi ;?></textarea>
                        <label for="isi">Isi Ringkas</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">featured_play_list</i>
                        <input id="keterangan" type="text" class="validate" name="keterangan" value="<?php echo $keterangan ;?>" required>
                        <label for="keterangan">Keterangan</label>
                    </div>
                    <div class="input-field col s6">
                        <div class="file-field input-field tooltipped" data-position="top" data-tooltip="Jika tidak ada file/scan gambar surat, biarkan kosong">
                          <div class="btn light-green darken-1">
                            <span>File</span>
                            <input type="file" id="file" name="file">
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" value="<?php echo $file ;?>" placeholder="Upload file/scan gambar surat masuk">
                            <small class="red-text">*Format yang diperbolehkan *.JPG, *.PNG, *.DOC, *.DOCX dan *.PDF</small>
                          </div>
                        </div>
                    </div>
                </div>
                <!-- Row in form END -->

                <div class="row">
                    <div class="col 6">
                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                    </div>
                    <div class="col 6">
                        <a href="?page=tsm" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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
?>
