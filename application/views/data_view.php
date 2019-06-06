<h2>Данные в базе</h2>

<?php foreach ($data as $row):	?>

	<h3><?= $row['Title'] ?></h3>
	<p><?= $row['TimePublic'] ?></p>
	<p>Комментариев: <?= $row['Comments'] ?></p>
	<a href="/data/post/<?= $row['id'] ?>">Читать</a>	<hr>

<?php endforeach; ?>