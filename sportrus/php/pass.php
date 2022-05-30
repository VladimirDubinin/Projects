<?php
if(isset($_POST['id'],$_POST['oldpass'],$_POST['newpass1'])) {
	$id = $_POST['id'];
	$oldpass = trim($_POST['oldpass']); 
	$newpass = trim($_POST['newpass1']); 
	$oldpass = md5($oldpass); 
	$newpass = md5($newpass); 

	require('dbconnect.php');
	$q = $db->query("SELECT id,password FROM users WHERE id = '$id'")->fetch_assoc();
	if ($q['password'] == $oldpass) {
		$db->query("UPDATE users SET password = '$newpass' WHERE id = '$id'");
		echo 'Success';
	} else echo $oldpass;
}
else echo 'Error';
