<?php
$id = $_POST['id'];
$surn = $_POST['surn'];
$name = $_POST['name'];
$lastn = $_POST['lastn'];
$about = $_POST['about'];
require('dbconnect.php');
$db->query("UPDATE users SET surname = '$surn', name = '$name', lastname = '$lastn', about = '$about'  WHERE id = '$id'");
echo 'Success';