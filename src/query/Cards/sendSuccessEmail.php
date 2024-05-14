<?php
include '../../../config.php';

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
    $to = $email;
    $date = date("Y-m-d H:i:s");
    $year = date("Y") + 1;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: prferreiraj@loudoun.dreamhost.com' . "\r\n";
    $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com' . "\r\n";
    $headers .= "X-Priority: 1\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    $subject = "GoPE! - Thanks and appreciation";

    $message = "
    <br>
      Dear Country Contact,
    <br><br>
    The indicators’ review process was completed. Thank you for your collaboration on developing the ".$year." ".$countryName." Country Card.
    <br><br>
    If you have any questions, please contact us at <a href='mailto: gopecoordination@gmail.com'>gopecoordination@gmail.com</a> or <a href='mailto:prjccristao@gmail.com'>prjccristao@gmail.com</a>.
    ";

    mail($to, $subject, $message, $headers);

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
    $to = $email;
    $date = date("Y-m-d H:i:s");
    $year = date("Y") + 1;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: prferreiraj@loudoun.dreamhost.com' . "\r\n";
    $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com' . "\r\n";
    $headers .= "X-Priority: 1\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    $subject = "GoPE! - Thanks and appreciation";

    $message = "
    <br>
      Dear Country Contact,
    <br><br>
    The indicators’ review process was completed. Thank you for your collaboration on developing the ".$year." ".$countryName." Country Card.
    <br><br>
    If you have any questions, please contact us at <a href='mailto: gopecoordination@gmail.com'>gopecoordination@gmail.com</a> or <a href='mailto:prjccristao@gmail.com'>prjccristao@gmail.com</a>.
    ";

    mail($to, $subject, $message, $headers);
  }
}else{
  return;
}


  