<?php // модуль для добавления новости (из adminpanel.php)
if (isset($_POST['title'],$_POST['theme'],$_POST['short'],$_POST['body'],$_POST['author'],$_FILES['img'])) {
	$title = trim($_POST['title']);
	$theme = trim($_POST['theme']);
	$short = trim($_POST['short']);
	$body = trim($_POST['body']);
	$author =trim( $_POST['author']);
	$img = $_FILES['img'];
	// Фильтр расширений файлов для добавления картинки
	$ftype = mb_strtolower(end(explode(".",$img['name'])));
	$goodtypes = ['png','jpg','jpeg'];
	if(in_array($ftype,$goodtypes)) {
		// если подходит, загружаем картинку на сервер в папку img, в базу путь.
		$path = 'img/news/'.mt_rand(0, 100000).'_'.$img['name'];
		move_uploaded_file($img['tmp_name'],'../'.$path);	
		require('dbconnect.php'); // подключение к базе
		$db->query("INSERT INTO news(title,theme,short,body,author,img) VALUES ('$title','$theme','$short','$body','$author','$path')");
	}
}
header('Location: http://sportrus/adminpanel.php');
