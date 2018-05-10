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
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<script src="js/preventSafari.js"></script>
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
			<input type="text" name="name" class="addexercise__input" required>
			<div class="addexercise__title">exercise group</div>
			<input type="text" class="addexercise__input" value="<?= $row['name']; ?>" readonly required>
			<div class="addexercise__title">sets</div>
			<div class="addexercise__sets"></div>
			<button type="button" class="addexercise__input-button"> add set </button>
			<div class="addexercise__button-holder">
				<a href="exercises.php?id=<?= $bodypart_id ?>">
					<i class="material-icons addexercise__button addexercise__button--cancel">cancel</i>
				</a>
				<button type="submit">
					<i class="material-icons addexercise__button addexercise__button--add">check_circle</i>
				</button>
			</div>
		</form>
	</div>
	<script>
		let formContainer = document.getElementsByClassName( 'addexercise__sets' )[0];
		let addSetButton = document.getElementsByClassName( 'addexercise__input-button' )[0];
		
		addSetButton.addEventListener( 'click', function() {
			if ( formContainer.childElementCount  < 4) {
				let inputSetHolder = document.createElement( 'div' );

				inputSetHolder.classList.add('addexercise__input-holder');
				formContainer.appendChild(inputSetHolder);
				
				if ( inputSetHolder ) {
					let inputSet = document.createElement( 'input' );
					inputSet.type = 'number';
					inputSet.pattern = '[0-9]*'
					inputSet.name = 'reps[]';
					inputSet.classList.add('addexercise__input');
					inputSet.classList.add('addexercise__input--set');
					inputSet.placeholder = 'E.G. 10';
					inputSetHolder.appendChild(inputSet);

					let inputSetRight = document.createElement( 'input' );
					inputSetRight.type = 'text';
					inputSetRight.name = 'weight[]';
					inputSetRight.classList.add('addexercise__input');
					inputSetRight.classList.add('addexercise__input--set');
					inputSetRight.placeholder = 'E.G. 12kg';
					inputSetHolder.appendChild(inputSetRight);
				}
			}
		});
	</script>
</body>
</html>
