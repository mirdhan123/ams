<?php
    //Cek session user yang login. Jika tidak ditemukan user yang login akan menampilkan pesan error
    if(empty($_SESSION['admin'])){

        //Menampilkan pesan error dan mengarahkan ke halaman login
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){

            /* Memeriksa apakah form diisi atau tidak, jika kosong maka akan menampilkan pesan untuk mengisinya dan jika
            ada isinya proses akan dilanjutkan */
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

                //Validasi input data
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

                        //Cek apakah nomor surat sudah ada di database
                        $cek = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE no_surat='$no_surat'");
                        $result = mysqli_num_rows($cek);

                        //Jika nomor surat sudah ada di database akan menampilkan pesan error
                        if($result > 0){
                            echo '<script language="javascript">
                            window.alert("ERROR! Terjadi duplikasi data NOMOR SURAT.");
                            window.location.href="./admin.php?page=tsk&act=add";
                            </script>';
                        } else {

                            //Query upload image
                            $file = $_FILES['file']['name'];
                            $target_dir = "upload/keluar/";
                            $imageFileType = pathinfo($file, PATHINFO_EXTENSION);

                            //Cek apakah file yang di upload adalah benar-benar file gambar
                            if (isset($_POST['submit'])){
                                /*
                                $check = getimagesize($_FILES['file']['tmp_name']);
                                if($check == false){
                                    echo '<script language="javascript">window.alert("ERROR! File yang diupload bukan gambar.");window.location.href="./admin.php?page=tsk&act=add";</script>';
                                } */

                            //Cek apakah file sudah ada
                            if(file_exists($file)){
                                echo '<script language="javascript">window.alert("ERROR! File yang diupload sudah ada dalam database.");window.location.href="./admin.php?page=tsk&act=add";</script>';
                            }

                            //Cek ukuran file
                            if($_FILES['file']['size'] > 2000000){
                                echo '<script language="javascript">window.alert("ERROR! Ukuran file yang diupload terlalu besar.");window.location.href="./admin.php?page=tsk&act=add";</script>';
                            }

                            //Cek format gambar
                            if($imageFileType != "" && $imageFileType != "JPG" && $imageFileType != "jpg" && $imageFileType != "JPEG" && $imageFileType != "jpeg" && $imageFileType != "PNG" && $imageFileType != "png"){
                                echo '<script language="javascript">window.alert("ERROR! Format file yang diperbolehkan hanya *.JPG, *.JPEG dan *.PNG.");window.location.href="./admin.php?page=tsk&act=add";</script>';
                            }

                            move_uploaded_file($_FILES['file']['tmp_name'], 'upload/surat_keluar/'.$file);

                            //Query insert data
                            $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,no_surat,tujuan,isi,kode,tgl_surat,
                                tgl_catat,file,keterangan)
                                VALUES('$no_agenda','$no_surat','$tujuan','$isi','$kode','$tgl_surat',NOW(),'$file','$keterangan')");

                            //Jika query berhasil user akan diarahkan kembali ke halaman transact surat masuk
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
                    <li class="waves-effect waves-light tooltipped" data-position="right" data-tooltip="Mohon isi semua form agar tidak terjadi error. Khusus form file gambar/scan surat boleh tidak diisi"><a href="#" class="judul"><i class="material-icons">drafts</i> Tambah Data Surat Keluar</a></li>
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
                <div class="file-field input-field">
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
