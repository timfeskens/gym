<?php 
	require 'require_session.php'; 
	$bodypart_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

	$result = mysqli_query($mysqli, "SELECT * FROM bodyparts WHERE id = '$bodypart_id'");
	$row =  mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/main.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Index</title>
</head>
<body>
	<div class="addexercise">
		<div class="page__head">
			<a href="exercises.php?id=<?= $bodypart_id ?>">
				<i class="material-icons page__icon">chevron_left</i>
			</a>
			<div class="page__title">
				add exercise
			</div>
			<a href="logout.php">
				<i class="material-icons page__icon">exit_to_app</i>
			</a>
		</div>
		<form action="addexercise_send.php?id=<?= $bodypart_id ?>" method="post" class="addexercise__form">
			<div class="addexercise__title">exercise name</div>
			<input type="text" name="name" class="addexercise__input">
			<div class="addexercise__title">exercise group</div>
			<input type="text" class="addexercise__input" value="<?= $row['name']; ?>" readonly>
			<div class="addexercise__button-holder">
				<i class="material-icons addexercise__button addexercise__button--cancel">cancel</i>
				<button type="submit">
					<i class="material-icons addexercise__button addexercise__button--add">check_circle</i>
				</button>
			</div>
		</form>
	</div>
</body>
</html>
