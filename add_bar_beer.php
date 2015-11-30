<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	if ($_POST["action"] == "addBar")
		addBar($_POST["barName"], $_POST["address"], $_POST["city"], $_POST["state"], $_POST["zip"], $mysqli);
	else if ($_POST["action"] == "addBeer")
		addBeer($_POST["barName"], $_POST["beerName"], $_POST["maker"], $_POST["type"], $_POST["rating"], $_POST["price"], $mysqli);
	header('Location: bar_list.php');
?>
