<?php foreach($data as $row): ?>

	<p><a href="<?= $row['Nickname']?>/post"><?= $row['Author']; ?></a> #<?= $row['Nickname']; ?></p>

<?php endforeach; ?>