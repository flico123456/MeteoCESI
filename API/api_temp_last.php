<?php
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getLastTemperature()
	{
		global $conn;
		$query = "SELECT * FROM relever_temp ORDER BY id DESC LIMIT 1";
		$response = array();
		$result = mysqli_query($conn, $query);
		$i=0;
		while($row = mysqli_fetch_array($result))
		{
			$response[$i]['id'] = $row ['id'];
			$response[$i]['temperature'] = $row ['temperature'];
			$response[$i]['humidite'] = $row ['humidite'];
			$response[$i]['pression'] = $row ['pression'];
			$response[$i]['altitude'] = $row ['altitude'];

		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	

	switch($request_method)
	{
		
		case 'GET':
			getLastTemperature();
			break;

		default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}
?>