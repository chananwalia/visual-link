<?php
	
	/** PHP script for entering a new link combo into the database. */

	require_once('db_connect.php');
	
	mysql_connect($hostname, $username, $password) OR DIE ("Unable to connect to database! :(");
	mysql_select_db($dbname);

	$link = "";

	if (isset($_GET["link"])) {
		$link = $_GET["link"];
	}

	if $link = "" {
		//error
		DIE ("You didn't enter a link!");
	} else {
		//enter new combo into db




	}

?>