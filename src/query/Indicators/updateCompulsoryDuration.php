<?php
include "../../../config.php";

$payload = $_POST['payload'];

$tableName = $payload['tableName'];
$inputName = $payload['inputName'];
$value = $payload['value'];
$idCountry = $payload['idCountry'];

//get the old value
$sql = "SELECT $inputName FROM $tableName WHERE id_country = $idCountry";
$result = $conn->query($sql);
$oldValue = $result->fetch_assoc()[$inputName];

// if the new value is the same as the old value, do nothing
if($oldValue === $value) {
  if($inputName === 'duration_compulsory_pe') {
    $sql = "UPDATE $tableName SET es_changed_pe = 0 WHERE id_country = $idCountry";
    $result = $conn->query($sql);
    echo "success";
  }else{
    $sql = "UPDATE $tableName SET es_changed_se = 0 WHERE id_country = $idCountry";
    $result = $conn->query($sql);
    echo "success";
  }
}else{
  // if the new value is different from the old value, update the value
  $sql = "UPDATE $tableName SET $inputName = '$value' WHERE id_country = $idCountry";
  $result = $conn->query($sql);
  //if the inputName is duration_compulsory_pe then update the es_changed_pe table
  if($inputName === 'duration_compulsory_pe') {
    $sql = "UPDATE $tableName SET es_changed_pe = 1 WHERE id_country = $idCountry";
    $result = $conn->query($sql);
    echo "success";
  }else{
    $sql = "UPDATE $tableName SET es_changed_se = 1 WHERE id_country = $idCountry";
    $result = $conn->query($sql);
    echo "success";
  }
}