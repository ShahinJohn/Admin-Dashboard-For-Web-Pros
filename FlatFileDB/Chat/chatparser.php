<?php
session_start();
setlocale(LC_ALL,"US");
date_default_timezone_set("America/Los_Angeles");
if(isset($_GET['liveupdate']))
{
$uname = trim($_SESSION['username']);
$entry =  array($uname=>time());
if(!file_exists("livelist.txt")){ file_put_contents("livelist.txt", serialize($entry)); }
if(file_exists("livelist.txt")){ $log = unserialize(file_get_contents("livelist.txt"));  }
$log[$uname] = time();
$i=0;
foreach($log as $key => $value)
{
   $i++;
   echo $key;
    echo "=";
    echo $value;  
   if($i < count($log)){ echo "&";  } 
}

file_put_contents("livelist.txt", serialize($log));

}

if(isset($_POST['new_message'])){

$message =
'
{
   "1":
   {
    "to" : "JohnnyBravo",
    "from": "DJKnox",
    "message" : ["this is the message","time it was sent","whwhether its been read"]
   },
 
   "2":
   {
    "to" : "DJKNox",
    "from": "JohnyBravo",
    "order_id" : ["CC-11","CC-16","BB-172"]
   },
 
   "3":
   {
       "customer_name" : "Jackie",
       "payment_method": "Cash",
       "order_id": ["EE-21","EE-101"]
   }
 
}
';
        
        
    
    
    
if(!file_exists("messages.txt")){ file_put_contents("messages.txt", serialize($entry)); }
if(file_exists("livelist.txt")){ $log = unserialize(file_get_contents("livelist.txt"));  }
$log[$uname] = $time;

foreach($log as $key => $value)
{
   echo $key;
    echo "=";
    echo $value;
}
}
	


    
//    $Users = array();
//    if($_POST['liveupdate'] == "need_user"){  
//	include('admin_login.php'); 
//	$sql = "SELECT username FROM users";
//    $result = mysqli_query($conn, $sql);
//    $usersArray= array();
//    $log = unserialize(file_get_contents("signinlog.txt"));
//	while($row = mysqli_fetch_array($result)){
//        echo row['username'].",";
//        if(!array_key_exists(row['username'], $log)){ $log[row['username']] = 0;} 
//    }
//        file_put_contents("signinlog.txt", serialize($log));
//    }
//    
//    if($_POST['liveupdate'] == "need_time"){
//        
//    if(!file_exists("signinlog.txt")){ file_put_contents("signinlog.txt", serialize($entry)); }
//    $log = unserialize(file_get_contents("signinlog.txt"));
//    $log[$_SESSION['username']] = $atTime;
//        foreach($log as $entry){
//            echo $entry[0]."=".$entry[1]."&";
//        }
//    file_put_contents("signinlog.txt", serialize($log));
//    }
//}
//
//if(isset($_POST['new_message'])){
//	$sender = trim($_POST['sender']); 
//	$reciever = trim($_POST['reciever']); 
//	$message = trim($_POST['message']); 
//
//	include('../Includes/admin_login.php'); 
//	$sql = "INSERT INTO `user_chat`(`sender`, `reciever`, `message`) VALUES ('$sender','$reciever','$message')";
//	if (mysqli_query($conn, $sql)) {
//		$last_id = $conn->insert_id;
//		echo "Message Sent";
//	} else {
//		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//	}
//	if($reciever == "everyone"){
//		$files = array_slice(scandir('Users/'), 2);
//		foreach($files as $file){
//			$txt = 'Messages/'.$file;
//			touch($txt);
//			file_put_contents($txt,$sender);
//		}
//	}else{
//		$txt = 'Messages/'.$reciever.".txt";
//		touch($txt);
//		file_put_contents($txt,$sender);
//	}
//	mysqli_close($conn);
//}
//
//if(isset($_POST['select_table']) && $_POST['select_table'] == "user_chat"){
//	$whoWith = trim($_POST['chat_with']);
//	$whoIs = trim($_SESSION['username']);
//	include('../Includes/admin_login.php'); 
//	if(trim($_POST['chat_with']) == "everyone"){
//		$sql = "SELECT * FROM user_chat WHERE reciever = '$whoWith'";
//	}else{
//		$sql = "SELECT * FROM user_chat WHERE (sender = '$whoWith' AND reciever= '$whoIs') OR (sender = '$whoIs' AND reciever = '$whoWith')";
//	}
//	$result = mysqli_query($conn, $sql);
//	while($row = mysqli_fetch_array($result))
//	{
//		$date = date_create($row['time']);
//		$sender = $row['sender'];
//
//		if(trim($row['sender']) == $whoIs){
//			echo "<tr>";
//			echo "<td></td>";		
//			echo "<td>" . $row['message'] . "</td>";
//			echo "<td>" . date_format($date, 'H:i:s') . "</td>";
//			echo "</tr>";
//		}else{
//			echo "<tr>";
//			echo "<td>" . $row['message'] . "</td>";
//			echo "<td>$sender said:</td>";   
//			echo "<td>" . date_format($date, 'H:i:s') . "</td>";
//			echo "</tr>";
//		}
//	}
//	echo "<tr>";
//	echo "<td>" . $row['message'] . "</td>";
//	echo "<td></td>";
//	echo "<td>" . date_format($date, 'H:i:s') . "</td>";
//	echo "</tr>";
//	
//	mysqli_close($conn);			
//}


?>
