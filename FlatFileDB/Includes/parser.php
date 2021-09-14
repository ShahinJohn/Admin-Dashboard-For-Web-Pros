<?php
session_start();
date_default_timezone_set("America/Los_Angeles");
if(isset($_POST['username']) && isset($_POST['password']))
{
	include('admin_login.php'); 
	$uname = trim($_POST['username']); 
	$pword = trim($_POST['password']);       
	$sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$pword'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result);
	if(mysqli_num_rows($result) === 1) 
	{
    
    $uname = $row['1'];
    $atTime = time();
    mysqli_query($conn,"UPDATE users SET login_record = $atTime WHERE username = '$uname'");
	$_SESSION['privilege'] = $row['3'];
	$_SESSION['username'] = $uname;
	$_SESSION['userid'] = $row['0'];
	$_SESSION['checkin'] = $atTime;
	$_SESSION['last_login'] = $row['0'];
    
$entry =  array($uname=>$atTime);
if(!file_exists("signinlog.txt")){ file_put_contents("signinlog.txt", serialize($entry)); }
if(file_exists("signinlog.txt")){ $log = unserialize(file_get_contents("signinlog.txt"));  }
$log[$uname] = $atTime; 
file_put_contents("signinlog.txt", serialize($log));
	mysqli_free_result($result);
	mysqli_close($conn);
	echo "success";
    }else{
        echo 'Invalid Credentials';
}
}

