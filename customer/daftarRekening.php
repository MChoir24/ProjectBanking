
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../css/daftar_rekening.css">
	<link rel="stylesheet" href="../css/master.css">
	<title>I BANKING</title>
</head>
<body>
	<!--HEADER-->
	<div class="header">
	    <a href="Index.php"><img src="../gambar/Logo.png" alt="dcs" width="45" height="48" id="dcs"></a>
	    <img src="../gambar/ebanking.png" alt="dcs" width="280" height="50" id="dc">
	</div>
	<div class="menu">
	    <ul>
	        <li><a href="../customer/daftar_transaksi.php">Daftar Transaksi</a></li>
	        <li><a href="../customer/transfer.php">Transfer</a></li>
	        <li><a href="../customer/editPass.php">Edit</a></li>
	        <li><a href="../logout.php">Logout</a></li>
	    </ul>
	</div>


	<!--CONTENT-->
	<div class="content">
		<h1>Selamt Datang Di CP Internet Banking</h1>
		<?php
			// session_start();
			require '../public/customer_permission.inc'; //memeriksa user apakah customer atau bukan
			include '../php/sql.php';
			$customer = selectAll('CUSTOMER','USERNAME',$_SESSION['user']['USERNAME'])[0]; //mengambil semua data yang dmiliki oleh customer tertentu
			$rekening = selectAll('REKENING','USERNAME',$_SESSION['user']['USERNAME']);
			echo "<p>{$customer['NAMA']}</p>";

			foreach ($rekening as $key => $value) {
				echo "<div class=\"row\">
                    <div class=\"col\">
                        <p>No Rekening</p>
                    </div>
                    <div class=\"col\">
                        <p>{$value['NO_REKENING']}</p>
                    </div>
                </div>
				<div class=\"row\">
                    <div class=\"col\">
                        <p>Saldo</p>
                    </div>
                    <div class=\"col\">
                        <p>Rp ".number_format($value['SALDO'],2)."</p>
                    </div>
                </div>";

			}
			?>
	</div>
	<!--FOOTER-->
	<?php include 'footer.inc'; ?>
</body>
</html>
