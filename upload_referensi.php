<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 2){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.location.href="./logout.php";
                  </script>';
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
                                            <li class="waves-effect waves-light"><a href="?page=ref&act=imp" class="judul"><i class="material-icons">bookmark</i> Import Referensi Surat</a></li>
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
                                <p class="kata">Silakan pilih file referensi kode klasifikasi berformat *.csv atau *.xls lalu klik tombol <strong>"import"</strong> untuk melakukan import file.</p><br/>

                                <p class="kata"><strong>CATATAN PENTING!</strong><br/> Data yang ada akan diganti dengan data yang baru.</p>
                            </div>
                            <div class="card-action">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="file-field input-field col m6 tooltipped" data-position="top" data-tooltip="Format file yang diperbolehkan hanya *.CSV dan *.XLS">
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

                //mengosongkan table klasifikasi
                mysqli_query($config, "TRUNCATE TABLE tbl_klasifikasi");

                //proses upload file
                if(isset($_POST['submit'])){
                    if (is_uploaded_file($_FILES['file']['tmp_name'])){
                        echo '<script language="javascript">
                                window.alert("SUKSES! Data berhasil diimport");
                                window.location.href="./admin.php?page=ref";
                              </script>';
                    } else {
                        echo '<script language="javascript">
                                window.alert("ERROR! Proses upload data gagal");
                                window.location.href="./admin.php?page=ref";
                              </script>';
                    }

                    //import file yang telah diupload ke dalam database 
                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while(($data = fgetcsv($handle, 2000000, ",")) !== FALSE){

                        $query = mysqli_query($config, "INSERT into tbl_klasifikasi(id_klasifikasi,kode,nama,uraian,id_user) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]')");
                    }
                    fclose($handle);
                }
            }
        }
?>
