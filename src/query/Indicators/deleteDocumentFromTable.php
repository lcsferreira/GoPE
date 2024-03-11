<?php
include '../../../config.php';

$id = $_GET['id'];
// const payload = {
//   tableName: tableName,
//   docInc: docInc,
//   idCountry: idCountry
// }
$payload = $_POST['payload'];
$docInc = $payload['docInc'];
$tableName = $payload['tableName'];

$sql = "DELETE FROM $tableName WHERE id_country = $id AND inc = $docInc";
$result = mysqli_query($conn, $sql);

if ($result){
  echo "Success";
}else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}