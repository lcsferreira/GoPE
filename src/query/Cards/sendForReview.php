<?php
include '../../../config.php';

// data: {
//   idCountry: idCountry,
// },

$idCountry = $_POST['idCountry'];

$sql = "SELECT name FROM countries WHERE id = $idCountry";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$countryName = $row['name'];

$sql = "UPDATE countries SET card_english_step = 'waiting contact' WHERE id = $idCountry";
$conn->query($sql);

//get the contacts related to the country
$sql = "SELECT email FROM user_country_relations INNER JOIN users ON user_country_relations.id_user = users.id WHERE id_country = $idCountry AND active = 1";
$result = $conn->query($sql);
$emails = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($emails, $row['email']);
  }
}

foreach ($emails as $email) {
  $to = $email;
  $year = date("Y") + 1;
  $subject = "Country Card English step - REVIEW REQUIRED - GoPE!";
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: prferreiraj@loudoun.dreamhost.com' . "\r\n";
  $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com' . "\r\n";
  $headers .= "X-Priority: 1\r\n";
  $headers .= 'X-Mailer: PHP/' . phpversion();

  $message = "
  <br>
    Dear ".$countryName." Contact,
  <br><br>
  For the First set of Country Cards ".$year.", <b>we have updated the GoPE! Country Card to the english
  version.</b> Please log into the workflow in order to review it, make any adjustments, and approve it.
  <br><br>
  Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
  <br><br>
  <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructions.php?id=".$idCountry."'>Workflow</a>
  <br><br>
  If you have any questions, please contact us at <a href='mailto: main.admin@email.com'>main.admin@email.com</a>
  ";

  mail($to, $subject, $message, $headers);
}

echo "success";