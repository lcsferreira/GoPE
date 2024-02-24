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
  <link rel="stylesheet" href="../../css/components/sideNavBar.css">
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
    <div class="indicators-container">
      <?php include '../../components/sideNavBar.php'; ?>
      <div style="display: flex; flex-direction:column; gap:2rem; margin-left: 10rem;">
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>01</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 1;
			  $inputName = "pa_prevalence_boys";
			  $inputTitle = "Physical activity prevalence in boys aged 11-17 years (%)";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "pa_prevalence_boys";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 1;
			$inputName = "pa_prevalence_boys";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>

        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>02</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 2;
			  $inputName = "pa_prevalence_girls";
			  $inputTitle = "Physical activity prevalence in girls aged 11-17 years (%)";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "pa_prevalence_girls";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 2;
			$inputName = "pa_prevalence_girls";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>

        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>03</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 3;
			  $inputName = "pa_prevalence_children_adolescents";
			  $inputTitle = "Physical activity prevalence in children and adolescents (total) aged 11-17
			  years (%)";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "pa_prevalence_children_ado";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 3;
			$inputName = "pa_prevalence_children_ado";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  </script>
</body>

</html>