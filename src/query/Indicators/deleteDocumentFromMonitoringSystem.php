<?php
include '../../../config.php';

$id = $_GET['id'];
$inc = $_POST['inc'];
$docInc = $_POST['docInc'];
$type = $_POST['type'];

$sql ="DELETE FROM pe_monitoring_monitoring_systems_documents_$type WHERE id_country = $id AND inc = $inc AND doc_inc = $docInc";
$result = mysqli_query($conn, $sql);

if ($result){
  echo "Success";
}else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}