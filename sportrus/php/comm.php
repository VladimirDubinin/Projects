<?php
if(isset($_POST['id'],$_POST['comm'],$_POST['nid'])) {
	$id = $_POST['id'];
	$comm = trim($_POST['comm']);
	$newsid = $_POST['nid'];
	require('dbconnect.php');
	$db->query("INSERT INTO comments(user_id,news_id,comment) VALUES ('$id','$newsid','$comm')");
	echo 'Success';
}	
else echo 'Error';