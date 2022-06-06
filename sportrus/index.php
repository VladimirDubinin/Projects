<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>SportRus</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/tables.css">
	<link rel="stylesheet" href="css/slider.css">
	<script type="text/javascript" src="js/slider.script.js"></script>
</head>
<body>
	<div class="cite-body">
		<?php require('inc/header.php'); ?>
		
		<main class="container">
			<h1>Главная</h1>
			<div class="main-matches">
				<p class="ms">БЛИЖАЙШИЕ МАТЧИ <a href="allmatches.php">Все матчи</a></p>
				<?php
				$count = $db->query('SELECT DISTINCT(sport) as id,sport_name,alias FROM matches INNER JOIN sports ON sport = sport_id');
				foreach($count as $vid_sporta) {
					$id = $vid_sporta['id'];
					$name = $vid_sporta['sport_name'];
					$alias = $vid_sporta['alias'];
				?>
				<div class="match-form-main">
					<div class="match-list">	
						<p class="t-cap <?=$alias?>"><a href="allsport.php?sport=<?=$id?>&page=1"><?=mb_strtoupper($name)?></a></p>
						<?php
						$q = $db->query("SELECT * FROM matches INNER JOIN sports ON sport = sport_id WHERE sport = $id ORDER BY date DESC LIMIT 5");
						foreach ($q as $match) {
							if($match['ended'] == false) {
								$date = strtotime($match['date']);
								$separator = date('H',$date).' : '.date('i',$date);			//чтобы внешне отличать несыгранные и сыгранные матчи
							} else {
								$separator = $match['hostgoals'].' - '.$match['guestgoals'];								
							}
						?>
						<a href="matchview.php?id=<?=$match['id']?>" class="match-link">
						<div class="match">
							<div class="host"><?=$match['hostteam']?></div>
							<div class="separator"><?=$separator?></div>
							<div class="guest"><?=$match['guestteam']?></div>
						</div>	
						</a>
						<?
						}
						?>	
					</div>
				</div>	
				<?
				}
				?>
			</div>
			
			<div class="main-news slider-container">
				<p class="ms">ПОСЛЕДНИЕ НОВОСТИ <a href="allnews.php?page=1">Все новости</a></p>
				<?php
				$themes = $db->query("SELECT theme,count(theme) FROM news GROUP BY theme ORDER BY count(theme) DESC LIMIT 4");
				foreach($themes as $theme){
					?> <div class="slider"> <?php
					$id = $theme['theme'];
					$query = $db->query("SELECT * FROM news INNER JOIN sports ON theme=sport_id WHERE theme=$id ORDER BY date DESC LIMIT 5");
					foreach($query as $news){
					?>
					<div class="slide fade">
						<img src="<?=$news['img']?>" class="slide-img" alt="Picture">
						<div class="slide-head-text"><a href="allsport.php?sport=<?=$news['sport_id']?>&page=1"><?=$news['sport_name']?></a></div>
						<div class="slide-img-text"><a href="viewing.php?id=<?=$news['id']?>"><?=$news['title']?></a></div>
					</div>
					<?
					}
					?> 
					<div class="dot-container">
					<?php for($i = 0; $i < $query->num_rows; $i++) { ?>
						<span class="dot"></span>
					<? } ?>	
					</div>	
					<a class="prev">&#10094</a>
					<a class="next">&#10095</a>
					</div> <?
				}
				?>	
			</div>			
		</main>
		<?php require('inc/footer.php'); ?>
	</div>
</body>
</html>