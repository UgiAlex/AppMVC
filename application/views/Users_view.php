<?php foreach($data as $row): ?>

<p><a href="<?= $row['Nickname']?>/post"><?= $row['Name']; ?></a> #<?= $row['Nickname']; ?></p>

<?php endforeach; ?>
