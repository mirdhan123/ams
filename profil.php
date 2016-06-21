        <!-- Row Start -->
        <div class="row">
            <!-- Secondary Nav START -->
            <div class="col s12">
                <nav class="secondary-nav">
                    <div class="nav-wrapper blue-grey darken-1">
                        <ul class="left">
                            <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">account_circle</i> Profil User</a></li>
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
                        <input disable value="admin" id="username" type="text" class="validate">
                        <label for="username">Username</label>
                    </div>
                    <div class="input-field col s6">
                        <input disable value="M. Rudianto" id="nama" type="text" class="validate">
                        <label for="nama">Nama</label>
                    </div>
                    <div class="input-field col s6">
                        <input disable value="*****" id="password" type="password" class="validate" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="input-field col s6">
                        <input disable value="19951205 2016010 1 010" id="nip" type="text" class="validate" required>
                        <label for="nip">NIP</label>
                    </div>
                </div>
                <!-- Row in form END -->

                <div class="row">
                    <div class="col 6">
                        <a href="./edit_user.php" class="btn-large blue waves-effect waves-light">EDIT <i class="material-icons">edit</i></a>
                    </div>
                    <div class="col 6">
                        <button type="reset" onclick="window.history.back();" class="btn-large deep-orange waves-effect waves-light"><i class="material-icons">arrow_back</i> KEMBALI</button>
                    </div>
                </div>

            </form>
            <!-- Form END -->

        </div>
        <!-- Row form END -->

