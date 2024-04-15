<?php
include "../../../config.php";

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
      $to = $email;
      //get the actual year
      $year = date("Y");
      date_default_timezone_set('Europe/Lisbon');
      $date = date('m/d/Y h:i:s a', time());
      
      $subject = "Indicators step - CONTACT REQUEST REVIEW - GoPE!";
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: prferreiraj@loudoun.dreamhost.com' . "\r\n";
      $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com' . "\r\n";
      $headers .= "X-Priority: 1\r\n";
      $headers .= 'X-Mailer: PHP/' . phpversion();
    
      $message = "
      <br>
        Dear Admin, 
        <br>
      ".$country_name." Contact,
      <br><br>
        ".$country_name." Contact has sended new information about indicators step for the Country Cards $year Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Indicators/indicatorsProgress.php?$countryId'>here</a>.
      <br><br>
        Please click in the <b>link below</b> to enter the $year GoPE! Country Cards Workflow.
      <br><br>
        <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Indicators/indicatorsProgress.php?$countryId'>Workflow</a>
      <br><br>
      ";
    
      mail($to, $subject, $message, $headers);
    }
    echo "success";
  }

} else {
  echo "error";
}