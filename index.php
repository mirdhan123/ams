<?php
    //Memulai session
    session_start();

    //Apabila ditemukan session login, maka akan diarahkan ke halaman dashboard
    if(isset($_SESSION['admin'])){
        header("Location: ./admin.php");
        die();
    }
    require('include/config.php');

?>
<!doctype html>
<html lang="en">

<!-- Head START -->
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
    <script src="./asset/js/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Global style START -->
    <link type="text/css" rel="stylesheet" href="./asset/css/materialize.css"  media="screen,projection"/>
    <style type="text/css">
        @media only screen and (min-width: 993px) {
            .container {
                width: 70%!important;
            }
        }
        .container {
            max-width: 100%;
            padding-top: 4.6%;
        }
        #logo {
            display: block;
            margin: -20px auto -15px;
        }
        img {
            border-radius: 50%;
            margin: 0 auto;
            max-width: 90px;
            max-height: 90px;
        }
        #login {
            margin-top: -2%;
        }
        #smk {
            font-size: 30px;
            margin-bottom: 10px;
        }
        #title {
            margin: 5px 0 35px;
        }
        .btn-large {
            font-size: 18px;
            margin: 0;
        }
        #alert-message {
            border-radius: 3px;
            color: #f44336 ;
            font-size: 16px;
            margin-bottom: -15px;
        }
        .error {
            padding: 10px;
        }
        .upss {
            font-size: 18px;
            margin-left: 20px;
        }
        noscript {
            color: #42a5f5;
        }
       .input-field label {
            font-size: 1.2rem;
        }
        .input-field label.active {
            font-size: 1rem;
        }
    </style>
    <!-- Global style END -->

</head>
<!-- Head END -->

<!-- Body START -->
<body class="light-green">

    <!-- Container START -->
    <div class="container">

        <!-- Row START -->
        <div class="row">

            <!-- Col START -->
            <div class="col s12 m6 offset-m3 offset-m3">

                <!-- Box START -->
                <div class="card-panel z-depth-2" id="login">

                    <!-- Row Form START -->
                    <div class="row">

                    <?php
                        $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
                        while($data = mysqli_fetch_array($query)){
                    ?>
                    <!-- Logo and title START -->
                    <div class="col s12">
                        <div class="card-content">
                            <h5 class="center" id="title">Aplikasi Manajemen Surat Menyurat</h5>
                            <?php
                                if(!empty($data['logo'])){
                                    echo '<img id="logo" src="'.$data['logo'].'"/>';
                                } else {
                                    echo '<img id="logo" src="./asset/img/logo.png"/>';
                                }
                            ?>
                            <h4 class="center" id="smk">
                            <?php
                                if(!empty($data['nama'])){
                                    echo ''.$data['nama'].'';
                                } else {
                                    echo 'SMK AL - Husna Loceret Nganjuk';
                                }
                             ?>
                            </h4>
                        </div>
                    </div>
                    <!-- Logo and title END -->
                    <?php
                        }
                    ?>

                    <?php

                        if(isset($_REQUEST['submit'])){

                            /* Memeriksa apakah form diisi atau tidak, jika kosong maka akan menampilkan pesan untuk mengisinya dan jika ada isinya proses akan dilanjutkan */
                            if($_REQUEST['username'] == "" || $_REQUEST['password'] == ""){
                                echo '<div class="upss red-text"><i class="material-icons">error_outline</i> <strong>ERROR!</strong> Username dan Password wajib diisi.
                                <a class="btn-large waves-effect waves-light blue-grey col s11" href="./" style="margin: 20px 0 0 5px;"><i class="material-icons md-24">arrow_back</i> Kembali ke halaman login</a></div>';
                            } else {

                                $username = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['username'])));
                                $password = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['password'])));

                                //Melakukan query terhadap database
                                $query = mysqli_query($config, "SELECT id_user, username, nama, nip, admin FROM tbl_user WHERE username=BINARY'$username' AND password=MD5('$password')");

                                //Apabila data ditemukan dan ada kecocokan data akan melist data
                                if(mysqli_num_rows($query) > 0){
                                    list($id_user, $username, $nama, $nip, $admin) = mysqli_fetch_array($query);

                                    //Mengeset session
                                    session_start();
                                    $_SESSION['id_user'] = $id_user;
                                    $_SESSION['username'] = $username;
                                    $_SESSION['nama'] = $nama;
                                    $_SESSION['nip'] = $nip;
                                    $_SESSION['admin'] = $admin;

                                    //Apabila ditemukan data yang cocok akan diarahkan ke halaman admin
                                    header("Location: ./admin.php");
                                    die();
                                } else {

                                    //Apabila tidak ditemukan data yang cocok akan diarahkan kembali ke halaman login dan menampilkan pesan error
                                    $_SESSION['err'] = '<strong>ERROR!</strong> Username dan Password tidak ditemukan.';
                                    header("Location: ./");
                                    die();
                                }
                            }
                        } else {
                    ?>

                    <!-- Form START -->
                    <form class="col s12 m12 offset-4 offset-4" method="POST" action="" >
                        <div class="row">
                            <?php
                                if(isset($_SESSION['err'])){
                                    $err = $_SESSION['err'];

                                    //Menampilkan pesan error
                                    echo '<div id="alert-message" class="error red lighten-5"><i class="material-icons">error_outline</i> '.$err.'</div>';
                                    unset($_SESSION['err']);
                                }
                            ?>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">account_circle</i>
                            <input id="username" type="text" class="validate" name="username" required autocomplete="off">
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">lock</i>
                            <input id="password" type="password" class="validate" name="password" required autocomplete="off">
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field col s12">
                            <button type="submit" class="btn-large waves-effect waves-light blue-grey col s12" name="submit">LOGIN</button>
                        </div>
                    </form>
                    <!-- Form END -->

                    <?php
                        }
                    ?>
                    </div>
                    <!-- Row Form START -->

                </div>
                <!-- Box END-->

            </div>
            <!-- Col END -->

        </div>
        <!-- Row END -->

    </div>
    <!-- Container END -->

    <!-- Javascript START -->
    <script type="text/javascript" src="asset/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="asset/js/materialize.min.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>

    <!-- Jquery auto hide untuk menampilkan pesan error -->
    <script type="text/javascript">
        $("#alert-message").alert().delay(3000).slideUp('slow');
    </script>
    <!-- Javascript END -->

    <noscript>
        <meta http-equiv="refresh" content="0;URL='./enable-javascript.html'" />
    </noscript>

</body>
<!-- Body END -->

</html>
