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
		//enter new combo into db


		$query = "INSERT INTO thdb (id, color, animal, bg,
		hitcount, init-time, expire-time

	}

?>