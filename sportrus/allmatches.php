<?php session_start(); // страница просмотра всех матчей?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>SportRus</title>
	<link rel="stylesheet" href="css\main.css">
	<link rel="stylesheet" href="css\tables.css">
	<script type="text/javascript" src="js/select.date.js"></script>
</head>
<body>
	<div class="cite-body">
		<?php require_once('inc/header.php'); 
		if(isset($_GET['sdate'],$_GET['fdate'])) {
			$sdate = $_GET['sdate']; //если переданы начальная и конечная даты, выводятся матчи из заданного периода
			$fdate = $_GET['fdate'];
		} else { //если нет, то выводятся матчи из периода по умолчанию
			$sdate = date('Y-m-d', strtotime('-1 year'));
			$fdate = date("Y-m-d"); 
		}
		?>
		
		<main class="container">
			<h1>Результаты</h1>
			<div class="main-matches">
				<div class="set-data" id="set-data">
					<span id="all" class="data-left selected">За всё время</span>
					<span id="sep" class="data-mid"> | </span>
					<span id="period" class="data-right">За период</span>
					<div class="date-container" id="date-container">
						<label>с <input type="date" class="date" id="start" name="start"  value="<?=$sdate?>" min="1970-01-01" max="<?=date("Y-m-d")?>"></label>
						<label>по <input type="date" class="date" id="finish" name="finish"  value="<?=$fdate?>" min="1970-01-01" max="<?=date("Y-m-d")?>"></label>
						<button class="btn-show" id="show">Применить</button>
					</div>	
				</div>
				<?php // Выбираем список видов спорта, для которых есть матчи в таблице matches
				$count = $db->query("SELECT DISTINCT(sport) as sport,sport_name,alias FROM matches INNER JOIN sports ON sport = sport_id WHERE date BETWEEN '$sdate' AND '$fdate' group by sport");
				foreach($count as $vid_sporta) {
					$id = $vid_sporta['sport'];
					$name = $vid_sporta['sport_name'];
					$alias = $vid_sporta['alias'];
				?>
				<div class="match-form-main">
					<div class="match-list">	
						<p class="t-cap <?=$alias?>"><a href="allsport.php?sport=<?=$id?>&page=1"><?=mb_strtoupper($name)?></a></p>
						<?php  // Выбираем список матчей, для каждого вида спорта
						$q = $db->query("SELECT * FROM matches WHERE sport = $id AND date BETWEEN '$sdate' AND '$fdate' ORDER BY date DESC");
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
							<div class="host"><?=$match['hostteam']?></div>
							<div class="separator"><?=$separator?></div>
							<div class="guest"><?=$match['guestteam']?></div>
						</div>	
						</a>
						<?php
						}
						?>	
					</div>
				</div>
				<?php
				}
				?>
				
			</div>		
		</main>

		<?php require_once('inc/footer.php'); ?>
	</div>
</body>
</html>