<?php // модуль для авторизации
session_start();
if(isset($_POST['login'],$_POST['pass'])) {
	$login = trim($_POST['login']);
	$pass = trim($_POST['pass']);
	$pass = md5($pass);
		
	require('dbconnect.php');
	$res = $db->query("SELECT id,login,password FROM users WHERE login = '$login' and password = '$pass'");
	if($res->num_rows == 1) { // если в базе найдено совпадение, происходит авторизация
		$user = $res->fetch_assoc();
		$_SESSION['username'] = $user['login'];
		$_SESSION['userid'] = $user['id'];
		echo 'Success';
	}
	else echo 'Error';
}
else echo 'None';