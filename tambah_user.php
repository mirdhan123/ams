<!-- Row Start -->
<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <nav class="secondary-nav">
            <div class="nav-wrapper blue-grey darken-1">
                <ul class="left">
                    <li class="waves-effect waves-light  tooltipped" data-position="right" data-tooltip="Mohon isi semua form agar tidak terjadi error. Jika belum memiliki NIP, isi dengan tanda minus (-)"><a href="#" class="judul"><i class="material-icons">person_add</i> Tambah User</a></li>
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
    <form class="col s12" method="post" action="save.php">

        <!-- Row in form START -->
        <div class="row">
            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Username hanya boleh mengandung karakter huruf, angka dan underscore (_)">
                <i class="material-icons prefix md-prefix">account_circle</i>
                <input id="username" type="text" class="validate" required>
                <label for="username">Username</label>
            </div>
            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Nama hanya boleh mengandung karakter huruf, spasi dan titik (.)">
                <i class="material-icons prefix md-prefix">text_fields</i>
                <input id="nama" type="text" class="validate" required>
                <label for="nama">Nama</label>
            </div>
            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Gunakan password yang kuat dan mudah diingat">
                <i class="material-icons prefix md-prefix">lock</i>
                <input id="password" type="password" class="validate" required>
                <label for="password">Password</label>
            </div>
            <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="NIP hanya boleh mengandung karakter angka, spasi, titik (.) dan minus (-)">
                <i class="material-icons prefix md-prefix">looks_one</i>
                <input id="nip" type="text" class="validate" required>
                <label for="nip">NIP</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">supervisor_account</i><label>Pilih tipe user</label><br/>
                <div class="input-field col s3 tooltipped" data-position="top" data-tooltip="Memiliki akses penuh pada aplikasi">
                    <input class="with-gap" name="admin" type="radio" id="admin"/>
                    <label for="admin">Admin</label>
                </div>
                <div class="input-field col s3  tooltipped" data-position="top" data-tooltip="Memiliki akses terbatas pada aplikasi">
                    <input class="with-gap" name="admin" type="radio" id="user"/>
                    <label for="user">user</label>
                </div>
            </div>
        </div>
        <!-- Row in form END -->
        <br/><br/>
        <div class="row">
            <div class="col 6">
                <button type="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
            </div>
            <div class="col 6">
                <button type="reset" onclick="window.history.back();" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></button>
            </div>
        </div>

    </form>
    <!-- Form END -->

</div>
<!-- Row form END -->
