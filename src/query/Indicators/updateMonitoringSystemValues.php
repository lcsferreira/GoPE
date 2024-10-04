<?php
include '../../../config.php';

$id = $_GET['id'];

$payload = $_POST['payload'];
$inc = $payload['inc'];
//if curriculumImplementation is checked, then it will be 1, otherwise 0
$curriculumImplementation = $payload['curriculumImplementation'] == 'true' ? 1 : 0;
$peGeneralSchool = $payload['peGeneralSchool'] == 'true' ? 1 : 0;
$minTime = $payload['minTime'] == 'true' ? 1 : 0;
$other = $payload['other'] == 'true' ? 1 : 0;

$sql = "UPDATE pe_monitoring_monitoring_systems_".$payload["type"]." SET reach = '".$payload['reach'] ."', curriculum_implementation = ".$curriculumImplementation.", pe_general_school = ".$peGeneralSchool.", min_time = ".$minTime.", other = ".$other.", other_purposes = '".$payload['otherPurposes']."', education_level = '".$payload['educationLevel']."', years_applied = '".$payload['yearsApplied']."', year_publication = '".$payload['yearPublication']."', years_application = '".$payload['yearsApplication']."', voluntary_comments = '".$payload['voluntaryComments']."' WHERE id_country = ".$id . " AND inc = " . $inc;

$result = mysqli_query($conn, $sql);

if ($result) {
  echo "Success";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}