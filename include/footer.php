<?php
    //Cek session login
    if(!empty($_SESSION['admin'])){
?>
<!-- Footer START -->
<footer class="page-footer white">
    <div class="container">
        <div class="row white">
            <div class="col 12"></div>
        </div>
    </div>
    <div class="footer-copyright blue-grey darken-1 white-text">
        <div class="container">
            <i class="material-icons">language</i> <a href="http://www.smkalhusnaloceret.sch.id/" target="_blank" class="white-text">
            www.smkalhusnaloceret.sch.id</a> &nbsp;&nbsp;
            <i class="material-icons">mail</i> <a href="mailto:info@smkalhusnaloceret.sch.id" class="white-text">
            info@smkalhusnaloceret.sch.id</a>
        </div>
    </div>
</footer>
<!-- Footer END -->

<!-- Javascript START -->
<script type="text/javascript" src="asset/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="asset/js/materialize.min.js"></script>
<script type="text/javascript">

//jquery dropdown
$(".dropdown-button").dropdown();

//jquery sidenav on mobile
$('.button-collapse').sideNav({
    menuWidth: 240, // Default is 240
    edge: 'left', // Choose the horizontal origin
    closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
});

//jquery datepicker
$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 10 // Creates a dropdown of 15 years to control year
});

//jquery teaxtarea
$('#isi_ringkas').val('');
$('#isi_ringkas').trigger('autoresize');   

//jquery dropdown select
$(document).ready(function() {
$('select').material_select();
});

//jquery modal
$(document).ready(function(){

// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
$('.modal-trigger').leanModal();
});
         
</script>
<!-- Javascript END -->
<?php 
    } else {
        header("Location:../");
        die();
    }
?>