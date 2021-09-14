<?php
session_start();
if(isset($_POST['liveupdate']))
{  
    echo "hello";
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
}



?>
