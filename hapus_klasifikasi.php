<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        $id_klasifikasi = mysqli_real_escape_string($config, $_REQUEST['id_klasifikasi']);
        $query = mysqli_query($config, "SELECT * FROM tbl_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

            if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 2){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk menghapus data ini");
                        window.location.href="./admin.php?page=ref";
                      </script>';
            } else {
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
			                    <td width="13%">Kode</td>
			                    <td width="1%">:</td>
			                    <td width="86%">'.$row['kode'].'</td>
			                </tr>
			                <tr>
			                    <td width="13%">Nama</td>
			                    <td width="1%">:</td>
			                    <td width="86%">'.$row['nama'].'</td>
			                </tr>
			                <tr>
			                    <td width="13%">Uraian</td>
			                    <td width="1%">:</td>
			                    <td width="86%">'.$row['uraian'].'</td>
			                </tr>
			            </tbody>
			   		</table>
			    </div>
			</div>
			<!-- Row form END -->

	        <div class="row bts">
	            <div class="col 6">
	                <a href="?page=ref&act=del&submit=yes&id_klasifikasi='.$row['id_klasifikasi'].'" class="btn-large deep-orange waves-effect waves-light">HAPUS <i class="material-icons">delete</i></a>
	            </div>
	            <div class="col 6">
	                <a href="?page=ref" class="btn-large blue waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
	            </div>
	        </div><br/>';

        	if(isset($_REQUEST['submit'])){
        		$id_klasifikasi = $_REQUEST['id_klasifikasi'];

                $query = mysqli_query($config, "DELETE FROM tbl_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");

            	if($query == true){
                    echo '<script language="javascript">
                            window.alert("SUKSES! Data berhasil dihapus.");
                            window.location.href="./admin.php?page=ref";
                          </script>';
            	} else {
                    echo '<script language="javascript">
                            window.alert("ERROR! Periksa penulisan querynya.");
                            window.location.href="./admin.php?page=ref&act=del&id_klasifikasi='.$id_klasifikasi.'";
                          </script>';
            	}
            }
	    }
    }
}
}
?>
