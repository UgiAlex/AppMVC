<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
	<header>
		<ul>
			<li><a href="/">Главная</a></li>
			<li><a href="/parse">Получить новые данные</a></li>
		</ul>		
	</header>

	<div class='content'>
		<?php include 'application/views/'.$content_view; ?>
	</div>
</body>
</html>