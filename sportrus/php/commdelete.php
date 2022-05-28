<?php
if(isset($_POST['id'])) {
	$id = $_POST['id'];
	require('dbconnect.php');
	$db->query("DELETE FROM comments WHERE comm_id = '$id'");
	echo "Success";
}	
else echo 'Error';