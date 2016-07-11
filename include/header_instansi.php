<?php
    //cek session
    if(!empty($_SESSION['admin'])){

        $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
        while($data = mysqli_fetch_array($query)){
            echo '<div class="col s12" id="header-instansi">
                    <div class="card blue-grey white-text">
                        <div class="card-content">
                            <div class="circle left">';
                            if(!empty($data['logo'])){
                                echo '<img src="./upload/'.$data['logo'].'"/>';
                            } else {
                                echo '<img src="./asset/img/logo.png"/>';
                            }
                             echo '</div>
                            <h5>';
                            if(!empty($data['nama'])){
                                echo ''.$data['nama'].'';
                            } else {
                                echo 'SMK AL - Husna Loceret Nganjuk';
                            }
                            echo '</h5>
                            <p>';
                            if(!empty($data['alamat'])){
                                echo ''.$data['alamat'].'';
                            } else {
                                echo 'Jalan Raya Kediri Gg. Kwagean No. 04 Loceret Telp/Fax. (0358) 329806 Nganjuk 64471';
                            }
                            echo '</p>
                        </div>
                    </div>
                </div>';
        }
    } else {
        header("Location:../");
        die();
    }
?>
