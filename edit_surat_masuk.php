<?php
//Cek session user yang login. Jika tidak ditemukan id_user yang login akan menampilkan pesan error
if(empty($_SESSION['admin'])){

    //Menampilkan pesan error dan mengarahkan ke halaman login
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header("Location: ./");
    die();
} else {

    if(isset($_REQUEST['submit'])) {

        $no_agenda = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['no_agenda'])));
        $no_surat = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['no_surat'])));
        $asal_surat = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['asal_surat'])));
        $isi = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['isi'])));
        $kode = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['kode'])));
        $indeks = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['indeks'])));
        $tgl_surat = date('Y-m-d', strtotime(trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['tgl_surat'])))));
        $keterangan = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['keterangan'])));

        $query = mysqli_query($config, "UPDATE tbl_surat_masuk SET no_agenda='$no_agenda' WHERE id_surat='$id_surat'");

        if($query == true){
            header("Location: ./admin.php?page=tsm&message=2");
            die();
        } else {
            echo '<br/><div class="error red lighten-5"><i class="material-icons">error_outline</i> <strong>ERROR!</strong> Periksa penulisan querynya.</div>';
        }
      } else {
        $id_surat = $_REQUEST['id_surat'];
        $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
        $data = mysqli_fetch_array($query);
?>

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
    <form class="col s12" method="POST" action="?page=tsm&aksi=edit">

        <!-- Row in form START -->
        <div class="row">
             <div class="input-field col s6">
                <input type="hidden" name="id_surat" value="<?php echo $data['id_surat']; ?>">
                <input id="no_agenda" type="number" class="validate" name="no_agenda" value="<?php echo $data['no_agenda']; ?>">
                 <label for="no_agenda">Nomor Agenda</label>
            </div>
            <div class="input-field col s6">
                <input id="kode" type="text" class="validate" name="kode" value="<?php echo $data['kode']; ?>">
                <label for="kode">Kode Klasifikasi</label>
            </div>
            <div class="input-field col s6">
                <input id="asal_surat" type="text" class="validate" name="asal_surat" value="<?php echo $data['asal_surat']; ?>">
                <label for="asal_surat">Asal Surat</label>
            </div>
            <div class="input-field col s6">
                <input id="indeks" type="text" class="validate" name="indeks" value="<?php echo $data['indeks']; ?>">
                <label for="indeks">Indeks Berkas</label>
            </div>
            <div class="input-field col s6">
                <input id="no_surat" type="text" class="validate" name="no_surat" value="<?php echo $data['no_surat']; ?>">
                <label for="no_surat">Nomor Surat</label>
            </div>
            <div class="input-field col s6">
                    <input id="tanggal_surat" type="date" class="datepicker" name="tgl_surat" value="<?php echo $data['tgl_surat']; ?>">
                    <label for="tanggal_surat">Tanggal Surat</label>
            </div>
            <div class="input-field col s6">
                <textarea id="isi" class="materialize-textarea" name="isi"><?php echo $data['isi']; ?></textarea>
                <label for="isi">Isi Ringkas</label>
            </div>
            <div class="input-field col s6">
                <input id="keterangan" type="text" class="validate" name="keterangan" value="<?php echo $data['keterangan']; ?>">
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