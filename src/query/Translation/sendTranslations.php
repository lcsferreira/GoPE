<?php
include '../../../config.php';
include '../../../email_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

$country_id = $_GET['id'];

//use mysql_real_escape_string to prevent sql injection
foreach ($_POST as $key => $value) {
  $_POST[$key] = mysqli_real_escape_string($conn, $value);
}

//s1 to s44
$sql = "UPDATE translations SET s1 = '".$_POST['s1']."', s2 = '".$_POST['s2']."', s3 = '".$_POST['s3']."', s4 = '".$_POST['s4']."', s5 = '".$_POST['s5']."', s6 = '".$_POST['s6']."', s7 = '".$_POST['s7']."', s8 = '".$_POST['s8']."',s9 = '".$_POST['s9']."', s10 = '".$_POST['s10']."', s11 = '".$_POST['s11']."', s12 = '".$_POST['s12']."', s13 = '".$_POST['s13']."',s14 = '".$_POST['s14']."', s15 = '".$_POST['s15']."', s16 = '".$_POST['s16']."', s17 = '".$_POST['s17']."', s18 = '".$_POST['s18']."',s19 = '".$_POST['s19']."', s20 = '".$_POST['s20']."', s21 = '".$_POST['s21']."', s22 = '".$_POST['s22']."', s23 = '".$_POST['s23']."',s24 = '".$_POST['s24']."', s25 = '".$_POST['s25']."', s26 = '".$_POST['s26']."', s27 = '".$_POST['s27']."', s28 = '".$_POST['s28']."', s29 = '".$_POST['s29']."', s30 = '".$_POST['s30']."', s31 = '".$_POST['s31']."', s32 = '".$_POST['s32']."', s33 = '".$_POST['s33']."', s34 = '".$_POST['s34']."', s35 = '".$_POST['s35']."', s36 = '".$_POST['s36']."', s37 = '".$_POST['s37']."', s38 = '".$_POST['s38']."', s39 = '".$_POST['s39']."', s40 = '".$_POST['s40']."', s41 = '".$_POST['s41']."', s42 = '".$_POST['s42']."', s43 = '".$_POST['s43']."', s44 = '".$_POST['s44']."' WHERE id_country = ".$country_id;

$rs = mysqli_query($conn, $sql);

if($rs > 0){ 
  //update the countries table of the translation_step to 'completed'
  $sql = "UPDATE countries SET translation_step = 'completed' WHERE id = ".$country_id;
  $rs = mysqli_query($conn, $sql);

  //send email to admin
  $sql = "SELECT name FROM countries WHERE id = $country_id";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  $country_name = $row['name'];

  // $admin_emails = ["lucas.simoes.ferreira@gmail.com"];
  $adminEmails = ["gopecoordination@gmail.com", "prjccristao@gmail.com"];

  foreach ($admin_emails as $email) {
    //get time
    date_default_timezone_set('Europe/Lisbon');
    $date = date('m/d/Y h:i:s a', time());
    $year = date("Y") + 1;
    //send email to admin
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
      $mail->Subject = "Translation step - COMPLETED - GoPE!";
      $mail->Body = "
      <br>
        Dear Admin,
      <br><br>
      ".$country_name." Contact has completed the translation step for the Country Cards ".$year." Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Translation/translation.php?id=".$country_id."'>here</a>.
      ";
      $mail->send();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
  if($_SESSION['type']=='contact') {
    echo "success";
  }
  else {
    echo "success";
  }
}

?>