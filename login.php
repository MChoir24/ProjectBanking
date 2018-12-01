<?php
session_start(); //memulai session
include './php/validate.php';
if (isset($_SESSION['level'])) {
    header('location: ./public/index.php');
}

include 'php/sql.php'; //mengimport semua fungsi pada file sql.php
$err = '';
if (isset($_POST['login'])) { //mengecek apakah tombol submit login sudah di tekan

    $_SESSION['user'] = checkUser($_POST['nama'],$_POST['passwd']); //mengambil semua data yang dimiliki oleh user yang telah login
    if ($_SESSION['user']) {
        header("location: public/index.php"); //mengarahkan ke halaman index.php jika berhasil login
    }
    else { //jika salah username dan passwd salah
        $err = '<span class="err">Username atau Password tidak benar.</span>'; //memberikan nilai pada variable err untuk ditampilkan
    }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" href="css/master.css">
    <meta charset="utf-8">
	<title>I BANKING</title>
</head>
<body>
	<!--HEADER-->
	<div class="header">
		<a href="public/index.php"><img src="gambar/Logo.png" alt="dcs" width="60" height="60" id="dcs"></a>
		<img src="./gambar/ebanking.png" alt="dcs" width="300" height="70" id="dc">
	</div>
	<div class="header">
	<b>Selamat Datang di CP IBanking</b>
	</div>
	<!--SIDEBAR-->
	<div class="sidebar">
		<?php include 'inc/formlogin.inc'; ?>
	</div>
	<!--FOOTER-->
	<div id="footer">
		<img src="./gambar/Logo.png" alt="no image" height="120" width="120">
		<p> &copy; Copyright 2018 Online Banking - Pengembangan Aplikasi Web</p>
	</div>
</body>
</html>
