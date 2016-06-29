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
    <form class="col s12" method="POST" action="">

        <!-- Row in form START -->
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">school</i>
                <input id="nama" type="text" class="validate" name="nama">
                <label for="nama">Nama Instansi</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">account_box</i>
                <input id="kepsek" type="text" class="validate" name="kepsek">
                <label for="kepsek">Nama Kepala Sekolah</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">place</i>
                <input id="alamat" type="text" class="validate" name="alamat">
                <label for="alamat">Alamat</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">looks_one</i>
                <input id="nip" type="text" class="validate" name="nip">
                <label for="nip">NIP Kepala Sekolah</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">language</i>
                <input id="website" type="url" class="validate" name="website">
                <label for="website">Website</label>
            </div>
            <div class="input-field col s6">
                <div class="file-field input-field">
                  <div class="btn light-green darken-1">
                    <span>File</span>
                    <input type="file" id="file" name="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload Logo instansi">
                  </div>
                </div>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">mail</i>
                <input id="email" type="email" class="validate" name="email">
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
