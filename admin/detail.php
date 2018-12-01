<?php
require '../public/admin_permission.inc'; //masuk kehalaman admin_permission dulu untuk ducek apakah yang login sebagai admin atau bukan
include '../php/sql.php';
$id = $_GET['id'];
$customer = selectAll('CUSTOMER','USERNAME',$id)[0]; //mengambil semua data yang dimiliki oleh USERNAME tertentu pada table COSTUMER
$rekening = selectAll('REKENING','USERNAME',$id); //mengambil semua data yang dimiliki oleh USERNAME tertentu pada table REKENING
?>
<!-- menampilkan data lengkap customer dalam bentuk table -->
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
	<div class="content">
		<div class="row">
			<div class="col">
				<p>Nama</p>
			</div>
			<div class="col">
				<p><?php echo $customer['NAMA'];?></p>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p>Tanggal Lahir</p>
			</div>
			<div class="col">
				<p><?php echo $customer['TGL_LAHIR'] ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p>jenis kelamin</p>
			</div>
			<div class="col">
				<p>
				<?php
				if ($customer['JENIS_KELAMIN']) {
				   echo "Laki-Laki";
				}
				else {
				   echo "Perempuan";
				} ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p>Alamat</p>
			</div>
			<div class="col">
				<p><?php echo $customer['ALAMAT']; ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p>No Hp</p>
			</div>
			<div class="col">
				<p><?php echo $customer['NO_TELP']; ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p>Email</p>
			</div>
			<div class="col">
				<p><?php echo $customer['EMAIL']; ?></p>
			</div>
		</div>
		<?php foreach ($rekening as $key => $value): ?>
			<div class="row">
				<div class="col">
					<p>No Rekening</p>
				</div>
				<div class="col">
					<p><?php echo $value['NO_REKENING']; ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<p>Saldo</p>
				</div>
				<div class="col">
					<p><?php echo $value['SALDO']; ?></p>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="row">
			<div class="col">
				&nbsp;
			</div>
			<div class="col">
				<p><a href="./addRekening.php?id=<?php echo $id ?>">add rekening</a></p>
			</div>
		</div>
	</div>
	<!--FOOTER-->
	<?php include 'footer.inc'; ?>
</body>
</html>
