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



 mysqli_close($conn);
?>