<?php
    session_start();
    session_destroy();
    echo '<script language="javascript">
    window.alert("SUKSES! Anda berhasil logout.");
    window.location.href="./";
    </script>';
?>
