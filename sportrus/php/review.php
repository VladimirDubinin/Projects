<?php // модуль для загрузки нового отзыва в БД
if(isset($_POST['id'],$_POST['comm'],$_POST['theme'])) {
	$id = $_POST['id'];
	$comm = trim($_POST['comm']);
	$theme = trim($_POST['theme']);
	require('dbconnect.php');
	$db->query("INSERT INTO reviews(user_id,theme,message) VALUES ('$id','$theme','$comm')");
	echo 'Success';
}	
else echo 'Error';