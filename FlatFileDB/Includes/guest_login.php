<?php
	$servername = "localhost";
	$username = "tgt_guest";
	$password = "*JIbvRV7-nDxZSiTg";
	$dbname = "tgt_db";
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
	  die("Connection failed: " . $conn->connect_error);
	}
?>
	
