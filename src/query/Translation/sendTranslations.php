<?php
include '../../../config.php';
$country_id = $_GET['id'];

$sql = "update translations set s1 = '".$_POST['s1']."', s2 = '".$_POST['s2']."', s3 = '".$_POST['s3']."', s4 = '".$_POST['s4']."', s5 = '".$_POST['s5']."',
                                s6 = '".$_POST['s6']."', s7 = '".$_POST['s7']."', s8 = '".$_POST['s8']."',s9 = '".$_POST['s9']."', s10 = '".$_POST['s10']."', s11 = '".$_POST['s11']."',
                                s12 = '".$_POST['s12']."', s13 = '".$_POST['s13']."',s14 = '".$_POST['s14']."', s15 = '".$_POST['s15']."', s16 = '".$_POST['s16']."',
                                s17 = '".$_POST['s17']."', s18 = '".$_POST['s18']."',s19 = '".$_POST['s19']."', s20 = '".$_POST['s20']."', s21 = '".$_POST['s21']."',
                                s22 = '".$_POST['s22']."', s23 = '".$_POST['s23']."',s24 = '".$_POST['s24']."', s25 = '".$_POST['s25']."',
                                s26 = '".$_POST['s26']."', s27 = '".$_POST['s27']."', s28 = '".$_POST['s28']."', s29 = '".$_POST['s29']."',
                                s30 = '".$_POST['s30']."' WHERE id_country = ".$country_id;
$rs = mysqli_query($conn, $sql);

if($rs > 0){ 
  //update the countries table of the translation_step to 'approved'
  $sql = "UPDATE countries SET translation_step = 'completed' WHERE id = ".$country_id;
  $rs = mysqli_query($conn, $sql);

  //send email to admin
  $sql = "SELECT name FROM countries WHERE id = $country_id";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  $country_name = $row['name'];

  $admin_emails = ["lucas.simoes.ferreira@gmail.com"];
  foreach ($admin_emails as $email) {
    //get time
    date_default_timezone_set('Europe/Lisbon');
    $date = date('m/d/Y h:i:s a', time());
    $year = date("Y");
    //send email to admin
    $assunto = "Translation Step - COMPLETED - GoPE!";
        
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Workflow GoPE <info@globalphysicaleducationobservatory.com>'. "\r\n";
    $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com'. "\r\n";
    $headers .= "X-Priority: 1\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    $mensagem = "
    <br>
    Dear Admin,
    <br><br>
    ".$country_name." Contact has completed the translation step for the Country Cards ".$year." Workflow on ".$date.". You may view their responses <a href=''>here</a>.
    <br><br>
    Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
    <br><br>
    <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Translation/translation.php?id=".$country_id."'>Workflow</a>
    <br><br>
    ";

    mail($email, $assunto, $mensagem, $headers);
  }
  if($_SESSION['type']=='contact') {
    echo "success";
  }
  else {
    echo "success";
  }
}

?>