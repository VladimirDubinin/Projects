<?php
session_start();
if(isset($_POST['login']) && isset($_POST['pass'])) {
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	$pass = md5($pass);
		
	require('dbconnect.php');
	$q = $db->query("SELECT login FROM users WHERE login = '$login'");
	if($q->num_rows == 0) {
		$db->query("INSERT INTO users(login,password) VALUES ('$login','$pass')");
		$rez = $db->query("SELECT id,login FROM users WHERE login = '$login'");
		$user = $rez->fetch_assoc();
		$_SESSION['username'] = $user['login'];
		$_SESSION['userid'] = $user['id'];
		echo 'Success';
	}
	else echo 'Error';
}
else echo 'None';