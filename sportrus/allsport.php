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
		<?php require('inc/header.php'); $sport = $_GET['sport'];?>
		<main class="container">
			<h1><?=$sport?></h1>	
				<?php
				$startdate = -360;
				$enddate = 1;
				$q = $db->query("SELECT count(id) as c FROM matches WHERE sport = '$sport' AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY)")->fetch_assoc();
				$count = $q['c'];
				if ($count > 0) {
				?>
				<div class="main-matches">
					<p class="ms">МАТЧИ<a href="allmatches.php">Все матчи</a></p>
					<div class="match-form-main">
						<table class="match-list">
							<?php
							$col1 = ceil($count/2);
							$col2 = $count - $col1;

							$q = $db->query("SELECT * FROM matches WHERE sport = '$sport' AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY) ORDER BY date DESC LIMIT $col1 OFFSET 0");
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
							<?php
							$q = $db->query("SELECT * FROM matches WHERE sport = '$sport' AND date BETWEEN DATE_ADD(CURDATE(), INTERVAL $startdate DAY) AND DATE_ADD(CURDATE(), INTERVAL $enddate DAY) ORDER BY date DESC LIMIT $col2 OFFSET $col1");
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
				<?php }	?>
			<div class="main-news">
				<p class="ms">НОВОСТИ<a href="allnews.php?page=1">Все новости</a></p>
				<?php
				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$limit = 6;
				$offset = $limit * ($page - 1);
				
				$q = $db->query("SELECT * FROM news WHERE theme = '$sport' ORDER BY date DESC LIMIT $limit OFFSET $offset");
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
					<?php $i = ($_GET['page'] - 1 > 0) ? $i = $_GET['page'] - 1 : $i = 1; ?>
					<a href="allsport.php?sport=<?=$sport?>&page=1"><button class="btn-page"><<</button></a>
					<a href="allsport.php?sport=<?=$sport?>&page=<?=$i?>"><button class="btn-page"><</button></a>
					<?php
					$q = $db->query("SELECT count(id) as c FROM news WHERE theme = '$sport'")->fetch_assoc();
					$count = $q['c'];
					$col = ceil($count/$limit);
					for ($i = 1; $i <= $col; $i++) {
						$class = ($i == $_GET['page']) ? $class = "btn-page-cur" : $class = "btn-page";
						?>
						<a href="allsport.php?sport=<?=$sport?>&page=<?=$i?>"><button class="<?=$class?>"><?=$i?></button></a>
					<?php
					}
					$i = ($_GET['page'] + 1 > $col) ? $i = $col : $i = $_GET['page'] + 1;
					?>
					<a href="allsport.php?sport=<?=$sport?>&page=<?=$i?>"><button class="btn-page">></button></a>
					<a href="allsport.php?sport=<?=$sport?>&page=<?=$col?>"><button class="btn-page">>></button></a>
				</div> 
			</div>	
		</main>
		<?php require('inc/footer.php'); ?>
	</div>
</body>
</html>	