<?php
session_start(); //memulai sebuah SESSION
require '../public/customer_permission.inc';
include '../php/sql.php'; //mengimport semua fungsi pada file sql.php
include '../php/validate.php';
$SelfNoRek = array();
$err = '';
$errors = array();
foreach (getCol('REKENING','NO_REKENING','USERNAME',$_SESSION['user']['USERNAME']) as $key => $value) {
    $SelfNoRek[$key]=$value;

}
// echo $SelfNoRek[0][0];
if (isset($_POST['transfer'])) { //mengecek apakah tombol submit transfer sudah ditekan
    validateNoRek($errors, $_POST, 'no_rekening');
    validateRequired($errors,$_POST);
    if (!$errors) {
        $sisa = getCol('REKENING','SALDO','NO_REKENING',$_POST['selfNoRek']); //mengambil data saldo pada pada user yang sudah login.
        $sisa2 = getCol('REKENING','SALDO','NO_REKENING',$_POST['no_rekening']); //mengambil nilai data saldo pada user yang akan dikirim
        $pin = getCol('REKENING','PIN','NO_REKENING',$_POST['selfNoRek']); //mengambil nilai PIN pada user yang akan dikirim
    	if ($sisa2){ //mengecek apakah user yang akan menerma transfer ada atau tidak
            if ($sisa[0][0] >= $_POST['nominal']) { //mengecek apakah saldo mencukupi untuk transfer
                if ($pin[0][0] == $_POST['pin']) {
                    $sisa[0][0] -= $_POST['nominal']; //mengurangi saldo pada user yang mentransfer
                    $sisa2[0][0] += $_POST['nominal']; //menambah saldo pada user yang akan ditransfer
                    // echo $_SESSION['user']['no_rek'];

                    set2col('REKENING','SALDO',$sisa[0][0], 'NO_REKENING', $_POST['selfNoRek']); //men-set saldo yang baru pada user
                    set2col('REKENING','SALDO', $sisa2[0][0],'NO_REKENING', $_POST['no_rekening']); //men-set saldo yang baru pada user
                    recordTransaksi($_POST['selfNoRek'],$_POST['no_rekening'],$_POST['nominal'],$sisa[0][0],$sisa2[0][0]);
                    header('Location: ./sukses.php');
                }
                else {
                    $errors['pin'] = "<span class=\"err\">pin salah</span>";
                }
            }
            else { //jika saldo kurang
                $err = "<span class=\"err\">sisa saldo kurang</span>";
            }
        }
        else { //jika no rek salah
            $errors['no_rekening'] =  "<span class=\"err\">no rekening tujuan anda salah</span>";
        }
    }
}
?>
<!-- menampilkan form tranfer -->
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../css/daftar_rekening.css">
	<link rel="stylesheet" href="../css/master.css">
	<title>I BANKING</title>
</head>
<body>
	<!--HEADER-->
	<?php include 'header.inc'; ?>

	<!--CONTENT-->
	<div class="content">
        <?php echo "$err"; ?>
		<form class=""  method="post">
			<div class="row">
				<div class="col">
					<p>No Rekening</p>
				</div>
				<div class="col">
					<select class="" name="selfNoRek">
						<?php foreach ($SelfNoRek as $key => $value): ?>
				            <option value="<?php echo $value[0];?>"> <?php echo $value[0]; ?> </option>
				        <?php endforeach; ?>
				    </select>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<p>No Rekening Tujuan</p>
				</div>
				<div class="col">
					<input type="text" name="no_rekening" placeholder="No Rekening Tujuan" value="<?php if(isset($_POST['no_rekening'])) echo htmlspecialchars($_POST['no_rekening']); ?>"> <?php if (isset($errors['no_rekening'])) echo $errors['no_rekening']; ?>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<p>Nominal</p>
				</div>
				<div class="col">
					<input type="number" name="nominal" value="<?php if ($errors) {echo $_POST['nominal'];} else echo "100"; ?>" placeholder="nominal" max="1000000000" min="100"> <?php if (isset($errors['nominal'])) echo $errors['nominal']; ?>
				</div>
			</div>
            <div class="row">
                <div class="col">
                    <p>PIN</p>
                </div>
                <div class="col">
                    <input type="password" name="pin" value="" placeholder="pin"> <?php if (isset($errors['pin'])) echo $errors['pin']; ?>
                </div>
            </div>
			<div class="row">
				<div class="col">
					<input type="submit" name="transfer" value="Transfer">
				</div>
			</div>
		</form>
	</div>
	<!--FOOTER-->
	<?php include 'footer.inc'; ?>
</body>
</html>
