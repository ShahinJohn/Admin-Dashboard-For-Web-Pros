<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["password"]);
unset($_SESSION["checkin"]);
unset($_SESSION["privilege"]);

if(!empty($_SESSION)){ die(var_dump($_SESSION)); }else{header('location: /signin.php');} 
     
    
    
    
?>