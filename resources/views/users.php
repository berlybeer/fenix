<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listado de usuarios</title>
</head>
<body>
	<h1><?= e($title) ?></h1>
	<ul>
	<?php foreach($users as $user): ?>
		<li><?php echo e($user) ?></li>
	<?php endforeach; ?>
	</ul>

</body>
</html>