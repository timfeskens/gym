<?php
	if (!empty($_GET['error'])) {
		$error = $_GET['error'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/main.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Log in</title>
</head>
<body>
	<div class="login">
		<div class="login__block login__block--photo">
			<div class="login__photo">
			</div>
		</div>
		<form action="login_send.php" method="post" class="login__block login__block--inputs">
			<input type="email" name="email" class="login__input" placeholder="Email" required>
			<input type="password" name="password" class="login__input" placeholder="Password" required>
			<button type="submit" class="login__input login__input--button">Log in</button>
			<?php 
				if (!empty($_GET['error'])) {
					echo '<div class="login__error">';
					if ($error == 'user') {
						echo 'User does not exist';
					}
					if ($error == 'password') {
						echo 'Wrong password';
					}
					if ($error == 'session') {
						echo 'Session error';
					}
					echo '</div>';
				}
			?>
		</form>
	</div>
</body>
</html>