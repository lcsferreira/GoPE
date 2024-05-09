<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}
//check if hasEdited is setted, and if is false keep it false
if (!isset($_SESSION['hasEdited']) || $_SESSION['hasEdited'] === false) {
  $_SESSION['hasEdited'] = false;
}

$indicators = array("demographic_data", "pa_prevalence", "pe_policy", "pe_monitoring");
$countryId = $_GET['id'];
// $valueTypes = array("comments", "values_admin", "values_contact", "agreement");

$progressIndicators = array(0, 0, 0, 0);
$totalIndicators = array(14, 3, 6, 1);

$index = 0;
foreach ($indicators as $step) {
  //select row from demographic_values_contacct table
  $sql = "SELECT * FROM " . $step . "_agreement WHERE id_country = ".$countryId;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  //for each row except id, check if the value is not null or zero
  foreach($row as $key => $value){
    if($key != "id_country" && $value == 1){
      $progressIndicators[$index] ++;
    }
  }
  $index ++;
}

foreach ($progressIndicators as $key => $progress) {
  $progress = ($progress / $totalIndicators[$key]) * 100;

  if ($progress == 100 || $progress > 100) {
    $progress = 100;
  }

  //format to 1 numbers after comma
  $progress = number_format($progress, 1);
  $progressIndicators[$key] = $progress;
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Progress of Indicators - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/pages/indicators.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1>Country <strong>Progress</strong></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2><strong>Indicators</strong></h2>
      </div>
      <div class="dashboard-container__description">
        <p>Dear Country Contact, in the First set of Country Cards, GoPE!’s core indicators will be
          updated to the most recent and available information. Here, you can monitor the
          indicators' review progress. Keep in mind that achieving 100% completion requires a
          collaborative process between the Country Contact and the GoPE! team.</p>
        <p>You will have to review the Country Card’s indicators, review the English version of the
          Country Contact, translate your country’s Country Card (if applicable) and review the
          translated version of the Country Card (if applicable).</p>
        <p style="color: var(--blue); font-weight:bold">
          The GoPE! team will review the information you provide.
          We will send the data back to you for final confirmation.
        </p>
        <p style="color: var(--blue);">
          The system automatically stores data. You can log out and log back in as needed, and
          your progress won’t be lost. No limit exists to how often you check the data before its
          approval. However, once the data is approved by you (or by the main GoPE! Country
          Contact when multiple Country Contacts exist), you won't be able to make any more
          changes.
        </p>
      </div>
      <div class="container__cards-progress">
        <div class="card-progress" onclick="window.location.href='demographicData.php?id=<?php echo $_GET['id'] ?>'"
          style="background: linear-gradient(360deg, rgba(76,95,126,1) 0%, rgba(141,184,233,1) 100%);">
          <div class="progress">
            <?php echo $progressIndicators[0] ?>%
          </div>
          <h3>Country and Demographic data</h3>
        </div>
        <div class="card-progress" onclick="window.location.href='paPrevalence.php?id=<?php echo $_GET['id'] ?>'"
          style="background: linear-gradient(360deg, rgba(31,99,157,1) 34%, rgba(40,156,255,1) 100%);">
          <div class="progress">
            <?php echo $progressIndicators[1] ?>%
          </div>
          <h3>Physical activity participation</h3>
        </div>
        <div class="card-progress" onclick="window.location.href='pePolicy.php?id=<?php echo $_GET['id'] ?>'">
          <div class="progress">
            <?php echo $progressIndicators[2] ?>%
          </div>
          <h3>Physical Education policy</h3>
        </div>
        <div class="card-progress" onclick="window.location.href='peMonitoring.php?id=<?php echo $_GET['id'] ?>'"
          style="background: linear-gradient(360deg, rgba(17,38,71,1) 0%, rgba(90,120,152,1) 100%);">
          <div class="progress">
            <?php echo $progressIndicators[3] ?>%
          </div>
          <h3>Physical Education monitoring</h3>
        </div>
        <div class="card-progress" onclick="window.location.href='researchPe.php?id=<?php echo $_GET['id'] ?>'"
          style="background: linear-gradient(360deg, rgba(18,25,36,1) 0%, rgba(70,102,137,1) 100%);">
          <div class="progress">
            100.0%
          </div>
          <h3>PE and school-based PA interventions research</h3>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  const buttonNext = document.querySelector('.btn-next');
  const buttonBack = document.querySelector('.btn-back');

  buttonNext.addEventListener('click', () => {
    window.location.href = 'demographicData.php?id=<?php echo $_GET['id'] ?>';
  });

  buttonBack.addEventListener('click', () => {
    window.location.href = '../Dashboard/countriesList.php<?php if ($_SESSION['type'] == 'admin') {
                                                              echo "'";
                                                            } else {
                                                              echo "?id=" . $_SESSION['id'] . "'";
                                                            }
                                                            ?>
  });
  </script>
</body>

</html>