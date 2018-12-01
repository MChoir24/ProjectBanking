<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// session_start();
// $_SESSION['detail'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (!isset($_SESSION['level'])) { //mengecek user sudah login atau belum
    header("Location: ../login.php"); //jika belum login akan diarahkan ke halaman login
    exit();
}
 ?>
