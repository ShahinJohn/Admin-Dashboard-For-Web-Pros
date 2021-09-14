<?php
session_start();
if(isset($_POST['newPage']) && isset($_POST['oldPage']) && isset($_POST['pageContent'])){
	$new = $_POST['newPage'];
	$old = $_POST['oldPage'];
	$content = $_POST['pageContent'];
	$folder = $_SESSION['username'];
	file_put_contents($folder."/".$old, $content);
	$page = file_get_contents($folder."/".$new);
echo $page;
}
?>
