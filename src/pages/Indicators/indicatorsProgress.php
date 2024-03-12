<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}

$indicators = array("demographic_data", "pa_pravelance", "pe_policy", "pe_monitoring");
$countryId = $_GET['id'];
// $valueTypes = array("comments", "values_admin", "values_contact", "agreement");

$progressIndicators = array(0, 0, 0, 0);
$totalIndicators = array(14, 3, 1, 6);

$index = 0;
foreach ($indicators as $step) {
  //select row from demographic_values_contacct table
  $sql = "SELECT * FROM " . $step . "_agreement WHERE id = ".$countryId;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  //for each row except id, check if the value is not null or zero
  foreach($row as $key => $value){
    if($key != "id_country" && $value == 2){
      $progressIndicators[$index] ++;
    }
  }
  $index ++;
}

foreach ($progressIndicators as $key => $progress) {
  $progress = ($progress / $totalIndicators[$key]) * 100;

  if ($progress == 100 || $progress > 100) {
    $progress[$key] = 100;
  }

  //format to 1 numbers after comma
  $progress[$key] = number_format($progress[$key], 1);
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
        <p>Welcome to our dashboard! Here, you can monitor the indicators' review progress. Keep in mind that achieving
          100% completion requires a collaborative process</p>
        <ul>
          <li>
            Enter new information and comments as needed
          </li>
          <li>
            The GoPE! team will review the information you provide
          </li>
          <li>
            We will send the data back to you for final confirmation
          </li>
          <li>
            Only when you approve all information as correct, will the indicator reach 100% completion
          </li>
        </ul>
      </div>
      <div class="container__cards-progress">
        <div class="card-progress">
          <div class="progress">
            <?php echo $progressIndicators[0] ?>%
          </div>
          <h3>Demographic data</h3>
        </div>
        <div class="card-progress">
          <div class="progress">
            <?php echo $progressIndicators[1] ?>%
          </div>
          <h3>Physical activity prevalence</h3>
        </div>
        <div class="card-progress">
          <div class="progress">
            <?php echo $progressIndicators[2] ?>%
          </div>
          <h3>Physical Education policy</h3>
        </div>
        <div class="card-progress">
          <div class="progress">
            <?php echo $progressIndicators[3] ?>%
          </div>
          <h3>Physical Education policy</h3>
        </div>
        <div class="card-progress">
          <div class="progress">
            <?php echo $progressIndicators[4] ?>%
          </div>
          <h3>Research in PE and school-based PA</h3>
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