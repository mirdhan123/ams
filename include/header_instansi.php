<?php
    //Cek session login
    if(!empty($_SESSION['admin'])){

        $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
        while($data = mysqli_fetch_array($query)){
            echo '<div class="col s12" id="header-instansi">
                    <div class="card blue-grey white-text">
                        <div class="card-content">
                            <div class="circle left">';
                            if(!empty($data['logo'])){
                                echo '<img src="'.$data['logo'].'"/>';
                            } else {
                                echo '<img src="./asset/img/logo.png"/>
                            </div>
                            <h5>'.$data['nama'].'</h5>
                            <p>'.$data['alamat'].'</p>
                        </div>
                    </div>
                </div>';
                            }
        }
    } else {
        header("Location:../");
        die();
    }
?>
