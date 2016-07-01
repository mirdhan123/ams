<?php
    //Cek session user yang login. Jika tidak ditemukan user yang login akan menampilkan pesan error
    if(empty($_SESSION['admin'])){

        //Menampilkan pesan error dan mengarahkan ke halaman login
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        //Menampilkan data sesuai id_surat
    	$id_surat = $_REQUEST['id_surat'];

    	$query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

    		  echo '<!-- Row form Start -->
				<div class="row jarak-form">

				    <div class="col m12">
				        <table>
				            <thead class="red lighten-5 red-text">
				                <div class="confir red-text"><i class="material-icons md-36">error_outline</i>
				                Apakah Anda yakin akan menghapus data ini?</div>
				            </thead>

				            <tbody>
				                <tr>
				                    <td width="13%">No. Agenda</td>
				                    <td width="1%">:</td>
				                    <td width="86%">'.$row['no_agenda'].'</td>
				                </tr>
				                <tr>
				                    <td width="13%">Kode Klasifikasi</td>
				                    <td width="1%">:</td>
				                    <td width="86%">'.$row['kode'].'</td>
				                </tr>
				                <tr>
				                    <td width="13%">No. Isi</td>
				                    <td width="1%">:</td>
				                    <td width="86%">'.$row['isi'].'</td>
				                </tr>
				                <tr>
				                    <td width="13%">File</td>
				                    <td width="1%">:</td>
				                    <td width="86%"><a href="upload/surat_masuk/'.$row['file'].'">'.$row['file'].'</a></td>
				                </tr>
				                <tr>
				                    <td width="13%">Asal Surat</td>
				                    <td width="1%">:</td>
				                    <td width="86%">'.$row['asal_surat'].'</td>
				                </tr>
				                <tr>
				                    <td width="13%">No. Surat</td>
				                    <td width="1%">:</td>
				                    <td width="86%">'.$row['no_surat'].'</td>
				                </tr>
				                <tr>
				                    <td width="13%">Tanggal Surat</td>
				                    <td width="1%">:</td>
				                    <td width="86%">'.$tgl = date('d M Y ', strtotime($row['tgl_surat'])).'</td>
				                </tr>
				            </tbody>
				   		</table>
				    </div>
				</div>
				<!-- Row form END -->

		        <div class="row bts">
		            <div class="col 6">
		                <a href="?page=tsm&aksi=del&submit=yes&id_surat='.$row['id_surat'].'" class="btn-large deep-orange waves-effect waves-light">HAPUS <i class="material-icons">delete</i></a>
		            </div>
		            <div class="col 6">
		                <a href="?page=tsm" class="btn-large blue waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
		            </div>
		        </div><br/>';

                //Jika tombol hapus diklik akan mengirimkan id_surat dan melakukan query penghapusan data
            	if(isset($_REQUEST['submit'])){
            		$id_surat = $_REQUEST['id_surat'];
            		$query = mysqli_query($config, "DELETE FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

            		if($query == true){
                        echo '<script language="javascript">
                        window.alert("SUKSES! Data berhasil dihapus.");
                        window.location.href="./admin.php?page=tsm";
                        </script>';
            		} else {
                        echo '<script language="javascript">
                        window.alert("ERROR! Periksa penulisan querynya.");
                        window.location.href="./admin.php?page=tsm&act=del&id_surat='.$id_surat.'";
                        </script>';
            		}
            	}
		    }
	    }
    }
?>
