<?php
    //Cek session user yang login. Jika tidak ditemukan user yang login akan menampilkan pesan error
    if(empty($_SESSION['admin'])){

        //Menampilkan pesan error dan mengarahkan ke halaman login
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        //Request url aksi menggunakan fungsi switch case
        if(isset($_REQUEST['sub'])){
            $sub = $_REQUEST['sub'];
            switch ($sub) {
                case 'add':
                    include "tambah_disposisi.php";
                    break;
                case 'edit':
                    include "edit_disposisi.php";
                    break;
                case 'del':
                    include "hapus_disposisi.php";
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

            //Menampilkan data sesuai id_surat
            $id_surat = $_REQUEST['id_surat'];

            $query = "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'";
            $result = mysqli_query($config, $query);

            if(mysqli_num_rows($result) > 0){
                $no = 1;
                while($row = mysqli_fetch_array($result)){
                    echo '

<!-- Row Start -->
<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <div class="z-depth-1">
            <nav class="secondary-nav">
                <div class="nav-wrapper blue-grey darken-1">
                    <div class="col m12">
                        <ul class="left">
                            <li class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">description</i> Disposisi  Surat</a></li>
                            <li class="waves-effect waves-light tooltipped" data-position="bottom" data-tooltip="Klik untuk menambahkan data disposisi surat">
                                <a href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'&sub=add"><i class="material-icons md-24">add_circle</i> Tambah Disposisi</a>
                            </li>
                            <li class="waves-effect waves-light hide-on-small-only tooltipped" data-position="bottom" data-tooltip="Klik untuk kembali ke halaman transaksi surat masuk"><a href="?page=tsm"><i class="material-icons">arrow_back</i> Kembali</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Secondary Nav END -->
</div>
<!-- Row END -->

<!-- Perihal START -->
<div class="col s12">
    <div class="card blue lighten-5">
        <div class="card-content">
            <p><p class="description">Perihal Surat:</p>'.$row['isi'].'</p>
        </div>
    </div>
</div>
<!-- Perihal END -->

<!-- Row form Start -->
<div class="row jarak-form">

    <div class="col m12" id="colres">
        <table class="responsive bordered" id="tbl">
            <thead class="blue lighten-4" id="head">
                <tr>
                    <th width="6%">No</th>
                    <th width="24%">Tujuan Disposisi</th>
                    <th width="36%">Isi Disposisi</th>
                    <th width="24%">Sifat<br/>Batas Waktu</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr>';

                //Melakukan query ke tabel surat masuk
                $query2 = "SELECT * FROM tbl_disposisi WHERE id_surat IN(SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat')";

                $result2 = mysqli_query($config, $query2);

                if($result2 != false){
                    $no = 1;
                    while($row = mysqli_fetch_array($result2)){
                echo '
                    <td>'.$row['id_disposisi'].'</td>
                    <td>'.$row['tujuan'].'</td>
                    <td>'.$row['isi'].'</td>
                    <td>'.$row['sifat'].'<br/>'.date('d M Y', strtotime($row['batas_waktu'])).'</td>
                    <td>
                        <a class="dropdown-button btn deep-orange" href="#" data-activates="dropdown1">Aksi</a>
                        <ul id="dropdown1" class="dropdown-content">
                            <li class="cyan "><a href="?page=tsm&act=edit&id_disposisi='.$row['id_disposisi'].'"><i class="material-icons">edit</i> EDIT</a></a></li>
                            <li class="divider"></li>
                            <li class="deep-orange"><a href="?page=tsm&act=edit&id_disposisi='.$row['id_disposisi'].'" class="modal-trigger"><i class="material-icons">delete</i> HAPUS</a></li>
                        </ul>
                    </td>
                </tr>
            </tbody>';
            }
        } else {
    echo '<tr><td colspan="5"><center><h5>Tidak ada data untuk ditampilkan.</h5></center></td></tr>';
        }
    echo '</table>
    </div>

</div>
<!-- Row form END -->';

            //Query database untuk pagging
            $query = mysqli_query($config, "SELECT * FROM tbl_disposisi");
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
}
}
?>
