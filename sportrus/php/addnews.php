<?php
if (isset($_POST['title']) && isset($_POST['theme']) && isset($_POST['short']) && isset($_POST['body']) && isset($_POST['author']) && isset($_FILES['img'])) {
	$title = trim($_POST['title']);
	$theme = trim($_POST['theme']);
	$short = trim($_POST['short']);
	$body = trim($_POST['body']);
	$author =trim( $_POST['author']);
	$img = trim($_FILES['img']);

	$ftype = mb_strtolower(end(explode(".",$img['name'])));
	$goodtypes = ['png','jpg','jpeg'];
	if(in_array($ftype,$goodtypes)) {
		$path = 'img/news/'.mt_rand(0, 100000).'_'.$img['name'];
		move_uploaded_file($img['tmp_name'],'../'.$path);	
		require('dbconnect.php');
		//echo "INSERT INTO news(title,theme,short,body,author,img) VALUES ('$title','$theme','$short','$body','$author','$path')";
		$db->query("INSERT INTO news(title,theme,short,body,author,img) VALUES ('$title','$theme','$short','$body','$author','$path')");
	}
}
header('Location: http://sportrus/adminpanel.php');
