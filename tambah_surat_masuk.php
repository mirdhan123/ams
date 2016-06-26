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
                window.alert("ERROR! Form wajib diisi.");
                window.location.href="./admin.php?page=tsm&aksi=add";
                </script>';
            } else {

                $no_agenda = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['no_agenda'])));
                $no_surat = htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['no_surat']));
                $asal_surat = htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['asal_surat']));
                $isi = htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['isi']));
                $kode = htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['kode']));
                $indeks = htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['indeks']));
                $tgl_surat = date('Y-m-d', strtotime(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['tgl_surat']))));
                $keterangan = htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['keterangan']));

                //Jika nomor agenda tidak diisi angka maka akan menampilkan pesan error
                if(is_numeric($no_agenda) == false){
                    echo '<script language="javascript">
                    window.alert("ERROR! Form NOMOR AGENDA harus diisi angka.");
                    window.location.href="./admin.php?page=tsm&aksi=add";
                    </script>';
                } else {

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
    <form class="col s12" method="POST" action="?page=tsm&aksi=add">

        <!-- Row in form START -->
        <div class="row">
            <div class="input-field col s6">
                <input id="no_agenda" type="number" class="validate" name="no_agenda">
                <label for="no_agenda">Nomor Agenda</label>
            </div>
            <div class="input-field col s6">
                <input id="kode" type="text" class="validate" name="kode">
                <label for="kode">Kode Klasifikasi</label>
            </div>
            <div class="input-field col s6">
                <input id="asal_surat" type="text" class="validate" name="asal_surat">
                <label for="asal_surat">Asal Surat</label>
            </div>
            <div class="input-field col s6">
                <input id="indeks" type="text" class="validate" name="indeks">
                <label for="indeks">Indeks Berkas</label>
            </div>
            <div class="input-field col s6">
                <input id="no_surat" type="text" class="validate" name="no_surat">
                <label for="no_surat">Nomor Surat</label>
            </div>
            <div class="input-field col s6">
                <input id="tgl_surat" type="date" name="tgl_surat" class="datepicker">
                <label for="tgl_surat">Tanggal Surat</label>
            </div>
            <div class="input-field col s6">
                <textarea id="isi" class="materialize-textarea validate" name="isi"></textarea>
                <label for="isi">Isi Ringkas</label>
            </div><!--
            <div class="input-field col s6">
                <div class="file-field input-field">
                    <div class="btn waves-effect waves-light">
                        <span>File</span>
                        <input type="file" name="file" >
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload file scan surat keluar">
                    </div>
                </div>
            </div> -->
            <div class="input-field col s6">
                <input id="keterangan" type="text" class="validate" name="keterangan">
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
