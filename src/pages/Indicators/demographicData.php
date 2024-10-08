<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}

// $sql = "SELECT id, title, year_publication, eletronic_source, voluntary_comment FROM documents INNER JOIN duration_compulsory_pe_documents_admin ON documents.id = duration_compulsory_pe_documents_admin.id_document";
// $result = mysqli_query($conn, $sql);
// $durationDocumentsPEAdmin = [];
// while ($row = mysqli_fetch_assoc($result)) {
//   array_push($durationDocumentsPEAdmin, $row);
// }

// $sql = "SELECT id, title, year_publication, eletronic_source, voluntary_comment FROM documents INNER JOIN duration_compulsory_pe_documents_contact ON documents.id = duration_compulsory_pe_documents_contact.id_document";
// $result = mysqli_query($conn, $sql);
// $durationDocumentsPEContact = [];
// while ($row = mysqli_fetch_assoc($result)) {
//   array_push($durationDocumentsPEContact, $row);
// }

$sql = "SELECT * FROM demographic_data_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$adminValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM demographic_data_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$contactValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM demographic_data_comments WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$commentValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM demographic_data_agreement WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$agreementValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM duration_compulsory_pe_documents_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$compulsoryPeDocumentsAdmin = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM duration_compulsory_pe_documents_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$compulsoryPeDocumentsContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM duration_compulsory_se_documents_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$compulsorySeDocumentsAdmin = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM duration_compulsory_se_documents_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$compulsorySeDocumentsContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Country and Demographic data - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/sideNavBar.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/components/modalMethod.css">
  <link rel="stylesheet" href="../../css/components/agreementGroup.css">
  <link rel="stylesheet" href="../../css/components/commentGroup.css">
  <link rel="stylesheet" href="../../css/pages/indicators.css">
  <link rel="stylesheet" href="../../css/components/videoContainer.css">
  <link rel="stylesheet" href="../../css/components/cardLocation.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <?php 
    // $typeModal = "warning";
    // $icon = "fas fa-exclamation-triangle";
    // $buttonCloseText = "Close";
    // include '../../components/modalInfo.php'; ?>
    <?php include '../../components/modalMetodology.php'; ?>
    <?php
    $cardLocationPath = "../../assets/card_demographic_data.png";
    include '../../components/cardLocation.php';
    ?>
    <!-- <div id="notification" class="notification">
      <div class="notification-content">
        <p id="notification-message">Error saving data. Please try again.</p>
        <button id="close-btn" class="close-btn">&times;</button>
        <div id="progress-bar" class="progress-bar"></div>
      </div>
    </div> -->


    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1>Country and demographic data <i class="fas fa-info-circle" id="cardLocationModal"></i></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="indicators-container">
      <?php include '../../components/sideNavBar.php'; ?>
      <div style="display: flex; flex-direction:column; gap:2rem; margin-left: 10rem;">
        <?php 
        $videoTitle = "Methodological approach for collecting country and demographic data";
        $videoUrl = "https://drive.google.com/file/d/1IN3WSir94uzGzdt_2is7Wj1ajX70-rMP/preview";
        include '../../components/videoContainer.php'; ?>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>01</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 1;
              $inputs = [
                (object) [
                  "name" => "country",
                  "title" => "Country name",
                  "type" => "text",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="1-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 1;
              $inputs = [
                (object) [
                  "name" => "country",
                  "title" => "Country name",
                  "type" => "text",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "country";
              $indicatorOrder = 1;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 1;
            $indicatorName = "country";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>02</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 2;
              $inputs = [
                (object) [
                  "name" => "capital",
                  "title" => "Capital city name",
                  "type" => "text",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="2-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 2;
              $inputs = [
                (object) [
                  "name" => "capital",
                  "title" => "Capital city name",
                  "type" => "text",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "capital";
              $indicatorOrder = 2;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 2;
            $indicatorName = "capital";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>03</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 3;
              $inputs = [
                (object) [
                  "name" => "total_population",
                  "title" => "Total population (n)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="3-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 3;
              $inputs = [
                (object) [
                  "name" => "total_population",
                  "title" => "Total population (n)",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "total_population";
              $indicatorOrder = 3;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 3;
            $indicatorName = "total_population";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>04</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 4;
              $inputs = [
                (object) [
                  "name" => "literacy_youth_total",
                  "title" => "Literacy youth total 15-24 years (%)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="4-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 4;
              $inputs = [
                (object) [
                  "name" => "literacy_youth_total",
                  "title" => "Literacy youth total 15-24 years (%)",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "literacy_youth_total";
              $indicatorOrder = 4;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 4;
            $indicatorName = "literacy_youth_total";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>05</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 5;
              $inputs = [
                (object) [
                  "name" => "gov_expenditure_education",
                  "title" => "Government expenditure on education (%)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="5-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 5;
              $inputs = [
                (object) [
                  "name" => "gov_expenditure_education",
                  "title" => "Government expenditure on education (%)",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "gov_expenditure_education";
              $indicatorOrder = 5;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 5;
            $indicatorName = "gov_expenditure_education";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>06</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 6;
              $inputs = [
                (object) [
                  "name" => "entrance_age_pe",
                  "title" => "Official entrance age to primary education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="6-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 6;
              $inputs = [
                (object) [
                  "name" => "entrance_age_pe",
                  "title" => "Official entrance age to primary education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "entrance_age_pe";
              $indicatorOrder = 6;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 6;
            $indicatorName = "entrance_age_pe";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>07</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 7;
              $inputs = [
                (object) [
                  "name" => "entrance_age_se",
                  "title" => "Official entrance age to secondary education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="7-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 7;
              $inputs = [
                (object) [
                  "name" => "entrance_age_se",
                  "title" => "Official entrance age to secondary education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "entrance_age_se";
              $indicatorOrder = 7;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 7;
            $indicatorName = "entrance_age_se";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>08</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 8;
              $inputs = [
                (object) [
                  "name" => "duration_pe",
                  "title" => "Duration of primary education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="8-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 8;
              $inputs = [
                (object) [
                  "name" => "duration_pe",
                  "title" => "Duration of primary education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "duration_pe";
              $indicatorOrder = 8;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 8;
            $indicatorName = "duration_pe";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>09</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 9;
              $inputs = [
                (object) [
                  "name" => "duration_se",
                  "title" => "Duration of secondary education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="9-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 9;
              $inputs = [
                (object) [
                  "name" => "duration_se",
                  "title" => "Duration of secondary education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "duration_se";
              $indicatorOrder = 9;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 9;
            $indicatorName = "duration_se";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>10</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 10;
              $inputs = [
                (object) [
                  "name" => "duration_ce",
                  "title" => "Duration of compulsory education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="10-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 10;
              $inputs = [
                (object) [
                  "name" => "duration_ce",
                  "title" => "Duration of compulsory education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "duration_ce";
              $indicatorOrder = 10;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 10;
            $indicatorName = "duration_ce";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>11</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 11;
              $inputs = [
                (object) [
                  "name" => "duration_compulsory_pe",
                  "title" => "Duration of the compulsory school years of primary education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <div id="documents-duration_compulsory_pe-admin">
                <?php
                if($compulsoryPeDocumentsAdmin != null) {
                  $docRole = "admin";
                  $tableName = "duration_compulsory_pe_documents_admin";
                  $indicatorName = "duration_compulsory_pe";
                  foreach($compulsoryPeDocumentsAdmin as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
              </div>
              <?php if($_SESSION['type'] == 'admin'): ?>
              <button id="add-document" class="btn-primary" data-indicator-name="duration_compulsory_pe"
                data-table-name="duration_compulsory_pe_documents_admin" data-role="admin"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
              <?php endif; ?>
              <div id="11-contact-label">
                <p class="contact-label">Provide new information here:</p>
                <?php
                $indicatorRole = "contact";
                $indicatorOrder = 11;
                $inputs = [
                  (object) [
                    "name" => "duration_compulsory_pe",
                    "title" => "Duration of the compulsory school years of primary education (years)",
                    "type" => "number",
                    "tableName" => "demographic_data_contact"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
                <div id="documents-duration_compulsory_pe-contact">
                  <?php
                if($compulsoryPeDocumentsContact != null) {
                  $docRole = "contact";
                  $tableName = "duration_compulsory_pe_documents_contact";
                  $indicatorName = "duration_compulsory_pe";
                  foreach($compulsoryPeDocumentsContact as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
                </div>
                <?php if($_SESSION['type'] == 'contact'): ?>
                <button id="add-document" class="btn-primary" data-indicator-name="duration_compulsory_pe"
                  data-table-name="duration_compulsory_pe_documents_contact" data-role="contact"
                  style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
                <?php endif; ?>
              </div>
              <?php
              $indicatorName = "duration_compulsory_pe";
              $indicatorOrder = 11;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 11;
            $indicatorName = "duration_compulsory_pe";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>12</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 12;
              $inputs = [
                (object) [
                  "name" => "duration_compulsory_se",
                  "title" => "Duration of the compulsory school years of secondary education (years)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <div id="documents-duration_compulsory_se-admin">
                <?php
                if($compulsorySeDocumentsAdmin != null) {
                  $docRole = "admin";
                  $tableName = "duration_compulsory_se_documents_admin";
                  $indicatorName = "duration_compulsory_se";
                  foreach($compulsorySeDocumentsAdmin as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
              </div>
              <?php if($_SESSION['type'] == 'admin'): ?>
              <button id="add-document" class="btn-primary" data-indicator-name="duration_compulsory_se"
                data-table-name="duration_compulsory_se_documents_admin" data-role="admin"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
              <?php endif; ?>
              <div id="12-contact-label">
                <p class="contact-label">Provide new information here:</p>
                <?php
                $indicatorRole = "contact";
                $indicatorOrder = 12;
                $inputs = [
                  (object) [
                    "name" => "duration_compulsory_se",
                    "title" => "Duration of the compulsory school years of secondary education (years)",
                    "type" => "number",
                    "tableName" => "demographic_data_contact"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
                <div id="documents-duration_compulsory_se-contact">
                  <?php
                if($compulsorySeDocumentsContact != null) {
                  $docRole = "contact";
                  $tableName = "duration_compulsory_se_documents_contact";
                  $indicatorName = "duration_compulsory_se";
                  foreach($compulsorySeDocumentsContact as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
                </div>
                <?php if($_SESSION['type'] == 'contact'): ?>
                <button id="add-document" class="btn-primary" data-indicator-name="duration_compulsory_se"
                  data-table-name="duration_compulsory_se_documents_contact" data-role="contact"
                  style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
                <?php endif; ?>
              </div>
              <?php
              $indicatorName = "duration_compulsory_se";
              $indicatorOrder = 12;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 12;
            $indicatorName = "duration_compulsory_se";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>13</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 13;
              $inputs = [
                (object) [
                  "name" => "school_age_pe",
                  "title" => "School-age population at primary education (n)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="13-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 13;
              $inputs = [
                (object) [
                  "name" => "school_age_pe",
                  "title" => "School-age population at primary education (n)",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "school_age_pe";
              $indicatorOrder = 13;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 13;
            $indicatorName = "school_age_pe";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>14</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 14;
              $inputs = [
                (object) [
                  "name" => "school_age_se",
                  "title" => "School-age population at secondary education (n)",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="14-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 14;
              $inputs = [
                (object) [
                  "name" => "school_age_se",
                  "title" => "School-age population at secondary education (n)",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "school_age_se";
              $indicatorOrder = 14;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 14;
            $indicatorName = "school_age_se";
            $tableName = "demographic_data_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./methods/demograhpicData.js"></script>
    <script>
    $(document).ready(function() {
      // verifyIfDocumentIsFFilled("duration_compulsory_pe", "admin")
      $(".btn-back").click(function() {
        window.location.href = "../Indicators/indicatorsProgress.php<?php echo "?id=" . $_GET['id'] ?>";
      });

      $(".btn-next").click(function() {
        window.location.href = "../Indicators/paPrevalence.php<?php echo "?id=" . $_GET['id'] ?>";
      });


      $(".hide-show-video").click(function() {
        hideVideo()
      });

      let methodSpans = document.querySelectorAll("[method]");
      methodSpans.forEach(methodSpan => {
        methodSpan.addEventListener("click", function() {
          openModalMethod(methodSpan.getAttribute("method"))
        })
      })


      openCardLocationModal()
      verifyAgreementInput()
    });

    // function showErrorNotification(message, timeout = 5000) {
    //   const notification = document.getElementById("notification");
    //   const progressBar = document.getElementById("progress-bar");
    //   const progressDiv = document.createElement("div");
    //   const closeButton = document.getElementById("close-btn");

    //   progressDiv.classList.add("progress-bar-fill");

    //   // Atualizar a mensagem de erro
    //   document.getElementById("notification-message").textContent = message;

    //   // Adicionar a barra de progresso
    //   progressBar.innerHTML = "";
    //   progressBar.appendChild(progressDiv);

    //   // Definir a duração da animação da barra de progresso
    //   progressDiv.style.animationDuration = `${timeout / 1000}s`;

    //   // Mostrar notificação com a animação de slide in
    //   notification.style.animation = "slideIn 0.5s forwards";

    //   // Função para fechar a notificação
    //   function closeNotification() {
    //     notification.style.animation = "slideOut 0.5s forwards";
    //   }

    //   // Adicionar evento ao botão de fechar
    //   closeButton.addEventListener("click", closeNotification);

    //   // Fechar notificação automaticamente após o timeout
    //   setTimeout(() => {
    //     closeNotification();
    //   }, timeout);
    // }


    function openModalMethod(method) {
      const methodData = methods.find(
        m => m.name == method)

      $("#modalMethod").css("display", "block")

      $("#indicatorTitle").html(methodData.title)
      $("#modalIndicatorMethod").html(methodData.html)
      $("#modal-close-method").click(function() {
        closeModalMethod()
      })
    }

    function closeModalMethod() {
      $("#indicatorTitle").html("")
      $("#modalIndicatorMethod").html("")
      $("#modalMethod").css("display", "none")
    }

    function openCardLocationModal() {
      $("#cardLocationModal").click(function() {
        $("#cardLocation").css("display", "block")
        $(".card-location-modal-body").append(
          "<p>In GoPE!, we prioritize data comparability between countries and, therefore, rely on established international databases. However, if a GoPE! researcher or Country Contact strongly suggests including another data source, we require the collected data to be supported by an updated official document endorsed by a governmental or political authority.</p>"
        )
        $("#card-location-modal-close").click(function() {
          closeCardLocationModal()
        })
      })
    }

    function closeCardLocationModal() {
      $("#cardLocation").css("display", "none")
      //remove only the p tag
      $(".card-location-modal-body").find("p").remove()
    }

    function addDocumentToTable(indicatorName, tableName, role) {
      const documents = $(`#documents-${indicatorName}-${role}`)
      const lastDoc = documents.children().last().attr('id')
      const docInc = lastDoc ? parseInt(lastDoc.split("-")[2]) + 1 : 1
      let idCountry = <?php echo $_GET['id'] ?>;

      const payload = {
        tableName: tableName,
        indicatorName: indicatorName,
        docInc: docInc
      }

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/addDocumentToTable.php?id=" + idCountry,
        data: {
          payload: payload
        },
        success: function(response) {
          if (response == "Success") {
            showDocument(indicatorName, tableName, role)
          } else {
            // showErrorNotification(
            //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
            //   5000)
            console.log(response)
          }
        }
      });
    }

    function showDocument(indicatorName, tableName, role) {
      const documents = $(`#documents-${indicatorName}-${role}`)
      const lastDoc = documents.children().last().attr('id')
      const docInc = lastDoc ? parseInt(lastDoc.split("-")[2]) + 1 : 1
      const docRole = role

      const document = `
      <div id="document-${indicatorName}-${docInc}-${docRole}">
        <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Document
          ${docInc}
          <span><button class="btn-delete"
              onclick="deleteDocumentFromIndicator(${docInc}, '${tableName}', '${docRole}', '${indicatorName}')"><i
                class="fas fa-trash-alt"></i></button></span>
        </h3>
        <div class="indicator-input">
          <label for="document-title-${indicatorName}-${docInc}-${docRole}">Document
            title</label>
            <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
          <textarea
            name="document-title-${indicatorName}-${docInc}-${docRole}"
            id="document-title-${indicatorName}-${docInc}-${docRole}"
            onblur="saveDocumentValue('document-title-${indicatorName}-${docInc}-${docRole}', '${tableName}', '${docInc}')"></textarea>
        </div>

        <div class="indicator-input">
          <label
            for="document-year_publication-${indicatorName}-${docInc}-${docRole}">Year of publication</label>
            <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
          <textarea
            name="document-year_publication-${indicatorName}-${docInc}-${docRole}"
            id="document-year_publication-${indicatorName}-${docInc}-${docRole}"
            onblur="saveDocumentValue('document-year_publication-${indicatorName}-${docInc}-${docRole}', '${tableName}', '${docInc}')"></textarea>
        </div>

        <div class="indicator-input">
          <label
            for="document-eletronic_source-${indicatorName}-${docInc}-${docRole}">Eletronic
            source</label>
            <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
          <textarea
            name="document-eletronic_source-${indicatorName}-${docInc}-${docRole}"
            id="document-eletronic_source-${indicatorName}-${docInc}-${docRole}"
            onblur="saveDocumentValue('document-eletronic_source-${indicatorName}-${docInc}-${docRole}', '${tableName}', '${docInc}')"></textarea>
        </div>

        <div class="indicator-input">
          <label
            for="document-voluntary_comments-${indicatorName}-${docInc}-${docRole}">Voluntary
            comments</label>
          <textarea
            name="document-voluntary_comments-${indicatorName}-${docInc}-${docRole}"
            id="document-voluntary_comments-${indicatorName}-${docInc}-${docRole}"
            onblur="saveDocumentValue('document-voluntary_comments-${indicatorName}-${docInc}-${docRole}', '${tableName}', '${docInc}')"></textarea>
        </div>
      </div>
    `

      documents.append(document)
    }

    //for all add-document buttons
    const addDocumentButtons = document.querySelectorAll("#add-document")
    addDocumentButtons.forEach(button => {
      button.addEventListener("click", function() {
        let indicatorName = this.dataset.indicatorName
        let tableName = this.dataset.tableName
        let role = this.dataset.role
        addDocumentToTable(indicatorName, tableName, role)
      })
    })

    function saveDocumentValue(inputName, tableName, docInc) {
      let value = $(`#${inputName}`).val()
      let idCountry = <?php echo $_GET['id'] ?>;
      const input = inputName.split("-")[1]

      const payload = {
        tableName: tableName,
        inputName: input,
        value: value,
        idCountry: idCountry,
        docInc: docInc
      }

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/updateDocumentValueOfTable.php?id=" + idCountry,
        data: {
          payload: payload
        },
        success: function(response) {
          console.log(response)
        },
        error: function(error) {
          // showErrorNotification(
          //   "An error occurred while saving the document value due to internet instability. Please try again.",
          //   5000)
          console.log(error)
        }
      });
    }

    function deleteDocumentFromIndicator(docInc, tableName, docRole, indicatorName) {
      let idCountry = <?php echo $_GET['id'] ?>;

      const payload = {
        tableName: tableName,
        docInc: docInc,
        idCountry: idCountry
      }

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/deleteDocumentFromTable.php?id=" + idCountry,
        data: {
          payload: payload
        },
        success: function(response) {
          removeDocumentFromIndicator(tableName, docInc, docRole, indicatorName)
        },
        error: function(error) {
          // showErrorNotification(
          //   "An error occurred while deleting the document due to internet instability. Please try again.", 5000
          // )
          console.log(error)
        }
      });

      function removeDocumentFromIndicator(tableName, docInc, docRole, indicatorName) {
        // id="document-${indicatorName}-${docInc}-${docRole}"
        $(`#document-${indicatorName}-${docInc}-${docRole}`).remove()
      }
    }

    function verifyAgreementInput() {
      let contactInputs = []
      let contactLabels = []
      let agreementGroups = []
      for (let i = 1; i <= 14; i++) {
        // get all the divs with id that contains i and -contact
        if (i == 11 || i == 12) {
          contactLabels.push($(`div[id="${i}-contact-label"]`))
          contactInputs.push($(`div[id="${i}-contact"]`))
          agreementGroups.push($(`div[id*="agreement-group-${i}"]`))
          continue
        }
        contactLabels.push($(`p[id="${i}-contact-label"]`))
        contactInputs.push($(`div[id="${i}-contact"]`))
        agreementGroups.push($(`div[id*="agreement-group-${i}"]`))
      }

      agreementGroups.forEach((agreementGroup, index) => {
        // on load verify the value of the radio input inside of the agreementGroup
        verifyRadioValue(agreementGroup, contactInputs[index], contactLabels[index])
      })
    }

    function verifyRadioValue(agreementGroup, contactInput, contactLabel) {
      //get all the radio inputs inside of the agreementGroup
      let radioInputs = agreementGroup.find("input[type='radio']")
      //if none of the radio inputs are checked hide the contactLabel and contactInput
      if (!radioInputs.is(":checked")) {
        contactLabel.hide()
        contactInput.hide()
      } else if (radioInputs.is(":checked") && radioInputs.filter(":checked").val() == 1) {
        contactLabel.hide()
        contactInput.hide()
      } else {
        contactLabel.show()
        contactInput.show()
      }

      radioInputs.each(function() {
        //on change verify the value of the radio input inside of the agreementGroup
        $(this).change(function() {
          //if the value of the radio input is 1 hide the contactLabel and contactInput
          if ($(this).val() == 1) {
            contactLabel.hide()
            contactInput.hide()
          } else {
            contactLabel.show()
            contactInput.show()
          }
        })
      })
    }

    function saveAgreementValue(indicatorName, tableName, value) {
      let idCountry = <?php echo $_GET['id'] ?>;
      const payload = {
        tableName: tableName,
        indicatorName: indicatorName,
        value: value,
        idCountry: idCountry
      }

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/updateAgreementValue.php",
        data: {
          payload: payload
        },
        success: function(response) {
          console.log(response)
        },
        error: function(error) {
          // showErrorNotification(
          //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
          //   5000)
          console.log(error)

        }
      });
    }

    function saveAdminValue(inputName, tableName) {
      let value = $(`#${inputName}-admin`).val()
      let idCountry = <?php echo $_GET['id'] ?>;

      const payload = {
        tableName: tableName,
        inputName: inputName,
        value: value,
        idCountry: idCountry
      }

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/updateIndicatorValue.php",
        data: {
          payload: payload
        },
        success: function(response) {
          console.log(response)
        },
        error: function(error) {
          // showErrorNotification(
          //   "An error occurred while saving the admin value due to internet instability. Please try again.",
          //   5000)
          console.log(error)
        }
      });
    }

    function saveContactValue(inputName, tableName) {
      let value = $(`#${inputName}-contact`).val()
      let idCountry = <?php echo $_GET['id'] ?>;

      const payload = {
        tableName: tableName,
        inputName: inputName,
        value: value,
        idCountry: idCountry
      }

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/updateIndicatorValue.php",
        data: {
          payload: payload
        },
        success: function(response) {
          console.log(response)
        },
        error: function(error) {
          // showErrorNotification(
          //   "An error occurred while saving the value due to internet instability. Please try again.", 5000)
          console.log(error)

        }
      });
    }

    function saveComment(inputName, tableName) {
      //get the value from textarea
      let value = $(`#${inputName}-comments`).val()
      let idCountry = <?php echo $_GET['id'] ?>;

      const payload = {
        tableName: tableName,
        inputName: inputName,
        value: value,
        idCountry: idCountry
      }

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/updateIndicatorValue.php",
        data: {
          payload: payload
        },
        success: function(response) {
          console.log(response)
        },
        error: function(error) {
          // showErrorNotification(
          //   "An error occurred while saving the comment due to internet instability. Please try again.", 5000)
          console.log(error)

        }
      });
    }

    function hideComment(divName) {
      if ($(`#${divName}`).is(":hidden")) {
        $(`#${divName}`).show()
      } else {
        $(`#${divName}`).hide()
      }
    }

    function hideVideo() {
      if ($(".indicator-video-container__content").is(":hidden")) {
        $(".indicator-video-container__content").show()
        //rotate the icon
        $(".indicator-video-container__icon").css("transform", "rotate(0deg)")
        $(".indicator-video-container__header").css("border-radius", "0.75rem 0.75rem 0 0")
      } else {
        $(".indicator-video-container__content").hide()
        //rotate the icon
        $(".indicator-video-container__icon").css("transform", "rotate(180deg)")
        $(".indicator-video-container__header").css("border-radius", "0.75rem")
      }
    }
    </script>
</body>

</html>