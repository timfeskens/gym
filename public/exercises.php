<?php
require 'require_session.php'; 

$bodypart_id = $_GET['id'];

$query = "SELECT * FROM exercises WHERE bodypart_id = '$bodypart_id'";
$result = mysqli_query($mysqli, $query);

while ($row = mysqli_fetch_array($result)) {
	echo $row['name'];
}
?>
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

	</div>
</body>
</html>