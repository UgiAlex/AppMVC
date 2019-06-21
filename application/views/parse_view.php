<?php for ($i=0; $i < 5; $i++) { ?>

	<h3><?= $data['title'][$i]['#text'][0]; ?></h3>
	<p><?= $data['time'][$i]['#text'][0]; ?></p>
	<p>Комментарии: <?= $data['comments'][$i]['#text'][0]; ?></p>

<?php } ?>