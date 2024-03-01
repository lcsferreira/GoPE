<?php
include '../../../config.php';

$id = $_GET['id'];
$inc = $_POST['inc'];

$sql ="DELETE FROM research_pe_intervation_studies WHERE id_country = $id AND inc = $inc";
$result = mysqli_query($conn, $sql);

if ($result){
  echo "Success";
}else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}