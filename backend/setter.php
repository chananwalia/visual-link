<?php
	
	/** PHP script for entering a new link combo into the database. */

	require_once('db_connect.php');

	$link = "";

	if (isset($_GET["link"])) {
		$link = $_GET["link"];
	}

	if $link = "" {
		//error
		DIE ("You didn't enter a link!");
	} else {
		// enter new combo into db

		// generate a unique combo for the link
		$colors = array("pink", "red", "orange", "yellow", "green", "blue", "purple", "teal", "maroon");
		$animals = array("elephant", "penguin", "turtle", "pig", "dog", "cat", "unicorn", "monkey", "whale");
		$bgs = array("beach", "jungle", "city", "snow", "space", "desert", "mountain", "garden", "underwater");

		$now = time();
		$query = "SELECT * FROM thdb WHERE from_unixtime({$now}) < expire-time";
		$response = @mysqli_query($dbc, $query);
		

		$expiration = date('Y-m-d H:i:s', $now + 259200); // default is to expire in 3 days.
		$query = "INSERT INTO thdb (link, color, animal, bg, expire-time) 
			VALUES (?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "sssss", $link, $color, $animal, $bg, $expiration);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($dbc);
	}

?>