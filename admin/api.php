<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$firstname = "";
$lastnames = "";
$memid     = "";
$policies  = [];

$servername = "localhost";
$database = "crud";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//echo 'Connected successfully' ;
//echo json_encode($_POST);
$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
  $crud = $_GET['crud'];
}
//$postdata = file_get_contents("php://input");

  if($crud == 'read'){
  $sql = "SELECT * FROM `members`";
  $query = $conn->query($sql);
  //print_r($query);
  
  //print_r($query);
  $members = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['memid']      = $row['memid'];
    $policies[$i]['firstname']    = $row['firstname'];
    $policies[$i]['lastname']   = $row['lastname'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['members'] = $members;

}


if($crud == 'create'){

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{

$request = json_decode($postdata);

$firstname = mysqli_real_escape_string($conn ,trim($request->firstname));
$lastname  = mysqli_real_escape_string($conn,trim($request->lastname));



$query = "INSERT into `members` (`firstname`, `lastname`) 
	      VALUES ('{$firstname}', '{$lastname}')";
            print_r($query);


  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
}
}

if($crud == 'update'){


$memid = mysqli_real_escape_string($conn, $_POST['memid']);

$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname  = mysqli_real_escape_string($conn, $_POST['lastname']);

$query = "UPDATE `members` SET `firstname` = '$firstname', `lastname` = '$lastname' WHERE `memid` = '$memid' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }
}


if($crud == 'delete'){

$memid = mysqli_real_escape_string($conn, $_POST['memid']);

$sql = $conn->prepare("DELETE FROM `members` WHERE memid=?");
$sql->bind_param(i, $memid);
$sql->execute();
  
  
  if(mysqli_query($conn , $sql)){
    echo "Member Deleted Successfully";
  }
  else{
    $out['error'] = true;
    $out['message'] = "Could not delete Member";
  }
  
}



$conn->close();


die();


?>