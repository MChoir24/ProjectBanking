<!-- menampilkan form untuk edit password -->
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
        <form class="" action="editPass.php" method="post">
            <div class="row">
                <div class="col">
                    <p>Password Lama</p>
                </div>
                <div class="col">
                    <input type="password" name="lastPass" value="" placeholder="Password Lama"> <?php if(isset($errors['lastPass'])) echo $errors['lastPass']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Password baru</p>
                </div>
                <div class="col">
                    <input type="password" name="newPass" value="" placeholder="Password Baru"> <?php if(isset($errors['newPass'])) echo $errors['newPass']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Confirm password</p>
                </div>
                <div class="col">
                    <input type="password" name="cNewPass" value="" placeholder="Konfirmasi Password Baru"><?php if(isset($errors['cNewPass'])) echo $errors['cNewPass']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="submit" name="update" value="update">
                </div>
            </div>

        </form>

	</div>
	<!--FOOTER-->
	<?php include 'footer.inc'; ?>
</body>
</html>
