<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
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
          <div class="progress-bar">
            <div class="progress-bar__fill" style="width: 50%;">
              <p>50%</p>
            </div>
          </div>
          <h3>Demographic data</h3>
        </div>
        <div class="card-progress">
          <div class="progress-bar">
            <div class="progress-bar__fill" style="width: 50%;">
              <p>50%</p>
            </div>
          </div>
          <h3>Physical activity prevalence”</h3>
        </div>
        <div class="card-progress">
          <div class="progress-bar">
            <div class="progress-bar__fill" style="width: 50%;">
              <p>50%</p>
            </div>
          </div>
          <h3>Physical Education policy</h3>
        </div>
        <div class="card-progress">
          <div class="progress-bar">
            <div class="progress-bar__fill" style="width: 50%;">
              <p>50%</p>
            </div>
          </div>
          <h3>Physical Education monitoring</h3>
        </div>
        <div class="card-progress">
          <div class="progress-bar">
            <div class="progress-bar__fill" style="width: 50%;">
              <p>50%</p>
            </div>
          </div>
          <h3>Research in PE and school-based PA</h3>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  </script>
</body>

</html>