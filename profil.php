<!-- Row Start -->
<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <nav class="secondary-nav">
            <div class="nav-wrapper blue-grey darken-1">
                <ul class="left">
                    <li class="waves-effect waves-light  tooltipped" data-position="right" data-tooltip="Detail profil user"><a href="#" class="judul"><i class="material-icons">person</i> Profil User</a></li>
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
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">account_circle</i>
                <input id="username" type="text" class="validate" required>
                <label for="username">Username</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">text_fields</i>
                <input id="nama" type="text" class="validate" required>
                <label for="nama">Nama</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">lock</i>
                <input id="password" type="password" class="validate" required>
                <label for="password">Password</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">looks_one</i>
                <input id="nip" type="text" class="validate" required>
                <label for="nip">NIP</label>
            </div>
        </div>
        <!-- Row in form END -->
        <br/><br/>
        <div class="row">
            <div class="col m12">
                <a href="?page=epro" class="btn-large blue waves-effect waves-light">EDIT PROFIL<i class="material-icons">mode_edit</i></a>
            </div>
        </div>

    </form>
    <!-- Form END -->

</div>
<!-- Row form END -->
