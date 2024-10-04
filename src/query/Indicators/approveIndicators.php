<?php
include '../../../config.php';
include '../../../email_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

$id = $_POST['idCountry'];

$sql = "UPDATE countries SET indicators_step = 'completed' WHERE id = $id";
$result = $conn->query($sql);

if ($result) {
  //send email to main contact
  $sql = "SELECT email FROM user_country_relations INNER JOIN users ON user_country_relations.id_user = users.id WHERE id_country = $countryId AND active = 1";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $emails = array();
  array_push($emails, $row['email']);

  $sql = "SELECT name FROM countries WHERE id = $countryId";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $country_name = $row['name'];
  
  if ($result->num_rows > 0) {

    foreach ($emails as $email) {
      try{
        $to = $email;
        //get the actual year
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
        $mail->isHTML(true);
        $mail->Subject = "Country Card English step - In production - GoPE!";
        $mail->Body = "
          <br>
          Dear ".$country_name." Contact,
        <br><br>
          For the first set of Country Cards ".$year.", the indicator's review is now completed and approved. The GoPE! Team is already working on the production of the English Version of your country's Country Card.
        <br><br>
          <strong>We will ask for your contribution from November forward to review it.</strong>
        <br><br>
        If you have any questions, please contact us at <a href='mailto: gopecoordination@gmail.com'>gopecoordination@gmail.com</a>,<a href='mailto:jmartins@fmh.ulisboa.pt'>jmartins@fmh.ulisboa.pt</a> or <a href='mailto:prjccristao@gmail.com'>prjccristao@gmail.com</a>
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