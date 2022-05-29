<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>SportRus</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/tables.css">
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
					<table class="match-list">
						<caption class="t-cap-<?=$alias?>"><a href="allsport.php?sport=<?=$id?>&page=1"><?=mb_strtoupper($name)?></a></caption>
						<?php
						$q = $db->query("SELECT * FROM matches INNER JOIN sports ON sport = sport_id WHERE sport = $id ORDER BY date DESC LIMIT 3");
						foreach ($q as $match) {
							if($match['ended'] == false) {
								$date = strtotime($match['date']);
								$host = date('H',$date);
								$guest = date('i',$date);
								$host_cl = 'h-goal-time';
								$guest_cl = 'g-goal-time';
							} else {
								$host = $match['hostgoals'];
								$guest = $match['guestgoals'];
								$host_cl = 'h-goal';
								$guest_cl = 'g-goal';								
							}
						?>
						<tr>
							<td class="host"><?=$match['hostteam']?></td>
							<td class="<?=$host_cl?>"><?=$host?> :</td>
							<td class="<?=$guest_cl?>"><?=$guest?></td>
							<td class="guest"><?=$match['guestteam']?></td>
						</tr>
						<?php
						}
						?>	
					</table>
				</div>
				<?php
				}
				?>
			</div>
			
			<div class="main-news">
				<p class="ms">ПОСЛЕДНИЕ НОВОСТИ <a href="allnews.php?page=1">Все новости</a></p>
				<?php
				$q = $db->query("SELECT * FROM news INNER JOIN sports ON theme=sport_id ORDER BY date DESC LIMIT 6");
				foreach($q as $news){
				?>
				<div class="news-form">
					<img src="<?=$news['img']?>" alt="<?=$news['title']?>" width="450" height="255">
						<div class="news-form-a">
							<a href="viewing.php?id=<?=$news['id']?>"><?=$news['title']?></a>
						</div>	
						<div class="news-form-p">
							<span><?=$news['short']?></span>
						</div>	
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