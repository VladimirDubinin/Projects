<?php // модуль для смены информации о пользователе в личном кабинете
if(isset($_POST['id'],$_POST['surn'],$_POST['name'],$_POST['lastn'],$_POST['about'])) {
	$id = $_POST['id'];
	$surn = trim($_POST['surn']);
	$name = trim($_POST['name']);
	$lastn = trim($_POST['lastn']);
	$about = trim($_POST['about']);
	require('dbconnect.php');
	$db->query("UPDATE users SET surname = '$surn', name = '$name', lastname = '$lastn', about = '$about'  WHERE id = '$id'");
	echo 'Success';
} 
else echo 'Error';