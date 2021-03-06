<nav class="header">
	<div class="container-head">
		<div class="logo">
			<a href="/"><img width="60" height="60" alt="Logo" src="../img/logo.png"></a>
		</div>
		<div class="nav-link">
			<a href="allnews.php?page=1">Новости</a>
		</div>
		<div class="nav-link">
			<a href="allmatches.php">Результаты</a>
		</div>
		<div class="nav-link">
			<ul class="menu">
				<p>Виды спорта</p>
				<ul class="submenu">
				<?php
				require_once('php/dbconnect.php'); //Подключение к БД для выбора доступных видов спорта для ниспадающего списка в шапке
				$q = $db->query("SELECT * FROM sports");
				for ($i = 0; $i < $q->num_rows; $i++) {
					$res = $q->fetch_assoc();
				?>
					<li><a href="allsport.php?sport=<?=$res['sport_id']?>&page=1"><?=$res['sport_name']?></a></li>
				<?php } ?>
				</ul>
			</ul>
		</div>
		<div class="nav-link">
			<a href="forum.php">Общение</a>
		</div>
		
		
		<?php // Если пользователь не авторизован, показываются кнопки регистрации и авторизации
		if(!isset($_SESSION['userid']) && !isset($_SESSION['username'])) {
		?>
		<div class="nav-bar-unlog">
			<a href="authorization.php" class="nav-link-btn"><span>Войти</span></a>
			<a href="registration.php" class="nav-link-btn"><span>Регистрация</span></a>
		</div>	
		<?php 
		} else { // иначе показываются логин и кнопка выхода из профиля 
		?>
		<div class="nav-bar-log">
			<a href="usercabinet.php" class="nav-link-nick"><span><?=$_SESSION['username']?></span></a>
			<a href="php/exit.php" class="nav-link-btn"><span>Выйти</span></a>
		</div>	
		<?php 
		}
		?>	
		
	</div>	
</nav>