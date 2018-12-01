<?php
require '../public/admin_permission.inc';
include '../php/sql.php';
$id = $_GET['id'];
deleteRow('CUSTOMER','USERNAME', $id); //fungsi menghaps data
header('location: ../public/index.php'); //setelah berhasil diarahkan ke halaman index.php
 ?>
