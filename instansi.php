<?php
    //Cek session user yang login. Jika tidak ditemukan user yang login akan menampilkan pesan error
    if (empty($_SESSION['admin'])) {

        //Menampilkan pesan error dan mengarahkan ke halaman login
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if (isset($_REQUEST['submit'])) {

            $id_instansi = "1";
            $nama = $_REQUEST['nama'];
            $alamat = $_REQUEST['alamat'];
            $kepsek = $_REQUEST['kepsek'];
            $nip = $_REQUEST['nip'];
            $website = $_REQUEST['website'];
            $email = $_REQUEST['email'];

            $logo = $_FILES['logo']['name'];
            $target_dir = "upload/";
            $imageFileType = pathinfo($logo, PATHINFO_EXTENSION);

            //Cek apakah file yang di upload adalah benar-benar file gambar

            move_uploaded_file($_FILES['logo']['tmp_name'], 'upload/'.$logo);

            $query = mysqli_query($config, "UPDATE tbl_instansi SET nama='$nama',alamat='$alamat',kepsek='$kepsek',nip='$nip',website='$website',email='$email',logo='$logo' WHERE id_instansi='$id_instansi'");

            if ($query == true) {
                echo '<script language="javascript">
                window.alert("SUKSES! Data berhasil diupdate.");
                window.location.href="./admin.php?page=sett&sub=ins";
                </script>';
            } else {
                echo '<script language="javascript">
                window.alert("ERROR! Periksa penulisan querynya.");
                window.location.href="./admin.php?page=sett&sub=ins";
                </script>';
                }
            } else {

                $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
                if (mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_array($query)) {?>

<!-- Row Start -->
<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <nav class="secondary-nav">
            <div class="nav-wrapper blue-grey darken-1">
                <ul class="left">
                    <li class="waves-effect waves-light tooltipped" data-position="right" data-tooltip="Kelola nama instansi, alamat dan logo instansi pada aplikasi. Mohon isi semua form agar tidak terjadi error"><a href="#" class="judul"><i class="material-icons">work</i> Manajemen Instansi</a></li>
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
    <form class="col s12" method="POST" action="?page=sett&sub=ins">

        <!-- Row in form START -->
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">school</i>
                <input id="nama" type="text" class="validate" name="nama" value="<?php echo $row['nama']; ?>">
                <label for="nama">Nama Instansi</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">account_box</i>
                <input id="kepsek" type="text" class="validate" name="kepsek" value="<?php echo $row['kepsek']; ?>">
                <label for="kepsek">Nama Kepala Sekolah</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">place</i>
                <input id="alamat" type="text" class="validate" name="alamat" value="<?php echo $row['alamat']; ?>">
                <label for="alamat">Alamat</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">looks_one</i>
                <input id="nip" type="text" class="validate" name="nip" value="<?php echo $row['nip']; ?>">
                <label for="nip">NIP Kepala Sekolah</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">language</i>
                <input id="website" type="url" class="validate" name="website" value="<?php echo $row['website']; ?>">
                <label for="website">Website</label>
            </div>
            <div class="input-field col s6">
                <div class="file-field input-field">
                  <div class="btn light-green darken-1">
                    <span>File</span>
                    <input type="file" id="logo" name="logo">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload Logo instansi">
                  </div>
                </div>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">mail</i>
                <input id="email" type="email" class="validate" name="email" value="<?php echo $row['email']; ?>">
                <label for="email">Email Instansi</label>
            </div>
        </div>
        <!-- Row in form END -->

        <div class="row">
            <div class="col 6">
                <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
            </div>
            <div class="col 6">
                <a href="./admin.php" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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
