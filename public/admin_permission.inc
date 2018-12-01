<?php
require 'user_permission.inc';
if ($_SESSION['level'] != 'admin') {
    die('anda tidak dizinkan mengakses halaman ini!');
}
 ?>
