<?php
session_start();
if(isset($_SESSION['userid'])) {
	header("Location: http://sportrus/usercabinet.php");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>SportRus</title>
	<link rel="stylesheet" href="css\app.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/regist.js"></script>
</head>
<body>
	<div class="form-body">
		<div class="logo">
			<a href="index.php"><img width="100" height="100" alt="Logo" src="img/logo.png"></a>
		</div>
		
		<form method="POST" action="" class="form-reg" id="formreg">
			<p>Регистрация</p>
			<input type="text" name="login" id="login" class="input-reg" placeholder="Введите логин"><br>
			<input type="password" name="pass" id="pass" class="input-reg" placeholder="Введите пароль"><br>
			<input type="submit" class="btn-reg" id="btnreg" value="Зарегистрироваться">
			<div class="message" id="message"></div>
		</form>
		
	<?php require('inc/footer.php'); ?>
	</div>
</body>
</html>	