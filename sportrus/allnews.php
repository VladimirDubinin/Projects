<?php session_start(); // страница просмотра всех новостей на сайте ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>SportRus</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="cite-body">
		<?php require_once('inc/header.php'); ?>
		
		<main class="container">
			<h1>Новости</h1>
			<div class="main-news">
				<?php // Пагинация. вывод по 10 новостей на странице
				$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
				$limit = 10;
				$offset = $limit * ($page - 1);
				$q = $db->query("SELECT * FROM news ORDER BY date DESC LIMIT $limit OFFSET $offset");
				foreach ($q as $news) { // Вывод всех новостей текущей страницы
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
					<?php $i = ($page - 1 > 0) ? $i = $page - 1 : $i = 1; // навигация по страницам ?>
					<a href="allnews.php?page=1"><button class="btn-page"><<</button></a>
					<a href="allnews.php?page=<?=$i?>"><button class="btn-page"><</button></a>
					<?php
					$q = $db->query("SELECT count(id) as c FROM news")->fetch_assoc();
					$count = $q['c'];
					$col = ceil($count/$limit);
					for ($i = 1; $i <= $col; $i++) {
						$class = ($i == $page) ? $class = "btn-page-cur" : $class = "btn-page";
						?>
						<a href="allnews.php?page=<?=$i?>"><button class="<?=$class?>"><?=$i?></button></a>
					<?php
					}
					$i = ($page + 1 > $col) ? $i = $col : $i = $page + 1;
					?>
					<a href="allnews.php?page=<?=$i?>"><button class="btn-page">></button></a>
					<a href="allnews.php?page=<?=$col?>"><button class="btn-page">>></button></a>
				</div> 
			</div>			
		</main>

		<?php require_once('inc/footer.php'); ?>
	</div>
</body>
</html>