<?php include('include/config.php'); ?>
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
            padding-top: 5%;
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
            margin-bottom: 25px;
        }
        #title {
            margin: 0 0 35px;
        }
        .btn-large {
            font-size: 18px;
            margin: 0;
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

                    <!-- Form START -->
                    <form class="col s12 m12 offset-4 offset-4" method="POST" action="proses/login.phpe" >
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
                            <button type="submit" class="btn-large waves-effect waves-light blue-grey col s12">LOGIN</button>
                        </div>
                    </form> 
                    <!-- Form END -->

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

    <!-- jquery dropdown select -->
    <script type="text/javascript">
        $(document).ready(function() {
        $('select').material_select();
        });
    </script>
    <!-- Javascript END -->

</body>
<!-- Body END -->

</html>