<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'fsk':
                    include "file_sk.php";
                    break;
            }
        } else {

            //pagging
            $limit = 8;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }

                    echo '<!-- Row Start -->
                    <div class="row">
                        <!-- Secondary Nav START -->
                        <div class="col s12">
                            <div class="z-depth-1">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <div class="col m7">
                                            <ul class="left">
                                                <li class="waves-effect waves-light hide-on-small-only"><a href="?page=gsk" class="judul"><i class="material-icons">image</i> Galeri File Surat Keluar</a></li>
                                            </ul>
                                        </div>
                                        <div class="col m5 hide-on-med-and-down">
                                            <form method="post" action="?page=gsk">
                                                <div class="input-field round-in-box">
                                                    <input id="search" type="search" name="cari" placeholder="Ketik dan tekan enter mencari data..." required>
                                                    <label for="search"><i class="material-icons">search</i></label>
                                                    <input type="submit" name="submit" class="hidden">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <!-- Secondary Nav END -->
                    </div>
                    <!-- Row END -->

                    <!-- Row form Start -->
                    <div class="row jarak-form">';

                    if(isset($_REQUEST['submit'])){
                    $cari = mysqli_real_escape_string($config, $_REQUEST['cari']);
                        echo '
                        <div class="col s12" style="margin-top: -18px;">
                            <div class="card blue lighten-5">
                                <div class="card-content">
                                    <p class="description">Hasil pencarian untuk kata kunci <strong>"'.stripslashes($cari).'"</strong></p>
                                </div>
                            </div>
                        </div>';

                                //script mencari menampilkan data
                                $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE isi LIKE '%$cari%' ORDER BY id_surat DESC LIMIT $curr, $limit");
                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_array($query)){
                                        if(empty($row['file'])){
                                            echo '';
                                        } else {

                                            $ekstensi = array('jpg','png','jpeg');
                                            $ekstensi2 = array('doc','docx');
                                            $ekstensi3 = array('pdf');
                                            $file = $row['file'];
                                            $x = explode('.', $file);
                                            $eks = strtolower(end($x));

                                            if(in_array($eks, $ekstensi) == true){
                                            echo '
                                                <div class="col m3">
                                                    <img class="galeri materialboxed" data-caption="'.date('d M Y', strtotime($row['tgl_difsk'])).'" src="./upload/surat_keluar/'.$row['file'].'"/>
                                                    <a class="btn light-green darken-1" href="?page=gsk&act=fsk&id_surat='.$row['id_surat'].'">Tampilkan Ukuran Penuh</a>
                                                </div>';
                                            } else {
                                                if(in_array($eks, $ekstensi2) == true){
                                                echo '
                                                    <div class="col m3">
                                                        <img class="galeri materialboxed" data-caption="'.date('d M Y', strtotime($row['tgl_catat'])).'" src="./asset/img/word.png"/>
                                                        <a class="btn light-green darken-1" href="?page=gsk&act=fsk&id_surat='.$row['id_surat'].'">Lihat Detail File</a>
                                                    </div>';
                                                } else {
                                                    echo '
                                                        <div class="col m3">
                                                            <img class="galeri materialboxed" data-caption="'.date('d M Y', strtotime($row['tgl_catat'])).'" src="./asset/img/pdf.png"/>
                                                            <a class="btn light-green darken-1" href="?page=gsk&act=fsk&id_surat='.$row['id_surat'].'">Lihat Detail File</a>
                                                        </div>';
                                                }
                                        }
                                        }
                                    }
                                } else {
                                    echo '<p class="center tidak">Data tidak ditemukan</p>';
                                } echo '
                                </div>';
                    } else {

                        //script untuk menampilkan data
                        $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar ORDER BY id_surat DESC LIMIT $curr, $limit");
                        if(mysqli_num_rows($query) > 0){
                            while($row = mysqli_fetch_array($query)){
                                if(empty($row['file'])){
                                    echo '';
                                } else {

                                    $ekstensi = array('jpg','png','jpeg');
                                    $ekstensi2 = array('doc','docx');
                                    $file = $row['file'];
                                    $x = explode('.', $file);
                                    $eks = strtolower(end($x));

                                    if(in_array($eks, $ekstensi) == true){
                                    echo '
                                        <div class="col m3">
                                            <img class="galeri materialboxed" data-caption="'.date('d M Y', strtotime($row['tgl_catat'])).'" src="./upload/surat_keluar/'.$row['file'].'"/>
                                            <a class="btn light-green darken-1" href="?page=gsk&act=fsk&id_surat='.$row['id_surat'].'">Tampilkan Ukuran Penuh</a>
                                        </div>';
                                    } else {
                                        if(in_array($eks, $ekstensi2) == true){
                                        echo '
                                            <div class="col m3">
                                                <img class="galeri materialboxed" data-caption="'.date('d M Y', strtotime($row['tgl_catat'])).'" src="./asset/img/word.png"/>
                                                <a class="btn light-green darken-1" href="?page=gsk&act=fsk&id_surat='.$row['id_surat'].'">Lihat Detail File</a>
                                            </div>';
                                        } else {
                                            echo '
                                                <div class="col m3">
                                                    <img class="galeri materialboxed" data-caption="'.date('d M Y', strtotime($row['tgl_catat'])).'" src="./asset/img/pdf.png"/>
                                                    <a class="btn light-green darken-1" href="?page=gsk&act=fsk&id_surat='.$row['id_surat'].'">Lihat Detail File</a>
                                                </div>';
                                        }
                                }
                                }
                            }
                        } else {
                            echo '';
                        } echo '
                        </div>';

                    $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar");
                    $cdata = mysqli_num_rows($query);
                    $cpg = ceil($cdata/$limit);

                    echo '<br/><!-- Pagination START -->
                          <ul class="pagination">';

                    if($cdata > $limit ){

                    if($pg > 1){
                        $prev = $pg - 1;
                        echo '<li><a href="?page=gsk&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                              <li><a href="?page=gsk&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                    } else {
                        echo '<li class="disabled"><a href=""><i class="material-icons md-48">first_page</i></a></li>
                              <li class="disabled"><a href=""><i class="material-icons md-48">chevron_left</i></a></li>';
                    }

                    for($i=1; $i <= $cpg; $i++)
                        if($i != $pg){
                            echo '<li class="waves-effect waves-dark"><a href="?page=gsk&pg='.$i.'"> '.$i.' </a></li>';
                        } else {
                            echo '<li class="active waves-effect waves-dark"><a href="?page=gsk&pg='.$i.'"> '.$i.' </a></li>';
                        }

                    if($pg < $cpg){
                        $next = $pg + 1;
                        echo '<li><a href="?page=gsk&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                              <li><a href="?page=gsk&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
                    } else {
                        echo '<li class="disabled"><a href=""><i class="material-icons md-48">chevron_right</i></a></li>
                              <li class="disabled"><a href=""><i class="material-icons md-48">last_page</i></a></li>';
                    }
                    echo '
                    </ul>
                    <!-- Pagination END -->';
                } else {
                    echo '';
                }
            }
        }
    }
?>
