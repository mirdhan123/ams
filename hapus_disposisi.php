<?php
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

    	$id_disposisi = $_REQUEST['id_disposisi'];

    	$query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");

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
    				                    <td width="13%">Tujuan</td>
    				                    <td width="1%">:</td>
    				                    <td width="86%">'.$row['tujuan'].'</td>
    				                </tr>
    				                <tr>
    				                    <td width="13%">Isi Disposis</td>
    				                    <td width="1%">:</td>
    				                    <td width="86%">'.$row['isi'].'</td>
    				                </tr>
    				                <tr>
    				                    <td width="13%">Sifat</td>
    				                    <td width="1%">:</td>
    				                    <td width="86%">'.$row['sifat'].'</td>
    				                </tr>
    				                <tr>
    				                    <td width="13%">Batas Waktu</td>
    				                    <td width="1%">:</td>
    				                    <td width="86%">'.date('d M Y', strtotime($row['batas_waktu'])).'</td>
    				                </tr>
    				            </tbody>
    				   		</table>
    				    </div>
    				</div>
    				<!-- Row form END -->

    		        <div class="row bts">
    		            <div class="col 6">
    		                <a href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'&sub=del&submit=yes&id_disposisi='.$row['id_disposisi'].'" class="btn-large deep-orange waves-effect waves-light">HAPUS <i class="material-icons">delete</i></a>
    		            </div>
    		            <div class="col 6">
    		                <a href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'" class="btn-large blue waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
    		            </div>
    		        </div><br/>';

            	if(isset($_REQUEST['submit'])){
            		$id_disposisi = $_REQUEST['id_disposisi'];

            		$query = mysqli_query($config, "DELETE FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");

            		if($query == true){
                        echo '<script language="javascript">
                        window.alert("SUKSES! Data berhasil dihapus.");
                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$row['id_surat'].'";
                        </script>';
            		} else {
                        echo '<script language="javascript">
                        window.alert("ERROR! Periksa penulisan querynya.");
                        window.location.href="./admin.php?page=tsm&act=disp&id_surat='.$row['id_surat'].'&sub=del&id_disposisi='.$row['id_disposisi'].'";
                        </script>';
            		}
            	}
		    }
	    }
    }
?>
