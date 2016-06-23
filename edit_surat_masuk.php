<?php
//Cek session user yang login. Jika tidak ditemukan id_user yang login akan menampilkan pesan error
if(empty($_SESSION['admin'])){

    //Menampilkan pesan error dan mengarahkan ke halaman login
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header("Location: ./");
    die();
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
    <form class="col s12" method="POST" action="ceklogin.php">

        <!-- Row in form START -->
        <div class="row">
             <div class="input-field col s6">
            <input type="hidden" name="id" value="<?php echo $id_surat; ?>">
                <input id="no_agenda" type="number" class="validate" value="<?php echo $data['no_agenda']; ?>">
                 <label for="no_agenda">Nomor Agenda</label>
            </div>
            <div class="input-field col s6">
                <input id="kode" type="text" class="validate" value="<?php echo $data['kode']; ?>">
                <label for="kode">Kode Klasifikasi</label>
            </div>
            <div class="input-field col s6">
                <input id="asal_surat" type="text" class="validate" value="<?php echo $data['asal_surat']; ?>">
                <label for="asal_surat">Asal Surat</label>
            </div>
            <div class="input-field col s6">
                <input id="indeks" type="text" class="validate" value="<?php echo $data['indeks']; ?>">
                <label for="indeks">Indeks Berkas</label>
            </div>
            <div class="input-field col s6">
                <input id="no_surat" type="text" class="validate" value="<?php echo $data['no_surat']; ?>">
                <label for="no_surat">Nomor Surat</label>
            </div>
            <div class="input-field col s6">
                    <input id="tanggal_surat" type="date" class="datepicker" value="<?php echo $data['tgl_surat']; ?>">
                    <label for="tanggal_surat">Tanggal Surat</label>
            </div>
            <div class="input-field col s6">
                <textarea id="isi" class="materialize-textarea"><?php echo $data['isi']; ?></textarea>
                <label for="isi">Isi Ringkas</label>
            </div>
            <div class="input-field col s6">
                <input id="keterangan" type="text" class="validate" value="<?php echo $data['keterangan']; ?>">
                <label for="keterangan">Keterangan</label>
            </div>
                  
        </div>
        <!-- Row in form END -->

        <div class="row">
            <div class="col 6">
                <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
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
?>