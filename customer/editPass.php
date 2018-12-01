<?php

require '../public/customer_permission.inc'; //memeriksa user apakah customer atau bukan
include '../php/sql.php'; //import semua fumgsi dari sql.php
include '../php/validate.php';
$id = $_SESSION['user']['USERNAME'];
$errors = array();

if (isset($_POST['update'])) { //mengecek apakah inputan submit 'update' sudah diklik
    validatePassword($errors,$_POST,'newPass'); //validasi form
    validateRequired($errors,$_POST);
    validateConfirmPassword($errors, $_POST, 'newPass', 'cNewPass');
    if (checkLassPass($_POST['lastPass'],$id)) { //mengecek apakah password yang diinputkan cocok dengan  password lama pada data base
        if ($errors) { //mengecek apakah ada error atau tidak
			include 'formEditPass.inc';
        }else {
			setPass($_POST['newPass'],$id);
			header('location: sukses.php');
        }
    }
    else {
        $errors['lastPass'] = '<span class="err">password do not match</span>'; 
        include 'formEditPass.inc';
    }
    // set2col('');
}
else {
	include 'formEditPass.inc';
}
$lastPass = getCol('CUSTOMER','PASSWORD','USERNAME',$id);
?>
