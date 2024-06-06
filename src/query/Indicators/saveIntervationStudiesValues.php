<?php
include '../../../config.php';

$id = $_GET['id'];
$inc = $_POST['inc'];

$values = $_POST['values'];

foreach ($values as $key => $value) {
  if($value === "") {
    $values[$key] = "null";
  } else if($value === "true") {
    $values[$key] = 1;
  }else if($value === "false") {
    $values[$key] = 0;
  }
  else{
    $values[$key] = "'".$value."'";
  }
}

$sql = "UPDATE research_pe_intervation_studies SET title = $values[title], year = $values[year], authors = $values[authors], eletronic_source = $values[eletronicSource], is_pop_study_comp = $values[isPopStudyComp], is_main_outcome = $values[isMainOutcome], is_study_intervention = $values[isStudyIntervention], is_prim_school_set = $values[isPrimSchoolSet], is_published_peer = $values[isPublishedPeer], was_collected = $values[wasCollected], has_abstract_en = $values[hasAbstractEn] WHERE id_country = ".$id . " AND inc = " . $inc;


$result = mysqli_query($conn, $sql);
var_dump($result);

echo(mysqli_error($conn));


if ($result) {
  echo "Success";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}