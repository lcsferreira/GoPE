<?php
include '../../../config.php';

$id = $_GET['id'];
$inc = $_POST['inc'];

$values = $_POST['values'];
foreach ($values as $key => $value) {
  if($key != 'fullReference'){
    $values[$key] = $value == 'true' ? 1 : 0;
  }
}

$sql = "UPDATE research_pe_intervation_studies SET full_reference = ".$values['fullReference'] .", pe = ".$values['pe'].", atp = ".$values['atp'].", ac = ".$values['ac'].", ar = ".$values['ar'].", e_pa = ".$values['e_pa']." WHERE id_country = ".$id . " AND inc = " . $inc;
$result = mysqli_query($conn, $sql);

if ($result) {
  echo "Success";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}