<?php
include "../../../config.php";
include '../../../email_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

$countryId = $_POST['idCountry'];

$sql = "UPDATE countries SET indicators_step = 'waiting admin' WHERE id = $countryId";
$result = $conn->query($sql);

if ($result) {
  // $emails = ["lucas.simoes.ferreira@gmail.com"]; //change to admin email
  $emails = ["gopecoordination@gmail.com", "prjccristao@gmail.com"];


  $sql = "SELECT name FROM countries WHERE id = $countryId";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $country_name = $row['name'];
  
  if ($result->num_rows > 0) {
    foreach ($emails as $email) {
      try{
        $to = $email;
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
        $mail->isHTML(true); 
        $year = date("Y") + 1;
        $mail->Subject = "Indicators step - REVIEW REQUIRED - GoPE!";
        $mail->Body = "
        <br>
          Dear Admin,
        <br><br>
        ".$country_name." Contact has sended new information about indicators step for the Country Cards ".$year." Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Indicators/indicatorsProgress.php?id=".$countryId."'>here</a>.
        ";
        $mail->send();
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }
    echo "success";
  }
} else {
  echo "error";
}