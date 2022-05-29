<?php
session_start();
if(!isset($_SESSION['userid'])) {
	header('Location: http://sportrus/authorization.php');
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>SportRus</title>
	<link rel="stylesheet" href="css\main.css">
	<link rel="stylesheet" href="css\comm.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/changeinfo.js"></script>
	<script type="text/javascript" src="js/changepass.js"></script>
</head>
<body>
	<div class="cite-body">
		<?php require('inc/header.php'); 
		
		$login = $_SESSION['userid'];
		$user = $db->query("SELECT * FROM users WHERE id = '$login'")->fetch_assoc();
		$date = date('d.m.Y H:i',strtotime($user['regdate']));
		?>
		
		<main class="container">
			<h1>Добро пожаловать, <?=$user['login']?>!</h1>
			<div class="comments-container">
				<div class="user-info">
					<div class="user-img"><img width="125" alt="avatar" height="125" src="<?=$user['avatar']?>"></div>
					<div class="user-text">Дата регистрации: <?=$date?></div>
					<div class="user-text">Фамилия: <?=$user['surname']?></div>
					<div class="user-text">Имя: <?=$user['name']?></div>
					<div class="user-text">Отчество: <?=$user['lastname']?></div>
					<div class="user-text">О себе: <?=$user['about']?></div>
				</div>		
				<form class="comment-add" id="form-info" action="" method="POST">
					<br>
					<p class="ms">ИЗМЕНИТЬ ПЕРСОНАЛЬНЫЕ ДАННЫЕ</p>
					<input type="text" class="write-theme" id="srname" name="srname" placeholder="Введите фамилию" maxlength="50" value="<?=$user['surname']?>">
					<input type="text" class="write-theme" id="name" name="name" placeholder="Введите имя" maxlength="50" value="<?=$user['name']?>">
					<input type="text" class="write-theme" id="lastname" name="lastname" placeholder="Введите отчество" maxlength="50" value="<?=$user['lastname']?>">
					<textarea class="write-com" id="about" name="about" placeholder="Введите информацию о себе" maxlength="255"><?=$user['about']?></textarea>
					<input type="hidden" id="userid" name="userid" value="<?=$_SESSION['userid']?>"><br>
					<input class="btn-change" id="send-info" type="submit" value="Изменить информацию">
				</form>	
				
				<?php if($_SESSION['userid'] != 1) { ?>			
				<form class="comment-add" id="form-pass" action="" method="POST">
					<p class="ms">ИЗМЕНИТЬ ПАРОЛЬ</p>
					<input type="password" class="write-pass" id="oldpass" name="oldpass" placeholder="Введите старый пароль" maxlength="20">
					<input type="password" class="write-pass" id="newpass1" name="newpass1" placeholder="Придумайте новый пароль" maxlength="20">
					<input type="password" class="write-pass" id="newpass2" name="newpass2" placeholder="Повторите новый пароль" maxlength="20">
					<input type="hidden" id="userid" name="userid" value="<?=$_SESSION['userid']?>"><br>
					<input class="btn-change" id="send-pass" type="submit" value="Изменить пароль">
				</form>	
				<?php } else echo '<a href="adminpanel.php"><button class="btn-change">Панель администратора</button></a>'?>
				
			</div>	
		</main>

		<?php 
		require('inc/footer.php'); 
		?>
	</div>
</body>
</html>