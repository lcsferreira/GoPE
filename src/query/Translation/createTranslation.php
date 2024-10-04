<?php
include '../../../config.php';
include '../../../email_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

$country_id = $_GET['id'];

$sql = "INSERT INTO translations (id_country) VALUES (".$country_id.")";
$rs = mysqli_query($conn, $sql);



if($rs){
  $sql = "UPDATE countries SET translation_step = 'waiting contact' WHERE id = ".$country_id;
  $rs = mysqli_query($conn, $sql);

  if($rs){
    //get the contacts related to the country
    $sql = "SELECT email FROM user_country_relations INNER JOIN users ON user_country_relations.id_user = users.id WHERE id_country = $country_id AND active = 1";
    $result = $conn->query($sql);
    $emails = array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        array_push($emails, $row['email']);
      }
    }

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
        $mail->Subject = "Translation step - STARTED - GoPE!";
        $mail->Body = "
        <br>
          Dear ".$countryName." Contact,
        <br><br>
        For the First set of Country Cards ".$year.", <b>we have started the translation of the GoPE! Country Card.</b> Please log into the workflow in order to complete the translation.
        <br><br>
        Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
        <br><br>
        <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Translation/translation.php?id=".$country_id."'>Workflow</a>
        <br><br>
        If you have any questions, please contact us at <a href='mailto: gopecoordination@gmail.com'>gopecoordination@gmail.com</a> or <a href='mailto:prjccristao@gmail.com'>prjccristao@gmail.com</a>
        ";

        $mail->send();
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }

    header('Location: ../../pages/Translation/translation.php?id='.$country_id);
  }
}else{
  echo "error";
}