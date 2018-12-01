<?php
require '../public/admin_permission.inc'; //masuk kehalaman admin_permission dulu untuk ducek apakah yang login sebagai admin atau bukan
include '../php/sql.php'; //import semua fungsi yang ada di sql.php
include '../php/validate.php'; //import semua fungsi yang ada di sql.php
$id = $_GET['id']; //mengambil data yang dikirim melalui url (GET)
$errors = array();
if (isset($_POST['submit'])) { //mengecek apakah sudah ditekan tombol submit
    validatePIN($errors,$_POST,'pin'); //validasi untuk form
	validateNoRek($errors, $_POST, 'no_rek');
    validateRequired($errors,$_POST);
	if (!$errors) { //dicek apakah ada yang error pada inputan
		addRek($_POST['no_rek'],$_POST['saldo'],$_POST['pin'],$id);
	    header("location: detail.php?id=$id");
	}

} ?>
<!-- menampilkan form untuk tmabah rekening -->
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../css/daftarCustomer.css">
	<link rel="stylesheet" href="../css/master.css">
	<title>I BANKING</title>
</head>
<body>
	<!-- include file header.inc-->

	<?php include 'header.inc';; ?>
	<!--CONTENT-->
	<div class="content">
		<form class="" action="" method="post">
			<div class="row">
				<div class="col">
					<p>No Rekening</p>
				</div>
				<div class="col">
					<input type="text" name="no_rek" placeholder="no rekening" value="<?php if(isset($_POST['no_rek'])) echo htmlspecialchars($_POST['no_rek']); ?>"><?php if (isset($errors['no_rek'])) echo $errors['no_rek']; ?>
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
					<p>Saldo</p>
				</div>
				<div class="col">
					<input type="number" name="saldo" placeholder="saldo" value="<?php if(isset($_POST['saldo'])) echo htmlspecialchars($_POST['saldo']); ?>"><?php if (isset($errors['saldo'])) echo $errors['saldo']; ?><br>
            	</div>
			</div>
			<div class="row">
				<div class="col">
					&nbsp;
				</div>
				<div class="col">
					<input type="submit" name="submit" value="submit">
				</div>
			</div>
		</form>
	</div>
	<!--FOOTER-->
	<?php include 'footer.inc'; ?>
</body>
</html>
