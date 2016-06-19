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
                            <div class="col m7">
                                <ul class="left">
                                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">description</i> Disposisi Surat</a></li>
                                    <li class="waves-effect waves-light">
                                        <a href="tambah_disposisi.php"><i class="material-icons md-24">add_circle</i> Tambah Disposisi</a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <a href="transaksi_surat_masuk.php">Kembali <i class="material-icons md-24">redo</i> </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col m5">
                                <form>
                                    <div class="input-field round-in-box">
                                        <input id="search" type="search" placeholder="Ketik dan tekan enter..." required>
                                        <label for="search"><i class="material-icons">search</i></label>
                                        <i class="material-icons">close</i>
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
                    <p><p class="description">Perihal Surat:</p>Segera kirimkan siswanya untuk mengikuti senam skj</p>
                </div>
            </div>
        </div>
        <!-- Perihal END -->

        <!-- Row form Start -->
        <div class="row jarak-form">

            <div class="col m12">
                <!-- Table START -->
                <table class="responsive bordered">
                    <thead>
                        <tr>
                            <th width="80">No</th>
                            <th width="230">Tujuan Disposisi</th>
                            <th width="390">Isi Disposisi</th>
                            <th width="150">Sifat, Batas Waktu</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1/F</td>
                            <td>Mohon mengirimkan 10 siswanya untuk mengikuti senam skj</td>
                            <td>Dinas Dikpora Kabupaten Nganjuk</td>
                            <td><p>Penting<p><p>agustus 2016</p></td>
                            <td>
                                <!-- Dropdown Trigger -->
                                <a class='dropdown-button btn deep-orange' href='#' data-activates='dropdown1'>Aksi</a>

                                <!-- Dropdown Structure -->
                                <ul id='dropdown1' class='dropdown-content'>
                                    <li class="cyan"><a href="edit_disposisi.php"><i class="material-icons">edit</i> EDIT</a></a></li>
                                    <li class="divider"></li>
                                    <li class="deep-orange"><a href="#hapus" class=" modal-trigger"><i class="material-icons">delete</i> HAPUS</a></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Table END -->
            </div>

            <!-- Delete modal trigger START -->
            <div id="hapus" class="modal">
                <div class="modal-content">
                    <h5 class="redtext"><i class="material-icons md-36">error_outline</i> Konfirmasi</h5>
                    <p>Apakah Anda yakin akan menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">BATAL</a>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">HAPUS</a>
                </div>
            </div>
            <!-- Delete modal trigger END -->

        </div>
        <!-- Row form END -->

        <!-- Pagination START -->
        <ul class="pagination">
            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
            <li class="active"><a href="#!">1</a></li>
            <li class="waves-effect"><a href="#!">2</a></li>
            <li class="waves-effect"><a href="#!">3</a></li>
            <li class="waves-effect"><a href="#!">4</a></li>
            <li class="waves-effect"><a href="#!">5</a></li>
            <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
        </ul>
        <!-- Pagination END -->
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