<!-- Row Start -->
<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <nav class="secondary-nav">
            <div class="nav-wrapper blue-grey darken-1">
                <ul class="left">
                    <li class="waves-effect waves-light  tooltipped" data-position="right" data-tooltip="Ganti tipe user"><a href="#" class="judul"><i class="material-icons">mode_edit</i> Edit Tipe User</a></li>
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
                <input id="username" type="text" value="admin" readonly class="grey-text">
                <label  for="username">Username</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">text_fields</i>
                <input id="username" type="text" value="M. Rudianto" readonly class="grey-text">
                <label for="username">Username</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">supervisor_account</i><label>Pilih tipe user</label><br/>
                <div class="input-field col s11 right">
                    <select class="browser-default">
                        <option value="1">Admin</option>
                        <option value="2">User Biasa</option>
                    </select>
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
                <a href="?page=sett&sub=usr" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
            </div>
        </div>

    </form>
    <!-- Form END -->

</div>
<!-- Row form END -->
