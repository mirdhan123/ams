<?php
    //Cek session user yang login. Jika tidak ditemukan user yang login akan menampilkan pesan error
    if(empty($_SESSION['admin'])){

        //Menampilkan pesan error dan mengarahkan ke halaman login
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        //Request url aksi menggunakan fungsi switch case
        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_surat_masuk.php";
                    break;
                case 'edit':
                    include "edit_surat_masuk.php";
                    break;
                case 'disp':
                    include "disposisi.php";
                    break;
                case 'print':
                    include "cetak_disposisi.php";
                    break;
                case 'del':
                    include "hapus_surat_masuk.php";
                    break;
            }
        } else {

            $limit = 5;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }

                    //Melakukan query ke tabel surat masuk
                    $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk ORDER BY id_surat DESC LIMIT $curr, $limit");

echo '<!-- Row Start -->
<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <div class="z-depth-1">
            <nav class="secondary-nav">
                <div class="nav-wrapper blue-grey darken-1">
                    <div class="col m7">
                        <ul class="left">
                            <li class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">mail</i> Surat Masuk</a></li>
                            <li class="waves-effect waves-light tooltipped" data-position="bottom" data-tooltip="Klik untuk menambahkan data surat masuk">
                                <a href="?page=tsm&act=add"><i class="material-icons md-24">add_circle</i> Tambah Data</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col m5 hide-on-med-and-down">
                        <form>
                            <div class="input-field round-in-box tooltipped" data-position="bottom" data-tooltip="Ketik dan tekan enter mencari data surat masuk yang telah tersimpan">
                                <input id="search" type="search" placeholder="Ketik dan tekan enter mencari data..." required>
                                <label for="search"><i class="material-icons">search</i></label>
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
<div class="row jarak-form">

    <div class="col m12" id="colres">
        <table class="responsive bordered" id="tbl">
            <thead class="blue lighten-4" id="head">
                <tr>
                    <th width="10%">No. Agenda<br/>Kode</th>
                    <th width="36%">Isi Ringkas<br/> File</th>
                    <th width="24%">Asal Surat</th>
                    <th width="20%">No. Surat<br/>Tgl Surat</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr>';

        if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){
              echo '<td>'.$row['no_agenda'].'<br/>'.$row['kode'].'</td>
                    <td>'.$row['isi'].'<br/><br/><strong>File: <a href="upload/surat_masuk/'.$row['file'].'">'.$row['file'].'</a></strong></td>
                    <td>'.$row['asal_surat'].'</td>
                    <td>'.$row['no_surat'].'<br/>'.date('d M Y', strtotime($row['tgl_surat'])).'</td>
                    <td>

                        <a class="dropdown-button btn deep-orange" href="#" data-activates="dropdown1">Aksi</a>
                        <ul id="dropdown1" class="dropdown-content">
                            <li class="cyan"><a href="?page=tsm&act=edit&id_surat='.$row['id_surat'].'"><i class="material-icons">edit</i> EDIT</a></a></li>
                            <li class="lime darken-2 tooltipped" data-position="left" data-tooltip="Klik untuk menambahkan disposisi surat"><a href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'"><i class="material-icons">add_circle</i> DISPOSISI</a></a></li>
                            <li class="yellow darken-3 tooltipped" data-position="left" data-tooltip="Klik untuk mencetak discurr surat"><a href="?page=tsm&act=print"><i class="material-icons">print</i> CETAK</a></li>
                            <li class="divider"></li>
                            <li class="deep-orange"><a href="?page=tsm&act=del&id_surat='.$row['id_surat'].'" class="modal-trigger"><i class="material-icons">delete</i> HAPUS</a></li>
                        </ul>
                    </td>
                </tr>
            </tbody>';
            }
        } else {
    echo '<tr><td colspan="5"><center><h5>Tidak ada data untuk ditampilkan</h5></center></td></tr>';
        }
  echo '</table>
    </div>

</div>
<!-- Row form END -->';

        //Query database untuk pagging
        $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk");
        $cdata = mysqli_num_rows($query);
        $cpg = ceil($cdata/$limit);

        echo '<br/><!-- Pagination START -->
              <ul class="pagination">';

        if($cdata > 5 ){

        //First and previous pagging
        if($pg > 1){
            $prev = $pg - 1;
            echo '<li><a href="?page=tsm&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                  <li><a href="?page=tsm&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
        } else {
            echo '<li class="disabled"><a href=""><i class="material-icons md-48">first_page</i></a></li>
                  <li class="disabled"><a href=""><i class="material-icons md-48">chevron_left</i></a></li>';
        }

        //Perulangan pagging
        for($i=1; $i <= $cpg; $i++)
            if($i != $pg){
                echo '<li class="waves-effect waves-dark"><a href="?page=tsm&pg='.$i.'"> '.$i.' </a></li>';
            } else {
                echo '<li class="active waves-effect waves-dark"><a href="?page=tsm&pg='.$i.'"> '.$i.' </a></li>';
            }

        //Last and next pagging
        if($pg < $cpg){
            $next = $pg + 1;
            echo '<li><a href="?page=tsm&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                  <li><a href="?page=tsm&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
        } else {
            echo '<li class="disabled"><a href=""><i class="material-icons md-48">chevron_right</i></a></li>
                  <li class="disabled"><a href=""><i class="material-icons md-48">last_page</i></a></li>';
        }
        echo '
        </ul>
        <br/>
        <!-- Pagination END -->';
    } else {
        echo '';
    }
}
}
?>
