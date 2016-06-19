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
                <div class="z-depth-1">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <div class="col 12">
                                <ul class="left">
                                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">print</i> Cetak Agenda Surat Masuk<a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Secondary Nav END -->
        </div>
        <!-- Row END -->

        <!-- Row form Start -->
        <div class="row jarak-form">
            <div class="input-field col s3">
                <input id="dari_tanggal" type="date" class="datepicker">
                <label for="dari_tanggal">Dari Tanggal</label>
            </div>
            <div class="input-field col s3">
                <input id="sampai_tanggal" type="date" class="datepicker">
                <label for="sampai_tanggal">Sampai Tanggal</label>
            </div>
            <div class="col s6">
                <a href="#" class="btn-large blue waves-effect waves-light"> <i class="material-icons">print</i> CETAK</a>&nbsp;&nbsp;
                <a href="admin.php" class="btn-large deep-orange waves-effect waves-light"> <i class="material-icons">arrow_back</i> KEMBALI</a>
            </div>
        </div>
        <!-- Row form END -->
    <br/>
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