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
                            <div class="col m12">
                                <ul class="left">
                                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">people</i> Manajemen User</a></li>
                                    <li class="waves-effect waves-light">
                                        <a href="tambah_user.php"><i class="material-icons md-24">add_circle</i> Tambah User</a>
                                    </li>
                                </ul>
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

            <div class="col m12">
                <!-- Table START -->
                <table class="responsive bordered">
                    <thead>
                        <tr>
                            <th width="80">ID</th>
                            <th width="200">Username</th>
                            <th width="250">Nama, NIP</th>
                            <th width="150">Level</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>admin</td>
                            <td>M. Rudianto<br/>19951205 2001601 01</td>
                            <td>administrator</td>
                            <td>
                                <!-- Dropdown Trigger -->
                                <a class='dropdown-button btn deep-orange' href='#' data-activates='dropdown1'>Aksi</a>

                                <!-- Dropdown Structure -->
                                <ul id='dropdown1' class='dropdown-content'>
                                    <li class="cyan"><a href="edit_user_admin.php"><i class="material-icons">edit</i> EDIT</a></a></li>
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
                    <p>Apakah Anda yakin akan menghapus user ini?</p>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">BATAL</a>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">HAPUS</a>
                </div>
            </div>
            <!-- Delete modal trigger END -->

        </div>
        <!-- Row form END -->

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