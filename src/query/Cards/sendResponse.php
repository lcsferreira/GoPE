<?php
include '../../../config.php';

// data: {
//   idCountry: idCountry,
// },

$idCountry = $_POST['idCountry'];
$response = $_POST['sendResponse'];

$sql = "SELECT name FROM countries WHERE id = $idCountry";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$countryName = $row['name'];

// $sql = "UPDATE countries SET card_english_step = 'waiting contact' WHERE id = $idCountry";
// $conn->query($sql);

//get the contacts related to the country
// $sql = "SELECT email FROM user_country_relation INNER JOIN users ON user_country_relation.id_user = users.id WHERE id_country = $countryId AND active = 1";
// $result = $conn->query($sql);
// $emails = array();
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     array_push($emails, $row['email']);
//   }
// }

$adminEmails = ["lucas.simooes.ferreira@gmail.com"];
date_default_timezone_set('Europe/Lisbon');

foreach ($adminEmails as $email) {
  $to = $email;
  $date = date("Y-m-d H:i:s");
  $year = date("Y");
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: Workflow GoPE <info@globalphysicaleducationobservatory.com>' . "\r\n";
  $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com' . "\r\n";
  $headers .= "X-Priority: 1\r\n";
  $headers .= 'X-Mailer: PHP/' . phpversion();
  if($response == "adjust"){
    $subject = "Country Card English step - ADJUSTMENT REQUIRED - GoPE!";
    $message = "
    <br>
      Dear Admin,
    <br><br>
    ".$countryName." Contact has sended new information about the card step for the Country Cards".$year." Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructions.php?id=".$idCountry."'>here</a>.
    <br><br>
    Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
    <br><br>
    <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructions.php?id=".$idCountry."'>Workflow</a>
    <br><br>
    ";
  }else{
    $subject = "Country Card English step - APPROVED - GoPE!";
    $message = "
    <br>
      Dear Admin,
    <br><br>
    ".$countryName." Contact has approved the card step for the Country Cards".$year." Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructions.php?id=".$idCountry."'>here</a>.
    <br><br>
    Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
    <br><br>
    <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructions.php?id=".$idCountry."'>Workflow</a>
    <br><br>
    ";
  }

  mail($to, $subject, $message, $headers);
}