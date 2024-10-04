<?php
include '../../../config.php';
include '../../../email_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

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
  $mail = new PHPMailer(true); 
  //Server settings
  $mail->SMTPDebug = 0;                                 // Enable verbose debug output
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = $dreamhost;                  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = $host_username ;           // SMTP username
  $mail->Password = $host_password;                          // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
  $mail->Port = $host_port;                                    // TCP port to connect to   

  //Recipients
  $mail->setFrom($host_username, 'GoPE!');
  $mail->addAddress($to);     // Add a recipient

  //Content
  $mail->isHTML(true);                                  // Set email format to HTML

  if($response == "adjust"){
    $sql = "UPDATE countries SET card_translated_step = 'waiting admin' WHERE id = $idCountry";
    $result = $conn->query($sql);

    try{
      $mail->Subject = "Country Card Translated step - ADJUSTMENT REQUIRED - GoPE!";
      $mail->Body = "
      <br>
        Dear Admin,
      <br><br>
      ".$countryName." Contact has sended new information about the card step for the Country Cards ".$year." Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructions.php?id=".$idCountry."'>here</a>.
      <br><br>
      Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
      <br><br>
      <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructionsTranslated.php?id=".$idCountry."'>Workflow</a>
      <br><br>
      ";

      $mail->send();
      echo "success";
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
  }else{
    try{
      $mail->Subject = "Country Card Translated step - APPROVED - GoPE!";
      $mail->Body = "
      <br>
        Dear Admin,
      <br><br>
      ".$countryName." Contact has approved the translated card step for the Country Cards ".$year." Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructionsTranslated.php?id=".$idCountry."'>here</a>.
      <br><br>
      Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
      <br><br>
      <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Card/reviewInstructionsTranslated.php?id=".$idCountry."'>Workflow</a>
      <br><br>
      ";
      $mail->send();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    //adicionar update card_translated_step = completed
    $sql = "UPDATE countries SET card_translated_step = 'completed' WHERE id = $idCountry";
    $result = $conn->query($sql);
    
    echo "approved";
  }

}