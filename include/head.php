<?php
    //Cek session login
    if(!empty($_SESSION['admin'])){
?>
<?php require('include/config.php'); ?>
<head>

    <title>Aplikasi Manajemen Surat Menyurat</title>

    <!-- Meta START -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="asset/img/favicon.ico" type="image/x-icon">
    <!-- Meta END -->

    <!--[if lt IE 9]>
    <script src="../asset/js/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Global style START -->
    <link type="text/css" rel="stylesheet" href="asset/css/materialize.css"  media="screen,projection"/>
    <style type="text/css">
        #menu {
            margin-left: 20px;
        }
        .title {
            background: #333;
            border-radius: 3px 3px 0 0;
            margin: -20px -20px 25px;
            padding: 20px;
        }
        img {
            border-radius: 40px;
            margin: 0 15px -10px 0;
            max-width: 80px;
            max-height: 80px;
        }
        .description {
            font-size: 20px;
        }
        noscript{
            color: #fff;
        }
        .file {
            margin-top: 20px;
        }
        .file-sm {
            margin: 0 0 10px 0;
        }
        #browser-default {
            margin-top: -25px;
        }
        @media only screen and (max-width: 701px) {
            #colres{
                width: 100%;
                overflow-x: scroll!important;
            }
            #tbl{
                width: 600px!important;
            }
        }
    </style>
    <!-- Global style END -->

</head>
<?php
    } else {
        header("Location:../");
        die();
    }
?>
