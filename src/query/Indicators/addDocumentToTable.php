<?php
include '../../../config.php';

$id = $_GET['id'];
$payload = $_POST['payload'];
$docInc = $payload['docInc'];
$tableName = $payload['tableName'];

//call procedure 
$sql = "CALL InsertDocumentToTable($id, $docInc, '$tableName')";
$result = mysqli_query($conn, $sql);

if ($result){
  echo "Success";
}else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}