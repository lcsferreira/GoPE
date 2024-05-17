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

// $adminEmails = ["lucas.simoes.ferreira@gmail.com"];
$adminEmails = ["gopecoordination@gmail.com", "prjccristao@gmail.com"];
date_default_timezone_set('Europe/Lisbon');

foreach ($adminEmails as $email) {
  $to = $email;
  $date = date("Y-m-d H:i:s");
  $year = date("Y") + 1;
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: prferreiraj@loudoun.dreamhost.com' . "\r\n";
  $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com' . "\r\n";
  $headers .= "X-Priority: 1\r\n";
  $headers .= 'X-Mailer: PHP/' . phpversion();
  if($response == "adjust"){
    $sql = "UPDATE countries SET card_english_step = 'waiting admin' WHERE id = $idCountry";
    $result = $conn->query($sql);
    
    $subject = "Country Card English step - ADJUSTMENT REQUIRED - GoPE!";
    $message = "
    <br>
      Dear Admin,
    <br><br>
    ".$countryName." Contact has sended new information about the card step for the Country Cards ".$year." Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructions.php?id=".$idCountry."'>here</a>.
    <br><br>
    Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
    <br><br>
    <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructions.php?id=".$idCountry."'>Workflow</a>
    <br><br>
    ";
    mail($to, $subject, $message, $headers);
    echo "success";
  }else{
    $subject = "Country Card English step - APPROVED - GoPE!";
    $message = "
    <br>
      Dear Admin,
    <br><br>
    ".$countryName." Contact has approved the english card step for the Country Cards ".$year." Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructions.php?id=".$idCountry."'>here</a>.
    <br><br>
    Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
    <br><br>
    <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructions.php?id=".$idCountry."'>Workflow</a>
    <br><br>
    ";
    mail($to, $subject, $message, $headers);
    //adicionar update card_english_step = completed
    $sql = "UPDATE countries SET card_english_step = 'completed' WHERE id = $idCountry";
    $result = $conn->query($sql);
    
    echo "approved";
  }

}