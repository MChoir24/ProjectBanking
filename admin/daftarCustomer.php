<?php
require './admin_permission.inc'; //masuk kehalaman admin_permission dulu untuk ducek apakah yang login sebagai admin atau bukan
include '../php/sql.php'; //import fungsi di sql.php
$customer = selectAll('CUSTOMER'); //mengambil semua data yang ada di table customer disimpan ke variable $customers
 ?>

 <!-- menampilkan daftar customer dalam bentuk tabel -->
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../css/daftarCustomer.css">
    <link rel="stylesheet" href="../css/master.css">
	<title>I BANKING</title>
</head>
<body>
	<!--HEADER-->
	<div class="header">
		<a href="./index.php"><img src="../gambar/Logo.png" alt="dcs" width="45" height="48" id="dcs"></a>
		<img src="../gambar/ebanking.png" alt="dcs" width="280" height="50" id="dc">
	</div>
	<div class="menu">
		<ul>
			<li style="float: left;"><a href="../admin/addCustomer.php">Add</a></li>
			<li style="float: right;"><a class= "active" href="../logout.php">Logout</a></li>
		</ul>
	</div>

	<!--CONTENT-->

	<div class="content">
	<?php
	echo "<table class=\"table\">
	<tr>
		<th>Nama Nasabah</th><th>tanggal lahir</th><th>Jenis Kelamin</th><th>Alamat</th><th>No Hp</th><th>Email</th><th>action</th>
	</tr>";
	foreach ($customer as $key => $value) { //iterasi untuk menampilkan data yang ada di var $customer
		// $nama = getCol('REKENING','NAMA_NASABAH','USERNAME',$value['USERNAME'])[0]; //mengambil data di table rekening pada kolom nama nasabah menurut username
		$jenisKelamin = jenisKelamin($value['JENIS_KELAMIN']); //menentukan jenis kelamin laki" = 1 perempuan = 0

			echo "<tr>";
			echo "<td>{$value['NAMA']}</td><td>{$value['TGL_LAHIR']}</td><td>$jenisKelamin</td><td>{$value['ALAMAT']}</td><td>{$value['NO_TELP']}</td><td>{$value['EMAIL']}</td><td><a href=\"../admin/edit.php?id={$value['USERNAME']}\">edit</a> <a href=\"../admin/deleteCustomer.php?id={$value['USERNAME']}\">delete</a> <a href=\"../admin/detail.php?id={$value['USERNAME']}\">detail</a></td>"; //menampilkan data ke tabel menurut kolomnya.

			echo "</tr>";
	}
	echo "</table>";
		?>

	</div>
	<!--FOOTER-->
	<div id="footer">
		<img src="../gambar/Logo.png" alt="no image" height="120" width="120">
		<p> &copy; Copyright 2018 Online Banking - Pengembangan Aplikasi Web</p>
	</div>
</body>
</html>
