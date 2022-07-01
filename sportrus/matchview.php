<?php 
session_start();
if(!isset($_GET['id'])) { // страница просмотра матча, если id матча не указан, редирект на главную
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
	<link rel="stylesheet" href="css\tables.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/sendcomm.js"></script>
	<script type="text/javascript" src="js/deletecomm.js"></script>
</head>
<body>
	<div class="cite-body">
		<?php require_once('inc/header.php'); ?>
		
		<main class="container">
		<?php // Данные о матче
		$q = $db->query("SELECT * FROM matches INNER JOIN sports ON sport=sport_id WHERE id = '$id'");
		if($q->num_rows == 1) { 
			$match = $q->fetch_assoc();
			$date = date('h:i d.m.Y',strtotime($match['date']));
			$sport_id = $match['sport_id'];
			?>
			<div class="container-matchview">
				<div class="container-match-head">
					<p class="ms2"><a href="allsport.php?sport=<?=$sport_id?>&page=1"><?=$match['sport_name']?></a><?=" &bull; ".$match['tour']?></p>
					<h1><?=$match['hostteam'].' - '.$match['guestteam']?></h1>
					<p><?=$date?></p>
				</div>	
			</div>

			<video preload="auto" class="videoplayer" controls src="<?=$match['link']?>"></video>

			<div class="container-matchadd">
				<p class="match-add-head">МАТЧИ ТУРА</p><hr>
				<?php // Вывод списка похожих матчей
				$q = $db->query("SELECT * FROM matches INNER JOIN sports ON sport = sport_id WHERE sport = $sport_id ORDER BY date DESC LIMIT 10");
				foreach ($q as $match) {
					if($match['ended'] == false) {
						$date = strtotime($match['date']);
						$separator = date('H',$date).' : '.date('i',$date);	//чтобы внешне отличать несыгранные и сыгранные матчи
					} else {
						$separator = $match['hostgoals'].' - '.$match['guestgoals'];								
					}
				?>
				<a href="matchview.php?id=<?=$match['id']?>" class="match-link">
				<div class="match">
					<div class="add-host"><?=$match['hostteam']?></div>
					<div class="add-separator"><?=$separator?></div>
					<div class="add-guest"><?=$match['guestteam']?></div>
				</div>	
				</a>
				<?
				}
				?>	
			</div>
			
			<div class="main-news">
				<p class="ms">НОВОСТИ ПО ТЕМЕ <a href="allnews.php?page=1">Все новости</a></p>
				<?php // Вывод списка последних новостей из того же вида спорта
				$q = $db->query("SELECT * FROM news INNER JOIN sports ON theme = sport_id WHERE theme = $sport_id ORDER BY date DESC LIMIT 10");
				foreach ($q as $res) {
				?>
				<div class="news-small">
					<div class="news-small-head"><a href="viewing.php?id=<?=$res['id']?>"><?=$res['title']?></a></div>
					<img alt="avatar" class="news-small-img" src="<?=$res['img']?>">
					<div class="news-small-body"><?=$res['short']?></div>
				</div>	
				<? } ?>
			</div>
		<?php
		} else { 
		?>
		<h1>Матч не найден</h1>
		<?php
		}	
		?>
		</main>

		<?php require_once('inc/footer.php'); ?>
	</div>
</body>
</html>