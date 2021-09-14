<?php
session_start();
date_default_timezone_set( "America/Los_Angeles" );
$cunt = "";

function isEven( $cunt ) {
  if ( is_int( $cunt ) ) {
    switch ( $cunt ) {
      case 0:
      case 1:
      case ( $cunt % 2 == 1 ):
        return false;
        break;
      case ( $cunt % 2 == 0 ):
        return true;
        break;
    }
  } else {
    return false;
  }
}

function isOdd( $cunt ) {
  if ( is_int( $cunt ) ) {
    switch ( $cunt ) {
      case 0:
      case 1:
      case ( $cunt % 2 == 1 ):
        return true;
        break;
      case ( $cunt % 2 == 0 ):
        return false;
        break;
    }
  } else {
    echo "$cunt";
    return true;
  }
}





if ( isset( $_POST[ 'timeclock' ] ) ) {
    
    
    
    
    
    
    
  if ( isset( $_POST[ 'longitude' ] ) ) {
    $lon = trim( $_POST[ 'longitude' ] );
  } else {
    $lon = 00;
  }
  if ( isset( $_POST[ 'latitude' ] ) ) {
    $lat = trim( $_POST[ 'latitude' ] );
  } else {
    $lat = 00;
  }
    
  $time = time();
  $uname = trim( $_POST[ 'timeclock' ] );
 
  $entry =  array($uname=>array());
if(!file_exists("timeclock.txt")){ file_put_contents("timeclock.txt", serialize($entry)); }
if(file_exists("timeclock.txt")){ $log = unserialize(file_get_contents("timeclock.txt"));  }
if(array_key_exists($uname,$log)){$log[$uname][] = $time;}else{$log[] = $entry;$log[$uname][]= $time;}
$entries = count($log[$uname]);

file_put_contents("timeclock.txt", serialize($log));
if(isOdd($entries)){  echo "In = " . date( 'm/d-H:i', $time ) . ""; }  
if(isEven($entries)){ echo "Out = " . date( 'm/d-H:i', $time ) . ""; }



include('../Includes/admin_login.php');    
$sql= "UPDATE users SET timeclock_record = REPLACE(timeclock_record,'@@','".$time.",@@') WHERE username  = '$uname';";
$conn->query($sql);
mysqli_close($conn);


exit();    
    
}    
//  include( '../Includes/admin_login.php' );
//    
//    
//    $sql = "SELECT * FROM timeclock WHERE name = '$uname' AND time_out = '@@';";
//	$result = mysqli_query($conn, $sql);
//	$row = mysqli_fetch_row($result);
//	if(mysqli_num_rows($result) === 1) 
//	{
//        $sql = "UPDATE timeclock SET time_out = $time WHERE name  = $uname AND time_out = '@@';";
//        $conn->query( $sql );
//        echo "Out=" . date( 'm/d/Y H:i', $time ) . "";
//      } else {
//        $sql = "INSERT INTO timeclock (`name`,`time_in`, `time_out`, `latitude`, `longitude`)values('$uname','$time','@@','$lat','$lon');";
//        $conn->query( $sql );
//        echo "In=" . date( 'm/d/Y H:i', $time ) . "";
//      }
//      $sql = "UPDATE users SET timeclock_record = REPLACE(timeclock_record,'@@','" . $time . ",@@') WHERE username  = '$uname';";
//      $conn->query( $sql );
//    mysqli_free_result( $result );
//    mysqli_close( $conn );
//
//}
//

//if(isset($_POST['timeclock']))
//{ 
//	include('../Includes/admin_login.php');
//    if(isset($_POST['longitude'])){ $lon =  trim($_POST['longitude']); }else{$lon = 00;  }
//    if(isset($_POST['latitude'])){ $lat = trim($_POST['latitude']); }else{$lat = 00; }
//    $time = time();
//    $uname = trim($_POST['timeclock']);
//	$sql = "SELECT id FROM timeclock WHERE `name` = '$uname';";
//    if($result = mysqli_query($conn,$sql)){
//        $rows = mysqli_num_rows($result);
//     if(isEven($rows)){
//            $sql= "UPDATE timeclock SET time_out = $time WHERE `name`  = '$uname' AND time_out = '';";
//            $conn->query($sql);
//            echo "Out=".date('m/d/Y H:i',$time)."";
//        }elseif(isOdd($rows)){
//            $sql= "INSERT INTO timeclock (`name`,`time_in`, `latitude`, `longitude`)values('$uname','$time','$lat','$lon');";
//            $conn->query($sql);
//            echo "In=".date('m/d/Y H:i',$time)."";
//        }else{ 
//    
//            echo "error=unknown";
//        }
//        $sql= "UPDATE users SET timeclock_record = REPLACE(timeclock_record,'@@','".$time.",@@') WHERE username  = '$uname';";
//        $conn->query($sql);
//
//   }
//     
//		mysqli_free_result($result);
//		mysqli_close($conn);
//        
//    
//
//}
//


?>