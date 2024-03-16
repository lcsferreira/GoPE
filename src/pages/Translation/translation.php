<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}


// // Processar o formulário quando o botão for clicado
// if (isset($_POST["language"])) {
//   $selected_language = $_POST["language"];

//   // Cria a lista de colunas s1 a s57
//   $columns = implode(', ', array_map(function ($i) {
//       return "s" . ($i + 1);
//   }, range(1, 56)));

//   //if the country already has data, delete it
//   $sql = "DELETE FROM translations WHERE country_id = ".$country_id;
//   $result = $connection->query($sql);

//   // Consulta para copiar dados
//   $copy_sql = "INSERT INTO translations (country_id, id, $columns) 
//                   SELECT $country_id, 0, $columns 
//                   FROM language_translations 
//                   WHERE language = '$selected_language' limit 1";

//   $result = $connection->query($copy_sql);

//   // if ($conn->query($copy_sql) === TRUE) {
//   //     echo "<p>Dados copiados com sucesso!</p>";
//   // } else {
//   //     echo "<p>Erro ao copiar dados</p>";
//   // }
// }


// $sql = "SELECT * FROM translations WHERE country_id = ".$country_id;
// $result = $connection->query($sql);
// if ($result->num_rows > 0) {
//   if(isset($_POST['submit']))
//   {
//       $sql = "update translations set  s1 = '".$_POST['s1']."', s2 = '".$_POST['s2']."', s3 = '".$_POST['s3']."', s4 = '".$_POST['s4']."', s5 = '".$_POST['s5']."',
//                                       s6 = '".$_POST['s6']."', s7 = '".$_POST['s7']."', s8 = '".$_POST['s8']."',s9 = '".$_POST['s9']."', s10 = '".$_POST['s10']."', s11 = '".$_POST['s11']."',
//                                       s12 = '".$_POST['s12']."', s13 = '".$_POST['s13']."',s14 = '".$_POST['s14']."', s15 = '".$_POST['s15']."', s16 = '".$_POST['s16']."',
//                                       s17 = '".$_POST['s17']."', s18 = '".$_POST['s18']."',s19 = '".$_POST['s19']."', s20 = '".$_POST['s20']."', s21 = '".$_POST['s21']."',
//                                       s22 = '".$_POST['s22']."', s23 = '".$_POST['s23']."',s24 = '".$_POST['s24']."', s25 = '".$_POST['s25']."',
//                                       s26 = '".$_POST['s26']."', s27 = '".$_POST['s27']."', s28 = '".$_POST['s28']."', s29 = '".$_POST['s29']."',
//                                       s30 = '".$_POST['s30']."', s31 = '".$_POST['s31']."', s32 = '".$_POST['s32']."', s33 = '".$_POST['s33']."',
//                                       s34 = '".$_POST['s34']."', s35 = '".$_POST['s35']."', s36 = '".$_POST['s36']."', s37 = '".$_POST['s37']."',
//                                       s38 = '".$_POST['s38']."', s39 = '".$_POST['s39']."', s40 = '".$_POST['s40']."',
//                                       s41 = '".$_POST['s41']."', s42 = '".$_POST['s42']."', s43 = '".$_POST['s43']."', s44 = '".$_POST['s44']."',
//                                       s45 = '".$_POST['s45']."', s46 = '".$_POST['s46']."', s47 = '".$_POST['s47']."', s48 = '".$_POST['s48']."',
//                                       s49 = '".$_POST['s49']."', s50 = '".$_POST['s50']."', s51 = '".$_POST['s51']."', s52 = '".$_POST['s52']."',
//                                       s53 = '".$_POST['s53']."', s54 = '".$_POST['s54']."', s55 = '".$_POST['s55']."', s56 = '".$_POST['s56']."',
//                                       s57 = '".$_POST['s57']."' 
//           WHERE country_id = ".$country_id;
//       $rs = mysqli_query($connection, $sql);
//       $affectedRows = mysqli_affected_rows($connection);
//       if($affectedRows >0){ 
//           //update the countries table of the translation_step to 'approved'
//           $sql = "UPDATE countries SET translation_step = 'approved' WHERE id = ".$country_id;
//           $rs = mysqli_query($connection, $sql);
//       }
//       echo "<script>window.location.href = '../countriesList/countriesListContacts.php?id=".$country_id."';</script>";
//       //redirect to countries list with javascript
//   }
// }
// else { 
//   if(isset($_POST['submit']))
//   {
//     $sql = "insert into translations values (".$country_id.", 0, '".
//                                       $_POST['s1']."','".$_POST['s2']."','".$_POST['s3']."','".$_POST['s4']."','".$_POST['s5']."','".$_POST['s6']."','".$_POST['s7']."','".$_POST['s8']."','".$_POST['s9']."','".$_POST['s10']."','".
//                                       $_POST['s11']."','".$_POST['s12']."','".$_POST['s13']."','".$_POST['s14']."','".$_POST['s15']."','".$_POST['s16']."','".$_POST['s17']."','".$_POST['s18']."','".$_POST['s19']."','".$_POST['s20']."','".
//                                       $_POST['s21']."','".$_POST['s22']."','".$_POST['s23']."','".$_POST['s24']."','".$_POST['s25']."','".$_POST['s26']."','".$_POST['s27']."','".$_POST['s28']."','".$_POST['s29']."','".$_POST['s30']."','".
//                                       $_POST['s31']."','".$_POST['s32']."','".$_POST['s33']."','".$_POST['s34']."','".$_POST['s35']."','".$_POST['s36']."','".$_POST['s37']."','".$_POST['s38']."','".$_POST['s39']."','".$_POST['s40']."','".
//                                       $_POST['s41']."','".$_POST['s42']."','".$_POST['s43']."','".$_POST['s44']."','".$_POST['s45']."','".$_POST['s46']."','".$_POST['s47']."','".$_POST['s48']."','".
//                                       $_POST['s49']."','".$_POST['s50']."','".$_POST['s51']."','".$_POST['s52']."','".$_POST['s53']."','".$_POST['s54']."','".$_POST['s55']."','".$_POST['s56']."','".$_POST['s57'].
//                                       "')";

