<?php
require 'require_session.php';

$query = "SELECT * FROM bodyparts";
$result = mysqli_query($mysqli, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/main.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<script src="js/preventSafari.js"></script>
	<title>Index</title>
</head>
<body>
	<div class="training">
	<div class="page__head">
		<a href="index.php">
			<i class="material-icons page__icon">chevron_left</i>
		</a>
		<div class="page__title">
			Training
		</div>
		<a href="logout.php">
			<i class="material-icons page__icon">exit_to_app</i>
		</a>
	</div>
	<?php 
		while ($row = mysqli_fetch_array($result)) {
	?>
		<a href="exercises.php?id=<?= $row['id']; ?>" class="training__block">
			<div class="training__title">
				<?= $row['name']; ?>
			</div>
		</a>
	<?php
		}
	?>
	</div>
</body>
</html>