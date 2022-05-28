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
				<?php
				$count = $db->query('SELECT DISTINCT(sport) as id,sport_name,alias FROM matches INNER JOIN sports ON sport = sport_id');
				foreach($count as $vid_sporta) {
					$id = $vid_sporta['id'];
					$name = $vid_sporta['sport_name'];
					$alias = $vid_sporta['alias'];
				?>
				<div class="match-form">
					<table class="match-list">
						<caption class="t-cap-<?=$alias?>"><a href="allsport.php?sport=<?=$id?>&page=1"><?=mb_strtoupper($name)?></a></caption>
						<?php
						$startdate = -360; //Потенциально чтобы не выводить слишком старые матчи, но новых матчей в базе пока больше не предвидится, поэтому выводим даже прошлогодние
						$enddate = 1;
						$q = $db->query("SELECT * FROM matches WHERE sport = $id AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY) ORDER BY date DESC LIMIT 10");
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
				<?php
				}
				?>
				
			</div>		
		</main>

		<?php require('inc/footer.php'); ?>
	</div>
</body>
</html>