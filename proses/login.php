    <?php
    include ('../include/config.php');
    if(isset($_REQUEST['submit'])){
        $user = $_REQUEST['username'];
        $pass = $_REQUEST['password'];

        $sql    = "SELECT * FROM tbl_user WHERE username = '$username' && password = MD5('$password')";
        $login = mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($login) > 0) {
            list($id_user, $username) = mysqli_fetch_array($login);
            $_SESSION['id_user'] = $id_user;

            header('location: ./admin.php');
            die();
            } else {
            $_SESSION['err'] = "Username & Password Tidak sesuai";
            header('Location: ./');
            die();
            }
        }else{
            if (isset($_SESSION['err'])) {
                echo '<div align="center" class="alert alert-warning alert-message">'.$_SESSION['err'].'</div>';
                unset($_SESSION['err']);
            }}
        ?>