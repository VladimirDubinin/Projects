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
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/sendcomm.js"></script>
	<script type="text/javascript" src="js/deletecomm.js"></script>
</head>
<body>
	<div class="cite-body">
		<?php require('inc/header.php'); ?>
		
		<main class="container">
		<?php
		$q = $db->query("SELECT * FROM news INNER JOIN sports ON theme=sport_id WHERE id = '$id'");
		if($q->num_rows == 1) {
			$news = $q->fetch_assoc();
			$date = date('d.m.Y h:i',strtotime($news['date'])); 
			?>
			<div class="container-view">
				<div class="ms2"><a href="allsport.php?sport=<?=$news['sport_id']?>&page=1"><?=$news['sport_name']?></a></div>
				<h1><?=$news['title']?></h1>
				<p class="ms2"><?=$news['author']?>   <?=$date?></p>
				<img src="<?=$news['img']?>" alt="<?=$news['title']?>" width="650" height="365">
				<div class="news-form-p">
					<span><?=nl2br($news['body'])?></span>
				</div>			
			</div>
			<div class="container-add">
				<p class="ms">ПОХОЖИЕ НОВОСТИ</p><hr>
				<?php
				$theme = $news['theme'];
				$title = $news['title'];
				$q = $db->query("SELECT id,title,theme,date FROM news WHERE theme = '$theme' AND title<>'$title' ORDER BY date DESC LIMIT 10");
				foreach ($q as $news) {
				?>
					<ul>
						<li><a href="viewing.php?id=<?=$news['id']?>"><?=$news['title']?></a></li>
					</ul>
				<?php 
				} 
				?>
			</div>	
			
			<div class="comments-container">
				<?php if(isset($_SESSION['userid'])) { ?>
				<form class="comment-add" id="form-comment" action="" method="POST">
					<p class="ms">Добавить комментарий</p><br>
					<textarea class="write-com" id="comm" name="comm" placeholder="Введите комментарий" maxlength="255"></textarea>
					<input type="hidden" id="newsid" name="newsid" value="<?=$id?>">
					<input type="hidden" id="userid" name="userid" value="<?=$_SESSION['userid']?>"><br>
					<input class="btn-send" id="send" type="submit" value="Отправить">
				</form>	
				<p class="ms">КОММЕНТАРИИ</p><br>
				<?php 
				} else { ?>
				<div class="comment-add">
					<p class="ms">Авторизуйтесь, чтобы добавить комментарий</p><br>
				</div>	
				<p class="ms">КОММЕНТАРИИ</p><br>
				<?php } 
				$q = $db->query("SELECT * FROM comments INNER JOIN users ON comments.user_id = users.id WHERE news_id = '$id' ORDER BY date DESC");
				foreach ($q as $res) {
					$date = date('H:i d.m.Y ',strtotime($res['date']));
					?>
					<form class="comment" id="form-comment" action="" method="POST">
						<img class="comment-img" alt="avatar" src="<?=$res['avatar']?>">
						<?php 
						if(isset($_SESSION['userid'])) {
							if($res['user_id'] == $_SESSION['userid']) {?>
							<input type="hidden" value="<?=$res['comm_id']?>" id="com-id">
							<button id="del" class="comment-del"><img width="14" alt="delete" height="14" src="img/X.jpg"></button>
							<?php 
							} 
						}
						?>
						<div class="comment-name"><a href="userpage.php?id=<?=$res['id']?>"><?=$res['login']?></a></div>
						<div class="comment-info"><?=$date?></div>
						<div class="comment-text"><?=$res['comment']?></div>
					</form>	
				<?php
				}	
				?>
			</div>	
		<?php
		} else {
		?>
		<h1>Новость не найдена</h1>
		<?php
		}	
		?>
		</main>

		<?php require('inc/footer.php'); ?>
	</div>
</body>
</html>