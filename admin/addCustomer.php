<?php
require '../public/admin_permission.inc';
include '../php/sql.php';
include '../php/validate.php';
$errors = array();
if (isset($_POST['submit'])) { //mengecek apakah sudah ditekan submit apa tidak
    validatePIN($errors,$_POST,'pin'); //validasi form
    validateNoRek($errors, $_POST, 'no_rek');
    validateUsername($errors,$_POST,'username');
    validatePassword($errors,$_POST,'password');
    validateNumber($errors,$_POST,'noTelp');
    validateName($errors,$_POST,'nama');
    validateEmail($errors,$_POST,'email');
    validateRequired($errors,$_POST);
    if (!$errors) { //mengecek apakah ada error atau tidak
        addCustomer($_POST['username'],$_POST['password'],$_POST['nama'],$_POST['tgl_lahir'],$_POST['jenisKelamin'],$_POST['alamat'],$_POST['noTelp'],$_POST['email']); //fungsi untuk menambah data customer
        addRek($_POST['no_rek'],$_POST['saldo'],$_POST['pin'],$_POST['username']); //fungsi untuk menambah data rekenening
        echo "success";
    }
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../css/daftarCustomer.css">
	<link rel="stylesheet" href="../css/master.css">
	<title>I BANKING</title>
</head>
<body>
    <!-- menampilkan form untuk menambah kustomer -->
	<!--HEADER-->
	<?php include 'header.inc'; ?>

	<!--CONTENT-->
	<div class="content">
		<form class=""  method="post">
			<div class="row">
				<div class="col">
					<p>Username</p>
				</div>
				<div class="col">
					<input type="text" name="username" placeholder="username" value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>"><?php if (isset($errors['username'])) echo $errors['username']; ?><br>
                    <!-- menampilkan pesan  error (jika ada) dan isi field yang sebelumnya sudah diketik akan tampil -->
            	</div>
			</div>
			<div class="row">
				<div class="col">
					<p>Password</p>
				</div>
				<div class="col">
					<input type="password" name="password" placeholder="password" value="<?php if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>"><?php if (isset($errors['password'])) echo $errors['password']; ?><br>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<p>Nama Nasabah</p>
				</div>

				<div class="col">
					<input type="text" name="nama" placeholder="Nama" value="<?php if(isset($_POST['nama'])) echo htmlspecialchars($_POST['nama']); ?>"><?php if (isset($errors['nama'])) echo $errors['nama']; ?><br>
            	</div>
			</div>
			<div class="row">
				<div class="col">
					<p>Tanggal Lahir</p>
				</div>
				<div class="col">
					<input type="date" name="tgl_lahir" value="<?php if(isset($_POST['tgl_lahir'])) echo htmlspecialchars($_POST['tgl_lahir']); ?>"><?php if (isset($errors['tgl_lahir'])) echo $errors['tgl_lahir']; ?><br>
            	</div>
			</div>
			<div class="row">
				<div class="col">
					<p>Jenis Kelamin</p>
				</div>
				<div class="col">
					<input type="radio" name="jenisKelamin" value="1" checked>Laki Laki <br>
            		<input type="radio" name="jenisKelamin" value="0">Perempuan <br>
            	</div>
			</div>
			<div class="row">
				<div class="col">
					<p>Alamat</p>
				</div>
				<div class="col">
					<textarea name="alamat" rows="8" cols="80" placeholder="alamat"><?php if(isset($_POST['alamat'])) echo htmlspecialchars($_POST['alamat']); ?></textarea><?php if (isset($errors['alamat'])) echo $errors['alamat']; ?><br>
            	</div>
			</div>
			<div class="row">
				<div class="col">
					<p>No Ponsel</p>
				</div>
				<div class="col">
					<input type="text" name="noTelp" placeholder="No Hp" value="<?php if(isset($_POST['noTelp'])) echo htmlspecialchars($_POST['noTelp']); ?>"><?php if (isset($errors['noTelp'])) echo $errors['noTelp']; ?><br>
            	</div>
			</div>
			<div class="row">
				<div class="col">
					<p>Email</p>
				</div>
				<div class="col">
					<input type="text" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>"><?php if (isset($errors['email'])) echo $errors['email']; ?><br>
            	</div>
			</div>
			<div class="row">
				<div class="col">
					<p>No Rekening</p>
				</div>
				<div class="col">
					<input type="text" name="no_rek" placeholder="No rek" value="<?php if(isset($_POST['no_rek'])) echo htmlspecialchars($_POST['no_rek']); ?>"><?php if (isset($errors['no_rek'])) echo $errors['no_rek']; ?><br>
            	</div>
			</div>
			<div class="row">
				<div class="col">
					<p>Saldo</p>
				</div>
				<div class="col">
					<input type="number" name="saldo" placeholder="saldo" value="<?php if(isset($_POST['saldo'])) echo htmlspecialchars($_POST['saldo']); ?>"><?php if (isset($errors['saldo'])) echo $errors['saldo']; ?><br>
            	</div>
			</div>
			<div class="row">
				<div class="col">
					<p>PIN</p>
				</div>
				<div class="col">
					<input type="text" name="pin" placeholder="PIN" value="<?php if(isset($_POST['pin'])) echo htmlspecialchars($_POST['pin']); ?>"><?php if (isset($errors['pin'])) echo $errors['pin']; ?><br>
            	</div>
			</div>
			<div class="row">
				<div class="col">
					<p>&nbsp;</p>
				</div>
				<div class="col">
					<input type="submit" name="submit" value="Submit">
				</div>
			</div>

    	</form>
	</div>
	<!--FOOTER-->
	<?php include 'footer.inc'; ?>
</body>
</html>
