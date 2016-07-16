<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

          echo '<!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col m12">
                                        <ul class="left">
                                            <li class="waves-effect waves-light"><a href="?page=ref&act=imp" class="judul"><i class="material-icons">file_upload</i> Import Referensi Surat</a></li>
                                            <li class="waves-effect waves-light"><a href="?page=ref"><i class="material-icons">arrow_back</i> Kembali</a></li>
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
                <div class="row">
                    <div class="col m12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title black-text">Import Referensi Kode Klasifikasi Surat</span>
                                <p class="kata">Silakan pilih file referensi kode klasifikasi berformat *.csv, *.xls atau *.xlsx lalu klik tombol <strong>"import"</strong> untuk melakukan import file.</p>
                            </div>
                            <div class="card-action">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="file-field input-field col m6 tooltipped" data-position="top" data-tooltip="Format file yang diperbolehkan hanya *.CSV, *.XLS dan *.XLSX">
                                        <div class="btn light-green darken-1">
                                            <span>File</span>
                                            <input type="file" name="file">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                         </div>
                                    </div>&nbsp;&nbsp;
                                    <button type="submit" class="btn-large blue waves-effect waves-light" name="submit">IMPORT <i class="material-icons">file_upload</i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';

                mysqli_query($config, "TRUNCATE TABLE tbl_klasifikasi");

                if (isset($_POST['submit'])) {
                    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                        echo "<h1>" . "File ". $_FILES['file']['name'] ." uploaded successfully." . "</h1>";
                        echo "<h2>Displaying contents:</h2>";
                        readfile($_FILES['file']['tmp_name']);
                    }
                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                        $query = mysqli_query($config, "INSERT into tbl_klasifikasi(id_klasifikasi,kode,nama,uraian,id_user) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]')");
                    }
                    fclose($handle);
                    print "Import done";
                }
            }

            ?>
