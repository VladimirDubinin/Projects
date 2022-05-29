<?php
if(isset($_POST['id']) && isset($_POST['comm']) && isset($_POST['theme'])) {
	$id = $_POST['id'];
	$comm = $_POST['comm'];
	$theme = $_POST['theme'];
	require('dbconnect.php');
	$db->query("INSERT INTO reviews(user_id,theme,message) VALUES ('$id','$theme','$comm')");
	echo 'Success';
}	
else echo 'Error';