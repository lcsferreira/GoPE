<?php
include '../../../config.php';

$id = $_GET['id'];

$payload = $_POST['payload'];
$docInc = $payload['docInc'];
$tableName = $payload['tableName'];
$input = $payload['inputName'];
$value = $payload['value'];

$sql = "UPDATE $tableName SET $input = '$value' WHERE id_country = $id AND inc = $docInc";

$result = mysqli_query($conn, $sql);

if ($result) {
  echo "Success";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}