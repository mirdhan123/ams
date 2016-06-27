<?php
    //Cek session user yang login. Jika tidak ditemukan user yang login akan menampilkan pesan error
    if(empty($_SESSION['admin'])){

        //Menampilkan pesan error dan mengarahkan ke halaman login
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        //Request url aksi menggunakan fungsi switch case
        if(isset($_REQUEST['dsm'])){
            $dsm = $_REQUEST['dsm'];
            switch ($dsm) {
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

            //Menampilkan data sesuai id_surat
            $id_surat = $_REQUEST['id_surat'];

            $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

            if(mysqli_num_rows($query) > 0){
                $no = 1;
                while($row = mysqli_fetch_array($query)){
                    echo '

<!-- Row Start -->
<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <div class="z-depth-1">
            <nav class="secondary-nav">
                <div class="nav-wrapper blue-grey darken-1">
                    <div class="col m7">
                        <ul class="left">
                            <li class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">description</i> Disposisi  Surat</a></li>
                            <li class="waves-effect waves-light tooltipped" data-position="bottom" data-tooltip="Klik untuk menambahkan data disposisi surat">
                                <a href="?page=tsm&aksi=disp&id_surat='.$row['id_surat'].'&dsm=add"><i class="material-icons md-24">add_circle</i> Tambah Disposisi</a>
                            </li>
                            <li class="waves-effect waves-light hide-on-small-only tooltipped" data-position="bottom" data-tooltip="Klik untuk kembali ke halaman transaksi surat masuk"><a href="?page=tsm"><i class="material-icons">arrow_back</i> Kembali</a></li>
                        </ul>
                    </div>
                    <div class="col m5 hide-on-med-and-down">
                        <form>
                            <div class="input-field round-in-box tooltipped" data-position="bottom" data-tooltip="Ketik dan tekan enter mencari data disposisi surat yang telah tersimpan">
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
                $query = mysqli_query($config, "SELECT * FROM tbl_disposisi");

                if(mysqli_num_rows($query) > 0){
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){
                echo '
                    <td>'.$row['id_disposisi'].'</td>
                    <td>'.$row['tujuan'].'</td>
                    <td>'.$row['isi'].'</td>
                    <td>'.$row['sifat'].'<br/>'.date('d M Y', strtotime($row['batas_waktu'])).'</td>
                    <td>
                        <a class="dropdown-button btn deep-orange" href="#" data-activates="dropdown1">Aksi</a>
                        <ul id="dropdown1" class="dropdown-content">
                            <li class="cyan "><a href="?page=tsm&aksi=edit&id_disposisi='.$row['id_disposisi'].'"><i class="material-icons">edit</i> EDIT</a></a></li>
                            <li class="divider"></li>
                            <li class="deep-orange"><a href="?page=tsm&aksi=edit&id_disposisi='.$row['id_disposisi'].'" class="modal-trigger"><i class="material-icons">delete</i> HAPUS</a></li>
                        </ul>
                    </td>
                </tr>
            </tbody>';
            }
        } else {
    echo '<tr><td colspan="5"><center><h5>Tida ada data untuk ditampilkan.</h5></center></td></tr>';
        }
    echo '</table>
    </div>

</div>
<!-- Row form END -->';
}
}
}
}
?>
