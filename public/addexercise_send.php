<?php
	require_once '../../private/config.inc.php';

	if (!$mysqli) {
		die("Connection error: " . mysqli_connect_error());
	}

	$exerciseName = filter_var($_POST['name'], FILTER_SANITIZE_STRIPPED);
	$bodypart_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

	// Using prepared statements means that SQL injection is not possible. 
	if (strlen($exerciseName) > 0 && $bodypart_id < 9) {
		$result = mysqli_query($mysqli, "INSERT INTO exercises (name, bodypart_id) VALUES ('$exerciseName', '$bodypart_id')");

		if ($result) {
			header('location: exercises.php?id=' . $bodypart_id);
			exit;
		} else {
			header('location: exercises.php?id=' . $bodypart_id . 'error=data');
			exit;
		}
	} else {
		header('location: exercises.php?id=' . $bodypart_id . 'error=id');
		exit;
	}