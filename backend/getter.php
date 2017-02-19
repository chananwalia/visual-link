<?php

	/** PHP script that retrieves a link from the db given a combo. */

	require_once('db_connect.php');

	$color = $_GET["color"];
	$animal = $_GET["animal"];
	$bg = $_GET["bg"];

	$query = "SELECT * FROM thdb WHERE color = '{$color}' AND animal = '{$animal}' AND bg = '{$bg}' ORDER BY -id LIMIT 1";
	$response = @mysqli_query($dbc, $query);

	$currtime = time();

	if ($response) {
		while ($row = mysqli_fetch_array($response)) {
			if ($currtime > strtotime($row['expire-time'])) {
				die("No link for this combo!");
			}
			// update hit count
			$newHitCount = $row['hitcount'] + 1;
			$id = $row['id'];
			$query2 = "UPDATE thdb SET hitcount={$newHitCount} WHERE id={$id}";
			$response2 = @mysqli_query($dbc, $query2);
			print json_encode(array("link"=>$row['link']));
		}
	} else {
		die("No link for this combo! :(");
	}

	mysqli_close($dbc);

?>