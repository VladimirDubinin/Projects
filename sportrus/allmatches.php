<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>SportRus</title>
	<link rel="stylesheet" href="css\main.css">
	<link rel="stylesheet" href="css\tables.css">
</head>
<body>
	<div class="cite-body">
		<?php require('inc/header.php'); ?>
		
		<main class="container">
			<h1>Результаты</h1>
			<div class="main-matches">
				<div class="match-form">
					<table class="match-list">
						<caption class="t-cap-football"><a href="allsport.php?sport=Футбол&page=1">ФУТБОЛ</a></caption>
						<?php
						$startdate = -360;
						$enddate = 1;
						$q = $db->query("SELECT * FROM matches WHERE sport = 'Футбол' AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY) ORDER BY date DESC LIMIT 10");
						foreach ($q as $news) {
						?>
						<tr>
							<td class="host"><?=$news['hostteam']?></td>
							<td class="h-goal"><?=$news['hostgoals']?> :</td>
							<td class="g-goal"><?=$news['guestgoals']?></td>
							<td class="guest"><?=$news['guestteam']?></td>
						</tr>
						<?php
						}
						?>	
					</table>
				</div>
				
				<div class="match-form">
					<table class="match-list">
						<caption class="t-cap-hockey"><a href="allsport.php?sport=Хоккей&page=1">ХОККЕЙ</a></caption>
						<?php
						$q = $db->query("SELECT * FROM matches WHERE sport = 'Хоккей' AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY) ORDER BY date DESC LIMIT 10");
						if ($q->num_rows > 0) {
							for ($i = 0; $i < $q->num_rows; $i++) {
							$news = $q->fetch_assoc();	
						?>
						<tr>
							<td class="host"><?=$news['hostteam']?></td>
							<td class="h-goal"><?=$news['hostgoals']?> :</td>
							<td class="g-goal"><?=$news['guestgoals']?></td>
							<td class="guest"><?=$news['guestteam']?></td>
						</tr>
						<?php
							}
						}
						?>	
					</table>
				</div>
				
				<div class="match-form">
					<table class="match-list">
						<caption class="t-cap-basket"><a href="allsport.php?sport=Баскетбол&page=1">БАСКЕТБОЛ</a></caption>
						<?php
						$q = $db->query("SELECT * FROM matches WHERE sport = 'Баскетбол' AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY) ORDER BY date DESC LIMIT 10");
						if ($q->num_rows > 0) {
							for ($i = 0; $i < $q->num_rows; $i++) {
							$news = $q->fetch_assoc();	
						?>
						<tr>
							<td class="host"><?=$news['hostteam']?></td>
							<td class="h-goal"><?=$news['hostgoals']?> :</td>
							<td class="g-goal"><?=$news['guestgoals']?></td>
							<td class="guest"><?=$news['guestteam']?></td>
						</tr>
						<?php
							}
						}
						?>	
					</table>
				</div>	
				
				<div class="match-form">
					<table class="match-list">
						<caption class="t-cap-voley"><a href="allsport.php?sport=Волейбол&page=1">ВОЛЕЙБОЛ</a></caption>
						<?php
						$q = $db->query("SELECT * FROM matches WHERE sport = 'Волейбол' AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY) ORDER BY date DESC LIMIT 10");
						if ($q->num_rows > 0) {
							for ($i = 0; $i < $q->num_rows; $i++) {
							$news = $q->fetch_assoc();	
						?>
						<tr>
							<td class="host"><?=$news['hostteam']?></td>
							<td class="h-goal"><?=$news['hostgoals']?> :</td>
							<td class="g-goal"><?=$news['guestgoals']?></td>
							<td class="guest"><?=$news['guestteam']?></td>
						</tr>
						<?php
							}
						}
						?>	
					</table>
				</div>	
			</div>		
		</main>

		<?php require('inc/footer.php'); ?>
	</div>
</body>
</html>