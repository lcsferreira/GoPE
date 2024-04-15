<?php
include '../../../config.php';
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
      $to = $email;
      $year = date("Y");
      $subject = "Translation step - STARTED - GoPE!";
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: prferreiraj@loudoun.dreamhost.com' . "\r\n";
      $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com' . "\r\n";
      $headers .= "X-Priority: 1\r\n";
      $headers .= 'X-Mailer: PHP/' . phpversion();
    
      $message = "
      <br>
        Dear ".$countryName." Contact,
      <br><br>
      For the First set of Country Cards ".$year.", <b>we have started the translation of the GoPE! Country Card.</b> Please log into the workflow in order to fulfill the translation.
      <br><br>
      Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
      <br><br>
      <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Translation/translation.php?id=".$country_id."'>Workflow</a>
      <br><br>
      If you have any questions, please contact us at <a href='mailto: main.admin@email.com'>main.admin@email.com</a>
      ";
    
      mail($to, $subject, $message, $headers);
    }

    header('Location: ../../pages/Translation/translation.php?id='.$country_id);
  }
}else{
  echo "error";
}