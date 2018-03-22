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
			<i class="material-icons exercises__icon exercises__icon--open">keyboard_arrow_down</i>
		</div>
		<div class="exercises__content">
				<div class="exercises__set-column">
					<?php 
						$exerciseID = $row['id'];
						$exerciseResult = mysqli_query($mysqli, "SELECT * FROM user_exercises WHERE exercise_id = '$exerciseID' AND user_id = '1'");

						while ($rows = mysqli_fetch_array($exerciseResult)) {
							$setID = $rows['set_id'];
							$setsResult = mysqli_query($mysqli, "SELECT * FROM sets WHERE id = '$setID'");

							$row = mysqli_fetch_array($setsResult);
							?>
							<div class="exercises__set-row">
								<div class="exercises__set-number">
									<?= $row['set_number'] ?>
								</div> 
								<?= $row['reps'] . 'x' . $row['weight'] . '<br>';?>
							</div>
							<?php
							
						}
					?>
				</div>
				<div class="exercises__set-column">
					<i class="material-icons exercises__icon exercises__icon--edit">mode_edit</i>
				</div>
			</div>
		<?php } ?>
		<a href="excersises_add.php?id=<?= $bodypart_id; ?>" class="exercises__add">
			<i class="material-icons exercises__icon exercises__icon--add">add_box</i>
		</a>
	</div>
	<script>
		let dropdown = document.getElementsByClassName( 'exercises__block' );
		let dropdownContent = document.getElementsByClassName( 'exercises__content' );
		let icon = document.getElementsByClassName( 'exercises__icon--open' );
		
		for ( let i = 0; i < dropdown.length; i++) {
			dropdown[i].addEventListener( "click", function() {
				if ( dropdownContent[i].style.display == 'flex' ) {
					dropdownContent[i].style.display = 'none';
					icon[i].style.transform = "rotate(0deg)"; 
				} else {
					dropdownContent[i].style.display = 'flex';
					icon[i].style.transform = "rotate(180deg)";
				}
			});
		}
	</script>
</body>
</html>