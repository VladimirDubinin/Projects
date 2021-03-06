<?php 
session_start();
if($_SESSION['userid'] != 1) { // страница ТОЛЬКО для админа. можно добавить или удалить новость
	header('Location: http://sportrus/');
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
	<script type="text/javascript" src="js/deletenews.js"></script>
</head>
<body>
	<div class="cite-body">
		<?php require_once('inc/header.php'); ?>
		<main class="container">
			<h1>Панель администратора</h1>
			<form class="comment-add" action="php/addnews.php" method="POST" enctype="multipart/form-data">
				<p class="ms">ДОБАВИТЬ НОВОСТЬ</p><br>
				<input type="text" class="write-news" id="title" name="title" maxlength="100" placeholder="Введите заголовок" required>
				<label class="lab">Выберите тему
				<select class="select-news" id="theme" name="theme">
					<option value="1" selected>Футбол</option>
					<option value="2">Хоккей</option>
					<option value="3">Баскетбол</option>
					<option value="4">Волейбол</option>
					<option value="5">Киберспорт</option>
				</select>
				</label>
				<input type="text" class="write-news" id="short" name="short" maxlength="255" placeholder="Введите краткое описание" required>
				<textarea class="write-news-text" id="body" name="body" rows="10" placeholder="Введите текст новости" required></textarea>	
				<input type="text" class="write-news" id="author" name="author" maxlength="50" placeholder="Введите имя автора" required>
				<input type="file" class="write-news" id="img" name="img" maxlength="100" required><br><br>
				<input class="btn-send" id="send" type="submit" value="Добавить">
			</form>	
			<p class="ms">ВСЕ НОВОСТИ</p><br>
			<div class="comments-container">
			<?php	
			$q = $db->query("SELECT * FROM news ORDER BY date DESC");
			foreach ($q as $res) { // список всех новостей (с возможностью удаления)
				$date = date('H:i d.m.Y ',strtotime($res['date']));
			?>
			
			<form class="news-small" id="form-comment" action="" method="POST">
				<div class="news-small-head"><a href="viewing.php?id=<?=$res['id']?>"><?=$res['title']?></a></div>
				<input type="hidden" value="<?=$res['id']?>" name="news-id" id="news-id">
				<button id="del" class="comment-del"><img width="14" alt="delete" height="14" src="img/X.jpg"></button>
				<img class="news-small-img" alt="avatar" src="<?=$res['img']?>">
				<div class="news-small-body"><small><?=$date?></small></div>
				<div class="news-small-body"><?=$res['short']?></div>
			</form>	
			
			<?php
			}	
			?>
			</div>
		</main>
		<?php require_once('inc/footer.php'); ?>
	</div>
</body>
</html>