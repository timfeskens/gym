<?php
	require 'require_session.php';
	require_once '../../private/config.inc.php';

	if (!$mysqli) {
		die("Connection error: " . mysqli_connect_error());
	}

	// filters vars and arrays for sql injection
	$bodypart_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
	$exerciseName = filter_var($_POST['name'], FILTER_SANITIZE_STRIPPED);


	// check if sets were given
	if ($_POST['weight'] && $_POST['reps']) {
		$exerciseWeight = filter_var_array($_POST['weight'], FILTER_SANITIZE_STRIPPED);
		$exerciseRep = filter_var_array($_POST['reps'], FILTER_SANITIZE_STRIPPED);
	}

	// Using prepared statements means that SQL injection is not possible. 
	if (strlen($exerciseName) > 0 && $bodypart_id < 9) {
		$result = mysqli_query($mysqli, "INSERT INTO exercises (name, bodypart_id) VALUES ('$exerciseName', '$bodypart_id')");

		if ($result) {
			if ($exerciseRep) {
				$exerciseID = mysqli_insert_id($mysqli);
			} else {
				header('location: exercises.php?id=' . $bodypart_id);
				exit;
			}
		} else {
			header('location: exercises.php?id=' . $bodypart_id . 'error=data');
			exit;
		}
	} else {
		header('location: exercises.php?id=' . $bodypart_id . 'error=id');
		exit;
	}

	$exerciseSet = 1;
	$weightNumber = 0;
	
	// check if sets were given
	if ($exerciseRep) {
		foreach ( $exerciseRep as $exerciseReps ) {
			if (strlen($exerciseName) > 0 && $bodypart_id < 9) {
				$resultSets = mysqli_query($mysqli, "INSERT INTO sets (set_number, reps, weight) VALUES ('$exerciseSet', '$exerciseReps', '$exerciseWeight[$weightNumber]')");

				if ($resultSets) {
					$exerciseSet++;
					$weightNumber++;

					$setID = mysqli_insert_id($mysqli);
					$resultUserExercises = mysqli_query($mysqli, "INSERT INTO user_exercises (user_id, exercise_id, set_id) VALUES ('$userID', '$exerciseID', '$setID')");

					if ( $resultUserExercises ) {
						header('location: exercises.php?id=' . $bodypart_id);
						exit;
					} else {
						header('location: addexercise.php?id=' . $bodypart_id . 'error=data');
						exit;
					}
				} else {
					header('location: addexercise.php?id=' . $bodypart_id . 'error=data');
					exit;
				}
			} else {
				header('location: addexercise.php?id=' . $bodypart_id . 'error=id');
				exit;
			}
		}
	}
