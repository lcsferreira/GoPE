<?php
include '../../../config.php';

$id = $_GET['id'];

// tableName: tableName,
//         inputName: inputName,
//         value: value,
//         idCountry: idCountry,
//         inc: inc,
//         type: type
$payload = $_POST['payload'];
$inc = $payload['inc'];
$docInc = $payload['docInc'];

$sql = "UPDATE pe_monitoring_monitoring_systems_documents_".$payload["type"]." SET ".$payload['inputName']." = '".$payload['value']."' WHERE id_country = ".$id . " AND inc = " . $inc . " AND doc_inc = " . $docInc;

$result = mysqli_query($conn, $sql);

if ($result) {
  echo "Success";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}