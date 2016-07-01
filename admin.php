<?php
    //Memulai session
    session_start();

    //Cek session user yang login. Jika tidak ditemukan id_user yang login akan menampilkan pesan error
    if(empty($_SESSION['admin'])){

        //Menampilkan pesan error dan mengarahkan ke halaman login
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
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

    <?php

        //Request url page menggunakan fungsi switch case
        if(isset($_REQUEST['page'])){
            $page = $_REQUEST['page'];
            switch ($page) {
                case 'tsm':
                    include "transaksi_surat_masuk.php";
                    break;
                case 'tsk':
                    include "transaksi_surat_keluar.php";
                    break;
                case 'asm':
                    include "agenda_surat_masuk.php";
                    break;
                case 'ask':
                    include "agenda_surat_keluar.php";
                    break;
                case 'bse':
                    include "buat_surat_edaran.php";
                    break;
                case 'bst':
                    include "buat_surat_tugas.php";
                    break;
                case 'bskt':
                    include "buat_surat_keterangan.php";
                    break;
                case 'bskp':
                    include "buat_surat_keputusan.php";
                    break;
                case 'ref':
                    include "referensi.php";
                    break;
                case 'dg':
                    include "data_guru.php";
                    break;
                case 'sett':
                    include "pengaturan.php";
                    break;
                case 'pro':
                    include "profil.php";
                    break;
                case 'epro':
                    include "edit_profil.php";
                    break;
                    case 'prnt':
                        include "cetak_agenda_surat_masuk.php";
                        break;
            }
        } else {
    ?>
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
                            if($_SESSION['admin'] == 1 ){
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
                $count1 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_masuk"));

                //Menghitung jumlah surat masuk
                $count2 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_keluar"));

                //Menghitung jumlah surat masuk
                $count3 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_disposisi"));

                //Menghitung jumlah pengguna
                $count4 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_user"));
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
                        <?php echo '<h5 class="white-text">'.$count2.' Surat Keluar</h5>'; ?>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card yellow darken-3">
                    <div class="card-content">
                        <span class="card-title white-text"><i class="material-icons md-36">description</i> Jumlah Disposisi</span>
                        <?php echo '<h5 class="white-text">'.$count3.' Disposisi</h5>'; ?>
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
    <?php
        }
    ?>
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
<?php
    }
?>
