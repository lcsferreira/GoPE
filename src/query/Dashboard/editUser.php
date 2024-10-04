<?php
include '../../../config.php';
include '../../../email_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

$payload = $_POST['payload'];

// Perform any necessary operations with the payload
$id = $payload['id'];
$name = $payload['name'];
$email = $payload['email'];
$secondaryEmail = $payload['secondaryEmail'];
$institution = $payload['institution'];
$type = $payload['type'];
if (isset($payload['countries'])) {
    $countries = $payload['countries'];
} else {
    $countries = [];
}
$active = $payload['active'];

// Use prepared statements to select active status
$stmt = $conn->prepare("SELECT active FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$oldActive = $row['active'];
$stmt->close();

// Use prepared statements to update the user
$stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, secondary_email = ?, institution = ?, type = ?, active = ? WHERE id = ?");
$stmt->bind_param("sssssii", $name, $email, $secondaryEmail, $institution, $type, $active, $id);
$stmt->execute();
$stmt->close();

if ($countries !== []) {
  // Use prepared statements to delete old country relations
  $stmt = $conn->prepare("DELETE FROM user_country_relations WHERE id_user = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();

  // Use prepared statements to insert new country relations
  $stmt = $conn->prepare("INSERT INTO user_country_relations (id_user, id_country, is_main) VALUES (?, ?, ?)");
  foreach ($countries as $country) {
      $countryId = $country['countryId'];
      $isMain = $country['mainUser'] === "true" ? 1 : 0;
      $stmt->bind_param("iii", $id, $countryId, $isMain);
      $stmt->execute();
  }
  $stmt->close();
}

// if the active row was updated, send an email to the user
if ($active !== $oldActive && $active == 1) {
  $sql = "SELECT * FROM users WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  $currentYear = date("Y");

  $to = $user['email'];
  try{
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
    $mail->Subject = "Action Required -  GoPE! Country Contact registration instructions - new GoPE! data review and Country Card approval system";

    $mail->Body = "
    <br>
      This is an automatic user activation message for the GoPE! Country Contacts registration system. This is the new system for the Country Cards $currentYear review and approval.
    <br><br>
    Click here to go to the Workflow guide:
    <br><br>
    <a href='https://drive.google.com/file/d/1yflI4WRQQ2PkQyv_r60z6UFaixmySifp/view?usp=sharing'>English</a>
    <a href='https://drive.google.com/file/d/1oqEr43UIHvwIuTrBgZg4SuvtEc-cau3n/view?usp=sharing'>Spanish</a>
    <br><br>
    Please click on the link below to log in to the GoPE workflow. This is a link that will allow you to create the password.
    <br><br>
      <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Login/firstAccess.php?tk=$id'>First-time registration</a>
    <br><br>
    If you have any questions, please contact us at <a href='mailto: gopecoordination@gmail.com'>gopecoordination@gmail.com</a> or <a href='mailto:prjccristao@gmail.com'>prjccristao@gmail.com</a>
    ";

    $mail->send();
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

echo "Success";

mysqli_close($conn);