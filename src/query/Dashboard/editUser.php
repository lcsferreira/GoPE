<?php

include('../../../config.php');

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

$sql = "SELECT active FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$oldActive = $row['active'];

// Update the user in the database
$sql = "UPDATE users SET name = '$name', email = '$email', secondary_email = '$secondaryEmail', institution = '$institution', type = '$type', active = '$active' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);


if ($countries !== []) {
  $sql = "DELETE FROM user_country_relations WHERE id_user = '$id'";
  $result = mysqli_query($conn, $sql);

  foreach ($countries as $country) {
    $countryId = $country['countryId'];
    $isMain = $country['mainUser'];
    $isMain = $isMain === "true" ? 1 : 0;
    $sql = "INSERT INTO user_country_relations (id_user, id_country, is_main) VALUES ('$id', '$countryId', '$isMain')";
    $result = mysqli_query($conn, $sql);
  }
}

// if the active row was updated, send an email to the user
if ($active !== $oldActive && $active == 1) {
  $sql = "SELECT * FROM users WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  $currentYear = date("Y");

  $to = $user['email'];
  $subject = "Action Required -  GoPE! Country Contact registration instructions - new GoPE! data review and Country Card approval system";
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: Workflow GoPE <info@globalphysicaleducationobservatory.com>' . "\r\n";
  $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com' . "\r\n";
  $headers .= "X-Priority: 1\r\n";
  $headers .= 'X-Mailer: PHP/' . phpversion();

  $message = "
  <br>
  This is an automatic user activation message for the GoPE! Country Contacts registration system. This is the new system for the Country Cards $currentYear review and approval.
  <br><br>
  Click here to go to the Workflow guide:
  <br><br>
  <a href='http://google.com'>English</a>
  <a href='http://google.com'>Spanish</a>
  <br><br>
  Please click on the link below to log in to the GoPE workflow. This is a link that will allow you to create the password.
  <br><br>
    <a href='http://work.globalphysicaleducationobservatory.com/src/pages/login/firstAccess.php?tk=$id'>First-time registration</a>
  <br><br>
    If you have any questions, please contact us at <a href='mailto: main.admin@email.com'>main.admin@email.com</a>
  ";

  mail($to, $subject, $message, $headers);
}

echo "Success";

mysqli_close($conn);
