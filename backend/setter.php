<?php
	
	/** PHP script for entering a new link combo into the database. */

	require_once('db_connect.php');

	$link = "";

	if (isset($_GET["link"])) {
		$link = $_GET["link"];
	}

	if ($link == "") {
		//error
		DIE ("You didn't enter a link!");
	} else {
		// enter new combo into db

		// generate a unique combo for the link

		// initialize possibilities
		$colors = array("pink", "red", "orange", "yellow", "green", "blue", "purple", "teal", "maroon");
		$animals = array("elephant", "penguin", "turtle", "pig", "dog", "cat", "unicorn", "monkey", "whale");
		$bgs = array("beach", "jungle", "city", "snow", "space", "desert", "mountain", "garden", "underwater");

		// get all combos in the db
		$now = time();
		$db_combos = array();
		$fields = array();
		$query = "SELECT * FROM thdb WHERE from_unixtime({$now}) < expire_time";
		$response = @mysqli_query($dbc, $query);
		while ($row = mysqli_fetch_array($response)) {
			$db_combos[] = $row['color'] . "_" . $row['animal'] . "_" . $row['bg'];
			if ($link == $row['link']) {
				$fields[0] = $row['color'];
				$fields[1] = $row['animal'];
				$fields[2] = $row['bg'];
			}
		}

		// generate all possible combos
		$all_combos = array();
		foreach ($colors as $c) {
			foreach ($animals as $a) {
				foreach ($bgs as $b) {
					$all_combos[] = $c . "_" . $a . "_" . $b;
				}
			}
		}

		sort($db_combos);
		sort($all_combos);

		// loop through all combos, making new array of unused combos
		$size1 = count($all_combos);
		$size2 = count($db_combos);
		$x = 0;
		$y = 0;
		$new_combos = array();
		while ($x < $size1 && $y < $size2) {
			if ($all_combos[$x] != $db_combos[$y]) {
				$new_combos[] = $all_combos[$x];
				$x++;
			} else {
				$x++;
				$y++;
			}
		}
		$new_combos = $new_combos + array_slice($all_combos, $y); // all remaining combos are possible

		//generate random combo
		$r = rand(0, count($new_combos) - 1);
		if (count($fields) == 0) {
			$fields = explode("_", $new_combos[$r]);
		}


		$expiration = date('Y-m-d H:i:s', $now + 259200); // default is to expire in 3 days.
		$query = "INSERT INTO thdb (link, color, animal, bg, expire_time) 
			VALUES (?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "sssss", $link, $fields[0], $fields[1], $fields[2], $expiration);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		print json_encode(array("color"=>$fields[0],"animal"=>$fields[1],"bg"=>$fields[2]));
		mysqli_close($dbc);
	}

?>