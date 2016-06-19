 <!doctype html>
<html lang="en">

<!-- Include Head BEGIN -->
<?php include('include/head.php'); ?>
<!-- Include Head END -->

<!-- Body BEGIN -->
<body>

<!-- Header START -->
<header>

<!-- Include Navigation START -->
<?php include('include/menu.php'); ?>
<!-- Include Navigation END --> 

</header>
<!-- Header END --> 

<!-- Main START -->
<main>

    <!-- container START --> 
    <div class="container">

        <!-- Row Start -->
        <div class="row">
            <!-- Secondary Nav START -->
            <div class="col s12">
                <nav class="secondary-nav">
                    <div class="nav-wrapper blue-grey darken-1">
                        <ul class="left">
                            <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit User</a></li>
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
                    <medium>Setelah menekan tombol "Simpan", Anda akan diminta melakukan login ulang.</medium>
                </div>
                <div class="input-field col s6">
                    <input disable value="19951205 2016010 1 010" id="nip" type="text" class="validate" required>
                    <label for="nip">NIP</label>
                </div>
            </div>
            <!-- Row in form END -->
            <br/>

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

    </div>
    <!-- container END --> 

</main>
<!-- Main END --> 

<!-- Include Footer START -->
<?php include('include/footer.php'); ?>
<!-- Include Footer END -->

</body>
<!-- Body END -->

</html>