 <!doctype html>
<html lang="en">

<!-- Include Head START -->
<?php include('include/head.php'); ?>
<!-- Include Head END -->

<!-- Body STARt -->
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

        <!-- Row START --> 
        <div class="row">

            <!-- Include Header Instansi START -->
            <?php include('include/header_instansi.php'); ?>
            <!-- Include Header Instansi END -->

            <!-- Welcome Message START -->
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4>Selamat Datang Rudi</h4>
                        <p class="description">Anda login sebagai <b>Administrator</b>. Berikut adalah statistik data yang tersimpan dalam sistem.</p>
                    </div>
                </div>
            </div>
            <!-- Welcome Message END -->
         
            <!-- Info Statistic START -->
            <div class="col s12 m6 l3">
                <div class="card cyan">
                    <div class="card-content"> 
                        <span class="card-title white-text">Jumlah Surat Masuk</span>
                        <h5 class="white-text">1 Surat Masuk</h5>
                    </div>
                </div>
            </div>

            <div class="col s12 m6 l3">
                <div class="card lime darken-1">
                    <div class="card-content"> 
                        <span class="card-title white-text">Jumlah Surat Keluar</span>
                        <h5 class="white-text">1 Surat Keluar</h5>
                    </div>
                </div>
            </div>
         
            <div class="col s12 m6 l3">
                <div class="card yellow darken-3">
                    <div class="card-content"> 
                        <span class="card-title white-text">Jumlah Disposisi</span>
                        <h5 class="white-text">1 Disposisi</h5>
                    </div>
                </div>
            </div>

            <div class="col s12 m6 l3">
                <div class="card deep-orange">
                    <div class="card-content"> 
                        <span class="card-title white-text">Jumlah Pengguna</span>
                        <h5 class="white-text">2 Pengguna</h5>
                    </div>
                </div>
            </div>
            <!-- Info Statistic START -->

        </div>
        <!-- Row END --> 

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