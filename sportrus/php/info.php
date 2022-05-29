<?php
$id = $_POST['id'];
$surn = trim($_POST['surn']);
$name = trim($_POST['name']);
$lastn = trim($_POST['lastn']);
$about = trim($_POST['about']);
require('dbconnect.php');
$db->query("UPDATE users SET surname = '$surn', name = '$name', lastname = '$lastn', about = '$about'  WHERE id = '$id'");
echo 'Success';