<?php // модуль для регистрации
session_start();
if(isset($_POST['login'],$_POST['pass'])) {
	$login = trim($_POST['login']);
	$pass = trim($_POST['pass']);
	$pass = md5($pass);
		
	require('dbconnect.php');
	$q = $db->query("SELECT login FROM users WHERE login = '$login'");
	if($q->num_rows == 0) { // если совпадений не найдено, данные пользователя загружаются в базу
		$db->query("INSERT INTO users(login,password) VALUES ('$login','$pass')");
		$rez = $db->query("SELECT id,login FROM users WHERE login = '$login'"); //узнать id нового пользователя
		$user = $rez->fetch_assoc(); 
		$_SESSION['username'] = $user['login']; // авторизация
		$_SESSION['userid'] = $user['id'];
		echo 'Success';
	}
	else echo 'Error';
}
else echo 'None';