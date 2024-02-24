<?php
include "../../../config.php";
// Get the values from the POST request
$payload = $_POST['payload'];

$indicatorName = $payload['indicatorName'];
$tableName = $payload['tableName'];
$value = $payload['value'];
$idCountry = $payload['idCountry'];

// Update the values into the table
$sql = "UPDATE $tableName SET $indicatorName = $value WHERE id_country = $idCountry";
$result = mysqli_query($conn, $sql);

if (!$result) {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  die();
}
// Send a response back
echo "Success";