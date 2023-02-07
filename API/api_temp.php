<?php
	// Connect to database
	include("db_connect.php");
	$request_method = $_SERVER["REQUEST_METHOD"];

	function getTemperature()
	{
		global $conn;
		$query = "SELECT * FROM relever_temp ORDER BY id DESC LIMIT 5";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
	
	function AddInformation()
	{
		global $conn;
		$temperature = $_POST["temperature"];
		$humidite = $_POST["humidite"];
		$pression = $_POST["pression"];
		$query = "INSERT INTO relever_temp (temperature, humidite, pression) VALUES('".$temperature."', '".$humidite."', '".$pression."')";
		
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Votre insertion a été réalisé avec succès !'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'ERREUR !.'. mysqli_error($conn)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	

	switch($request_method)
	{
		
		case 'GET':
			getTemperature();
			break;
		
		case 'POST':
			AddInformation();
			break;

		default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}
?>