<?php // Подключение к базе: хост, логин, пароль, название БД.
$db_adress = 'localhost';
$db_login = 'root';
$db_pass = '';
$db_name = 'testtask';
$db = mysqli_connect($db_adress,$db_login,$db_pass,$db_name);