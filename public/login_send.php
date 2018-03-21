<?php
	require_once '../../private/config.inc.php';

	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRIPPED);

	// Using prepared statements means that SQL injection is not possible. 
	$checkLogin = mysqli_query($mysqli, "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1");
	$checkEmail = mysqli_query($mysqli, "SELECT * FROM users WHERE email = '$email' LIMIT 1");

	$password = hash('sha512', $password);
 
	if (mysqli_num_rows($checkEmail) == 1) {
		$row = mysqli_fetch_array($checkEmail);
		$db_password = $row['password'];

		if ($password === $db_password) {
			// Password is correct!
			// Get the user-agent string of the user.
			$user_browser = $_SERVER['HTTP_USER_AGENT'];
			session_start();
			$_SESSION['username'] = $email;
			$_SESSION['login_string'] = hash('sha512', $db_password . $user_browser);
			// Login successful.
			header('Location: index.php');
			exit();
		}
	} else {
		// No user exists.
		header('Location: login.php');
		exit();
	}
