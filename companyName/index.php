<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


 $ad = "";
 $tel = "";

 $database = "contact1";
 $username = "root";
 $password = "";
 
 // Create connection

 $servername = "localhost";
 $conn = mysqli_connect($servername, $username, $password, $database);
 
 // Check connection
 
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }

 $postdata = file_get_contents("php://input");

 echo $postdata;
 
 if(isset($postdata) && !empty($postdata))
{

 $request = json_decode($postdata);
 echo $request->ad;

 $ad = mysqli_real_escape_string($conn ,trim($request->ad) );
 $tel = mysqli_real_escape_string($conn,trim($request->tel));

 

  $query = "INSERT INTO `us`(`ad`,`tel`) 
  VALUES ('{$ad}','{$tel}')";

  
  if(mysqli_query($conn , $query)){
       echo "Records added successfully.";
     } else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
   }
}

  mysqli_close($conn);


?>