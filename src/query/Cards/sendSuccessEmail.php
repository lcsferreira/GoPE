<?php
include '../../../config.php';
include '../../../email_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

$idCountry = $_POST['id'];
$step = $_POST['cardStep'];

//verify if the step is the last one
$sql = "SELECT name, need_translation FROM countries WHERE id = $idCountry";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$needTranslation = $row['need_translation'];
$countryName = $row['name'];

if($needTranslation == 1 && $step == "tr"){
  //select users related to the country
  $sql = "SELECT email FROM user_country_relations INNER JOIN users ON user_country_relations.id_user = users.id WHERE id_country = $idCountry AND active = 1";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $emails = array();
  array_push($emails, $row['email']);

  //send email
  date_default_timezone_set('Europe/Lisbon');
  foreach ($emails as $email) {
    try{

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
      
      $mail->Subject = "GoPE! - Thanks and appreciation";
      
      $mail->Body = "
      <br>
      Dear Country Contact,
      <br><br>
      The indicators’ review process was completed. Thank you for your collaboration on developing the ".$year." ".$countryName." Country Card.
      <br><br>
      If you have any questions, please contact us at <a href='mailto: gopecoordination@gmail.com'>gopecoordination@gmail.com</a> or <a href='mailto:prjccristao@gmail.com'>prjccristao@gmail.com</a>.
      ";
      
      $mail->send();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

  }
}else if($needTranslation == 0 && $step == "en"){
  //select users related to the country
  $sql = "SELECT email FROM user_country_relations INNER JOIN users ON user_country_relations.id_user = users.id WHERE id_country = $idCountry AND active = 1";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $emails = array();
  array_push($emails, $row['email']);

  //send email
  date_default_timezone_set('Europe/Lisbon');
  foreach ($emails as $email) {
    try{

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
      $mail->addAddress($email);     // Add a recipient

      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      
      $mail->Subject = "GoPE! - Thanks and appreciation";
      
      $mail->Body = "
      <br>
      Dear Country Contact,
      <br><br>
      The indicators’ review process was completed. Thank you for your collaboration on developing the ".$year." ".$countryName." Country Card.
      <br><br>
      If you have any questions, please contact us at <a href='mailto: gopecoordination@gmail.com'>gopecoordination@gmail.com</a> or <a href='mailto:prjccristao@gmail.com'>prjccristao@gmail.com</a>.
      ";
    
      $mail->send();
    }
    catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}else{
  return;
}


  