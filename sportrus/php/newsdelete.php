<?php // модуль для удаления новости из БД
if(isset($_POST['id'])) {
	$id = $_POST['id'];
	require('dbconnect.php');
	$img = $db->query("SELECT img FROM news WHERE id = '$id'")->fetch_assoc();
	if(file_exists('../'.$img['img'])) unlink('../'.$img['img']);
	$db->query("DELETE FROM news WHERE id = '$id'");
	$db->query("DELETE FROM comments WHERE news_id = '$id'");
	echo "Success";
}	
else echo 'Error';

