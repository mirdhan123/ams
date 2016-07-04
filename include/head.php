<?php
    //Cek session login
    if(!empty($_SESSION['admin'])){
?>
<?php require('include/config.php'); ?>
<head>

    <title>Aplikasi Manajemen Surat</title>

    <!-- Meta START -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="asset/img/favicon.ico" type="image/x-icon">
    <!-- Meta END -->

    <!--[if lt IE 9]>
    <script src="./asset/js/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Global style START -->
    <link type="text/css" rel="stylesheet" href="./asset/css/materialize.css"  media="screen,projection"/>
    <style type="text/css">
        body {
            background: #fff;
        }
        .bg::before {
            content: '';
            background-image: url('./asset/img/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: scroll;
            position: absolute;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.2;
            filter:alpha(opacity=20);
        }
        #header-instansi {
            margin-top: 1%;
        }
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
        .jarak {
            height: 13.4rem;
        }
        #footer {
            background: #546e7a;
        }
        .warna {
            color: #444;
        }
        .agenda {
            font-size: 19px;
            padding-left: 8px;
        }
        .hid {
            display: none;
        }
        @media print{
            .side-nav,
            .secondary-nav,
            .jarak-form,
            .center,
            .hide-on-med-and-down,
            .dropdown-content,
            .button-collapse,
            .btn-large,
            .footer-copyright {
                display: none;
            }
            body {
                font-size: 12px;
                color: #212121;
            }
            .hid {
                display: block;
                font-size: 16px;
                text-transform: uppercase;
                margin-bottom: 0;
            }
            .agenda {
                font-size: 12px;
                text-align: center;
                color: #212121;
            }
            th, td{
                border: 0.8px solid #444;
            }
            th{
                padding: 3px 5px;
                display: table-cell;
                text-align: center;
                vertical-align: middle;
            }
            td{
                padding: 0 4px;
            }
            table {
              border-collapse: collapse;
              border-spacing: 0;
              font-size: 12px;
              color: #212121;
            }
        }
        .footer-copyright {
            margin-top: 6rem;
        }
        noscript{
            color: #fff;
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
