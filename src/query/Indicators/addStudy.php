<?php
include '../../../config.php';

$id = $_GET['id'];
$inc = $_POST['inc'];

//call procedure InsertIntervationStudies

$sql = "CALL InsertIntervationStudies($id, $inc)";
$result = mysqli_query($conn, $sql);

if ($result){
  echo "Success";
}else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}