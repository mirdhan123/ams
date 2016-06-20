<?php
//memulai session
session_start();

//Cek session user yang login. Jika tidak ditemukan id_user yang login akan menampilkan pesan error
if(empty($_SESSION['admin'])){

    //Menampilkan pesan error dan mengarahkan ke halaman login
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header("Location: ./");
    die();
}
?>
<!doctype html>
<html lang="en">

<!-- Include Head START -->
<?php include('include/head.php'); ?>
<!-- Include Head END -->

<!-- Body START -->
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
                        <h4>Selamat Datang <?php echo $_SESSION['nama']; ?></h4>
                        <p class="description">Anda login sebagai 
                        <?php 
                            if($_SESSION['admin'] == 1 ) {
                                echo "<strong>Administrator</strong>";
                            } else {
                                echo "<strong>Petugas Disposisi</strong>";
                            }
                        ?>
                            . Berikut adalah statistik data yang tersimpan dalam sistem.</p>
                    </div>
                </div>
            </div>
            <!-- Welcome Message END -->
         
        <?php 
            //Menghitung jumlah surat masuk
            $query1 = mysqli_query($config, "SELECT * FROM tbl_surat_masuk");
            $count1 = mysqli_num_rows($query1);

            //Menghitung jumlah pengguna
            $query4 = mysqli_query($config, "SELECT * FROM tbl_user");
            $count4 = mysqli_num_rows($query4);

        ?>
            <!-- Info Statistic START -->
            <div class="col s12 m4">
                <div class="card cyan">
                    <div class="card-content"> 
                        <span class="card-title white-text"><i class="material-icons md-36">mail</i> Jumlah Surat Masuk</span>
                        <?php echo '<h5 class="white-text">'.$count1.' Surat Masuk</h5>'; ?>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card lime darken-1">
                    <div class="card-content"> 
                        <span class="card-title white-text"><i class="material-icons md-36">drafts</i> Jumlah Surat Keluar</span>
                        <h5 class="white-text">1 Surat Keluar</h5>
                    </div>
                </div>
            </div>
         
            <div class="col s12 m4">
                <div class="card yellow darken-3">
                    <div class="card-content"> 
                        <span class="card-title white-text"><i class="material-icons md-36">description</i> Jumlah Disposisi</span>
                        <h5 class="white-text">1 Disposisi</h5>
                    </div>
                </div>
            </div>

        <?php
            //Menampilkan informasi jumlah pengguna (Hanya admin)
            if($_SESSION['admin'] == 1){?>
            <div class="col s12 m4">
                <div class="card deep-orange">
                    <div class="card-content"> 
                        <span class="card-title white-text"><i class="material-icons md-36">people</i> Jumlah Pengguna</span>
                        <?php echo '<h5 class="white-text">'.$count4.' Pengguna</h5>'; ?>
                    </div>
                </div>
            </div>
            <!-- Info Statistic START -->
        <?php 
            }
        ?>

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