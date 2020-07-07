<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$ad = "";
$tel = "";
$id     = "";
$policies  = [];

$servername = "localhost";
$database = "contact1";
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
  $sql = "SELECT * FROM `us`";
  $query = $conn->query($sql);
  //print_r($query);
  
  //print_r($query);
  $us = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']    = $row['id'];
    $policies[$i]['ad']    = $row['ad'];
    $policies[$i]['tel']   = $row['tel'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['us'] = $us;

}


if($crud == 'create'){

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{

$request = json_decode($postdata);

$ad      = mysqli_real_escape_string($conn,trim($request->ad));
$tel     = mysqli_real_escape_string($conn,trim($request->tel));



$query   = "INSERT into `us` (`ad`, `tel`) 
	        VALUES ('{$ad}', '{$tel}')";
print_r($query);


if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
} else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }
}
}

if($crud == 'update'){


$id   = mysqli_real_escape_string($conn, $_POST['id']);

$ad   = mysqli_real_escape_string($conn, $_POST['ad']);
$tel  = mysqli_real_escape_string($conn, $_POST['tel']);

$query = "UPDATE `us` SET `ad` = '$ad', `tel` = '$tel' WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }
 else{
        echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
 }
}


if($crud == 'delete'){

$id = mysqli_real_escape_string($conn,$_POST['id']);

$sql = $conn->prepare("DELETE FROM `us` WHERE id=?");
$sql->bind_param(i, $id);
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