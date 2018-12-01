<?php
require 'user_permission.inc';
if ($_SESSION['level'] != 'customer') {
    die('anda tidak dizinkan mengakses halaman ini!');
}
 ?>
