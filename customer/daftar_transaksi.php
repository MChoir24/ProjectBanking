<?php
// session_start();
require '../public/customer_permission.inc'; //memeriksa user apakah customer atau bukan
include '../php/sql.php';
$SelfNoRek = getCol('REKENING','NO_REKENING','USERNAME',$_SESSION['user']['USERNAME']);

 ?>
 <!-- menamplkan data customer -->
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../css/daftar_transaksi.css">
    <link rel="stylesheet" href="../css/master.css">
	<title>I BANKING</title>
</head>
<body>
	<!--HEADER-->
	<?php include 'header.inc'; ?>

	<!--CONTENT-->
	<?php echo "<br>" ?>
	<form class="select" method="post">
        <select class="" name="selfNoRek">
            <?php foreach ($SelfNoRek as $key => $value): ?>
                <option value="<?php echo $value['NO_REKENING'] ?>"><?php echo $value['NO_REKENING'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="submit" value="lihat">
    </form>
	<?php
        if (isset($_POST['submit']))
        {
            $dataRiwayat = getTransaksi($_POST['selfNoRek']);
            echo "<table class=\"table\" >
                    <tr>
                        <th>Id</th><th>tanggal</th><th>debet</th><th>kredit</th><th>Saldo</th>
                    </tr>";
            foreach ($dataRiwayat as $key => $value) {
                echo "<tr>
                        <td>{$value['NO_TRANSAKSI']}</td><td>{$value['TANGGAL']}</td>";
                if ($value['jenis']==1) {
                    echo "<td>Rp". number_format($value['NOMINAL'],2)."</td><td>-</td>";
                }
                else {
                    echo "<td>-</td><td> Rp". number_format($value['NOMINAL'],2)."</td>";
                }
                echo "<td>Rp ". number_format($value['SALDO'],2)."</td></tr>";
            }
            echo "</table>";
        }
    ?>

	<!--FOOTER-->
	<?php include 'footer.inc'; ?>
</body>
</html>
