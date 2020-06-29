<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept")

$conn = new mysqli("localhost", "root", "", "contact1");
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username = $_POST['username'];  
$password = $_POST['password'];  
$postdata = file_get_contents("php://input");

echo $username;

if(isset($postdata) && !empty($postdata))
{
	$request = json_decode($postdata);
	$username = mysqli_real_escape_string($conn,trim($request->username));
    $password = mysqli_real_escape_string($conn,trim($request->password));

    $sql = "SELECT username,password FROM `admin` 
            WHERE username = '{$username}' AND password = '{$password}'";  
    
    $result = mysqli_query($conn, $sql);  
    $row    = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count  = mysqli_num_rows($result);  
          
    if($count == 1){  
         echo "<h1><center> Login successful </center></h1>";  
    }  
    else{  
         echo "<h1> Login failed. Invalid username or password.</h1>";  
    }             

}

$conn->close();




?>