<?php
session_start(); //memulai session
unset($_SESSION['user']); //menghapus isi dari session 'user'
unset($_SESSION['level']); //menghapus isi dari session 'level'
header("Location: public/index.php"); //mengarah kan ke index.php
 ?>
