<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
        echo '
        <style type="text/css">
            table {
                background: #fff;
                padding: 5px;
            }
            tr, td {
                border: table-cell;
                border: 1px  solid #444;
            }
            tr,td {
                vertical-align: top!important;
            }
            #isi {
                height: 400px;
            }
            .tgh {
                text-align: center;
            }
            .up {
                text-transform: uppercase;
                margin: 15px 0 -15px 0;
                font-size: 22px;
            }
            #right {
                border-right: none !important;
            }
            #left {
                border-left: none !important;
            }
            #nama {
                font-size: 30px;
            }
            #alamat {
                font-size: 16px;
            }
            #lbr {
                font-size: 20px;
                font-weight: bold;
            }
            @media print{
                body {
                    font-size: 12px;
                    color: #212121;
                }
                table {
                    font-size: 12px;
                    color: #212121;
                }
                tr, td {
                    border: table-cell;
                    border: 1px  solid #444;
                    padding: 8px!important;

                }
                tr,td {
                    vertical-align: top!important;
                }
                #lbr {
                    font-size: 20px;
                }
                #isi {
                    height: 300px;
                }
                .tgh {
                    text-align: center;
                }
                #nama {
                    font-size: 20px!important;
                    margin-bottom: -10px;
                }
                #alamat {
                    font-size: 13px;
                }
                #lbr {
                    font-size: 17px;
                    font-weight: bold;
                }
            }
        </style>

        <body onload="window.print()">

        <!-- Container START -->
        <div class="container">
            <div id="colres">
                <table class="bordered" id="tbl">
                    <tbody>';

                    $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
                    $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

                    if(mysqli_num_rows($query) > 0){
                        $no = 0;
                        while($row = mysqli_fetch_array($query)){
                            echo ' <br/><tr>
                                <td class="tgh" colspan="5">';
                                    $query2 = mysqli_query($config, "SELECT nama, alamat FROM tbl_instansi");
                                    list($nama, $alamat) = mysqli_fetch_array($query2);
                                    echo '<h5 class="up" id="nama">'.$nama.'</h5><br/>
                                    <span id="alamat">'.$alamat.'</span>
                                </td>
                            <tr>
                                <td class="tgh" id="lbr" colspan="5">LEMBAR DISPOSISI</td>
                            </tr>
                            <tr>
                                <td id="right" width="18%"><strong>Indeks Berkas</strong></td>
                                <td id="left" style="border-right: none;" width="57%">: '.$row['indeks'].'</td>
                                <td id="left" width="25"><strong>Kode</strong> : '.$row['kode'].'</td>
                            </tr>
                            <tr>';

                                $y = substr($row['tgl_surat'],0,4);
                                $m = substr($row['tgl_surat'],5,2);
                                $d = substr($row['tgl_surat'],8,2);

                                if($m == "01"){
                                    $nm = "Januari";
                                } elseif($m == "02"){
                                    $nm = "Februari";
                                } elseif($m == "03"){
                                    $nm = "Maret";
                                } elseif($m == "04"){
                                    $nm = "April";
                                } elseif($m == "05"){
                                    $nm = "Mei";
                                } elseif($m == "06"){
                                    $nm = "Juni";
                                } elseif($m == "07"){
                                    $nm = "Juli";
                                } elseif($m == "08"){
                                    $nm = "Agustus";
                                } elseif($m == "09"){
                                    $nm = "September";
                                } elseif($m == "10"){
                                    $nm = "Oktober";
                                } elseif($m == "11"){
                                    $nm = "November";
                                } elseif($m == "12"){
                                    $nm = "Desember";
                                }
                                echo '

                                <td id="right"><strong>Tanggal/Nomor Surat</strong></td>
                                <td id="left" colspan="2">: '.$d." ".$nm." ".$y.' &nbsp;|&nbsp; '.$row['no_surat'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Asal Surat</strong></td>
                                <td id="left" colspan="2">: '.$row['asal_surat'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Isi Ringkas</strong></td>
                                <td id="left" colspan="2">: '.$row['isi'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Diterima Tanggal</strong></td>
                                <td id="left" style="border-right: none;">: '.$d." ".$nm." ".$y.'</td>
                                <td id="left"><strong>No. Agenda</strong> : '.$row['no_agenda'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Tanggal Penyelesaian</strong></td>
                                <td id="left" colspan="2">: </td>
                            </tr>
                            <tr>';
                            $query3 = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat'");

                            if(mysqli_num_rows($query3) > 0){
                                $no = 0;
                                $row = mysqli_fetch_array($query3);{
                                echo '
                            <tr id="isi">
                                <td colspan="2">
                                    <strong>Isi Disposisi :</strong><br/>'.$row['isi_disposisi'].'<br/><br/>
                                    <strong>Batas Waktu</strong> : '.$d." ".$nm." ".$y.'<br/>
                                    <strong>Sifat</strong> : '.$row['sifat'].'<br/>
                                    <strong>Catatan</strong> : '.$row['catatan'].'
                                </td>
                                <td><strong>Diteruskan Kepada</strong> : <br/>'.$row['tujuan'].'</td>
                            </tr>';
                                }
                            } else {
                                echo '
                                <tr height="300px">
                                    <td colspan="2"><strong>Isi Disposisi :</strong>
                                    </td>
                                    <td><strong>Diteruskan Kepada</strong> : </td>
                                </tr>';
                            }
                        } echo '
                </tbody>
            </table>
        </div>
        <div class="jarak2"></div>
    </div>
    <!-- Container END -->

    </body>';
    }
}
?>
