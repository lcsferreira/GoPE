<?php
include '../../../config.php';

$id = $_GET['id'];
$inc = $_POST['inc'];

$values = $_POST['values'];
foreach ($values as $key => $value) {
  if($value === NULL) {
    $values[$key] = "";
  } else if($value === "true") {
    $values[$key] = 1;
  }else if($value === "false") {
    $values[$key] = 0;
  }
  else{
    $values[$key] = "'".$value."'";
  }
}

$sql = "UPDATE research_pe_intervation_studies SET pe = ".$values['pe'].", atp = ".$values['atp'].", ac = ".$values['ac'].", ar = ".$values['ar'].", e_pa = ".$values['e_pa'].", other = ".$values['other'].", other_domain = ".$values['otherText'].", title = ".$values['title'].", year = ".$values['year'].", eletronic_source = ".$values['eletronicSource'].", apa7th_reference = ".$values['apa7thReference'].", inclusion_criteria = ".$values['inclusionCriteria'].", exclusion_criteria = ".$values['exclusionCriteria'].", main_outcomes = ".$values['mainOutcomes'].", min_age_sample = ".$values['minAgeSamples'].", avg_age_sample = ".$values['avgAgeSamples'].", max_age_sample = ".$values['maxAgeSamples'].", period_data_collect = ".$values['periodDataCollection'].", not_was_lockdown = ".$values['lockdown']." WHERE id_country = ".$id . " AND inc = " . $inc;
// echo $sql;
$result = mysqli_query($conn, $sql);
var_dump($result);
// echo(mysqli_query($conn, $sql));
echo(mysqli_error($conn));


if ($result) {
  echo "Success";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}