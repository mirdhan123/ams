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
                            <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">work</i> Manajemen Instansi</a></li>
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
                        <input id="nama_ins" type="text" class="validate" name="nama_ins">
                        <label for="nama_ins">Nama Instansi</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="nama_kepsek" type="text" class="validate" name="nama_kepsek">
                        <label for="nama_kesek">Nama Kepala Sekolah</label>
                    </div>
                    <div class="input-field col s6">
                        <textarea id="alamat_ins" class="materialize-textarea" name="alamat_ins"></textarea>
                        <label for="alamat_ins">Alamat</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="nip_kepsek" type="text" class="validate" name="nip_kepsek">
                        <label for="nip_kepsek">NIP Kepala Sekolah</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="website_ins" type="url" class="validate" name="website_ins">
                        <label for="website_ins">Website</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="email_ins" type="email" class="validate" name="email_ins">
                        <label for="email_ins">Email Instansi</label>
                    </div>
                </div>
                <!-- Row in form END -->

                <div class="row">
                    <div class="col 6">
                        <input type="submit" class="btn-large blue" name="simpan" value="simpan"/>
                    </div>
                    <div class="col 6">
                        <button type="reset" onclick="window.history.back();" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></button>
                    </div>
                </div>

          </form>
          <!-- Form END -->

          <?php
            if($_POST['simpan']){
              $nama_ins = @$_POST['nama_ins'];
              $alamat_ins = @$_POST['alamat_ins'];
              $nama_kepsek = @$_POST['nama_kepsek'];
              $nip_kepsek = @$_POST['nip_kepsek'];
              $website_ins = @$_POST['website_ins'];
              $email_ins = @$_POST['email_ins'];
              mysqli_query($db_con, "insert into tbl_instansi(nama_ins, alamat_ins, nama_kepsek, nip_kepsek, website_ins,
              email_ins) values('$nama_ins', '$alamat_ins', '$nama_kepsek', '$nip_kepsek', '$website_ins', '$email_ins')"  ) or die ($db_con->error);
            }

          ?>
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