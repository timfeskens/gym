<?php 
	require 'require_session.php'; 
	$result = mysqli_query($mysqli, "SELECT * FROM profiles");
	$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/main.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Profile</title>
</head>
<body>
	<div class="profile">
		<div class="profile__header">
			<a href="index.php"><i class="material-icons profile__icon">chevron_left</i></a>
			<div class="profile__title">PROFILE</div>
		</div>
		<div class="profile__info">
			<div class="profile__block">
				<div class="block__title">
					<?php
					$firstname = $row['first_name'];
					$lastname = $row['last_name'];

					$firstnameLength = strlen($firstname);
					$lastnameLength = strlen($lastname);

					$firstname = substr($firstname, 0, 1 - $firstnameLength);
					$lastname = substr($lastname, 0, 1 - $lastnameLength);
					echo $firstname .' '. $lastname;
					?>
				</div>
			</div>
			<div class="profile__block">
				<div class="block__title">
					<?= $row['age'] ?>
				</div>
			</div>
			<div class="profile__block">
				<div class="block__title">
					<?= $row['weight'] ?>KG
				</div>
			</div>
			<div class="profile__block">
				<div class="block__title">
					<?= $row['length'] ?>CM
				</div>
			</div>
		</div>
	</div>
</body>
</html>