//       $rs = mysqli_query($connection, $sql);
//     $affectedRows = mysqli_affected_rows($connection);
//       if($affectedRows >0){ 
//           //update the countries table of the translation_step to 'approved'
//           $sql = "UPDATE countries SET translation_step = 'approved' WHERE id = ".$country_id;
//           $rs = mysqli_query($connection, $sql);
//           //send email to admin
//           $sql = "SELECT name FROM countries WHERE id = $country_id";
//           $stmt = mysqli_prepare($connection, $sql);
//           mysqli_stmt_execute($stmt);
//           $result = mysqli_stmt_get_result($stmt);
//           $row = mysqli_fetch_assoc($result);
//           $country_name = $row['name'];

//           $admin_emails = ["lucas.simoes.ferreira@gmail.com"];
//           foreach ($admin_emails as $email) {
//               //get time
//               date_default_timezone_set('Europe/Lisbon');
//               $date = date('m/d/Y h:i:s a', time());
//               $year = date("Y");
//               //send email to admin
//               $assunto = "Translation Step - COMPLETED - GoPE!";
                  
//               $headers  = 'MIME-Version: 1.0' . "\r\n";
//               $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//               $headers .= 'From: Workflow GoPA <info@globalphysicalactivityobservatory.com>'. "\r\n";
//               $headers .= 'Reply-To: info@globalphysicalactivityobservatory.com'. "\r\n";
//               $headers .= "X-Priority: 1\r\n";
//               $headers .= 'X-Mailer: PHP/' . phpversion();
          
//               $mensagem = "
//               <br>
//               Dear Admin,
//               <br><br>
//               ".$country_name." Contact has completed the translation step for the Country Cards ".$year." Workflow on ".$date.". You may view their responses <a href=''>here</a>.
//               <br><br>
//               Please click in the <b>link below</b> to enter the ".$year." GoPE! Country Cards Workflow.
//               <br><br>
//               <a href=''>Workflow</a>
//               <br><br>
//               ";
          
//               $enviaremail = mail($email, $assunto, $mensagem, $headers);
//           }
//       }
//       echo "<script>window.location.href = '../countriesList/countriesListContacts.php?id=".$country_id."';</script>";
//   }
// }
// // Consulta para obter as opções do select
// $sql = "SELECT DISTINCT language FROM language_translations order by language";
// $result1 = $connection->query($sql);

