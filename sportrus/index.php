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
				<div class="match-form-main">
					<table class="match-list">
						<caption class="t-cap-football"><a href="allsport.php?sport=Футбол&page=1">ФУТБОЛ</a></caption>
						<?php
						$q = $db->query("SELECT * FROM matches WHERE sport = 'Футбол' ORDER BY date DESC LIMIT 3");
						if ($q->num_rows > 0) {
							for ($i = 0; $i < $q->num_rows; $i++) {
							$news = $q->fetch_assoc();	
							if($news['ended'] == FALSE) {
								$date = strtotime($news['date']);
								$host = date('H',$date);
								$guest = date('i',$date);
								$host_cl = 'h-goal-time';
								$guest_cl = 'g-goal-time';
							} else {
								$host = $news['hostgoals'];
								$guest = $news['guestgoals'];
								$host_cl = 'h-goal';
								$guest_cl = 'g-goal';								
							}
						?>
						<tr>
							<td class="host"><?=$news['hostteam']?></td>
							<td class="<?=$host_cl?>"><?=$host?> :</td>
							<td class="<?=$guest_cl?>"><?=$guest?></td>
							<td class="guest"><?=$news['guestteam']?></td>
						</tr>
						<?php
							}
						}
						?>	
					</table>
				</div>
				<div class="match-form-main">
					<table class="match-list">
						<caption class="t-cap-hockey"><a href="allsport.php?sport=Хоккей&page=1">ХОККЕЙ</a></caption>
						<?php
						$q = $db->query("SELECT * FROM matches WHERE sport = 'Хоккей' ORDER BY date DESC LIMIT 3");
						if ($q->num_rows > 0) {
							for ($i = 0; $i < $q->num_rows; $i++) {
							$news = $q->fetch_assoc();
							if($news['ended'] == FALSE) {
								$date = strtotime($news['date']);
								$host = date('H',$date);
								$guest = date('i',$date);
								$host_cl = 'h-goal-time';
								$guest_cl = 'g-goal-time';
							} else {
								$host = $news['hostgoals'];
								$guest = $news['guestgoals'];
								$host_cl = 'h-goal';
								$guest_cl = 'g-goal';								
							}							
						?>
						<tr>
							<td class="host"><?=$news['hostteam']?></td>
							<td class="<?=$host_cl?>"><?=$host?> :</td>
							<td class="<?=$guest_cl?>"><?=$guest?></td>
							<td class="guest"><?=$news['guestteam']?></td>
						</tr>
						<?php
							}
						}
						?>	
					</table>
				</div>
				<div class="match-form-main">
					<table class="match-list">
						<caption class="t-cap-basket"><a href="allsport.php?sport=Баскетбол&page=1">БАСКЕТБОЛ</a></caption>
						<?php
						$q = $db->query("SELECT * FROM matches WHERE sport = 'Баскетбол' ORDER BY date DESC LIMIT 3");
						if ($q->num_rows > 0) {
							for ($i = 0; $i < $q->num_rows; $i++) {
							$news = $q->fetch_assoc();	
							if($news['ended'] == FALSE) {
								$date = strtotime($news['date']);
								$host = date('H',$date);
								$guest = date('i',$date);
								$host_cl = 'h-goal-time';
								$guest_cl = 'g-goal-time';
							} else {
								$host = $news['hostgoals'];
								$guest = $news['guestgoals'];
								$host_cl = 'h-goal';
								$guest_cl = 'g-goal';								
							}
						?>
						<tr>
							<td class="host"><?=$news['hostteam']?></td>
							<td class="<?=$host_cl?>"><?=$host?> :</td>
							<td class="<?=$guest_cl?>"><?=$guest?></td>
							<td class="guest"><?=$news['guestteam']?></td>
						</tr>
						<?php
							}
						}
						?>	
					</table>
				</div>	
				<div class="match-form-main">
					<table class="match-list">
						<caption class="t-cap-voley"><a href="allsport.php?sport=Волейбол&page=1">ВОЛЕЙБОЛ</a></caption>
						<?php
						$q = $db->query("SELECT * FROM matches WHERE sport = 'Волейбол' ORDER BY date DESC LIMIT 3");
						if ($q->num_rows > 0) {
							for ($i = 0; $i < $q->num_rows; $i++) {
							$news = $q->fetch_assoc();
							if($news['ended'] == FALSE) {
								$date = strtotime($news['date']);
								$host = date('H',$date);
								$guest = date('i',$date);
								$host_cl = 'h-goal-time';
								$guest_cl = 'g-goal-time';
							} else {
								$host = $news['hostgoals'];
								$guest = $news['guestgoals'];
								$host_cl = 'h-goal';
								$guest_cl = 'g-goal';								
							}							
						?>
						<tr>
							<td class="host"><?=$news['hostteam']?></td>
							<td class="<?=$host_cl?>"><?=$host?> :</td>
							<td class="<?=$guest_cl?>"><?=$guest?></td>
							<td class="guest"><?=$news['guestteam']?></td>
						</tr>
						<?php
							}
						}
						?>	
					</table>
				</div>
			</div>
			
			<div class="main-news">
				<p class="ms">ПОСЛЕДНИЕ НОВОСТИ <a href="allnews.php?page=1">Все новости</a></p>
				<?php
				$q = $db->query("SELECT * FROM news ORDER BY date DESC LIMIT 4");
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