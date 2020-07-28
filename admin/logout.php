<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");



 $serverName = "localhost";
 $database   = "contact1";
 $userName   = "root";
 $password   = "";
 
 // Create connection
 
 $conn = mysqli_connect($serverName, $userName, $password, $database);
 
 // Check connection
 
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 
//logout.php

setcookie("data", '', time() -3600);
header(401);
exit();

?>