
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="newport" content="width=device-width, initial-scale=1">
	<title>Quest</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="js/custom_script.js"></script>
</head>
<body> 
	<nav class="navbar navbar-expand-sm navbar-light py-0" aria-label="First navbar example">
    <div class="container">
		<button class="navbar-toggler me-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbars01,#navbars02" aria-controls="navbars02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
        </button>
		<ul class="nav navbar-nav me-auto mb-md-0 d-flex flex-row">
			<li class="nav-item">
				<a class="navbar-brand py-0" href="/"><span class="logo c-green">LOGO</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link font-weight-normal d-flex flex-column justify-content-center" aria-current="page" href="/">
					<p class="h6 my-0 text-dark">Ростов-на-Дону</p>
					<p class="my-0 text-muted"><small>Ул. Ленина, 2Б</small></p>
				</a>
			</li>	
		</ul>
				
		<div class="d-flex justify-content-end">	
			<ul class="navbar-nav me-auto mb-md-0 collapse navbar-collapse" id="navbars01">
				<li class="nav-item d-flex flex-column justify-content-center">
					<a class="nav-link fw-bolder me-2 font-weight-normal" href="/">
						<i class="fa fa-whatsapp icon" aria-hidden="true"></i> 
						+7(863) 000 00 00</a>
				</li>		
				<li class="nav-item">
					<button class="btn btn-green btn-sm my-1" id="btnSub">Записаться на приём</div>
				</li>
			</ul>
		</div>				
			
    </div>
    </nav>
	
	<nav class="navbar-expand-sm bg-green" aria-label="Second navbar example">
		<div class="collapse navbar-collapse" id="navbars02">
			<div class="container">
			<div class="row">
				<ul class="navbar-nav me-auto mb-md-0">
					<li class="nav-item col-xs-12 my-2 mx-3">
						<a class="link" aria-current="page" href="/">О клинике</a>
					</li>
					<li class="nav-item col-xs-12 my-2 mx-3">
						<a class="link" aria-current="page" href="/">Услуги</a>
					</li>
					<li class="nav-item col-xs-12 my-2 mx-3">
						<a class="link" aria-current="page" href="/">Специалисты</a>
					</li>
					<li class="nav-item col-xs-12 my-2 mx-3">
						<a class="link" aria-current="page" href="/">Цены</a>
					</li>
					<li class="nav-item col-xs-12 my-2 mx-3">
						<a class="link" aria-current="page" href="/">Контакты</a>
					</li>
				</ul>
			</div>		
			</div>	
		</div>
	</nav>
	
	<div class="pop-up hidden">
		<div class="pop-up-container">
			<div class="pop-up-body rounded">
				<h1>Запись на приём</h1>
				<form action="php/sub.php" method="POST">
					<input class="form-control my-4" type="text" name="fio" id="fio" placeholder="Введите ФИО" required>
					<input class="form-control my-4" type="email" name="email" id="email" pattern="[A-Za-z0-9]{1,}@[A-Za-z]{1,10}\.[a-z]{1,3}" placeholder="Введите email" required>
					<input class="form-control my-4 w-50" name="datetime" id="datetime" type="datetime-local" value="<?=date('Y-m-d H:i');?>" required>
					<input class="btn btn-green btn-sm mt-2" type="submit" value="Записаться">
					<button class="btn btn-outline-green btn-sm mt-2" id="closeModal">Закрыть</button>
				</form>
			</div>
		</div>
	</div>
	
	<div class="container-fluid bg-light">
		<div class="row">
			<div class="col-xs-12 col-lg-3 offset-lg-1 col-md-7 col-sm-6 d-flex flex-column align-items-center justify-content-center">
				<p class="h2 fw-bold">Многопрофильная клиника для детей и взрослых</p>
				<p>Lorem ipsum dolor sit amet, consectetur
				adipiscing elit, sed do eiusmod tempor
				incididunt ut labore et dolore magna aliqua</p>
			</div>
			<div class="col-xs-12 col-lg-7 offset-lg-1 col-md-5 col-sm-6 px-0">
				<img class="img-fluid float-right" src="img/cab.png" alt="Pic">
			</div>
		</div>	
	</div>
	
	<div class="container">
		<div class="row slider">
			<div class="bg-light-green rounded">
			<?php 
			// Подключение к базе c помощью файла dbconnect.php.
			require('php/dbconnect.php');
			$slides = $db->query("SELECT * FROM checkup");
			foreach($slides as $slide) { //выбираем из БД все записи из таблицы checkup и для каждой создаём слайд
			?>
				<div class="slide appear hidden row">
					<div class="col-lg-5 offset-lg-1 col-xs-12 col-md-7 d-flex flex-column justify-content-center py-4">
						<p class="check-up my-0">CHECK UP</p>
						<p class="h5"><?=$slide['sex']?></p>
						<ul class="c-green ps-3">
							<li><span class="text-dark">Гормональный скрининг</span></li>
							<li><span class="text-dark">Тестостерон</span></li>
							<li><span class="text-dark">Свободный тестостерон</span></li>
							<li><span class="text-dark">Глобулин, связывающий половые гормоны</span></li>
						</ul>
						
						<?php //если есть скидка, то показываем её
						if ($slide['discount'] < $slide['cost']) 
							echo "<p class='h5 my-3'>Всего ".$slide['discount']." Р <small class='h6 text-muted'><del>".$slide['cost']."  Р </del></small></p>";
						else 
							echo" <p class='h5 my-3'>Всего ".$slide['cost']." Р </p>";
						?>
						
						<div class="row d-flex flex-row justify-content-center">
							<div class="col-xs-12 col-lg-6 nav-link"><a class="btn btn-green btn-sm px-5" href="/">Записаться</a></div>
							<div class="col-xs-12 col-lg-6 nav-link"><a class="btn btn-outline-green btn-sm px-5" href="/">Подробнее</a></div>
						</div>
					</div>
					<div class="col-lg-6 col-xs-12 col-md-5 px-0">
						<img class="img-fluid float-right clip h-100" src="img/slide.jpg" alt="Pic">
					</div>
				</div>
			<? } ?>	
			</div>
			<div class="d-flex flex-row justify-content-center align-items-center">
				<span class="text-black-50 me-4 h1 point" id="prev">&larr;</span>
				<span class="text-body" id="current-number"> 1 </span>
				<span class="text-black-50" >/</span>
				<span class="text-black-50" id="all-number"><?=$slides->num_rows?></span>
				<span class="text-black-50 ms-4 h1 point" id="next">&rarr;</span>
			</div>
		</div>
	</div>
	
	<footer class="d-flex flex-wrap justify-content-between align-items-center py-5 mt-4 bg-dark-green">
		<div class="container">
			<div class="row">
				<p class="col-2 col-xs-12 mb-0 logo text-white">LOGO</p>
				<ul class="nav col-8 col-xs-12 justify-content-center">
					<li class="nav-item"><a href="/" class="nav-link px-2 text-white">О клинике</a></li>
					<li class="nav-item"><a href="/" class="nav-link px-2 text-white">Услуги</a></li>
					<li class="nav-item"><a href="/" class="nav-link px-2 text-white">Специалисты</a></li>
					<li class="nav-item"><a href="/" class="nav-link px-2 text-white">Цены</a></li>
					<li class="nav-item"><a href="/" class="nav-link px-2 text-white">Контакты</a></li>
				</ul>
				<a href="/" class="col-2 col-xs-12 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
					<p class="bi me-2 text-white" width="40" height="32">
						<i class="fa fa-instagram icon mx-1" aria-hidden="true"></i>
						<i class="fa fa-whatsapp icon mx-1" aria-hidden="true"></i> 
						<i class="fa fa-telegram icon mx-1" aria-hidden="true"></i>

					</p>
				</a>
			</div>	
		</div>	
	</footer>
</body>
</html>