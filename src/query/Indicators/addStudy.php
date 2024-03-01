<?php
include '../../../config.php';

$id = $_GET['id'];
$inc = $_POST['inc'];

//search if the id_country and inc already exists
$sql = "SELECT * FROM research_pe_intervation_studies WHERE id_country = $id AND inc = $inc";
$result = mysqli_query($conn, $sql);

//call procedure InsertIntervationStudies

$sql = "CALL InsertIntervationStudies($id, $inc)";
$result = mysqli_query($conn, $sql);

if ($result){
  echo "Success";
}else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}