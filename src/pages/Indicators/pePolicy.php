<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}


$sql = "SELECT * FROM pe_policy_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$adminValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pe_policy_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$contactValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pe_policy_comments WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$commentValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pe_policy_agreement WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$agreementValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pe_policy_exist_pe_curriculum_documents_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$curriculumPeDocumentsAdmin = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_pe_curriculum_documents_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$curriculumPeDocumentsContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_se_curriculum_documents_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$curriculumSeDocumentsAdmin = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_se_curriculum_documents_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$curriculumSeDocumentsContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_pe_mandatory_documents_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$policyMandatoryPeDocumentsAdmin = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_pe_mandatory_documents_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$policyMandatoryPeDocumentsContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_se_mandatory_documents_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$policyMandatorySeDocumentsAdmin = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_se_mandatory_documents_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$policyMandatorySeDocumentsContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_pe_min_time_documents_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$policyMinTimePeDocumentsAdmin = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_pe_min_time_documents_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$policyMinTimePeDocumentsContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_se_min_time_documents_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$policyMinTimeSeDocumentsAdmin = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_policy_exist_se_min_time_documents_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$policyMinTimeSeDocumentsContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Physical Education policy - GoPE!</title>
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
      $cardLocationPath = "../../assets/card_pe_policy.png";
      include '../../components/cardLocation.php';
    ?>
    <?php include '../../components/modalMetodology.php'; ?>
    <?php 
    $typeModal = "warning";
    $icon = "fas fa-exclamation-triangle";
    $buttonCloseText = "Close";
    include '../../components/modalInfo.php'; ?>
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1>Physical education policy <i class="fas fa-info-circle" id="cardLocationModal"></i></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="indicators-container">
      <?php include '../../components/sideNavBar.php'; ?>
      <div style="display: flex; flex-direction:column; gap:2rem; margin-left: 10rem;">
        <?php 
          $videoTitle = "Methodological approach for collecting Physical Education policy data";
          $videoUrl = "https://drive.google.com/file/d/16CIawm6043Q6BwhY_fIyMzPm6cs29ySc/preview";
          include '../../components/videoContainer.php'; ?>
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>01</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 1;
              $indicatorName = "exist_pe_curriculum_pe";
              $indicatorTitle = "Existence of a national official Physical Education curriculum for the compulsory school years of primary education";
              $inputs = [
                (object) [
                  "name" => "yes-all",
                  "title" => "Yes, for all school years",
                  "value" => "1",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "yeas-some",
                  "title" => "Yes, for some of the school years",
                  "value" => "2",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "only-subnational-level",
                  "title" => "Only at subnational level",
                  "value" => "3",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "no",
                  "title" => "No",
                  "value" => "4",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ]
              ];
              include '../../components/indicatorChoiceGroup.php';
              ?>
              <div <?php if($adminValues['exist_pe_curriculum_pe'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_curriculum_pe-admin">
                <?php 
                $indicatorRole = "admin";
                $indicatorOrder = 1;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_curriculum_pe",
                    "title" => "Name of the region / state / canton / district / province with a subnational officially prescribed Physical Education curriculum for the
                    compulsory school years of primary education",
                    "type" => "text",
                    "tableName" => "pe_policy_admin"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
              </div>
              <div id="documents-exist_pe_curriculum_pe-admin">
                <?php
                if($curriculumPeDocumentsAdmin != null) {
                  $docRole = "admin";
                  $tableName = "pe_policy_exist_pe_curriculum_documents_admin";
                  $indicatorName = "exist_pe_curriculum_pe";
                  foreach($curriculumPeDocumentsAdmin as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
              </div>
              <?php if($_SESSION['type'] == 'admin'): ?>
              <button id="add-document" class="btn-primary" data-indicator-name="exist_pe_curriculum_pe"
                data-table-name="pe_policy_exist_pe_curriculum_documents_admin" data-role="admin"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
              <?php endif; ?>
              <div id="1-contact-label">
                <p class="contact-label">Provide new information here:</p>
                <?php
                $indicatorRole = "contact";
                $indicatorOrder = 1;
                $indicatorTitle = "Existence of a national official Physical Education curriculum for the compulsory school years of primary education";
                $inputs = [
                  (object) [
                    "name" => "yes-all",
                    "title" => "Yes, for all school years",
                    "value" => "1",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "yeas-some",
                    "title" => "Yes, for some of the school years",
                    "value" => "2",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "only-subnational-level",
                    "title" => "Only at subnational level",
                    "value" => "3",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "no",
                    "title" => "No",
                    "value" => "4",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ]
                ];
                include '../../components/indicatorChoiceGroup.php';
                ?>
                <div <?php if($contactValues['exist_pe_curriculum_pe'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_curriculum_pe-contact">
                  <?php 
                  $indicatorRole = "contact";
                  $indicatorOrder = 1;
                  $inputs = [
                    (object) [
                      "name" => "name_region_subnational_curriculum_pe",
                      "title" => "Name of the region / state / canton / district / province with a subnational officially prescribed Physical Education curriculum for the
                      compulsory school years of primary education",
                      "type" => "text",
                      "tableName" => "pe_policy_contact"
                    ]
                  ];
                  include '../../components/indicatorInputGroup.php';
                  ?>
                </div>
                <div id="documents-exist_pe_curriculum_pe-contact">
                  <?php
                  if($curriculumPeDocumentsContact != null) {
                    $docRole = "contact";
                    $tableName = "pe_policy_exist_pe_curriculum_documents_contact";
                    $indicatorName = "exist_pe_curriculum_pe";
                    foreach($curriculumPeDocumentsContact as $document) {
                      $docInc = $document['inc'];
                      include '../../components/documentGroup.php';
                    }
                  }
                  ?>
                </div>
                <?php if($_SESSION['type'] == 'contact'): ?>
                <button id="add-document" class="btn-primary" data-indicator-name="exist_pe_curriculum_pe"
                  data-table-name="pe_policy_exist_pe_curriculum_documents_contact" data-role="contact"
                  style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
                <?php endif; ?>
              </div>
              <?php
              $indicatorName = "exist_pe_curriculum_pe";
              $indicatorOrder = 1;
              $tableName = "pe_policy_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 1;
            $indicatorName = "exist_pe_curriculum_pe";
            $tableName = "pe_policy_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- ------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>02</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 2;
              $indicatorName = "exist_pe_curriculum_se";
              $indicatorTitle = "Existence of a national official Physical Education curriculum for the compulsory school years of secondary education";
              $inputs = [
                (object) [
                  "name" => "yes-all",
                  "title" => "Yes, for all school years",
                  "value" => "1",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "yeas-some",
                  "title" => "Yes, for some of the school years",
                  "value" => "2",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "only-subnational-level",
                  "title" => "Only at subnational level",
                  "value" => "3",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "no",
                  "title" => "No",
                  "value" => "4",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ]
              ];
              include '../../components/indicatorChoiceGroup.php';
              ?>
              <div <?php if($adminValues['exist_pe_curriculum_se'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_curriculum_se-admin">
                <?php 
                $indicatorRole = "admin";
                $indicatorOrder = 2;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_curriculum_se",
                    "title" => "Name of the region / state / canton / district / province with a subnational officially prescribed Physical Education curriculum for the
                    compulsory school years of secondary education",
                    "type" => "text",
                    "tableName" => "pe_policy_admin"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
              </div>
              <div id="documents-exist_pe_curriculum_se-admin">
                <?php
                if($curriculumSeDocumentsAdmin != null) {
                  $docRole = "admin";
                  $tableName = "pe_policy_exist_se_curriculum_documents_admin";
                  $indicatorName = "exist_pe_curriculum_se";
                  foreach($curriculumSeDocumentsAdmin as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
              </div>
              <?php if($_SESSION['type'] == 'admin'): ?>
              <button id="add-document" class="btn-primary" data-indicator-name="exist_pe_curriculum_se"
                data-table-name="pe_policy_exist_se_curriculum_documents_admin" data-role="admin"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
              <?php endif; ?>
              <div id="2-contact-label">
                <p class="contact-label">Provide new information here:</p>
                <?php
              $indicatorRole = "contact";
              $indicatorOrder = 2;
              $indicatorTitle = "Existence of a national official Physical Education curriculum for the compulsory school years of primary education";
              $inputs = [
                (object) [
                  "name" => "yes-all",
                  "title" => "Yes, for all school years",
                  "value" => "1",
                  "type" => "radio",
                  "tableName" => "pe_policy_contact"
                ],
                (object) [
                  "name" => "yeas-some",
                  "title" => "Yes, for some of the school years",
                  "value" => "2",
                  "type" => "radio",
                  "tableName" => "pe_policy_contact"
                ],
                (object) [
                  "name" => "only-subnational-level",
                  "title" => "Only at subnational level",
                  "value" => "3",
                  "type" => "radio",
                  "tableName" => "pe_policy_contact"
                ],
                (object) [
                  "name" => "no",
                  "title" => "No",
                  "value" => "4",
                  "type" => "radio",
                  "tableName" => "pe_policy_contact"
                ]
              ];
              include '../../components/indicatorChoiceGroup.php';
              ?>
                <div <?php if($contactValues['exist_pe_curriculum_se'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_curriculum_se-contact">
                  <?php 
                $indicatorRole = "contact";
                $indicatorOrder = 2;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_curriculum_se",
                    "title" => "Name of the region / state / canton / district / province with a subnational officially prescribed Physical Education curriculum for the
                    compulsory school years of secondary education",
                    "type" => "text",
                    "tableName" => "pe_policy_contact"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
                </div>
                <div id="documents-exist_pe_curriculum_se-contact">
                  <?php
                if($curriculumSeDocumentsContact != null) {
                  $docRole = "contact";
                  $tableName = "pe_policy_exist_se_curriculum_documents_contact";
                  $indicatorName = "exist_pe_curriculum_se";
                  foreach($curriculumSeDocumentsContact as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
                </div>
                <?php if($_SESSION['type'] == 'contact'): ?>
                <button id="add-document" class="btn-primary" data-indicator-name="exist_pe_curriculum_se"
                  data-table-name="pe_policy_exist_se_curriculum_documents_contact" data-role="contact"
                  style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
                <?php endif; ?>
              </div>
              <?php
              $indicatorName = "exist_pe_curriculum_se";
              $indicatorOrder = 2;
              $tableName = "pe_policy_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 2;
            $indicatorName = "exist_pe_curriculum_se";
            $tableName = "pe_policy_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- ------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>03</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 3;
              $indicatorName = "exist_policy_mandatory_pe";
              $indicatorTitle = "Existence of a national policy requiring Physical Education to be a mandatory subject for the compulsory school years of primary education";
              $inputs = [
                (object) [
                  "name" => "yes-all",
                  "title" => "Yes, for all school years",
                  "value" => "1",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "yeas-some",
                  "title" => "Yes, for some of the school years",
                  "value" => "2",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "only-subnational-level",
                  "title" => "Only at subnational level",
                  "value" => "3",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "no",
                  "title" => "No",
                  "value" => "4",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ]
              ];
              include '../../components/indicatorChoiceGroup.php';
              ?>
              <div <?php if($adminValues['exist_policy_mandatory_pe'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_mandatory_pe-admin">
                <?php 
                $indicatorRole = "admin";
                $indicatorOrder = 3;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_mandatory_pe",
                    "title" => "Name of the region / state / canton / district / province with a subnational policy requiring Physical Education to be mandatory for the
                    compulsory school years of primary education",
                    "type" => "text",
                    "tableName" => "pe_policy_admin"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
              </div>
              <div id="documents-exist_policy_mandatory_pe-admin">
                <?php
                if($policyMandatoryPeDocumentsAdmin != null) {
                  $docRole = "admin";
                  $tableName = "pe_policy_exist_pe_mandatory_documents_admin";
                  $indicatorName = "exist_policy_mandatory_pe";
                  foreach($policyMandatoryPeDocumentsAdmin as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
              </div>
              <?php if($_SESSION['type'] == 'admin'): ?>
              <button id="add-document" class="btn-primary" data-indicator-name="exist_policy_mandatory_pe"
                data-table-name="pe_policy_exist_pe_mandatory_documents_admin" data-role="admin"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
              <?php endif; ?>
              <div id="3-contact-label">
                <p class="contact-label">Provide new information here:</p>
                <?php
                $indicatorRole = "contact";
                $indicatorOrder = 3;
                $indicatorTitle = "Existence of a national official Physical Education curriculum for the compulsory school years of primary education";
                $inputs = [
                  (object) [
                    "name" => "yes-all",
                    "title" => "Yes, for all school years",
                    "value" => "1",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "yeas-some",
                    "title" => "Yes, for some of the school years",
                    "value" => "2",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "only-subnational-level",
                    "title" => "Only at subnational level",
                    "value" => "3",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "no",
                    "title" => "No",
                    "value" => "4",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ]
                ];
                include '../../components/indicatorChoiceGroup.php';
                ?>
                <div <?php if($contactValues['exist_policy_mandatory_pe'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_mandatory_pe-contact">
                  <?php 
                $indicatorRole = "contact";
                $indicatorOrder = 3;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_mandatory_pe",
                    "title" => "Name of the region / state / canton / district / province with a subnational policy requiring Physical Education to be mandatory for the
                    compulsory school years of primary education",
                    "type" => "text",
                    "tableName" => "pe_policy_contact"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
                </div>
                <div id="documents-exist_pe_mandatory_pe-contact">
                  <?php
                if($policyMandatoryPeDocumentsContact != null) {
                  $docRole = "contact";
                  $tableName = "pe_policy_exist_pe_mandatory_documents_contact";
                  $indicatorName = "exist_pe_mandatory_pe";
                  foreach($policyMandatoryPeDocumentsContact as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
                </div>
                <?php if($_SESSION['type'] == 'contact'): ?>
                <button id="add-document" class="btn-primary" data-indicator-name="exist_pe_mandatory_pe"
                  data-table-name="pe_policy_exist_pe_mandatory_documents_contact" data-role="contact"
                  style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
                <?php endif; ?>
              </div>
              <?php
              $indicatorName = "exist_policy_mandatory_pe";
              $indicatorOrder = 3;
              $tableName = "pe_policy_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 3;
            $indicatorName = "exist_policy_mandatory_pe";
            $tableName = "pe_policy_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- ------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>04</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 4;
              $indicatorName = "exist_policy_mandatory_se";
              $indicatorTitle = "Existence of a national policy requiring Physical Education to be a mandatory subject for the compulsory school years of secondary education";
              $inputs = [
                (object) [
                  "name" => "yes-all",
                  "title" => "Yes, for all school years",
                  "value" => "1",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "yeas-some",
                  "title" => "Yes, for some of the school years",
                  "value" => "2",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "only-subnational-level",
                  "title" => "Only at subnational level",
                  "value" => "3",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "no",
                  "title" => "No",
                  "value" => "4",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ]
              ];
              include '../../components/indicatorChoiceGroup.php';
              ?>
              <div <?php if($adminValues['exist_policy_mandatory_se'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_mandatory_se-admin">
                <?php 
                $indicatorRole = "admin";
                $indicatorOrder = 4;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_mandatory_se",
                    "title" => "Name of the region / state / canton / district / province with a subnational policy requiring Physical Education to be mandatory for the
                    compulsory school years of secondary education",
                    "type" => "text",
                    "tableName" => "pe_policy_admin"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
              </div>
              <div id="documents-exist_pe_mandatory_se-admin">
                <?php
                if($policyMandatorySeDocumentsAdmin != null) {
                  $docRole = "admin";
                  $tableName = "pe_policy_exist_se_mandatory_documents_admin";
                  $indicatorName = "exist_pe_mandatory_se";
                  foreach($policyMandatorySeDocumentsAdmin as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
              </div>
              <?php if($_SESSION['type'] == 'admin'): ?>
              <button id="add-document" class="btn-primary" data-indicator-name="exist_pe_mandatory_se"
                data-table-name="pe_policy_exist_se_mandatory_documents_admin" data-role="admin"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
              <?php endif; ?>
              <div id="4-contact-label">
                <p class="contact-label">Provide new information here:</p>
                <?php
                $indicatorRole = "contact";
                $indicatorOrder = 4;
                $indicatorTitle = "Existence of a national policy requiring Physical Education to be a mandatory subject for the compulsory school years of secondary education";
                $inputs = [
                  (object) [
                    "name" => "yes-all",
                    "title" => "Yes, for all school years",
                    "value" => "1",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "yeas-some",
                    "title" => "Yes, for some of the school years",
                    "value" => "2",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "only-subnational-level",
                    "title" => "Only at subnational level",
                    "value" => "3",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "no",
                    "title" => "No",
                    "value" => "4",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ]
                ];
                include '../../components/indicatorChoiceGroup.php';
                ?>
                <div <?php if($contactValues['exist_policy_mandatory_se'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_mandatory_se-contact">
                  <?php 
                $indicatorRole = "contact";
                $indicatorOrder = 4;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_mandatory_se",
                    "title" => "Name of the region / state / canton / district / province with a subnational policy requiring Physical Education to be mandatory for the
                    compulsory school years of secondary education",
                    "type" => "text",
                    "tableName" => "pe_policy_contact"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
                </div>
                <div id="documents-exist_pe_mandatory_se-contact">
                  <?php
                if($policyMandatorySeDocumentsContact != null) {
                  $docRole = "contact";
                  $tableName = "pe_policy_exist_se_mandatory_documents_contact";
                  $indicatorName = "exist_pe_mandatory_se";
                  foreach($policyMandatorySeDocumentsContact as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
                </div>
                <?php if($_SESSION['type'] == 'contact'): ?>
                <button id="add-document" class="btn-primary" data-indicator-name="exist_pe_mandatory_se"
                  data-table-name="pe_policy_exist_se_mandatory_documents_contact" data-role="contact"
                  style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
                <?php endif; ?>
              </div>
              <?php
              $indicatorName = "exist_policy_mandatory_se";
              $indicatorOrder = 4;
              $tableName = "pe_policy_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 4;
            $indicatorName = "exist_policy_mandatory_se";
            $tableName = "pe_policy_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- ------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>05</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 5;
              $indicatorName = "exist_policy_min_time_pe";
              $indicatorTitle = "Existence of a national policy requiring minimum Physical Education time for the compulsory school years of primary education";
              $inputs = [
                (object) [
                  "name" => "yes-all",
                  "title" => "Yes, for all school years",
                  "value" => "1",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "yeas-some",
                  "title" => "Yes, for some of the school years",
                  "value" => "2",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "only-subnational-level",
                  "title" => "Only at subnational level",
                  "value" => "3",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "no",
                  "title" => "No",
                  "value" => "4",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ]
              ];
              include '../../components/indicatorChoiceGroup.php';
              ?>
              <div <?php if($adminValues['exist_policy_min_time_pe'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_min_time_pe-admin">
                <?php 
                $indicatorRole = "admin";
                $indicatorOrder = 5;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_min_time_pe",
                    "title" => "Name of the region / state / canton / district / province with a subnational policy requiring minimum Physical Education time for the
                    compulsory school years of primary education",
                    "type" => "text",
                    "tableName" => "pe_policy_admin"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
              </div>
              <div id="documents-exist_policy_min_time_pe-admin">
                <?php
                if($policyMinTimePeDocumentsAdmin != null) {
                  $docRole = "admin";
                  $tableName = "pe_policy_exist_pe_min_time_documents_admin";
                  $indicatorName = "exist_policy_min_time_pe";
                  foreach($policyMinTimePeDocumentsAdmin as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
              </div>
              <?php if($_SESSION['type'] == 'admin'): ?>
              <button id="add-document" class="btn-primary" data-indicator-name="exist_policy_min_time_pe"
                data-table-name="pe_policy_exist_pe_min_time_documents_admin" data-role="admin"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
              <?php endif; ?>
              <div id="5-contact-label">
                <p class="contact-label">Provide new information here:</p>
                <?php
                  $indicatorRole = "contact";
                  $indicatorOrder = 5;
                  $indicatorTitle = "Existence of a national policy requiring minimum Physical Education time for the compulsory school years of primary education";
                  $inputs = [
                    (object) [
                      "name" => "yes-all",
                      "title" => "Yes, for all school years",
                      "value" => "1",
                      "type" => "radio",
                      "tableName" => "pe_policy_contact"
                    ],
                    (object) [
                      "name" => "yeas-some",
                      "title" => "Yes, for some of the school years",
                      "value" => "2",
                      "type" => "radio",
                      "tableName" => "pe_policy_contact"
                    ],
                    (object) [
                      "name" => "only-subnational-level",
                      "title" => "Only at subnational level",
                      "value" => "3",
                      "type" => "radio",
                      "tableName" => "pe_policy_contact"
                    ],
                    (object) [
                      "name" => "no",
                      "title" => "No",
                      "value" => "4",
                      "type" => "radio",
                      "tableName" => "pe_policy_contact"
                    ]
                  ];
                  include '../../components/indicatorChoiceGroup.php';
                ?>
                <div <?php if($contactValues['exist_policy_min_time_pe'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_min_time_pe-contact">
                  <?php 
                $indicatorRole = "contact";
                $indicatorOrder = 5;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_min_time_pe",
                    "title" => "Name of the region / state / canton / district / province with a subnational policy requiring minimum Physical Education time for the
                    compulsory school years of primary education",
                    "type" => "text",
                    "tableName" => "pe_policy_contact"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
                </div>
                <div id="documents-exist_policy_min_time_pe-contact">
                  <?php
                if($policyMinTimePeDocumentsContact) {
                  $docRole = "contact";
                  $tableName = "pe_policy_exist_pe_min_time_documents_contact";
                  $indicatorName = "exist_policy_min_time_pe";
                  foreach($policyMinTimePeDocumentsContact as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
                </div>
                <?php if($_SESSION['type'] == 'contact'): ?>
                <button id="add-document" class="btn-primary" data-indicator-name="exist_policy_min_time_pe"
                  data-table-name="pe_policy_exist_pe_min_time_documents_contact" data-role="contact"
                  style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
                <?php endif; ?>
              </div>
              <?php
              $indicatorName = "exist_policy_min_time_pe";
              $indicatorOrder = 5;
              $tableName = "pe_policy_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 5;
            $indicatorName = "exist_policy_min_time_pe";
            $tableName = "pe_policy_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- ------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>06</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 6;
              $indicatorName = "exist_policy_min_time_se";
              $indicatorTitle = "Existence of a national policy requiring minimum Physical Education time for the compulsory school years of secondary education";
              $inputs = [
                (object) [
                  "name" => "yes-all",
                  "title" => "Yes, for all school years",
                  "value" => "1",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "yeas-some",
                  "title" => "Yes, for some of the school years",
                  "value" => "2",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "only-subnational-level",
                  "title" => "Only at subnational level",
                  "value" => "3",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ],
                (object) [
                  "name" => "no",
                  "title" => "No",
                  "value" => "4",
                  "type" => "radio",
                  "tableName" => "pe_policy_admin"
                ]
              ];
              include '../../components/indicatorChoiceGroup.php';
              ?>
              <div <?php if($adminValues['exist_policy_min_time_se'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_min_time_se-admin">
                <?php 
                $indicatorRole = "admin";
                $indicatorOrder = 6;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_min_time_se",
                    "title" => "Name of the region / state / canton / district / province with a subnational policy requiring minimum Physical Education time for the
                    compulsory school years of secondary education",
                    "type" => "text",
                    "tableName" => "pe_policy_admin"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
              </div>
              <div id="documents-exist_policy_min_time_se-admin">
                <?php
                if($policyMinTimeSeDocumentsAdmin != null) {
                  $docRole = "admin";
                  $tableName = "pe_policy_exist_se_min_time_documents_admin";
                  $indicatorName = "exist_policy_min_time_se";
                  foreach($policyMinTimeSeDocumentsAdmin as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
              </div>
              <?php if($_SESSION['type'] == 'admin'): ?>
              <button id="add-document" class="btn-primary" data-indicator-name="exist_policy_min_time_se"
                data-table-name="pe_policy_exist_se_min_time_documents_admin" data-role="admin"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
              <?php endif; ?>
              <div id="6-contact-label">
                <p class="contact-label" id="6-contact-label">Provide new information here:
                </p>
                <?php
                $indicatorRole = "contact";
                $indicatorOrder = 6;
                $indicatorTitle = "Existence of a national policy requiring minimum Physical Education time for the compulsory school years of secondary education";
                $inputs = [
                  (object) [
                    "name" => "yes-all",
                    "title" => "Yes, for all school years",
                    "value" => "1",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "yeas-some",
                    "title" => "Yes, for some of the school years",
                    "value" => "2",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "only-subnational-level",
                    "title" => "Only at subnational level",
                    "value" => "3",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ],
                  (object) [
                    "name" => "no",
                    "title" => "No",
                    "value" => "4",
                    "type" => "radio",
                    "tableName" => "pe_policy_contact"
                  ]
                ];
                include '../../components/indicatorChoiceGroup.php';
                ?>
                <div <?php if($contactValues['exist_policy_min_time_se'] != 3){
                  echo "hidden";
                }?> name="name_region_subnational_min_time_se-contact">
                  <?php 
                $indicatorRole = "contact";
                $indicatorOrder = 6;
                $inputs = [
                  (object) [
                    "name" => "name_region_subnational_min_time_se",
                    "title" => "Name of the region / state / canton / district / province with a subnational policy requiring minimum Physical Education time for the
                    compulsory school years of secondary education",
                    "type" => "text",
                    "tableName" => "pe_policy_contact"
                  ]
                ];
                include '../../components/indicatorInputGroup.php';
                ?>
                </div>
                <div id="documents-exist_policy_min_time_se-contact">
                  <?php
                if($policyMinTimeSeDocumentsContact != null) {
                  $docRole = "contact";
                  $tableName = "pe_policy_exist_se_min_time_documents_contact";
                  $indicatorName = "exist_policy_min_time_se";
                  foreach($policyMinTimeSeDocumentsContact as $document) {
                    $docInc = $document['inc'];
                    include '../../components/documentGroup.php';
                  }
                }
                ?>
                </div>
                <?php if($_SESSION['type'] == 'contact'): ?>
                <!-- <button id="add-document" class="btn-primary" data-indicator-name="exist_policy_min_time_pe"
                  data-table-name="pe_policy_exist_pe_min_time_documents_contact" data-role="contact"
                  style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button> -->
                <button id="add-document" class="btn-primary" data-indicator-name="exist_policy_min_time_se"
                  data-table-name="pe_policy_exist_se_min_time_documents_contact" data-role="contact"
                  style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
                <?php endif; ?>
              </div>
              <?php
              $indicatorName = "exist_policy_min_time_se";
              $indicatorOrder = 6;
              $tableName = "pe_policy_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 6;
            $indicatorName = "exist_policy_min_time_se";
            $tableName = "pe_policy_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  const methods = [{
      name: "name_region_subnational_curriculum_pe",
      title: "Name of the region where the policy is implemented",
      html: "<div><p>This answer option means that there are no policies implemented at a national level. The subnational level is the highest level of the country’s division immediately under the national level. The Country Contact must provide information on one region of the country that implements the requested policy. Ideally, the Country Contact must identify and report the region with the best PE policy status: the one that meets more GoPE! indicators</p></div>",
    },
    {
      name: "name_region_subnational_curriculum_se",
      title: "Name of the region where the policy is implemented",
      html: "<div><p>This answer option means that there are no policies implemented at a national level. The subnational level is the highest level of the country’s division immediately under the national level. The Country Contact must provide information on one region of the country that implements the requested policy. Ideally, the Country Contact must identify and report the region with the best PE policy status: the one that meets more GoPE! indicators</p></div>",
    },
    {
      name: "name_region_subnational_mandatory_pe",
      title: "Name of the region where the policy is implemented",
      html: "<div><p>This answer option means that there are no policies implemented at a national level. The subnational level is the highest level of the country’s division immediately under the national level. The Country Contact must provide information on one region of the country that implements the requested policy. Ideally, the Country Contact must identify and report the region with the best PE policy status: the one that meets more GoPE! indicators</p></div>",
    },
    {
      name: "name_region_subnational_mandatory_se",
      title: "Name of the region where the policy is implemented",
      html: "<div><p>This answer option means that there are no policies implemented at a national level. The subnational level is the highest level of the country’s division immediately under the national level. The Country Contact must provide information on one region of the country that implements the requested policy. Ideally, the Country Contact must identify and report the region with the best PE policy status: the one that meets more GoPE! indicators</p></div>",
    },
    {
      name: "name_region_subnational_min_time_pe",
      title: "Name of the region where the policy is implemented",
      html: "<div><p>This answer option means that there are no policies implemented at a national level. The subnational level is the highest level of the country’s division immediately under the national level. The Country Contact must provide information on one region of the country that implements the requested policy. Ideally, the Country Contact must identify and report the region with the best PE policy status: the one that meets more GoPE! indicators</p></div>",
    },
    {
      name: "name_region_subnational_min_time_se",
      title: "Name of the region where the policy is implemented",
      html: "<div><p>This answer option means that there are no policies implemented at a national level. The subnational level is the highest level of the country’s division immediately under the national level. The Country Contact must provide information on one region of the country that implements the requested policy. Ideally, the Country Contact must identify and report the region with the best PE policy status: the one that meets more GoPE! indicators</p></div>",
    }
  ];
  $(document).ready(function() {
    $(".btn-back").click(function() {
      window.location.href = "../Indicators/paPrevalence.php<?php echo "?id=" . $_GET['id'] ?>";
    });
    $(".btn-next").click(function() {
      verifyAgreementInputWithNoDoc("peMonitoring")
    });

    $(".side-nav__links > li > a").click(function() {
      //remove href from the a tag
      event.preventDefault()
      //get the href value
      let pageUrl = $(this).attr("href")
      //get the value between the last / and the .php
      pageUrl = pageUrl.substring(pageUrl.lastIndexOf("/") + 1, pageUrl.lastIndexOf(".php"))
      verifyAgreementInputWithNoDoc(pageUrl)
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


  function openCardLocationModal() {
    $("#cardLocationModal").click(function() {
      $("#cardLocation").css("display", "block")
      $("#card-location-modal-close").click(function() {
        closeCardLocationModal()
      })
    })
  }

  function closeCardLocationModal() {
    $("#cardLocation").css("display", "none")
  }

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

  function openModal(msg) {
    $("#modal").css("display", "block")
    $(".modal-body").html(msg)
    $("#modal-close").click(function() {
      closeModal()
    })
  }

  function closeModal() {
    $(".modal-body").html("")
    $("#modal").css("display", "none")
  }

  function verifyAllDocuments(role) {
    const indicatorsNames = ["exist_pe_curriculum_pe", "exist_pe_curriculum_se", "exist_policy_mandatory_pe",
      "exist_policy_mandatory_se", "exist_policy_min_time_pe", "exist_policy_min_time_se"
    ]
    let allFilled = true
    indicatorsNames.forEach(indicatorName => {
      if (!verifyIfDocumentIsFFilled(indicatorName, role)) {
        allFilled = false
      }
    })
    return allFilled
  }

  function verifyIfDocumentIsFFilled(indicatorName, role) {
    let allFilled = true
    const documents = $(`#documents-${indicatorName}-${role}`)
    documents.children().each(function() {
      const doc = $(this)
      const docInc = doc.attr('id').split("-")[2]
      const title = doc.find(`#document-title-${indicatorName}-${docInc}-${role}`).val()
      const yearPublication = doc.find(`#document-year_publication-${indicatorName}-${docInc}-${role}`).val()
      const eletronicSource = doc.find(`#document-eletronic_source-${indicatorName}-${docInc}-${role}`).val()
      const voluntaryComments = doc.find(`#document-voluntary_comments-${indicatorName}-${docInc}-${role}`).val()

      if (title == "" || yearPublication == "" || eletronicSource == "") {
        allFilled = false
      }
    })

    return allFilled
  }

  //function to verify if the agreement input is 2 or 3, if it is, and no document is related, then show the modalInfo
  function verifyAgreementInputWithNoDoc(pageUrl) {
    let agreementGroups = []
    let allFilled = true

    for (let i = 1; i <= 6; i++) {
      agreementGroups.push($(`div[id*="agreement-group-${i}"]`))
    }

    const indicatorsNames = ["exist_pe_curriculum_pe", "exist_pe_curriculum_se", "exist_policy_mandatory_pe",
      "exist_policy_mandatory_se", "exist_policy_min_time_pe", "exist_policy_min_time_se"
    ]
    let message = ""

    agreementGroups.forEach(agreementGroup => {
      let radioInputs = agreementGroup.find("input[type='radio']")
      let agreementValue = radioInputs.filter(":checked").val()
      let indicatorName = indicatorsNames[agreementGroups.indexOf(agreementGroup)]

      if (agreementValue == 2 || agreementValue == 3) {
        const documents = $(`#documents-${indicatorName}-${'<?php echo $_SESSION['type'] ?>'}`)
        if (documents.children().length == 0) {
          allFilled = false
          if (indicatorName == "exist_pe_curriculum_pe" || indicatorName == "exist_pe_curriculum_se" ||
            indicatorName == "exist_policy_mandatory_pe" || indicatorName == "exist_policy_mandatory_se" ||
            indicatorName == "exist_policy_min_time_pe" || indicatorName == "exist_policy_min_time_se") {
            message =
              "Please <strong>add at least one document</strong> to the indicator!"
          }
        }
      }
    })

    if (allFilled) {
      window.location.href = `../Indicators/${pageUrl}.php<?php echo "?id=" . $_GET['id'] ?>`
    } else {
      openModal(message)
    }
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
          <input type="text"
            name="document-title-${indicatorName}-${docInc}-${docRole}"
            id="document-title-${indicatorName}-${docInc}-${docRole}"
            onblur="saveDocumentValue('document-title-${indicatorName}-${docInc}-${docRole}', '${tableName}', '${docInc}')">
        </div>

        <div class="indicator-input">
          <label
            for="document-year_publication-${indicatorName}-${docInc}-${docRole}">Year of publication</label>
            <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
          <input type="text"
            name="document-year_publication-${indicatorName}-${docInc}-${docRole}"
            id="document-year_publication-${indicatorName}-${docInc}-${docRole}"
            onblur="saveDocumentValue('document-year_publication-${indicatorName}-${docInc}-${docRole}', '${tableName}', '${docInc}')">
        </div>

        <div class="indicator-input">
          <label
            for="document-eletronic_source-${indicatorName}-${docInc}-${docRole}">Eletronic
            source</label>
            <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
          <input type="text"
            name="document-eletronic_source-${indicatorName}-${docInc}-${docRole}"
            id="document-eletronic_source-${indicatorName}-${docInc}-${docRole}"
            onblur="saveDocumentValue('document-eletronic_source-${indicatorName}-${docInc}-${docRole}', '${tableName}', '${docInc}')">
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
    for (let i = 1; i <= 6; i++) {
      // get all the divs with id that contains i and -contact
      contactLabels.push($(`div[id="${i}-contact-label"]`))
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
    //get all the add-document buttons with data-role="contact"

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


    if (value == '3') {
      let role = tableName.split("_")[2]
      let inputNameSearch = indicatorName.split("_")
      // console.log(inputNameSearch)
      if (inputNameSearch[2] == "min") {
        inputNameSearch = "name_region_subnational_" + inputNameSearch[2] + "_" + inputNameSearch[3] + "_" +
          inputNameSearch[4] + "-" + role;
      } else {
        inputNameSearch = "name_region_subnational_" + inputNameSearch[2] + "_" + inputNameSearch[3] + "-" + role;
      }
      // console.log(inputNameSearch)
      $(`div[name="${inputNameSearch}"]`).show()
    } else {
      let role = tableName.split("_")[2]
      let inputNameSearch = indicatorName.split("_")
      if (inputNameSearch[2] == "min") {
        inputNameSearch = "name_region_subnational_" + inputNameSearch[2] + "_" + inputNameSearch[3] + "_" +
          inputNameSearch[4] + "-" + role;
      } else {
        inputNameSearch = "name_region_subnational_" + inputNameSearch[2] + "_" + inputNameSearch[3] + "-" + role;
      }
      // console.log(inputNameSearch)
      $(`div[name="${inputNameSearch}"]`).hide()

    }

    console.log(payload)
    $.ajax({
      type: "POST",
      url: "../../query/Indicators/updateAgreementValue.php",
      data: {
        payload: payload
      },
      success: function(response) {
        console.log(response)
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



    console.log(payload)
    $.ajax({
      type: "POST",
      url: "../../query/Indicators/updateIndicatorValue.php",
      data: {
        payload: payload
      },
      success: function(response) {
        console.log(response)
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

    console.log(payload)
    $.ajax({
      type: "POST",
      url: "../../query/Indicators/updateIndicatorValue.php",
      data: {
        payload: payload
      },
      success: function(response) {
        console.log(response)
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

    console.log(payload)
    $.ajax({
      type: "POST",
      url: "../../query/Indicators/updateIndicatorValue.php",
      data: {
        payload: payload
      },
      success: function(response) {
        console.log(response)
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