<?php
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['submit'])){

            $dari_tanggal = $_REQUEST['dari_tanggal'];
            $sampai_tanggal = $_REQUEST['sampai_tanggal'];

            $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE tgl_terima BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
              echo '
                    <!-- SHOW DAFTAR AGENDA -->
                    <!-- Row Start -->
                    <div class="row">
                        <!-- Secondary Nav START -->
                        <div class="col s12">
                            <div class="z-depth-1">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <div class="col 12">
                                            <ul class="left">
                                                <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">print</i> Cetak Agenda Surat Masuk<a></li>
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
                    <div class="row jarak-form black-text">
                        <form class="col s12" method="post" action="">
                            <div class="input-field col s3">
                                <i class="material-icons prefix md-prefix">date_range</i>
                                <input id="dari_tanggal" type="date" name="dari_tanggal" id="dari_tanggal" required>
                                <label for="dari_tanggal">Dari Tanggal</label>
                            </div>
                            <div class="input-field col s3">
                                <i class="material-icons prefix md-prefix">date_range</i>
                                <input id="sampai_tanggal" type="date" name="sampai_tanggal" id="sampai_tanggal" required>
                                <label for="sampai_tanggal">Sampai Tanggal</label>
                            </div>
                            <div class="col s6">
                                <button type="submit" name="submit" class="btn-large blue waves-effect waves-light"> <i class="material-icons">visibility</i> TAMPILKAN</button>
                            </div>
                        </form>
                    </div>
                    <!-- Row form END -->

                    <div class="row agenda">
                        <div class="col s10">
                            <p class="warna agenda">Agenda Surat Masuk dari tanggal <strong>1 Juli 2015</strong> sampai tanggal <strong>1 Juli 2016</strong></p>
                        </div>
                        <div class="col s2">
                            <button type="submit" onClick="window.print()" class="btn-large deep-orange waves-effect waves-light right"> <i class="material-icons">print</i> CETAK</button>
                        </div>
                    </div>
                    <div id="colres" class="warna">
                        <table class="bordered" id="tbl">
                            <thead>
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="5%">Kode</th>
                                    <th width="21%">Isi<br/>Ringkas</th>
                                    <th width="18%">Asal Surat</th>
                                    <th width="15%">Nomor Surat</th>
                                    <th width="8%">Tanggal<br/> Surat</th>
                                    <th width="10%">Pengelola</th>
                                    <th width="8%">Tanggal <br/>Paraf</th>
                                    <th width="10%">Keterangan</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>';
                                if(mysqli_num_rows($query) > 0){
                                    $no = 1;
                                    while($row = mysqli_fetch_array($query)){
                                        echo '
                                <td>1</td>
                                <td>Column</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>';
                                    }
                                }
        } else {
            echo '<!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col 12">
                                        <ul class="left">
                                            <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">print</i> Cetak Agenda Surat Masuk<a></li>
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
                <div class="row jarak-form black-text">
                    <form class="col s12" method="post" action="">
                        <div class="input-field col s3">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="dari_tanggal" type="date" name="dari_tanggal" id="dari_tanggal" required>
                            <label for="dari_tanggal">Dari Tanggal</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="sampai_tanggal" type="date" name="sampai_tanggal" id="sampai_tanggal" required>
                            <label for="sampai_tanggal">Sampai Tanggal</label>
                        </div>
                        <div class="col s6">
                            <button type="submit" name="submit" class="btn-large blue waves-effect waves-light"> <i class="material-icons">visibility</i> TAMPILKAN</button>
                        </div>
                    </form>
                </div>
                <!-- Row form END -->';
        }
    }
?>
