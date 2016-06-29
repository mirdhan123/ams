<?php
    //Cek session login
    if(!empty($_SESSION['admin'])){
?>
<nav class="blue-grey darken-1">

    <!-- Menu on medium and small screen START -->
    <ul id="slide-out" class="side-nav" data-simplebar-direction="vertical">
        <li class="no-padding">
            <div class="logo-side center blue-grey darken-3">
                <img src="./asset/img/logo.png"/>
                <h5 class="smk-side">SMK  Al - Husna Loceret Nganjuk</h5>
                <p class="description-side">Jalan Raya Kediri Gg. Kwagean No. 04 Loceret Telp/Fax. (0358) 329806 Nganjuk 64471</p>
            </div>
        </li>
        <li class="no-padding blue-grey darken-4">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">account_circle</i>
                    <?php
                        if($_SESSION['admin'] == 1 ){
                            echo "Administrator";
                        } else {
                            echo "Petugas Disposisi";
                        }
                    ?>
                        </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="?page=pro">Profil</a></li>
                            <li><a href="?page=epro">Ubah Password</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li><a href="admin.php"><i class="material-icons middle">dashboard</i> Beranda</a></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">repeat</i> Transaksi Surat</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="?page=tsm">Surat Masuk</a></li>
                            <li><a href="?page=tsk">Surat Keluar</a></li>
                        </ul>
                    </div>
               </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">book</i> Buku Agenda</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="?page=asm">Surat Masuk</a></li>
                            <li><a href="?page=ask">Surat Keluar</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">description</i> Buat Surat Baru</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="?page=bse">Surat Edaran</a></li>
                            <li><a href="?page=bst">Surat Tugas</a></li>
                            <li><a href="?page=bskt">Surat Keterangan</a></li>
                            <li><a href="?page=bskp">Surat Keputusan</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li><a href="?page=ref"><i class="material-icons middle">bookmark</i> Referensi</a></li>
        <li><a href="?page=dg.php"><i class="material-icons middle">people</i> Data Guru</a></li>
        <li class="no-padding">
        <?php
            if($_SESSION['admin'] == 1 ){?>
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">settings</i> Pengaturan</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="?page=sett&sub=ins">Instansi</a></li>
                            <li><a href="?page=sett&sub=usr">User</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        <?php
            }
        ?>
        </li>
    </ul>
    <!-- Menu on medium and small screen END -->

    <!-- Menu on large screen START -->
    <ul class="center hide-on-med-and-down">
        <li><a href="./admin.php"><i class="material-icons">dashboard</i>&nbsp; Beranda</a></li>
        <li><a class="dropdown-button" href="#!" data-activates="transaksi">Transaksi Surat <i class="material-icons md-18">arrow_drop_down</i></a></li>
            <ul id='transaksi' class='dropdown-content'>
                <li><a href="?page=tsm">Surat Masuk</a></li>
                <li><a href="?page=tsk">Surat Keluar</a></li>
            </ul>
        <li><a class="dropdown-button" href="#!" data-activates="agenda">Buku Agenda <i class="material-icons md-18">arrow_drop_down</i></a></li>
            <ul id='agenda' class='dropdown-content'>
                <li><a href="?page=asm">Surat Masuk</a></li>
                <li><a href="?page=ask">Surat Keluar</a></li>
            </ul>
        <li><a class="dropdown-button" href="#!" data-activates="buat_surat">Buat Surat Baru<i class="material-icons md-18">arrow_drop_down</i></a></li>
            <ul id='buat_surat' class='dropdown-content'>
                <li><a href="?page=bse">Surat Edaran</a></li>
                <li><a href="?page=bst">Surat Tugas</a></li>
                <li><a href="?page=bskt">Surat Keterangan</a></li>
                <li><a href="?page=bskp">Surat Keputusan</a></li>
            </ul>
        <li><a href="?page=ref">Referensi</a></li>
        <li><a href="?page=dg">Data Guru</a></li>
        <?php
            if($_SESSION['admin'] == 1){ ?>
        <li><a class="dropdown-button" href="#!" data-activates="pengaturan">Pengaturan <i class="material-icons md-18">arrow_drop_down</i></a></li>
            <ul id='pengaturan' class='dropdown-content'>
                <li><a href="?page=sett&sub=ins">Instansi</a></li>
                <li><a href="?page=sett&sub=usr">User</a></li>
            </ul>
        <?php
            }
        ?>
        <li class="right"><a class="dropdown-button" href="#!" data-activates="logout"><i class="material-icons">account_circle</i>
        <?php
            if($_SESSION['admin'] == 1) {
                echo "Administrator";
            } else {
                echo "Petugas Disposisi";
            }
        ?>
                <i class="material-icons md-18">arrow_drop_down</i></a></li>
            <ul id='logout' class='dropdown-content'>
                <li><a href="?page=pro">Profil</a></li>
                <li><a href="?page=epro">Ubah Password</a></li>
                <li class="divider"></li>
                <li><a href="logout.php"><i class="material-icons">settings_power</i> Logout</a></li>
            </ul>
    </ul>
    <!-- Menu on large screen END -->

    <a href="#" data-activates="slide-out" class="button-collapse" id="menu"><i class="material-icons">menu</i></a>
</nav>
<?php
    } else {
        header("Location:../");
        die();
    }
?>
