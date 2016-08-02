<?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
?>

<!doctype html>
<html lang="en">

<?php include('include/_head.php'); ?>

<!-- Body START -->
<body class="bg">

    <?php

    if($_SESSION['admin'] ==2){
        echo '
            <audio id="audio">
                <source src="asset/sound/notify.mp3" type="audio/mp3" />
            </audio>';
        }
    ?>

<!-- Header START -->
<header>

<?php include('include/_menu.php'); ?>

</header>
<!-- Header END -->

<!-- Main START -->
<main>

    <!-- container START -->
    <div class="container">

    <?php
        if(isset($_REQUEST['page'])){
            $page = $_REQUEST['page'];
            switch ($page) {
                case 'tsm':
                    include "surat_masuk.php";
                    break;
                case 'asm':
                    include "surat_masuk_agenda.php";
                    break;
                case 'gsm':
                    include "surat_masuk_galeri.php";
                    break;
                case 'disp':
                    include "disposisi.php";
                    break;
                case 'ctk':
                    include "disposisi_print.php";
                    break;
                case 'tsk':
                    include "surat_keluar.php";
                    break;
                case 'ask':
                    include "surat_keluar_agenda.php";
                    break;
                case 'gsk':
                    include "surat_keluar_galeri.php";
                    break;
                case 'klas':
                    include "klasifikasi.php";
                    break;
                case 'sett':
                    include "pengaturan.php";
                    break;
                case 'pro':
                    include "user_profil.php";
                    break;
                default:
                    header("Location: ./admin.php");
                    die();
                    break;
            }
        } else {
    ?>
        <div class="row">

            <?php include('include/_header_instansi.php'); ?>

            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4>Selamat Datang <?php echo $_SESSION['nama']; ?></h4>
                        <p class="description">Anda login sebagai
                        <?php
                            if($_SESSION['admin'] == 1){
                                echo "<strong>Administrator</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                            } elseif($_SESSION['admin'] == 2){
                                echo "<strong>Pimpinan Instansi</strong>. Anda memiliki hak akses untuk memeriksa dan menyetujui surat masuk serta membuat disposisi surat.";
                            } else {
                                echo "<strong>Petugas Disposisi</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                            }?></p>
                    </div>
                </div>
            </div>

            <?php
                //menghitung jumlah surat masuk
                $count1 = mysqli_num_rows(mysqli_query($_config, "SELECT * FROM tbl_surat_masuk"));

                //menghitung jumlah surat masuk
                $count2 = mysqli_num_rows(mysqli_query($_config, "SELECT * FROM tbl_surat_keluar"));

                //menghitung jumlah klasifikasi
                $count3 = mysqli_num_rows(mysqli_query($_config, "SELECT * FROM tbl_klasifikasi"));

                //menghitung jumlah pengguna
                $count4 = mysqli_num_rows(mysqli_query($_config, "SELECT * FROM tbl_user"));

                //menghitung jumlah surat yang belum diperiksa
                $count5 = mysqli_num_rows(mysqli_query($_config, "SELECT * FROM tbl_surat_masuk WHERE status='0'"));
            ?>

        <?php
            if($_SESSION['admin'] == 1 || $_SESSION['admin']  == 3){
        ?>
        <a href="?page=tsm">
            <div class="col s12 l4">
                <div class="card cyan">
                    <div class="card-content">
                        <span class="card-title white-text"><i class="material-icons md-36">mail</i> Jumlah Surat Masuk</span>
                        <?php echo '<h5 class="link">'.$count1.' Surat Masuk</h5>'; ?>
                    </div>
                </div>
            </div>
        </a>
        <a href="?page=tsk">
            <div class="col s12 l4">
                <div class="card lime darken-1">
                    <div class="card-content">
                        <span class="card-title white-text"><i class="material-icons md-36">drafts</i> Jumlah Surat Keluar</span>
                        <?php echo '<h5 class="link">'.$count2.' Surat Keluar</h5>'; ?>
                    </div>
                </div>
            </div>
        </a>
        <a href="?page=klas">
            <div class="col s12 l4">
                <div class="card yellow darken-2">
                    <div class="card-content">
                        <span class="card-title white-text"><i class="material-icons md-36">class</i> Jumlah Klasifikasi Surat</span>
                        <?php echo '<h5 class="link">'.$count3.' Klasifikasi Surat</h5>'; ?>
                    </div>
                </div>
            </div>
        </a>
        <?php
            }
        ?>

        <?php
            if($_SESSION['id_user'] == 1){?>
        <a href="?page=sett&sub=usr">
            <div class="col s12 l4">
                <div class="card deep-orange">
                    <div class="card-content">
                        <span class="card-title white-text"><i class="material-icons md-36">people</i> Jumlah Pengguna</span>
                        <?php echo '<h5 class="link">'.$count4.' Pengguna</h5>'; ?>
                    </div>
                </div>
            </div>
        </a>
        <?php
            }
        ?>

        <?php
            if($_SESSION['admin'] == 2){
        ?>
        <a href="?page=tsm">
            <div class="col s12 l7">
                <div class="card deep-orange">
                    <div class="card-content">
                        <span class="card-title white-text"><i class="material-icons md-36">error_outline</i> Jumlah Surat Masuk yang Belum Diperiksa</span>
                        <?php echo '<h5 class="link">';
                            if($count5 == ""){
                                echo 'Semua surat sudah diperiksa';
                            } else {
                                echo $count5." Surat Masuk</h5>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </a>
        <a href="?page=tsm">
            <div class="col s12 l5">
                <div class="card cyan">
                    <div class="card-content">
                        <span class="card-title white-text"><i class="material-icons md-36">mail</i> Jumlah Surat Masuk</span>
                        <?php echo '<h5 class="link">'.$count1.' Surat Masuk</h5>'; ?>
                    </div>
                </div>
            </div>
        </a>
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

<?php include('include/_footer.php'); ?>

</body>
<!-- Body END -->

</html>

<?php
    }
?>
