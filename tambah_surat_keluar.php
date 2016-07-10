<?php
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){

            if ($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['tujuan'] == "" || $_REQUEST['isi'] == ""
                || $_REQUEST['kode'] == "" || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['keterangan'] == ""){
                echo '<script language="javascript">
                        window.alert("ERROR! Semua form wajib diisi.");
                        window.location.href="./admin.php?page=tsk&act=add";
                      </script>';
            } else {

                $no_agenda = $_REQUEST['no_agenda'];
                $no_surat = $_REQUEST['no_surat'];
                $tujuan = $_REQUEST['tujuan'];
                $isi = $_REQUEST['isi'];
                $kode = $_REQUEST['kode'];
                $tgl_surat = $_REQUEST['tgl_surat'];
                $keterangan = $_REQUEST['keterangan'];
                $id_user = $_SESSION['id_user'];

                if(!preg_match("/^[0-9]*$/", $no_agenda)){
                    echo '<script language="javascript">
                            window.alert("ERROR! Form NOMOR AGENDA harus diisi angka.");
                            window.location.href="./admin.php?page=tsk&act=add";
                          </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.\/ ]*$/", $no_surat)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form NOMOR SURAT hanya boleh mengandung huruf, angka, spasi, tanda titik(.) dan garis miring(/).");
                                window.location.href="./admin.php?page=tsk&act=add";
                              </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9. ]*$/", $tujuan)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form TUJUAN SURAT hanya boleh mengandung huruf, angka, spasi dan tanda titik(.).");
                                window.location.href="./admin.php?page=tsk&act=add";
                              </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/\r\n ]*$/", $isi)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form ISI RINGKAS hanya boleh mengandung huruf, angka, spasi, tanda titik(.), koma(,), garis miring(/), kurung(), persen(%) dan at(@).");
                                window.location.href="./admin.php?page=tsk&act=add";
                              </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9., ]*$/", $kode)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form KODE KLASIFIKASI hanya boleh mengandung huruf, angka, spasi, tanda titik(.) dan koma(,).");
                                window.location.href="./admin.php?page=tsk&act=add";
                              </script>';
                } else {

                    if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form TANGGAL SURAT hanya boleh mengandung angka dan tanda minus(-).");
                                window.location.href="./admin.php?page=tsk&act=add";
                              </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/ ]*$/", $keterangan)){
                        echo '<script language="javascript">
                                window.alert("ERROR! Form KETERANGAN hanya boleh mengandung huruf, angka, spasi, tanda titik(.), koma(,), garis miring(/), dan kurung().");
                                window.location.href="./admin.php?page=tsk&act=add";
                              </script>';
                }

                    $cek = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE no_surat='$no_surat'");
                    $result = mysqli_num_rows($cek);

                    if($result > 0){
                        echo '<script language="javascript">
                                window.alert("ERROR! Terjadi duplikasi data NOMOR SURAT.");
                                window.location.href="./admin.php?page=tsk&act=add";
                              </script>';
                        } else {

                            $ekstensi = array('jpg','png','jpeg');
                            $file = $_FILES['file']['name'];
                            $x = explode('.', $file);
                            $eks = strtolower(end($x));
                            $ukuran = $_FILES['file']['size'];
                            $target_dir = "upload/surat_keluar/";

                            if($file != ""){

                                $rand = rand(1,10000);
                                $nfile = $rand."-".$file;
                                if(in_array($eks, $ekstensi) == true){
                                    if($ukuran < 2000000){

                                        move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                        $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,kode,tgl_surat,
                                            tgl_catat,file,keterangan,id_user)
                                            VALUES('$no_agenda','$tujuan','$no_surat','$isi','$kode','$tgl_surat',NOW(),'$nfile','$keterangan','$id_user')");

                                        if($query == true){
                                            echo '<script language="javascript">
                                            window.location.href="./admin.php?page=tsk";
                                                    window.alert("SUKSES! Data berhasil ditambahkan.");
                                                  </script>';
                                        } else {
                                            echo '<script language="javascript">
                                                    window.alert("ERROR! Periksa penulisan querynya.");
                                                    window.location.href="./admin.php?page=tsk&act=add";
                                                  </script>';
                                        }
                                    } else {
                                        echo '<script language="javascript">
                                                window.alert("ERROR! Ukuran file yang diupload maksimal 2 MB.");
                                                window.location.href="./admin.php?page=tsk&act=add";
                                              </script>';
                                }
                            } else {
                                    echo '<script language="javascript">
                                            window.alert("ERROR! File yang diupload bukan gambar. Format file gambar yang diperbolehkan hanya *.JPG dan *.PNG.");
                                            window.location.href="./admin.php?page=tsk&act=add";
                                          </script>';
                            }
                        } else {
                            $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,kode,tgl_surat,
                                tgl_catat,keterangan,id_user)
                                VALUES('$no_agenda','$tujuan','$no_surat','$isi','$kode','$tgl_surat',NOW(),'$keterangan','$id_user')");

                            if($query == true){
                                echo '<script language="javascript">
                                        window.alert("SUKSES! Data berhasil ditambahkan.");
                                        window.location.href="./admin.php?page=tsk";
                                      </script>';
                            } else {
                                echo '<script language="javascript">
                                        window.alert("ERROR! Periksa penulisan querynya.");
                                        window.location.href="./admin.php?page=tsk&act=add";
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
?>
<!-- Row Start -->
<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <nav class="secondary-nav">
            <div class="nav-wrapper blue-grey darken-1">
                <ul class="left">
                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">drafts</i> Tambah Data Surat Keluar</a></li>
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
    <form class="col s12" method="POST" action="?page=tsk&act=add" enctype="multipart/form-data">

        <!-- Row in form START -->
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">looks_one</i>
                <input id="no_agenda" type="number" class="validate" name="no_agenda" required>
                <label for="no_agenda">Nomor Agenda</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">bookmark</i>
                <input id="kode" type="text" class="validate" name="kode" required>
                <label for="kode">Kode Klasifikasi</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">place</i>
                <input id="tujuan" type="text" class="validate" name="tujuan" required>
                <label for="tujuan">Tujuan Surat</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">looks_two</i>
                <input id="no_surat" type="text" class="validate" name="no_surat" required>
                <label for="no_surat">Nomor Surat</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">date_range</i>
                <input id="tgl_surat" type="date" name="tgl_surat" class="datepicker" required>
                <label for="tgl_surat">Tanggal Surat</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">featured_play_list</i>
                <input id="keterangan" type="text" class="validate" name="keterangan" required>
                <label for="keterangan">Keterangan</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">description</i>
                <textarea id="isi" class="materialize-textarea validate" name="isi" required></textarea>
                <label for="isi">Isi Ringkas</label>
            </div>
            <div class="input-field col s6">
                <div class="file-field input-field tooltipped" data-position="top" data-tooltip="Jika tidak ada file scan/gambar surat, biarkan kosong">
                  <div class="btn light-green darken-1">
                    <span>File</span>
                    <input type="file" id="file" name="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload file scan Surat Keluar">
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
                <a href="?page=tsk" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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
