<?php
$title = $_POST['title'];
$theme = $_POST['theme'];
$short = $_POST['short'];
$body = $_POST['body'];
$author = $_POST['author'];
$img = $_FILES['img'];

$path = 'img/news/'.mt_rand(0, 100000).'_'.$img['name'];
move_uploaded_file($img['tmp_name'],'../'.$path);
	
require('dbconnect.php');
$db->query("INSERT INTO news(title,theme,short,body,author,img) VALUES ('$title','$theme','$short','$body','$author','$path')");
header('Location: http://sportrus/adminpanel.php');
