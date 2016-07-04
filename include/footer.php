<?php
    //Cek session login
    if(!empty($_SESSION['admin'])){
?>

<noscript>
    <meta http-equiv="refresh" content="0;URL='./enable-javascript.html'" />
</noscript>

<!-- Footer START -->
<div class="footer-copyright blue-grey darken-1 white-text">
    <div class="container" id="footer">
        &copy; <?php echo date("Y"); ?>
        <div class="right hide-on-small-only">
            <?php
                $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
                while($data = mysqli_fetch_array($query)){
                    echo '
            <i class="material-icons md-12">language</i> '.$data['website'].' &nbsp;&nbsp;
            <i class="material-icons">mail_outline</i>  '.$data['email'].'';
                }
            ?>
        </div>
    </div>
</div>
<!-- Footer END -->

<!-- Javascript START -->
<script type="text/javascript" src="asset/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="asset/js/materialize.min.js"></script>
<script type="text/javascript">

//jquery dropdown
$(".dropdown-button").dropdown({ hover: false });

//jquery sidenav on mobile
$('.button-collapse').sideNav({
    menuWidth: 240,
    edge: 'left',
    closeOnClick: true
});

//jquery datepicker
$('#tgl_surat,#batas_waktu,#dari_tanggal,#sampai_tanggal').pickadate({
    selectMonths: true,
    selectYears: 10,
    format: "yyyy-mm-dd"
});

//jquery teaxtarea
$('#isi_ringkas').val('');
$('#isi_ringkas').trigger('autoresize');

//jquery dropdown select
$(document).ready(function() {
$('select').material_select();
});

//jquery tooltip
$(document).ready(function(){
$('.tooltipped').tooltip({delay: 10});
});

//Jquery UI
$(function() {
    $( "#kode" ).autocomplete({
        source: 'autocomplete.php'
    });
});

</script>
<!-- Javascript END -->

<?php
    } else {
        header("Location:./");
        die();
    }
?>
