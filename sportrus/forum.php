<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>SportRus</title>
	<link rel="stylesheet" href="css\main.css">
	<link rel="stylesheet" href="css\comm.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/sendreview.js"></script>
</head>
<body>
	<div class="cite-body">
		<?php require('inc/header.php'); ?>
		
		<main class="container">
			<h1>Отзывы и предложения</h1>
			<div class="comments-container">
				<?php if(isset($_SESSION['userid'])) {?>
				<form class="comment-add" id="form-comment" action="" method="POST">
					<p class="ms">Добавить отзыв</p>
					<input type="text" class="write-theme" id="theme" name="theme" placeholder="Введите тему" maxlength="50">
					<textarea class="write-com" id="comm" name="comm" placeholder="Введите отзыв" maxlength="2048"></textarea>
					<input type="hidden" id="userid" name="userid" value="<?=$_SESSION['userid']?>"><br>
					<input class="btn-send" id="send" type="submit" value="Опубликовать">
				</form>	
				<p class="ms">ОТЗЫВЫ</p><br>
				<?php 
				} else echo '<hr><p class="ms">ОТЗЫВЫ</p>';;
				$q = $db->query("SELECT * FROM reviews INNER JOIN users ON reviews.user_id = users.id ORDER BY reviews.date DESC");
				foreach ($q as $res) {
					$date = date('H:i d.m.Y ',strtotime($res['date']));
				?>
					<div class="review">
						<div class="comment-name"><a href="userpage.php?id=<?=$res['id']?>"><?=$res['login']?></a></div>
						<div class="comment-info"><?=$date?></div>
						<div class="comment-text">Тема: <?=$res['theme']?></div>
						<div class="comment-text"><?=$res['message']?></div>
					</div>	
				<?php
				}	
				?>
			</div>				
		</main>

		<?php require('inc/footer.php'); ?>
	</div>
</body>
</html>