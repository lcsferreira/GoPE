<?php
include "../../../config.php";
// Get the values from the POST request
$agreementOrder = $_POST['agreementOrder'];
$inputName = $_POST['inputName'];
$tableName = $_POST['tableName'];
$value = $_POST['value'];
$idCountry = $_POST['idCountry'];

// Update the values into the table
$sql = "UPDATE $tableName SET $inputName = $value WHERE id_country = $idCountry";
$result = mysqli_query($conn, $sql);

if (!$result) {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  die();
}
// Send a response back
echo "Success";
