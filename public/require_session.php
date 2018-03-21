<?php

require_once '../../private/config.inc.php';
session_start();

if (!isset($_SESSION['login_time'])) {
	$_SESSION['login_time'] = time();
} 
// session started more than 2 hours ago
if (time() - $_SESSION['login_time'] > 7200) {
	header('Location: logout.php');
	exit();
}

if (isset($_SESSION['username']) && isset($_SESSION['login_string'])) {
	$email = $_SESSION['username'];
	$checkEmail = mysqli_query($mysqli, "SELECT * FROM users WHERE email = '$email' LIMIT 1");

	if (mysqli_num_rows($checkEmail) == 1) {
		$row = mysqli_fetch_array($checkEmail);
		$db_password = $row['password'];

		// Get the user-agent string of the user.
		$user_browser = $_SERVER['HTTP_USER_AGENT'];
		session_start();
		$string = hash('sha512', $db_password . $user_browser);
		
		if ( $string !== $_SESSION['login_string']) {
			header('Location: login.php');
			exit();
		}
	} else {
		header('Location: login.php');
		exit();
	}
} else {
	header('Location: login.php');
	exit();
}