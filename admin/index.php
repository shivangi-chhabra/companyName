<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$username = "";
$password = "";

$database = "contact1";
$username = "root";
$password = "";
 
 // Create connection

 $servername = "localhost";
 $conn       = mysqli_connect($servername, $username, $password, $database);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
	$request  = json_decode($postdata);
	$username = mysqli_real_escape_string($conn,trim($request->username));
    $password = mysqli_real_escape_string($conn,trim($request->password));

    $sql = "SELECT username,password FROM admin 
            WHERE username = '{$username}' AND password = '{$password}'";  
    
    $result = mysqli_query($conn, $sql);  
    $row    = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count  = mysqli_num_rows($result);  
          
    if($count == 1)
    {  

        if ($row['username'] == 'Admin') {

                
                $myObj           = new stdClass;;
                $myObj->message  = "Admin Login successful";
                $myObj->username = "Admin";
                $myObj->token    = md5(1234);
        

                $myJSON          = json_encode($myObj);
                setcookie("data", $myJSON, time()+ 60*60*60,'/');
                echo $myJSON;        
            }else{
                
                $myObj           = new stdClass;;
                $myObj->message  = "Login successful";
                $myObj->username = "{$username}";
                $myObj->token    = md5(123456);
        

                $myJSON          = json_encode($myObj);
                setcookie("data", $myJSON, time()+ 60*60*60,'/');
                echo $myJSON;  

            }
                  
    }  
    else
    { 
        header('HTTP/1.0 401 Unauthorized');
        die ("Not authorized");
    }             

}

$conn->close();
?>