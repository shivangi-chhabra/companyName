<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$image="";                                 
$Heading = "";
$Text = "";
$policies = [];


 $serverHeading = "localhost";
 $database = "contact1";
 $userHeading = "root";
 $password = "";
 
 // Create connection
 
 $conn = mysqli_connect($serverHeading, $userHeading, $password, $database);
 
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
  $sql = "SELECT * FROM `news`";
  $query = $conn->query($sql);
  //print_r($query);
  $news = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']      = $row['id'];
    $policies[$i]['image']   = base64_encode($row['image']);
    $policies[$i]['Heading'] = $row['Heading'];
    $policies[$i]['Text']    = $row['Text'];
    $i++;
  }
  
  echo json_encode($policies);
  
}
  $out['news'] = $news;

}

if($crud == 'create'){


$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))

{

$request = json_decode($postdata);

$image = mysqli_real_escape_string($conn, trim($request->image));
$Heading = mysqli_real_escape_string($conn, trim($request->Heading));
$Text = mysqli_real_escape_string($conn, trim($request->Text));





$query = "
            INSERT INTO `news` (`image`,`Heading`, `Text`) 
            VALUES('{$image}','{$Heading}','{$Text}')";


  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
}
}

if($crud == 'update'){
$id      = mysqli_real_escape_string($conn, $_POST['id']);
$image   = mysqli_real_escape_string($conn, $_POST['image']);
$Heading = mysqli_real_escape_string($conn, $_POST['Heading']);
$Text    = mysqli_real_escape_string($conn, $_POST['Text']);

$query = "UPDATE `news` SET `image`= $image, `Heading`='$Heading',`Text`='$Text' WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }

  
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `news` WHERE id=?");
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