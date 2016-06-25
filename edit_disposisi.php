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
                            <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit Disposisi Surat</a></li>
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
                        <input id="tujuan_disposisi" type="text" class="validate" required>
                        <label for="tujuan_disposisi">Tujuan Disposisi</label>
                    </div>
                    <div class="input-field col s6">
                        <select required>
                            <option value="" disabled selected>Pilih Sifat Disposisi</option>
                            <option value="1">Biasa</option>
                            <option value="2">Penting</option>
                            <option value="3">Segera</option>
                            <option value="4">Perlu Perhatian Khusus</option>
                            <option value="5">Perhatian Batas Waktu</option>
                        </select>
                    </div>
                    <div class="input-field col s6">
                        <textarea id="isi_disposisi" class="materialize-textarea" required></textarea>
                        <label for="isi_disposisi">Isi Disposisi</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="batas_waktu" type="date" class="datepicker" required>
                        <label for="batas_waktu">Batas Waktu</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="catatan" type="text" class="validate" required>
                        <label for="catatan">Catatan</label>
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