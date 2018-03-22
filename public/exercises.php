<?php
require 'require_session.php'; 

$bodypart_id = $_GET['id'];

$result = mysqli_query($mysqli, "SELECT * FROM exercises WHERE bodypart_id = '$bodypart_id'");
?>
<?php require 'require_session.php'; ?>
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
	<div class="exercises">
		<?php while ($row = mysqli_fetch_array($result)) { ?>
		<div class="exercises__block">
			<div class="exercises__title">
				<?= $row['name']; ?>
			</div>
			<i class="material-icons exercises__icon">keyboard_arrow_down</i>
			<div class="exercises__content">
				<div class="exercises__set-column">
					<?php 
						$exerciseID = $row['id'];
						$exerciseResult = mysqli_query($mysqli, "SELECT * FROM user_exercises WHERE exercise_id = '$exerciseID' AND user_id = '1'");

						if ( count ($row) == 0) {
							echo 'No records for this exercise';
						} else {
						while ($rows = mysqli_fetch_array($exerciseResult)) {
							$setID = $rows['set_id'];
							$setsResult = mysqli_query($mysqli, "SELECT * FROM sets WHERE id = '$setID'");

							$row = mysqli_fetch_array($setsResult);
							
							
								echo 'Set ' . $row['set_number'] .': ' . $row['reps'] . 'x' . $row['weight'] . '<br>';
							}
						}
					?>
				</div>
				<div class="exercises__set-column">
					<i class="material-icons exercises__icon exercises__icon--edit">mode_edit</i>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</body>
</html>