if(isset($_POST['select_table']) && $_POST['select_table'] == "customers"){
	include('admin_login.php');
	if($_POST['search'] == "undefined"){
	$sql = "SELECT * FROM customers";
	}else{
	$match = $_POST['search'];
	$sql = "SELECT * FROM customers WHERE first_name LIKE '%$match%' OR last_name LIKE '%$match%' OR phone_number LIKE '%$match%' OR email_address LIKE '%$match%'";
	}
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result))
	{
	echo "<tr>";
	echo "<td>" . $row['id'] . "</td>";
	echo "<td>" . $row['first_name'] . "</td>";
	echo "<td>" . $row['last_name'] . "</td>";
	echo "<td>" . $row['phone_number'] . "</td>";
	echo "<td>" . $row['email_address'] . "</td>";
	echo "</tr>";
	}
	mysqli_close($conn);			
}
	
	
	if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone']) && isset($_POST['email']))
	{
		$fname = trim($_POST['fname']); 
		$lname = trim($_POST['lname']);     
		$phone = trim($_POST['phone']);   
		$email = trim($_POST['email']);

		include('admin_login.php');

        
		if(strlen($fname) > 2 && strlen(lname) > 2){
			$sql = "INSERT INTO `customers`(`first_name`, `last_name`, `phone_number`, `email_address`) VALUES ('$fname', '$lname', '$phone', '$email')";
		if (mysqli_query($conn, $sql)) {
			 echo "New Customer Added";
		}else{ echo "Error"; }  
//        $result = $conn->query("SELECT * FROM customers WHERE phone_number = $phone");
//		if($result->num_rows == 0){
//			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//		}
//		}else if($result->num_rows == 1){
//			echo "Customer Already Exists";
//		}else if($result->num_rows > 1){
//			echo "Multiple Entries Exists";
//		}		
        } 
        mysqli_close($conn);		
        }
	
	if(isset($_POST['waiting_list']))
	{
		$customer_id = trim($_POST['waiting_list']); 

		include('admin_login.php'); 
		
		$sql = "SELECT first_name, last_name, id FROM patients WHERE phone_number = '$customer_id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($result);
		if(mysqli_num_rows($result) == 0) 
		{
			echo 'no results';
		} else {
			$name = $row[0]." ".$row[1];
			$id_num = trim($row[2]);
			$sql = "INSERT IGNORE INTO `waiting_list`(`name`, `id_number`) VALUES ('$name','$customer_id')";
			if (mysqli_query($conn, $sql)) {
				  echo "added";
			} else {
				  echo "couldnt be added to waiting list";
			}
			
		}
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	if(isset($_POST['uname']) && isset($_POST['pword']) && isset($_POST['privilege']))
	{
		$uname = trim($_POST['uname']); 
		$pword = trim($_POST['pword']);     
		$privi = trim($_POST['privilege']);   
        $sql = "INSERT INTO `users`(`username`, `password`, `privilege`,`timeclock_record`) VALUES ('$uname', '$pword', '$privi', '@@')";
		include('admin_login.php');
		if (mysqli_query($conn, $sql)) 
        {
			 echo "New Customer Added";
		}else{ 
            echo "Error"; 
        }  



    }







//if(isset($_POST['timeclock']))
//{
//	include('admin_login.php');
//    if(isset($_POST['longitude'])){ $long =  trim($_POST['longitude']); }else{$long = 00;  }
//    if(isset($_POST['latitude'])){ $lat = trim($_POST['latitude']); }else{$lat = 00; }
//    $time = time();
//    $uname = trim($_POST['timeclock']);
//    $sql= "UPDATE users SET timeclock_record = REPLACE(timeclock_record,'@@','".$time.",@@') WHERE username  = '$uname';";
//    $conn->query($sql);
//    echo date("m/d/y H:i:s", $time);    
//    
//    //mysqli_free_result($result);
//
//
//}
//
//

// if(isset($_POST['getTable']))
// {
	// include('includes/admin_login.php');
	
	// switch($_POST['getTable'])
	// {
		// case "customers":
		// $sql = "SELECT * FROM customers";
		// break;
		// case "waiting_list":
		// $sql = "SELECT * FROM waiting_list";
		// break;
		// default:
		
		// break;			
		
	// }
	// if ($result = $conn->query($sql)) {
		// while ($row = $result->fetch_assoc()) {
			// $field1name = $row["first_name"];
			// $field2name = $row["last_name"];
			// $field3name = $row['id_number'];
			// $field4name = $row['phone_number'];
			// $field5name = $row['email_address'];
			// $str = "$field1name&$field2name&$field3name&$field4name&$field5name&";

			// echo "$field1name&$field2name&$field3name&";
		// }
		// $result->free();
	// }
// }









	// if(isset($_POST['request_for_patients']))
	// {
		// include('includes/admin_login.php');
		// $sql = "SELECT * FROM waiting_list";
		// if ($result = $conn->query($sql)) {
			// while ($row = $result->fetch_assoc()) {
				// $field1name = $row["name"];
				// $field2name = $row["time in"];
				// $field3name = $row['id_number'];

				// echo "$field1name&$field2name&$field3name&";
			// }
			// $result->free();
		// }
	// }
	// if(isset($_POST['customerCheckout']))
	// {
		// $custid = trim($_POST['id_number']);       
		// include('includes/admin_login.php');
		// $sql = "DELETE FROM `waiting_list` WHERE `id_number` =  '$custid'";
		// if ($conn->query($sql) === TRUE) {
		  // echo "removed";
		// } else {
		  // echo "Error deleting record: " . $conn->error;
		// }

		// $conn->close();
		// }
		
		
	// if(isset($_POST['request_for_customers']))
	// {
		// include('includes/admin_login.php');
		// $searchWord = $_POST['live_search'];
		// $sql = "SELECT * FROM customers";
		// if ($result = $conn->query($sql)) {
			// while ($row = $result->fetch_assoc()) {
				// $field1name = $row["first_name"];
				// $field2name = $row["last_name"];
				// $field3name = $row['id_number'];
				// $field4name = $row['phone_number'];
				// $field5name = $row['email_address'];
				// $str = "$field1name&$field2name&$field3name&$field4name&$field5name&";
				// if(strlen($searchWord) == 0)
				// { 
					// echo $str;
				// }elseif(stripos($str, $searchWord) !== false){
						// echo $str;
					// }
				// }
				
			// }
			// $result->free();
		// }
	
	
//}

// if(isset($_SESSION['username']) && $_SESSION['username'] !== "GUEST" && isset($_SESSION['privilege']) && $_SESSION['privilege'] > 1)
// {
// }
	// if(isset($_POST['waiting_list']))
	// {
		// $isOn = trim($_POST['waiting_list']); 
		// $custid = trim($_POST['id_number']);       

		// include('includes/admin_login.php'); 
		
		// $sql = "SELECT first_name, last_name, id_number FROM patients WHERE id_number = '$custid'";
		// $result = mysqli_query($conn, $sql);
		// $row = mysqli_fetch_row($result);
		// if(mysqli_num_rows($result) == 0) 
		// {
			// echo 'no results';
		// } else {
			// $name = $row[0]." ".$row[1];
			// $id_num = trim($row[2]);
			// $sql = "INSERT IGNORE INTO `waiting_list`(`name`, `id_number`) VALUES ('$name','$id_num')";
			// if (mysqli_query($conn, $sql)) {
				  // echo "added";
			// } else {
				  // echo "couldnt be added to waiting list";
			// }
			
		// }
		// mysqli_free_result($result);
		// mysqli_close($conn);
	// }
	// if(isset($_POST['live_update']))
	// {
		// include('includes/admin_login.php'); 
		// $sql = "SELECT * FROM waiting_list";
		// $result = mysqli_query($conn, $sql);
		// echo mysqli_num_rows($result);
	// }

// if(isset($_POST['logout']))
// {
	// session_destroy();
	// echo "logged-out";
// }


?>