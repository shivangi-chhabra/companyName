<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$username = "";
$password = "";
$email    = "";

$database = "contact1";
$username = "root";
$password = "";
 
 // Create connection

 $servername = "localhost";
 $conn = mysqli_connect($servername, $username, $password, $database);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
	$request  = json_decode($postdata);
	$username = mysqli_real_escape_string($conn,trim($request->username));
    $email    = mysqli_real_escape_string($conn,trim($request->email));
    $password = mysqli_real_escape_string($conn,trim($request->password));
   


    $query   = "INSERT into `admin` (`username`, `email`, `password`) 
                VALUES ('{$username}','{$email}', '{$password}')";
    

    if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
    } else{
         header('HTTP/1.0 401 Unauthorized');
         header('WWW-Authenticate: Basic realm="My Realm"');
        die ("Not authorized");
    }

    

}

$conn->close();


?>