<?php
if($_SERVER['SERVER_ADDR'] == "50.87.179.128"){

$servername = "localhost";
$username = "johnnzh5_admin";
$password = "2?{0GH3A2$,=";
$dbname = "johnnzh5_tgtpos_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
}else{
	$servername = "localhost";
	$username = "johnnzh5_admin";
	$password = "2?{0GH3A2$,=";
	$dbname = "johnnzh5_tgtpos_db";
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
	  die("Connection failed: " . $conn->connect_error);
	}
	
	
}

?>