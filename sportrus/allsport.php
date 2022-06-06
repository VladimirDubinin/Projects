<?php 
session_start();
if(!isset($_GET['sport'])) {
	header('Location: http://sportrus/');
}
else $sport_id = $_GET['sport'];
?>

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
	<?php require('inc/header.php');
	$q = $db->query("SELECT * FROM sports WHERE sport_id = $sport_id");
	if($q->num_rows == 1) {
		$sport = $q->fetch_assoc();
		?>
		<main class="container">
			<h1><?=$sport['sport_name']?></h1>	
				<?php
				$startdate = -360;
				$enddate = 1;        //Считаем, есть ли вообще матчи для данной темы (для киберспорта их нет), чтобы если их 0 не выводить инфу про матчи вообще
				$q = $db->query("SELECT count(id) as c FROM matches WHERE sport = $sport_id AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY)")->fetch_assoc();
				$count = $q['c'];
				if ($count > 0) {
				?>
				<div class="main-matches">
					<p class="ms">МАТЧИ<a href="allmatches.php">Все матчи</a></p>
					<div class="match-form-main">
						<div class="match-list">	
							<?php
							$col1 = ceil($count/2);
							$col2 = $count - $col1;

							$q = $db->query("SELECT * FROM matches WHERE sport = $sport_id AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY) ORDER BY date DESC LIMIT $col1 OFFSET 0");
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
							<?php
							}
							?>	
						</div>
					</div>	
					<div class="match-form-main">
						<div class="match-list">
							<?php
							$q = $db->query("SELECT * FROM matches WHERE sport = $sport_id AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY) ORDER BY date DESC LIMIT $col2 OFFSET $col1");
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
							<?php
							}
							?>	
						</div>
					</div>
				</div>	
				<?php 
				}	
				?>
			<div class="main-news">
				<p class="ms">НОВОСТИ<a href="allnews.php?page=1">Все новости</a></p>
				<?php
				$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
				$limit = 6;
				$offset = $limit * ($page - 1);
				
				$q = $db->query("SELECT * FROM news INNER JOIN sports ON theme=sport_id WHERE theme = $sport_id ORDER BY date DESC LIMIT $limit OFFSET $offset");
				foreach ($q as $news) {
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
				
				<div class="paginate">
					<?php $i = ($page - 1 > 0) ? $i = $page - 1 : $i = 1; ?>
					<a href="allsport.php?sport=<?=$sport_id?>&page=1"><button class="btn-page"><<</button></a>
					<a href="allsport.php?sport=<?=$sport_id?>&page=<?=$i?>"><button class="btn-page"><</button></a>
					<?php
					$q = $db->query("SELECT count(id) as c FROM news WHERE theme = $sport_id")->fetch_assoc();
					$count = $q['c'];
					$col = ceil($count/$limit);
					for ($i = 1; $i <= $col; $i++) {
						$class = ($i == $page) ? $class = "btn-page-cur" : $class = "btn-page";
						?>
						<a href="allsport.php?sport=<?=$sport_id?>&page=<?=$i?>"><button class="<?=$class?>"><?=$i?></button></a>
					<?php
					}
					$i = ($page + 1 > $col) ? $i = $col : $i = $page + 1;
					?>
					<a href="allsport.php?sport=<?=$sport_id?>&page=<?=$i?>"><button class="btn-page">></button></a>
					<a href="allsport.php?sport=<?=$sport_id?>&page=<?=$col?>"><button class="btn-page">>></button></a>
				</div> 
			</div>	
		</main>
	<?php
	} else {
	?>
	<h1>Категория не найдена</h1>	
	<?php } require('inc/footer.php'); ?>
	</div>
</body>
</html>	