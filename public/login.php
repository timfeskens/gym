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
		<div class="login__block">
			<div class="login__photo">
				<i class="material-icons login__icon">perm_identity</i>
			</div>
		</div>
		<form action="login_send.php" method="post" class="login__block login__block--inputs">
			<input type="email" name="email" class="login__input" placeholder="Email" required>
			<input type="password" name="password" class="login__input" placeholder="Password" required>
			<button type="submit" class="login__input login__input--button">Log in</button>
		</form>
	</div>
</body>
</html>