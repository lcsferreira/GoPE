<?php
include "../../../config.php";
// Get the values from the POST request

// data: {
//   inputName: inputName,
//   tableName: tableName,
//   value: value,
//   idCountry: 

$inputName = $_POST['inputName'];
$tableName = $_POST['tableName'];
$value = $_POST['value'];
$idCountry = $_POST['idCountry'];
$idDocument = $_POST['idDocument'];

// echo $inputName;
// echo "<br>";
// echo $tableName;
// echo "<br>";
// echo $value;
// echo "<br>";
// echo $idCountry;
// echo "<br>";
// echo $idDocument;

// //QUERY THAT VERIFIES IF THE idDocument EXISTS IN THE TABLE
$sql = "SELECT * FROM $tableName WHERE id_country = $idCountry AND id_document = $idDocument";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
  // Update the values into the table document
  $sql = "UPDATE documents SET $inputName = '$value' WHERE id = $idDocument";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    die();
  } else {
    echo "Success";
  }
} else {
  $sql = "INSERT INTO documents ( $inputName) VALUES ('$value')";

  $result = mysqli_query($conn, $sql);
  if (!$result) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    die();
  }
  // Get the id of the last inserted document
  $idDocument = mysqli_insert_id($conn);
  // Insert the id of the document into the table
  $sql = "INSERT INTO $tableName (id_country, id_document) VALUES ($idCountry, $idDocument)";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    die();
  } else {
    echo "Success";
  }
}