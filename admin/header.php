<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$Name="";                                 
$Link = "";
$policies = [];


 $servername = "localhost";
 $database = "contact1";
 $username = "root";
 $password = "";
 
 // Create connection
 
 $conn = mysqli_connect($servername, $username, $password, $database);
 
 // Check connection
 
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
  $sql = "SELECT * FROM `header`";
  $query = $conn->query($sql);
  //print_r($query);
  $header = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']      = $row['id'];
    $policies[$i]['Name']    = $row['Name'];
    $policies[$i]['Link']   = $row['Link'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['header'] = $header;

}


if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);


$Name = mysqli_real_escape_string($conn, trim($request->Name));
$Link = mysqli_real_escape_string($conn, trim($request->Link));





$query = "
            INSERT INTO `header` (`Name`, `Link`) 
            VALUES('{$Name}','{$Link}')";



  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
}
}

if($crud == 'update'){
$id = mysqli_real_escape_string($conn, $_POST['id']);
$Name = mysqli_real_escape_string($conn, $_POST['Name']);
$Link  = mysqli_real_escape_string($conn, $_POST['Link']);

$query = "UPDATE `header` SET `Name`='$Name',`Link`='$Link' WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `header` WHERE id=?");
  $sql->bind_param("s", $id);
  $sql->execute();

  

  if(mysqli_query($conn , $sql)){
    $out['message'] = "Member Deleted Successfully";
  }
  else{
    $out['error'] = true;
    $out['message'] = "Could not delete Member";
  }
  
}





 mysqli_close($conn);
 ?>

