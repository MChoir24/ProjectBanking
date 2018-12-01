<?php

require 'user_permission.inc'; //harus  mengakses file user_permission.inc terlebih dahulu

 if ($_SESSION['level'] == 'admin'){ //mengecek user yang login adalah sebagai admin
     include '../admin/daftarCustomer.php';

 } elseif ($_SESSION['level'] == 'customer'){ //mengecek user  yang login adalah sebagai customer
     include '../customer/daftarRekening.php'; //import file daftarRekening.php

 }?>
