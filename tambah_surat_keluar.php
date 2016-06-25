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
                            <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">drafts</i> Tambah Data Surat Keluar</a></li>
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
            <form class="col s12">

                <!-- Row in form START -->
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nomor_agenda" type="number" class="validate" required>
                        <label for="nomor_agenda">Nomor Agenda</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="kode_klasifikasi" type="text" class="validate" required>
                        <label for="kode_klasifikasi">Kode Klasifikasi</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="asal_surat" type="text" class="validate" required>
                        <label for="asal_surat">Asal Surat</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="tanggal_surat" type="date" class="datepicker" required>
                        <label for="tanggal_surat">Tanggal Surat</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="nomor_surat" type="text" class="validate" required>
                        <label for="nomor_surat">Nomor Surat</label>
                    </div>
                    <div class="input-field col s6">
                        <form action="#">
                            <div class="file-field input-field">
                                <div class="btn waves-effect waves-light">
                                    <span>File</span>
                                    <input type="file" required>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Upload file scan surat keluar">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="input-field col s6">
                        <textarea id="isi_ringkas" class="materialize-textarea" required></textarea>
                        <label for="isi_ringkas">Isi Ringkas</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="keterangan" type="text" class="validate" required>
                        <label for="keterangan">Keterangan</label>
                    </div>                     
                </div>
                <!-- Row in form END -->

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