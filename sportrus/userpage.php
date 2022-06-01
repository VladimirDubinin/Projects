<?php 
session_start();
if(!isset($_GET['id'])) {
	header('Location: http://sportrus/');
}
else $id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>SportRus</title>
	<link rel="stylesheet" href="css\main.css">
	<link rel="stylesheet" href="css\comm.css">
</head>
<body>
	<div class="cite-body">
		<main class="container">
		<?php 
		require('inc/header.php'); 
		$q = $db->query("SELECT * FROM users WHERE id = '$id'");
		if($q->num_rows == 1) {
			$user = $q->fetch_assoc();
			$date = date('d.m.Y H:i',strtotime($user['regdate']))
			?>
			<h1><?=$user['login']?></h1>
			<div class="user-info">
				<div class="user-img"><img width="125" alt="avatar" height="125" src="<?=$user['avatar']?>"></div>
				<div class="comment-text">Дата регистрации: <?=$date?></div>
				<div class="comment-text">Фамилия: <?=$user['surname']?></div>
				<div class="comment-text">Имя: <?=$user['name']?></div>
				<div class="comment-text">Отчество: <?=$user['lastname']?></div>
				<div class="comment-text">О себе: <?=$user['about']?></div>
			</div>				
		<?php 
		} else {
		?>
			<h1>Пользователь не найден</h1>
		<?php 
		}
		?>
		
		</main><br><br>
		<?php require('inc/footer.php'); ?>
	</div>
</body>
</html>