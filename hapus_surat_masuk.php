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
			header("Location: ./admin.php?page=tsm&message=3");
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
				        <table class="responsive">
				            <thead class="red lighten-5 red-text">
				                <div class="confir red-text"><i class="material-icons md-36">error_outline</i> 
				                Apakah Anda yakin akan menghapus data ini?</div>
				            </thead>

				            <tbody>
				                <tr>
				                    <td width="13%">No. Agenda</td>
				                    <td width="1%">:</td>
				                    <td width="86%"><b>'.$row['no_agenda'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="13%">Kode Klasifikasi</td>
				                    <td width="1%">:</td>			                    
				                    <td width="86%"><b>'.$row['kode'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="13%">No. Isi</td>
				                    <td width="1%">:</td>				                    
				                    <td width="86%"><b>'.$row['isi'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="13%">File</td>
				                    <td width="1%">:</td>			                    
				                    <td width="86%"><b>file</b></td>
				                </tr>
				                <tr>
				                    <td width="13%">Asal Surat</td>
				                    <td width="1%">:</td>			                    
				                    <td width="86%"><b>'.$row['asal_surat'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="13%">No. Surat</td>
				                    <td width="1%">:</td>			                   
				                    <td width="86%"><b>'.$row['no_surat'].'</b></td>
				                </tr>
				                <tr>
				                    <td width="13%">Tanggal Surat</td>
				                    <td width="1%">:</td>			                    
				                    <td width="86%"><b>'.$tgl = date('d M Y ', strtotime($row['tgl_surat'])).'</b></td>
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