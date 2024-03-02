<?php
include '../../../config.php';

$id = $_GET['id'];
$inc = $_POST['inc'];
$type = $_POST['type'];

$sql ="DELETE FROM pe_monitoring_monitoring_systems_$type WHERE id_country = $id AND inc = $inc";
$result = mysqli_query($conn, $sql);

if ($result){
  echo "Success";
}else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}