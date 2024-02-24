<?php
include "../../../config.php";

$payload = $_POST['payload'];

$tableName = $payload['tableName'];
$inputName = $payload['inputName'];
$value = $payload['value'];
$idCountry = $payload['idCountry'];

$sql = "UPDATE $tableName SET $inputName = '$value' WHERE id_country = $idCountry";
$result = $conn->query($sql);

if ($result) {
  echo "success";
} else {
  echo "error";
}