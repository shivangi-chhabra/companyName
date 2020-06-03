<?php

header("Access-Control-Allow-Origin: *");


 $ad = "";
 $tel = "";

 $database = "contact1";
 $username = "root";
 $password = "";
 
 // Create connectio

 $servername = "localhost";
 $conn = mysqli_connect($servername, $username, $password, $database);
 
 // Check connection
 
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
  
 $ad = mysqli_real_escape_string($conn ,$ad );
 $tel = mysqli_real_escape_string($conn,$tel);

 

  $query = "INSERT INTO contact(ad, tel) VALUES ('".$ad."','".$tel."')";

  
  if(mysqli_query($conn , $query)){
       echo "Records added successfully.";
     } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
   }

  mysqli_close($conn);


?>

