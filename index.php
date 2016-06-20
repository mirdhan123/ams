<?php
session_start();
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
    <script src="asset/js/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Global style START -->
    <link type="text/css" rel="stylesheet" href="asset/css/materialize.css"  media="screen,projection"/>
    <style type="text/css">
        .container {
            padding-top: 4.6%;
            max-width: 70%;
        }
        #logo {
            display: block;
           margin: -20px auto -15px;
        }
        img {
            border-radius: 50%;
            max-width: 90px;
            max-height: 90px;
            margin: 0 auto
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
        @media only screen and (max-width: 1024px) {
            .container {
                width: 100%;
            }
        }
    </style>
    <!-- Global style END -->

</head>
<!-- Head END -->

<!-- Body START -->
<body class="blue lighten-1">

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

                    <!-- Logo and title START -->
                    <div class="col s12">
                        <div class="card-content">
                            <h5 class="center" id="title">Aplikasi Manajemen Surat Menyurat</h5>  
                            <img id="logo" src="./asset/img/logo.png"/>
                            <h4 class="center" id="smk">SMK Al - Husna Loceret Nganjuk</h4>
                        </div>
                    </div>  
                    <!-- Logo and title END -->     

                    <!-- Proses Login -->
                    <?php
                        require('include/config.php');

                        //Apabila tombol login ditekan akan mengirimkan data username dan password
                        if(isset($_REQUEST['submit'])){
                            $username = mysqli_real_escape_string($config, $_REQUEST['username']);
                            $password = mysqli_real_escape_string($config, $_REQUEST['password']);

                            //Melakukan query terhadap database
                            $query = mysqli_query($config, "SELECT id_user, nama, admin FROM tbl_user WHERE username='$username' AND password=MD5('$password')");

                            //Apabila data ditemukan dan ada kecocokan data akan melist data
                            if(mysqli_num_rows($query) > 0){
                                list($id_user, $nama, $admin) = mysqli_fetch_array($query);

                                //Mengeset session
                                session_start();
                                $_SESSION['id_user'] = $id_user;
                                $_SESSION['nama'] = $nama;
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
                        } else {
                    ?>
                    <!-- Proses Login END -->

                    <!-- Form START -->
                    <form class="col s12 m12 offset-4 offset-4" method="POST" action="" >
                        <div class="row">
                           <?php
                                if(isset($_SESSION['err'])){
                                    $err = $_SESSION['err'];
                                    echo '<div id="alert-message" class="error red lighten-5"><i class="material-icons">error_outline</i> '.$err.'</div>';
                                }
                            ?>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="username" type="text" class="validate" name="username" required autocomplete="off">
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
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
    <script type="text/javascript" src="asset/js/b.js"></script>

    <!-- Jquery auto hide untuk menampilkan pesan error -->
    <script type="text/javascript">
        $("#alert-message").alert().delay(3000).slideUp('slow');
    </script>
    <!-- Javascript END -->

</body>
<!-- Body END -->

</html>