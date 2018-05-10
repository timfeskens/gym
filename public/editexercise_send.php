<?php
	require 'require_session.php';
	require_once '../../private/config.inc.php';

	if (!$mysqli) {
		die("Connection error: " . mysqli_connect_error());
	}

	// filters vars and arrays for sql injection
	$bodypart_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
	$exerciseID = filter_var($_POST['exerciseid'], FILTER_SANITIZE_STRIPPED);
	$exerciseName = filter_var($_POST['name'], FILTER_SANITIZE_STRIPPED);


	// check if sets were given
	if ($_POST['weight'] && $_POST['reps']) {
		$setID = filter_var_array($_POST['setid'], FILTER_SANITIZE_STRIPPED);
		$exerciseWeight = filter_var_array($_POST['weight'], FILTER_SANITIZE_STRIPPED);
		$exerciseRep = filter_var_array($_POST['reps'], FILTER_SANITIZE_STRIPPED);
	}

	// Using prepared statements means that SQL injection is not possible. 
	if (strlen($exerciseName) > 0 && $bodypart_id < 9) {
		$result = mysqli_query($mysqli, "UPDATE exercises SET name = '$exerciseName' WHERE id = '$exerciseID'");

		if (!$result) {
			header('location: exercises.php?id=' . $bodypart_id . 'error=data');
			exit;
		}
	} else {
		header('location: exercises.php?id=' . $bodypart_id . 'error=id');
		exit;
	}

	$exerciseSet = 1;
	$y = 0;

	// check if sets were given
	if ($exerciseRep) {
		for ( $i = 0; $i < count($exerciseRep); $i++ ) {
			$y++;
			if (strlen($exerciseName) > 0 && $bodypart_id < 9) {

				$checkUserExercises = mysqli_query($mysqli, "SELECT * FROM user_exercises WHERE user_id = '$userID' AND exercise_id = '$exerciseID' AND set_id = '$setID[$i]'");

				if (mysqli_num_rows($checkUserExercises) == 1) {
					$resultSets = mysqli_query($mysqli, "UPDATE sets SET reps = '$exerciseRep[$i]', weight = '$exerciseWeight[$i]' WHERE id = '$setID[$i]'");

					if (!$resultSets) {
						echo '<br>' . mysqli_error($mysqli) . '<br>';
						// echo '<br> rep: ' . $exerciseRep[$i];
						// echo '<br> weight: ' . $exerciseWeight[$i];
						// echo '<br> id: ' . $setID[$i];
					}
				} else {
					$resultSets = mysqli_query($mysqli, "INSERT INTO sets (set_number, reps, weight) VALUES ('$y', '$exerciseRep[$i]', '$exerciseWeight[$i]')");

					if ($resultSets) {
						$newSetID = mysqli_insert_id($mysqli);
						$exerciseSet++;

						$resultUserExercises = mysqli_query($mysqli, "INSERT INTO user_exercises (user_id, exercise_id, set_id) VALUES ('$userID', '$exerciseID', '$newSetID')");

						if ( $resultUserExercises ) {
							header('location: exercises.php?id=' . $bodypart_id);
							exit;
						} else {
							echo '<br>' . mysqli_error($mysqli) . '<br>';
							// echo '<br> rep: ' . $exerciseRep[$i];
							// echo '<br> weight: ' . $exerciseWeight[$i] . '<br>';
							// echo '<br> user id: ' . $userID;
							// echo '<br> exercise id: ' . $exerciseID;
							// echo '<br> set id: ' . $setID[$i];
							exit;
						}
					} else {
						echo 'sets nope <br>' . mysqli_error($mysqli) . '<br>';
						// echo '<br> rep: ' . $exerciseRep[$i];
						// echo '<br> weight: ' . $exerciseWeight[$i] . '<br>';
						// echo '<br> user id: ' . $userID;
						// echo '<br> exercise id: ' . $exerciseID;
						// echo '<br> set id: ' . $setID[$i];
						exit;
					}
				}
			} else {
				header('location: editexercise.php?id=' . $bodypart_id . '&exerciseid=' . $exerciseID . 'error=id');
				exit;
			}
		}
	}
