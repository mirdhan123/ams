<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 3){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.history.back();
                  </script>';
        } else {

        if(isset($_REQUEST['submit'])){

            //validasi form kosong
            if($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['tujuan'] == "" || $_REQUEST['isi'] == ""
                || $_REQUEST['kode'] == "" || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['keterangan'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $no_agenda = $_REQUEST['no_agenda'];
                $no_surat = $_REQUEST['no_surat'];
                $tujuan = $_REQUEST['tujuan'];
                $isi = $_REQUEST['isi'];
                $kode = substr($_REQUEST['kode'],0,30);
                $nkode = trim($kode);
                $tgl_surat = $_REQUEST['tgl_surat'];
                $keterangan = $_REQUEST['keterangan'];
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[0-9]*$/", $no_agenda)){
                    $_SESSION['no_agendak'] = 'Form Nomor Agenda harus diisi angka!';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)){
                        $_SESSION['no_suratk'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $tujuan)){
                            $_SESSION['tujuan_surat'] = 'Form Tujuan Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi)){
                                $_SESSION['isik'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0-9. ]*$/", $nkode)){
                                    $_SESSION['kodek'] = 'Form Kode Klasifikasi hanya boleh mengandung karakter huruf, angka, spasi dan titik(.)';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                                        $_SESSION['tgl_suratk'] = 'Form Tanggal Surat hanya boleh mengandung angka dan minus(-)';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                        if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $keterangan)){
                                            $_SESSION['keterangank'] = 'Form Keterangan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        } else {

                                            $cek = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE no_surat='$no_surat'");
                                            $result = mysqli_num_rows($cek);

                                            if($result > 0){
                                                $_SESSION['errDup'] = 'Nomor Surat sudah terpakai, gunakan yang lain!';
                                                echo '<script language="javascript">window.history.back();</script>';
                                            } else {

                                                $ekstensi = array('jpg','png','jpeg','doc','docx','pdf');
                                                $file = $_FILES['file']['name'];
                                                $x = explode('.', $file);
                                                $eks = strtolower(end($x));
                                                $ukuran = $_FILES['file']['size'];
                                                $target_dir = "upload/surat_keluar/";

                                                //jika form file tidak kosong akan mengekse
                                                if($file != ""){

                                                    $rand = rand(1,10000);
                                                    $nfile = $rand."-".$file;
                                                    if(in_array($eks, $ekstensi) == true){
                                                        if($ukuran < 2500000){

                                                            move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                            $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,kode,tgl_surat,
                                                                tgl_catat,file,keterangan,id_user)
                                                                VALUES('$no_agenda','$tujuan','$no_surat','$isi','$nkode','$tgl_surat',NOW(),'$nfile','$keterangan','$id_user')");

                                                            if($query == true){
                                                                $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                                header("Location: ./admin.php?page=tsk");
                                                                die();
                                                            } else {
                                                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
                                                        } else {
                                                            $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
                                                            echo '<script language="javascript">window.history.back();</script>';
                                                        }
                                                    } else {
                                                        $_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.JPG, *.PNG, *.DOC, *.DOCX atau *.PDF!';
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    }
                                                } else {
                                                    $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,kode,tgl_surat,
                                                        tgl_catat,keterangan,id_user)
                                                        VALUES('$no_agenda','$tujuan','$no_surat','$isi','$nkode','$tgl_surat',NOW(),'$keterangan','$id_user')");

                                                    if($query == true){
                                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                        header("Location: ./admin.php?page=tsk");
                                                        die();
                                                    } else {
                                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="?page=tsk&act=add" class="judul"><i class="material-icons">drafts</i> Tambah Data Surat Keluar</a></li>
                            </ul>
                            <ul class="right" style="margin-right: 10px">
                                <li class="waves-effect waves-light right"><a class="modal-trigger tooltipped" data-position="left" data-tooltip="Atur kode nama instansi dalam nomor surat" href="#modal"><i class="material-icons">settings</i></a></li>
                            </ul>

                            <div id="modal" class="modal">
                                <div class="modal-content white">
                                    <h5 style="color: #444">Edit kode instansi dalam nomor surat</h5>
                                    <?php
                                    $query = mysqli_query($config, "SELECT id_sett,kode_instansi FROM tbl_sett");
                                    list($id_sett,$kode_instansi) = mysqli_fetch_array($query);?>
                                    <div class="row">
                                        <style>
                                            .ins {
                                                float: right!important;
                                                font-size: 1.2rem;
                                                color: #444;
                                                border-bottom: 1px solid #e0e0e0;
                                                width: 90%!important
                                            }
                                            .md-prefix {
                                                margin-left: -12px
                                            }
                                            .inp {
                                                margin-left: -40px!important;
                                                line-height: 2rem;
                                            }
                                        </style>
                                        <form method="post" action="">
                                            <div class="input-field col s12">
                                                <div class="input-field col s1">
                                                    <input type="hidden" value="<?php echo $id_sett; ?>" name="id_sett">
                                                    <i class="material-icons prefix md-prefix">font_download</i>
                                                </div>
                                                <div class="input-field col s11 ins">
                                                    <input id="kode_instansi" type="text" name="kode_instansi" value="<?php echo $kode_instansi; ?>" class="inp" required>
                                                </div>
                                                <div class="modal-footer white">
                                                    <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>
                                                    <?php
                                                    if(isset($_REQUEST['simpan'])){
                                                        $id_sett = "1";
                                                        $kode_instansi = $_REQUEST['kode_instansi'];                                                                    $id_user = $_SESSION['id_user'];

                                                        $query = mysqli_query($config, "UPDATE tbl_sett SET kode_instansi='$kode_instansi',id_user='$id_user' WHERE id_sett='$id_sett'");
                                                        if($query == true){
                                                            header("Location: ./admin.php?page=tsk&act=add");
                                                            die();
                                                        }
                                                    } ?>
                                                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </nav>
                </div>
                <!-- Secondary Nav END -->
            </div>
            <!-- Row END -->

            <?php
                if(isset($_SESSION['errQ'])){
                    $errQ = $_SESSION['errQ'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errQ']);
                }
                if(isset($_SESSION['errEmpty'])){
                    $errEmpty = $_SESSION['errEmpty'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errEmpty.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errEmpty']);
                }
            ?>

            <!-- Row form Start -->
            <div class="row jarak-form">

                <!-- Form START -->
                <form class="col s12" method="POST" action="?page=tsk&act=add" enctype="multipart/form-data">

                    <!-- Row in form START -->
                    <div class="row">
                        <div class="input-field col m6">
                            <i class="material-icons prefix md-prefix">looks_one</i>
                                <?php
                                    $query = mysqli_query($config, "SELECT no_agenda FROM tbl_surat_keluar");
                                        echo '<input id="no_agenda" type="number" class="validate" value="';
                                    $no_agenda = 0;
                                    $result = mysqli_num_rows($query);
                                    $counter = 0;
                                    while(list($no_agenda) = mysqli_fetch_array($query)){
                                        if (++$counter == $result) {
                                            $no_agenda++;
                                            echo $no_agenda;
                                        }
                                    }
                                    echo '"name="no_agenda" required>';

                                    if(isset($_SESSION['no_agendak'])){
                                        $no_agendak = $_SESSION['no_agendak'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_agendak.'</div>';
                                        unset($_SESSION['no_agendak']);
                                    }
                                ?>
                            <label for="no_agenda">Nomor Agenda</label>
                        </div>
                        <div class="input-field col m6 tooltipped" data-position="top" data-tooltip="Kode klasifikasi diambil dari data Referensi">
                            <i class="material-icons prefix md-prefix">bookmark</i><label style="font-size: 1rem;margin-top: -30px">Pilih Kode Klasifikasi</label>
                            <div class="input-field col s11 right">
                                <select class="browser-default validate" name="kode" id="kode" required style="margin: -15px 0 20px;">
                                    <?php
                                        $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi");
                                        if(mysqli_num_rows($query) > 0){
                                            while($row = mysqli_fetch_array($query)){
                                                echo '<option value="'.$row['kode'].'">'.$row['kode']. " &nbsp;".$row['nama'].'</option>';
                                            }
                                        } echo 'Tidak ada kode surat';
                                    ?>
                                </select>
                            </div>
                            <?php
                                if(isset($_SESSION['kodek'])){
                                    $kodek = $_SESSION['kodek'];
                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kodek.'</div>';
                                    unset($_SESSION['kodek']);
                                }
                            ?>
                        </div>
                        <div class="input-field col m6">
                            <i class="material-icons prefix md-prefix">place</i>
                            <input id="tujuan" type="text" class="validate" name="tujuan" required>
                                <?php
                                    if(isset($_SESSION['tujuan_surat'])){
                                        $tujuan_surat = $_SESSION['tujuan_surat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tujuan_surat.'</div>';
                                        unset($_SESSION['tujuan_surat']);
                                    }
                                ?>
                            <label for="tujuan">Tujuan Surat</label>
                        </div>
                        <div class="input-field col m6 tooltipped" data-position="top" data-tooltip="Sesuaikan Kode Surat dengan Kode Klasifikasi & No Urut dengan No Agenda">
                            <i class="material-icons prefix md-prefix">looks_two</i>
                            <?php
                                $query = mysqli_query($config, "SELECT no_agenda FROM tbl_surat_keluar");
                                $no_agenda = 0;
                                $result = mysqli_num_rows($query);
                                $counter = 0;
                                while(list($no_agenda) = mysqli_fetch_array($query)){
                                    if (++$counter == $result) {
                                        $no_agenda++;
                                        $n = $no_agenda;
                                    }
                                }

                                $date = date("d-m-Y");
                                $y = substr($date,6,4);
                                $m = substr($date,3,2);

                                $query1 = mysqli_query($config, "SELECT kode_instansi FROM tbl_sett WHERE id_sett='1'");
                                list($kode_instansi) = mysqli_fetch_array($query1);
                                $g = "$kode_instansi";

                                if($m == "01"){
                                    $nm = "I";
                                } elseif($m == "02"){
                                    $nm = "II";
                                } elseif($m == "03"){
                                    $nm = "III";
                                } elseif($m == "04"){
                                    $nm = "IV";
                                } elseif($m == "05"){
                                    $nm = "V";
                                } elseif($m == "06"){
                                    $nm = "VI";
                                } elseif($m == "07"){
                                    $nm = "VII";
                                } elseif($m == "08"){
                                    $nm = "VIII";
                                } elseif($m == "09"){
                                    $nm = "IX";
                                } elseif($m == "10"){
                                    $nm = "X";
                                } elseif($m == "11"){
                                    $nm = "XI";
                                } elseif($m == "12"){
                                    $nm = "XII";
                                }

                                ?>
                            <input id="no_surat" type="text" class="validate" value="<?php echo "420 / ".$n." / ".$g." / ".$nm." / ".$y; ?>" name="no_surat" required>
                                <?php
                                    if(isset($_SESSION['no_suratk'])){
                                        $no_suratk = $_SESSION['no_suratk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_suratk.'</div>';
                                        unset($_SESSION['no_suratk']);
                                    }
                                    if(isset($_SESSION['errDup'])){
                                        $errDup = $_SESSION['errDup'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errDup.'</div>';
                                        unset($_SESSION['errDup']);
                                    }
                                ?>
                            <label for="no_surat">Nomor Surat</label>
                        </div>
                        <div class="input-field col m6">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="tgl_surat" type="text" name="tgl_surat" class="datepicker" required>
                                <?php
                                    if(isset($_SESSION['tgl_suratk'])){
                                        $tgl_suratk = $_SESSION['tgl_suratk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tgl_suratk.'</div>';
                                        unset($_SESSION['tgl_suratk']);
                                    }
                                ?>
                            <label for="tgl_surat">Tanggal Surat</label>
                        </div>
                        <div class="input-field col m6">
                            <i class="material-icons prefix md-prefix">featured_play_list</i>
                            <input id="keterangan" type="text" class="validate" name="keterangan" required>
                                <?php
                                    if(isset($_SESSION['keterangank'])){
                                        $keterangank = $_SESSION['keterangank'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$keterangank.'</div>';
                                        unset($_SESSION['keterangank']);
                                    }
                                ?>
                            <label for="keterangan">Keterangan</label>
                        </div>
                        <div class="input-field col m6">
                            <i class="material-icons prefix md-prefix">description</i>
                            <textarea id="isi" class="materialize-textarea validate" name="isi" required></textarea>
                                <?php
                                    if(isset($_SESSION['isik'])){
                                        $isik = $_SESSION['isik'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$isik.'</div>';
                                        unset($_SESSION['isik']);
                                    }
                                ?>
                            <label for="isi">Isi Ringkas</label>
                        </div>
                        <div class="input-field col m6">
                            <div class="file-field input-field tooltipped" data-position="top" data-tooltip="Jika tidak ada file/scan gambar surat, biarkan kosong">
                                <div class="btn light-green darken-1">
                                    <span>File</span>
                                    <input type="file" id="file" name="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Upload file/scan gambar surat keluar">
                                        <?php
                                            if(isset($_SESSION['errSize'])){
                                                $errSize = $_SESSION['errSize'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errSize.'</div>';
                                                unset($_SESSION['errSize']);
                                            }
                                            if(isset($_SESSION['errFormat'])){
                                                $errFormat = $_SESSION['errFormat'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errFormat.'</div>';
                                                unset($_SESSION['errFormat']);
                                            }
                                        ?>
                                    <small class="red-text">*Format file yang diperbolehkan *.JPG, *.PNG, *.DOC, *.DOCX, *.PDF dan ukuran maksimal file 2 MB!</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row in form END -->

                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <a href="?page=tsk" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
                        </div>
                    </div>

                </form>
                <!-- Form END -->

            </div>
            <!-- Row form END -->

<?php
        }
    }
}
?>
