<?php
include '../../../config.php';

$id = $_GET['id'];
$inc = $_POST['inc'];
$type = $_POST['type'];
//call procedure InsertMonitoringSystem
if($type =="admin"){
  $sql = "CALL InsertMonitoringSystemAdmin($id, $inc)";
  $result = mysqli_query($conn, $sql);
}else{
  $sql = "CALL InsertMonitoringSystemContact($id, $inc)";
  $result = mysqli_query($conn, $sql);
}

if ($result){
  echo "Success";
}else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}