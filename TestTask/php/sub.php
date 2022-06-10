<?php
if(isset($_POST['fio'],$_POST['email'],$_POST['datetime'])) {
	
	$fio = $_POST['fio'];
	$email = $_POST['email'];
	$date = $_POST['datetime'];
	
	require('dbconnect.php'); // Подключение к БД
	$db->query("INSERT INTO subs(fio,email,date) VALUES ('$fio','$email','$date')"); // отправляем данные о записи в базу
	
	mail('rbru-metrika@yandex.ru',$fio,$email.'; '.$date); // отправляем сообщение на почту
}
header("Location: http://testtask/"); // на главную