// $sql = "SELECT * FROM translations WHERE country_id = ".$country_id;
// $result = $connection->query($sql);
// $row = $result->fetch_assoc();
// $has_data = true;
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Translation - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/pages/indicators.css">
  <link rel="stylesheet" href="../../css/pages/translation.css">
  <link rel="stylesheet" href="../../css/components/commentGroup.css">
  <link rel="stylesheet" href="../../css/components/agreementGroup.css">
  <link rel="stylesheet" href="../../css/pages/cardUpload.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <?php
      $icon = "fas fa-exclamation-circle";
      $message = "Do you want to approve this step? This action will disable the possibility of modifying the data.";
      $buttonConfirmText = "Confirm";
      $buttonCloseText = "Cancel";
      include '../../components/modalCard.php';
    ?>
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1><strong>Review</strong> the Country <strong>Card</strong></h1>
      <div>
        <p>Please translate the following sentences to your country’s native language.</p>
      </div>
    </div>
    <div class="indicators-container">
      <form method="post" action="" style="margin: 2rem;">
        <label for="language">Language:</label>
        <select name="language" id="language" <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>>
          <?php
                      if ($result1->num_rows > 0) {
                          while ($row1 = $result1->fetch_assoc()) {
                              echo "<option value='" . $row1["language"] . "'>" . $row1["language"] . "</option>";
                          }
                      }
                      //default empty option
                      echo "<option value='' selected>Select</option>";
                      
                      ?>
        </select>
        <button class="btn-primary" type="submit" name="copy_data"
          <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>>Use as
          Default
          Language</button>
      </form>
      <form method="post" id="form" style="display: flex; flex-direction:column; gap:2rem;">
        <div style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>01</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">Please tell us what is your country's name in the native country language?
              For example Brazil = name
              in English; Brasil = name in Portuguese.</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s1" maxlength="255"><?php if ($has_data) echo $row["s1"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>02</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "World region (Africa — AFRO; Eastern Mediterranean
              EMRO; Europe - EURO; The
              Americas and the Caribbean - PAHO; South—East Asia - SEARO; Western Pacific - WPRO)" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s2" maxlength="255"><?php if ($has_data) echo $row["s2"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>03</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Demographic Data" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s3" maxlength="255"><?php if ($has_data) echo $row["s3"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>04</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate the word "Capital" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s4" maxlength="255"><?php if ($has_data) echo $row["s4"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>05</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Population" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s5" maxlength="255"><?php if ($has_data) echo $row["s5"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>06</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Urban Population" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s6" maxlength="255"><?php if ($has_data) echo $row["s6"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>07</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Life expectancy" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s7" maxlength="255"><?php if ($has_data) echo $row["s7"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>08</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Gini index for income inequality" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s8" maxlength="255"><?php if ($has_data) echo $row["s8"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>09</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Human Development Index" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s9" maxlength="255"><?php if ($has_data) echo $row["s9"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>10</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Literacy Rate" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s10" maxlength="255"><?php if ($has_data) echo $row["s10"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>11</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Deaths from non—communicable diseases" into your
              country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s11" maxlength="255"><?php if ($has_data) echo $row["s11"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>12</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Risk of premature non-communicable diseases
              mortality” into your country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s12" maxlength="255"><?php if ($has_data) echo $row["s12"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>13</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Human Capital Index” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s13" maxlength="255"><?php if ($has_data) echo $row["s13"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>14</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Democracy Index” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s14" maxlength="255"><?php if ($has_data) echo $row["s14"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>15</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Tax Burden” into your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s15" maxlength="255"><?php if ($has_data) echo $row["s15"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>16</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "World Bank Income Category (High income - Upper
              middle income — Lower middle
              income - Low income)" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s16" maxlength="255"><?php if ($has_data) echo $row["s16"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>17</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Physical Activity Participation" into your
              country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s17" maxlength="255"><?php if ($has_data) echo $row["s17"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>18</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Physical Activity Prevalence estimates for adults"
              into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s18" maxlength="255"><?php if ($has_data) echo $row["s18"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>19</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Adults" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s19" maxlength="255"><?php if ($has_data) echo $row["s19"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>20</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Gender Inequalities in Physical Activity
              Prevalence" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s20" maxlength="255"><?php if ($has_data) echo $row["s20"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>21</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Women" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s21" maxlength="255"><?php if ($has_data) echo $row["s21"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>22</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Men" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s22" maxlength="255"><?php if ($has_data) echo $row["s22"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>23</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Worldwide" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s23" maxlength="255"><?php if ($has_data) echo $row["s23"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>24</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "World region" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s24" maxlength="255"><?php if ($has_data) echo $row["s24"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>25</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "This country card is part of the 3rd Physical
              Activity Almanac (free resource
              on the GoPA! website) For description of indicators and data sources visit: " into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s25" maxlength="255"><?php if ($has_data) echo $row["s25"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>26</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Policy and Surveillance Status" into your
              country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s26" maxlength="255"><?php if ($has_data) echo $row["s26"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>27</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "National physical activity policy/plan" into your
              country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s27" maxlength="255"><?php if ($has_data) echo $row["s27"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>28</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "National recommendations" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s28" maxlength="255"><?php if ($has_data) echo $row["s28"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>29</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "National survey(s) including physical activity
              questions" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s29" maxlength="255"><?php if ($has_data) echo $row["s29"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>30</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Most recent" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s30" maxlength="255"><?php if ($has_data) echo $row["s30"]?></textarea></div>
          </div>
        </div>

        <div class="buttons">
          <?php if($_SESSION['type'] == 'admin'): ?>
          <button class="btn-back" type="button"
            onclick="document.location = `../countriesList/countriesListAdmin.php`">Back</button>
          <?php endif; ?>
          <?php if($_SESSION['type'] == 'admin'): ?>
          <button class="btn-primary" type="button" name="confirmval" onclick="openConfirmationModal()">Send to
            GoPA</button>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  const btnBack = document.querySelector('.btn-back');
  btnBack.addEventListener('click', () => {
    window.location.href =
      '../Dashboard/countriesList.php<?php if($_SESSION['type']=='contact') {echo "?id=".$_SESSION['id'];} ?>';
  });
  const modal = document.querySelector('.modal');
  const modalConfirm = document.querySelector('#modal-confirm');
  const modalClose = document.querySelector('#modal-close');

  function openConfirmationModal() {
    modal.style.display = 'block';
  }

  modalConfirm.addEventListener('click', () => {
    modal.style.display = 'none';
    sendTranslations();
  });

  modalClose.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  function sendTranslations() {
    //get all the values fro the #form
    const form = document.querySelector('#form');
    const formData = new FormData(form);
    const data = {};
    for (const [key, value] of formData.entries()) {
      data[key] = value;
    }
    console.log(data);
  }
  </script>
</body>

</html>