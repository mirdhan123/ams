<?php
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {
echo '
<style type="text/css">
    table {
        background: #fff;
    }
    tr, td {
        border: table-cell;
        border: 1px solid #444;
    }
    tr,td {
        vertical-align: top!important;
    }
    #isi {
        height: 300px;
    }
</style>

<body onload="window.print()">

<!-- Container START -->
<div class="container">
    <div id="colres">
        <table class="bordered" id="tbl">
            <tbody>';

                $id_surat = $_REQUEST['id_surat'];
                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

                if(mysqli_num_rows($query) > 0){
                    $no = 0;
                    while($row = mysqli_fetch_array($query)){
                 echo ' <br/><tr>
                            <td colspan="5">';
                                $query2 = mysqli_query($config, "SELECT nama, alamat FROM tbl_instansi");
                                list($nama, $alamat) = mysqli_fetch_array($query2);
                                echo '<h5>'.$nama.'</h5><br/>
                                '.$alamat.'
                            </td>
                        <tr>
                            <td colspan="5"><h5>LEMBAR DISPOSISI</h5></td>
                        </tr>
                        <tr>
                            <td width="18%"><strong>Indeks Berkas</strong></td>
                            <td width="57%">: '.$row['indeks'].'</td>
                            <td width="25"><strong>Kode</strong> : '.$row['kode'].'</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal/Nomor</strong></td>
                            <td colspan="2">: '.date('d M Y', strtotime($row['tgl_surat'])).' / '.$row['no_surat'].'</td>
                        </tr>
                        <tr>
                            <td><strong>Asal Surat</strong></td>
                            <td colspan="2">: '.$row['asal_surat'].'</td>
                        </tr>
                        <tr>
                            <td><strong>Isi Ringkas</strong></td>
                            <td colspan="2">: '.$row['isi'].'</td>
                        </tr>
                        <tr>
                            <td><strong>Diterima Tanggal</strong></td>
                            <td>: '.date('d M Y', strtotime($row['tgl_diterima'])).'</td>
                            <td><strong>No. Agenda</strong> : '.$row['no_agenda'].'</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Penyelesaian</strong></td>
                            <td colspan="2">: </td>
                        </tr>
                        <tr>';
                        $query3 = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat'");

                        if(mysqli_num_rows($query3) > 0){
                            $no = 0;
                            while($row = mysqli_fetch_array($query3)){
                            echo '
                        <tr id="isi">
                            <td colspan="2">
                                <strong>Isi Disposisi :</strong><br/>'.$row['isi_disposisi'].'<br/><br/>
                                <strong>Batas Waktu</strong> : '.date('d M Y', strtotime($row['batas_waktu'])).'<br/>
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
