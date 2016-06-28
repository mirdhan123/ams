<?php
    //Cek session user yang login. Jika tidak ditemukan user yang login akan menampilkan pesan error
    if(empty($_SESSION['admin'])){

        //Menampilkan pesan error dan mengarahkan ke halaman login
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){

            $id_surat = $_REQUEST['id_surat'];
            $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
            $no = 1;
            list($id_surat) = mysqli_fetch_array($query);

            /* Memeriksa apakah form diisi atau tidak, jika kosong maka akan menampilkan pesan untuk mengisinya dan jika
            ada isinya proses akan dilanjutkan */
            if ($_REQUEST['tujuan'] == "" || $_REQUEST['isi'] == "" || $_REQUEST['sifat'] == "" || $_REQUEST['batas_waktu'] == ""
                || $_REQUEST['catatan'] == ""){
                echo '<script language="javascript">
                window.alert("ERROR! Semua form wajib diisi.");
                window.location.href="./admin.php?page=tsm&act=add";
                </script>';
            } else {

                $tujuan = $_REQUEST['tujuan'];
                $isi = $_REQUEST['isi'];
                $sifat = $_REQUEST['sifat'];
                $batas_waktu = $_REQUEST['batas_waktu'];
                $catatan = $_REQUEST['catatan'];

                //Validasi input data
                if(!preg_match("/^[a-zA-Z0-9.,\/ ]*$/", $tujuan)){
                    echo '<script language="javascript">
                    window.alert("ERROR! Form TUJUAN DISPOSISI hanya boleh mengandung huruf, angka, spasi tanda titik(.), koma(,) dan garis miring(/).");
                    window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                    </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/ ]*$/", $isi)){
                        echo '<script language="javascript">
                        window.alert("ERROR! Form ISI DISPOSISI hanya boleh mengandung huruf, angka, spasi, tanda titik(.), koma(,), garis miring(/), kurung(), persen(%) dan at(@).");
                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                        </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/ ]*$/", $sifat)){
                        echo '<script language="javascript">
                        window.alert("ERROR! Form SIFAT hanya boleh mengandung huruf dan spasi.");
                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                        </script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/ ]*$/", $catatan)){
                        echo '<script language="javascript">
                        window.alert("ERROR! Form CATATAN hanya boleh mengandung huruf, angka, spasi, tanda titik(.), koma(,), garis miring(/), dan kurung().");
                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
                        </script>';
                }

                    //Query insert data
                    $query = mysqli_query($config, "INSERT INTO tbl_disposisi(tujuan,isi,sifat,batas_waktu,catatan)
                        VALUES('$tujuan','$isi','$sifat','$batas_waktu','$catatan')");

                    //Jika query berhasil user akan diarahkan kembali ke halaman transaksi surat masuk
                    if($query == true){
                        echo '<script language="javascript">
                        window.alert("SUKSES! Data berhasil ditambahkan.");
                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'";
                        </script>';
                    } else {
                        echo '<script language="javascript">
                        window.alert("ERROR! Periksa penulisan querynya.");
                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$id_surat.'&sub=add";
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
                <input id="tujuan" type="text" class="validate" name="tujuan">
                <label for="tujuan">Tujuan Disposisi</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">featured_play_list   </i>
                <input id="catatan" type="text" class="validate" name="catatan">
                <label for="catatan">Catatan</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">description</i>
                <textarea id="isi" class="materialize-textarea validate" name="isi"></textarea>
                <label for="isi">Isi Disposisi</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">date_range</i>
                <input id="batas_waktu" type="date" name="tgl_surat" class="datepicker" required>
                <label for="batas_waktu">Batas Waktu</label>
            </div>
            <div class="input-field col s6">
                <select class="browser-default validate" name="sifat">
                    <option value="" disabled selected>Pilih Sifat Disposisi</option>
                    <option value="1">Biasa</option>
                    <option value="2">Penting</option>
                    <option value="3">Segera</option>
                    <option value="4">Perlu Perhatian Khusus</option>
                    <option value="5">Perhatian Batas Waktu</option>
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
