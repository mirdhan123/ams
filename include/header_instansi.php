<?php
    //Cek session login
    if(!empty($_SESSION['admin'])){
?>
<div class="col s12" id="header-instansi">
    <div class="card blue-grey white-text">
        <div class="card-content"><div class="circle left"><img src="asset/img/logo.png"/></div>
            <h5>SMK Al - Husna Loceret Nganjuk</h5>
            <p>Jalan Raya Kediri Gg. Kwagean No. 04 Loceret Telp/Fax. (0358) 329806 Nganjuk 64471</p>
        </div>
    </div>
</div>
<?php 
    } else {
        header("Location:../");
        die();
    }
?>