<?php
session_start();
if(isset($_POST['live_update']))
{
	$user = trim($_SESSION['username']);
	$files = array_slice(scandir('Users/'), 2);
	foreach($files as $file){
		$txt = 'Users/'.$file;
		$datetime1 = filemtime($txt);
		$diff = time() - $datetime1;
		if($diff < 200){ echo substr($file, 0, -4)."=live&"; }else{ echo substr($file, 0, -4)."=away&";  }
	}
	    touch('Users/'.$user.".txt");
		
if (file_exists('Messages/'.$user.".txt")) {
	$isFrom = file_get_contents('Messages/'.$user.".txt");
setcookie("hasMail", $isFrom, time() + (86400 * 365), "/"); 
unlink('Messages/'.$user.".txt");
}

}
if(isset($_POST['new_message'])){
		$sender = trim($_POST['sender']); 
		$reciever = trim($_POST['reciever']); 
		$message = trim($_POST['message']); 

		include('../Includes/admin_login.php'); 
			$sql = "INSERT INTO `user_chat`(`sender`, `reciever`, `message`) VALUES ('$sender','$reciever','$message')";
		if (mysqli_query($conn, $sql)) {
			$last_id = $conn->insert_id;
			 echo "Message Sent";
		} else {
			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		if($reciever == "everyone"){
		$files = array_slice(scandir('Users/'), 2);
		foreach($files as $file){
		$txt = 'Messages/'.$file;
		touch($txt);
		file_put_contents($txt,$sender);
		}
		}else{
		$txt = 'Messages/'.$reciever.".txt";
		touch($txt);
		file_put_contents($txt,$sender);
		}
		mysqli_close($conn);
}

if(isset($_POST['select_table']) && $_POST['select_table'] == "user_chat"){
	$whoWith = trim($_POST['chat_with']);
	$whoIs = trim($_SESSION['username']);
	include('../Includes/admin_login.php'); 
	if(trim($_POST['chat_with']) == "everyone"){
	$sql = "SELECT * FROM user_chat WHERE reciever = '$whoWith'";
	}else{
	$sql = "SELECT * FROM user_chat WHERE (sender = '$whoWith' AND reciever= '$whoIs') OR (sender = '$whoIs' AND reciever = '$whoWith')";
	}
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result))
	{
		$date = date_create($row['time']);
		$sender = $row['sender'];

		if(trim($row['sender']) == $whoIs){
		echo "<tr>";
		echo "<td></td>";		//" . $row['sender'] . "
		echo "<td>" . $row['message'] . "</td>";
		echo "<td>" . date_format($date, 'H:i:s') . "</td>";
		echo "</tr>";
		}else{
		echo "<tr>";
		echo "<td>" . $row['message'] . "</td>";
		echo "<td>$sender said:</td>";   //" . $row['sender'] . "
		echo "<td>" . date_format($date, 'H:i:s') . "</td>";
		echo "</tr>";
		}
	}
	echo "<tr>";
	echo "<td>" . $row['message'] . "</td>";
	echo "<td></td>";//" . $row['sender'] . "
	echo "<td>" . date_format($date, 'H:i:s') . "</td>";
	echo "</tr>";
	
	mysqli_close($conn);			
}


?>
