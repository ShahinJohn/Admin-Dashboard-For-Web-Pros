<?php
	$servername = "localhost";
	$username = "tgt_user";
	$password = "Q*2[BFRBkX/SHima";
	$dbname = "tgt_db";
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
	  die("Connection failed: " . $conn->connect_error);
	}
?>
	
