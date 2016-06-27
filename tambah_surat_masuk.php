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
            if ($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['asal_surat'] == "" || $_REQUEST['isi'] == ""
                || $_REQUEST['kode'] == "" || $_REQUEST['indeks'] == "" || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['keterangan'] == ""){
                echo '<script language="javascript">
                window.alert("ERROR! Semua form wajib diisi.");
                window.location.href="./admin.php?page=tsm&aksi=add";
                </script>';
            } else {

                $no_agenda = $_REQUEST['no_agenda'];
                $no_surat = $_REQUEST['no_surat'];
                $asal_surat = $_REQUEST['asal_surat'];
                $isi = $_REQUEST['isi'];
                $kode = $_REQUEST['kode'];
                $indeks = $_REQUEST['indeks'];
                $tgl_surat = date('Y-m-d', strtotime($_REQUEST['tgl_surat']));
                $keterangan = $_REQUEST['keterangan'];

                //Validasi input data
                if(!preg_match("/^[0-9]*$/", $no_agenda)){
                    echo '<script language="javascript">
                    window.alert("ERROR! Form NOMOR AGENDA harus diisi angka.");
                    window.location.href="./admin.php?page=tsm&aksi=add";
                    </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.\/ ]*$/", $no_surat)){
                    echo '<script language="javascript">
                    window.alert("ERROR! Form NOMOR SURAT hanya boleh mengandung huruf, angka, spasi, tanda titik(.) dan garis miring(/).");
                    window.location.href="./admin.php?page=tsm&aksi=add";
                    </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9. ]*$/", $asal_surat)){
                    echo '<script language="javascript">
                    window.alert("ERROR! Form ASAL SURAT hanya boleh mengandung huruf, angka, spasi dan tanda titik(.).");
                    window.location.href="./admin.php?page=tsm&aksi=add";
                    </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/\r\n ]*$/", $isi)){
                    echo '<script language="javascript">
                    window.alert("ERROR! Form ISI RINGKAS hanya boleh mengandung huruf, angka, spasi, tanda titik(.), koma(,), garis miring(/), kurung(), persen(%) dan at(@).");
                    window.location.href="./admin.php?page=tsm&aksi=add";
                    </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9., ]*$/", $kode)){
                    echo '<script language="javascript">
                    window.alert("ERROR! Form KODE KLASIFIKASI hanya boleh mengandung huruf, angka, spasi, tanda titik(.) dan koma(,).");
                    window.location.href="./admin.php?page=tsm&aksi=add";
                    </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9., ]*$/", $indeks)){
                    echo '<script language="javascript">
                    window.alert("ERROR! Form INDEKS hanya boleh mengandung huruf, angka, spasi, tanda titik(.) dan koma(,).");
                    window.location.href="./admin.php?page=tsm&aksi=add";
                    </script>';
                } else {

                    if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                    echo '<script language="javascript">
                    window.alert("ERROR! Form TANGGAL SURAT hanya boleh mengandung angka dan tanda minus(-).");
                    window.location.href="./admin.php?page=tsm&aksi=add";
                    </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/ ]*$/", $keterangan)){
                    echo '<script language="javascript">
                    window.alert("ERROR! Form KETERANGAN hanya boleh mengandung huruf, angka, spasi, tanda titik(.), koma(,), garis miring(/), dan kurung().");
                    window.location.href="./admin.php?page=tsm&aksi=add";
                    </script>';
                }

                    //Cek apakah nomor agenda sudah ada di database
                    $cek1 = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE no_agenda='$no_agenda'");
                    $result1 = mysqli_num_rows($cek1);

                    //Jika nomor agenda sudah ada di database akan menampilkan pesan error
                    if($result1 > 0){
                        echo '<script language="javascript">
                        window.alert("ERROR! Terjadi duplikasi data NOMOR AGENDA.");
                        window.location.href="./admin.php?page=tsm&aksi=add";
                        </script>';
                    } else {

                        //Cek apakah nomor surat sudah ada di database
                        $cek2 = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE no_surat='$no_surat'");
                        $result2 = mysqli_num_rows($cek2);

                        //Jika nomor surat sudah ada di database akan menampilkan pesan error
                        if($result2 > 0){
                            echo '<script language="javascript">
                            window.alert("ERROR! Terjadi duplikasi data NOMOR SURAT.");
                            window.location.href="./admin.php?page=tsm&aksi=add";
                            </script>';
                        } else {

                            $query = mysqli_query($config, "INSERT INTO tbl_surat_masuk(no_agenda,no_surat,asal_surat,isi,kode,indeks,tgl_surat,
                                tgl_diterima,keterangan)
                                VALUES('$no_agenda','$no_surat','$asal_surat','$isi','$kode','$indeks','$tgl_surat',NOW(),'$keterangan')");

                            //Jika query berhasil user akan diarahkan kembali ke halaman transaksi surat masuk
                            if($query == true){
                                echo '<script language="javascript">
                                window.alert("SUKSES! Data berhasil ditambahkan.");
                                window.location.href="./admin.php?page=tsm";
                                </script>';
                            } else {
                                echo '<script language="javascript">
                                window.alert("ERROR! Periksa penulisan querynya.");
                                window.location.href="./admin.php?page=tsm&aksi=add";
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
                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">mail</i> Tambah Data Surat Masuk</a></li>
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
    <form class="col s12" method="POST" action="?page=tsm&aksi=add" enctype="multipart/form-data">

        <!-- Row in form START -->
        <div class="row">
            <div class="input-field col s6">
                <input id="no_agenda" type="number" class="validate tooltipped" name="no_agenda" data-position="top" data-tooltip="Nomor agenda surat. Isi dengan angka">
                <label for="no_agenda">Nomor Agenda</label>
            </div>
            <div class="input-field col s6">
                <input id="kode" type="text" class="validate tooltipped" name="kode" data-position="top" data-tooltip="Kode pengelompokan surat. Isi dengan huruf dan angka">
                <label for="kode">Kode Klasifikasi</label>
            </div>
            <div class="input-field col s6">
                <input id="asal_surat" type="text" class="validate tooltipped" name="asal_surat" data-position="top" data-tooltip="Instansi pengirim surat. Isi dengan huruf dan angka">
                <label for="asal_surat">Asal Surat</label>
            </div>
            <div class="input-field col s6">
                <input id="indeks" type="text" class="validate tooltipped" name="indeks" data-position="top" data-tooltip="Indeks berkas arsip surat. Isi dengan huruf dan angka">
                <label for="indeks">Indeks Berkas</label>
            </div>
            <div class="input-field col s6">
                <input id="no_surat" type="text" class="validate tooltipped" name="no_surat" data-position="top" data-tooltip="Nomor surat. Isi dengan huruf, angka tanda titik(.) dan garis miring(/)">
                <label for="no_surat">Nomor Surat</label>
            </div>
            <div class="input-field col s6">
                <input id="tgl_surat" type="date" name="tgl_surat" class="datepicker tooltipped" data-position="top" data-tooltip="Tanggal surat. Isi dengan tanggal">
                <label for="tgl_surat">Tanggal Surat</label>
            </div>
            <div class="input-field col s6">
                <textarea id="isi" class="materialize-textarea validate tooltipped" name="isi" data-position="top" data-tooltip="Isi ringkas surat. Isi dengan huruf dan angka"></textarea>
                <label for="isi">Isi Ringkas</label>
            </div> <!--
            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Gambar/file scan dari surat masuk. Ukuran maksimal 2MB berformat *.JPG, *.JPEG atau *.PNG">
                <div class="file-field input-field">
                    <div class="btn orange lighten-1 waves-effect waves-light">
                        <span>File</span>
                        <input type="file" name="file" >
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload file scan Surat Masuk">
                    </div>
                </div>
            </div> -->
            <div class="input-field col s6">
                <input id="keterangan" type="text" class="validate tooltipped" name="keterangan" data-position="top" data-tooltip="Keterangan tambahan surat. Isi dengan huruf dan angka">
                <label for="keterangan">Keterangan</label>
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
?>
