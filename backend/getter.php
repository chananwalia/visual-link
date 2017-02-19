<?php

	/** PHP script that retrieves a link from the db given a combo. */

	require_once('db_connect.php');

	$color = $_GET["color"];
	$animal = $_GET["animal"];
	$bg = $_GET["bg"];

	$query = "SELECT link FROM thdb WHERE color = {$color} AND animal = {$animal} AND bg = {$bg} ORDER BY -id LIMIT 1";

?>