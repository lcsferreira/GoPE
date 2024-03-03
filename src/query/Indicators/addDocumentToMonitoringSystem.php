<?php
include '../../../config.php';

$id = $_GET['id'];
$inc = $_POST['inc'];
$docInc = $_POST['docInc'];
$type = $_POST['type'];
//call procedure InsertMonitoringSystem
if($type =="admin"){
  $sql = "CALL InsertMonitoringSystemDocumentAdmin($id, $inc, $docInc)";
  $result = mysqli_query($conn, $sql);
}else{
  $sql = "CALL InsertMonitoringSystemDocumentContact($id, $inc, $docInc)";
  $result = mysqli_query($conn, $sql);
}

if ($result){
  echo "Success";
}else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}