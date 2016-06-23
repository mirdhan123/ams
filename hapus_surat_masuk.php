<?php
//Cek session user yang login. Jika tidak ditemukan id_user yang login akan menampilkan pesan error
if(empty($_SESSION['admin'])){

    //Menampilkan pesan error dan mengarahkan ke halaman login
    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header("Location: ./");
    die();
} else {
	if(isset($_REQUEST['submit'])){
		$id_surat = $_REQUEST['id_surat'];
		$query = mysqli_query($config, "DELETE FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
		if($query > 0){
			header("Location: ./admin.php?page=tsm");
			die();
		} else {
			echo '<br/><div id="alert-message" class="error red lighten-5"><i class="material-icons">error_outline</i> ERROR! Periksa penulisan querynya.</div>';
		}
	} else {
		$id_surat = $_REQUEST['id_surat'];
		$query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
		
		if (mysqli_num_rows($query) > 0) {
            $no = 1;
            while($row = mysqli_fetch_assoc($query)) { 

		  echo '<!-- Row form Start -->
				<div class="row jarak-form">

				    <div class="col m12">
				        <table class="responsive bordered">
				            <thead class="red lighten-5 red-text " id="head">
				                <tr>
				                    <th colspan="2"><h5><i class="material-icons md-36">error_outline</i> 
				                    Apakah Anda yakin akan menghapus data ini?</h5></th>
				                </tr>
				            </thead>

				            <tbody>
				                <tr>
				                    <td width="15%">No. Agenda</td>
				                    <td><b>'.$row['no_agenda'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="15%">Kode Klasifikasi</td>
				                    <td><b>'.$row['kode'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="15%">No. Isi</td>
				                    <td><b>'.$row['isi'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="15%">File</td>
				                    <td><b>'.$row['file'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="15%">Asal Surat</td>
				                    <td><b>'.$row['asal_surat'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="15%">No. Surat</td>
				                    <td><b>'.$row['no_surat'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="15%">Tanggal Surat</td>
				                    <td><b>'.$tgl = date('d M Y ', strtotime($row['tgl_surat'])).'</b></td>
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
		                <a type="reset" onclick="window.history.back();" class="btn-large blue waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
		            </div>
		        </div>';
			}
		}
	}
}
?>