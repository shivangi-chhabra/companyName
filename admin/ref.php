<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$active    = "";
$image     = "";                                 
$policies  = [];


 $servername = "localhost";
 $database   = "contact1";
 $username   = "root";
 $password   = "";
 
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
  $sql = "SELECT * FROM `ref`";
  $query = $conn->query($sql);
  //print_r($query);
  $service = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_array($result))
  {
    $policies[$i]['id']      = $row['id'];
    $policies[$i]['active']      = $row['active'];
    $policies[$i]['image']   = base64_encode($row['image']);
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['service'] = $service;

}



 mysqli_close($conn);
?>