<?php
require '../public/admin_permission.inc'; //mengambil semua data yang dimiliki oleh USERNAME tertentu pada table COSTUMER
include '../php/sql.php';
include '../php/validate.php';

$id = $_GET['id'];
$errors = array();
if (isset($_POST['update'])) { //mengecek apakah inputan submit 'update' sudah diklik
    validateNumber($errors,$_POST,'noTlp'); //validasi untuk form
    validateName($errors,$_POST,'nama');
    validateEmail($errors,$_POST,'email');
    validateRequired($errors,$_POST);
    if (!$errors) {
        set2col('CUSTOMER','NAMA',$_POST['nama'],'USERNAME',$id); //men set nilai ada table colom ke username tertentu
        set2col('CUSTOMER','TGL_LAHIR',$_POST['tgl_lahir'],'USERNAME',$id);
        set2col('CUSTOMER','ALAMAT',$_POST['alamat'],'USERNAME',$id);
        set2col('CUSTOMER','NO_TELP',$_POST['noTlp'],'USERNAME',$id);
        set2col('CUSTOMER','EMAIL',$_POST['email'],'USERNAME',$id);
        header('location: sukses.php'); //setelah berhasil akan diarahken ke halaman sukses
    }
}

$name = getCol('CUSTOMER','NAMA','USERNAME',$id); //mengambil data name dari sebuah kolom  pada user yang telah login
$tgl_lahir = getCol('CUSTOMER','TGL_LAHIR','USERNAME',$id); //mengambil data tgl_lahir dari sebuah kolom pada user yang telah login
$alamat = getCol('CUSTOMER','ALAMAT','USERNAME',$id); //mengambil data alamat dari sebuah kolom pada user yang telah login
$noTlp = getCol('CUSTOMER','NO_TELP','USERNAME',$id); //mengambil data noTlp dari sebuah kolom pada user yang telah login
$email = getCol('CUSTOMER','EMAIL','USERNAME',$id); //mengambil data email dari sebuah kolom pada user yang telah login

 ?>
<!-- menampilkan form edit  -->
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../css/daftarCustomer.css">
	<link rel="stylesheet" href="../css/master.css">
	<title>I BANKING</title>
</head>
<body>
	<!--HEADER-->
	<?php include 'header.inc'; ?>

	<!--CONTENT-->
	<form method="POST" action="">
    <div class="content">


        <div class="row">
            <div class="col"><p>Nama</p></div>
            <div class="col"><input type="text" name="nama" value="<?php if ($errors) {echo $_POST['nama'];} else { echo $name[0][0]; }?>">  <?php  if (isset($errors['nama'])) echo $errors['nama']; ?> </div>
            <!-- pertama menampilkan data yang ada pada data base, jika sudah submit maka akan menampilkan data yang sudah di edit -->
        </div>
        <div class="row">
            <div class="col"><p>Tanggal Lahir</p></div>
            <div class="col"><input type="date" name="tgl_lahir" value="<?php if ($errors) {echo $_POST['tgl_lahir'];} else  echo $tgl_lahir[0][0]; ?>"><?php  if (isset($errors['tgl_lahir'])) echo $errors['tgl_lahir']; ?></div>
        </div>
        <div class="row">
            <div class="col"><p>Alamat</p></div>
            <div class="col"><textarea name="alamat" rows="8" cols="80"><?php if ($errors) {echo $_POST['alamat'];} else echo $alamat[0][0]; ?></textarea> <?php  if (isset($errors['alamat'])) echo $errors['alamat']; ?> </div>
        </div>
        <div class="row">
            <div class="col"><p>No.Hp</p></div>
            <div class="col"><input type="text" name="noTlp" value="<?php if ($errors) {echo $_POST['noTlp'];} else echo $noTlp[0][0] ?>"> <?php  if (isset($errors['noTlp'])) echo $errors['noTlp']; ?> </div>
        </div>
        <div class="row">
            <div class="col"><p>Email</p></div>
            <div class="col"><input type="text"  name="email" value="<?php if ($errors) {echo $_POST['email'];} else echo $email[0][0];?>"> <?php  if (isset($errors['email'])) echo $errors['email']; ?> </div>
        </div>
        <div class="row">
            <div class="col"> </div>
            <div class="col"><input type="submit" name="update" value="Submit">&nbsp;<input type="reset" name="reset" value="Reset"></div>
        </div>
    </div>
</form>
	<!--FOOTER-->
	<?php include 'footer.inc'; ?>
</body>
</html>

<div class="row"></div>
