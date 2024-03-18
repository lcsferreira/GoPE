<?php
include "../../../config.php";

$countryId = $_POST['idCountry'];

$sql = "UPDATE countries SET indicators_step = 'waiting contact' WHERE id = $countryId";
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
      $to = $email;
      //get the actual year
      $year = date("Y");
      
      $subject = "Indicators step - REVIEW REQUIRED - GoPE!";
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: Workflow GoPE <info@globalphysicaleducationobservatory.com>' . "\r\n";
      $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com' . "\r\n";
      $headers .= "X-Priority: 1\r\n";
      $headers .= 'X-Mailer: PHP/' . phpversion();
    
      $message = "
      <br>
        Dear ".$country_name." Contact,
      <br><br>
        For the Third set of Country Cards ".$year.", we have updated the data for the GoPE! physical education indicators. Please log into the Workflow in order to review the indicators, make any adjustments and approve the new Country Card.
      <br><br>
        Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
      <br><br>
        <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Indicators/indicatorsProgress.php?id=$countryId'>Workflow</a>
      <br><br>
        If you have any questions, please contact us at <a href='mailto: main.admin@email.com'>main.admin@email.com</a>
      ";
    
      mail($to, $subject, $message, $headers);
    }
    echo "success";
  }

} else {
  echo "error";
}