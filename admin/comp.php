<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$Class="";                                 
$Heading = "";
$Text = "";
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
  $sql = "SELECT * FROM `comp`";
  $query = $conn->query($sql);
  //print_r($query);
  $service = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']      = $row['id'];
    $policies[$i]['Class']   = $row['Class'];
    $policies[$i]['Heading']   = $row['Heading'];
    $policies[$i]['Text']    = $row['Text'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['service'] = $service;

}
if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);

$Class = mysqli_real_escape_string($conn, trim($request->Class));
$Heading = mysqli_real_escape_string($conn, trim($request->Heading));
$Text = mysqli_real_escape_string($conn, trim($request->Text));





$query = "
            INSERT INTO `comp` (`Class`,`Heading`, `Text`) 
            VALUES('{$Class}','{$Heading}','{$Text}')";


  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
}
}

if($crud == 'update'){
$id      = mysqli_real_escape_string($conn, $_POST['id']);
$Class   = mysqli_real_escape_string($conn, $_POST['Class']);
$Heading = mysqli_real_escape_string($conn, $_POST['Heading']);
$Text    = mysqli_real_escape_string($conn, $_POST['Text']);

$query = "UPDATE `comp` SET `Class`= $Class, `Heading`='$Heading',`Text`='$Text' WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `comp` WHERE id=?");
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