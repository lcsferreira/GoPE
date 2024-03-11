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


?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Physical education policy - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/sideNavBar.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/components/agreementGroup.css">
  <link rel="stylesheet" href="../../css/components/commentGroup.css">
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
              <button id="add-document" class="btn-primary" data-indicator-name="exist_pe_curriculum_pe"
                data-table-name="pe_policy_exist_pe_curriculum_documents_admin" data-role="admin"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
              <p class="contact-label" id="1-contact-label">Provide new information here:</p>
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
              <button id="add-document" class="btn-primary" data-indicator-name="exist_pe_curriculum_pe"
                data-table-name="pe_policy_exist_pe_curriculum_documents_contact" data-role="contact"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
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
              <button id="add-document" class="btn-primary" data-indicator-name="exist_pe_curriculum_se"
                data-table-name="pe_policy_exist_se_curriculum_documents_admin" data-role="admin"
                style="width: 100% !important; margin-bottom: 1rem;" onclick=""><strong>Add</strong> Document</button>
              <p class="contact-label" id="2-contact-label">Provide new information here:</p>
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
              <p class="contact-label" id="3-contact-label">Provide new information here:</p>
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
              <p class="contact-label" id="4-contact-label">Provide new information here:</p>
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
              <p class="contact-label" id="5-contact-label">Provide new information here:</p>
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
              <p class="contact-label" id="6-contact-label">Provide new information here:</p>
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
  $(document).ready(function() {
    $(".btn-back").click(function() {
      window.location.href = "../Indicators/paPrevalence.php<?php echo "?id=" . $_GET['id'] ?>";
    });
    $(".btn-next").click(function() {
      window.location.href = "../Indicators/peMonitoring.php<?php echo "?id=" . $_GET['id'] ?>";
    });
    verifyAgreementInput()
  });

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
          <input type="text"
            name="document-title-${indicatorName}-${docInc}-${docRole}"
            id="document-title-${indicatorName}-${docInc}-${docRole}"
            onblur="saveDocumentValue('document-title-${indicatorName}-${docInc}-${docRole}', '${tableName}', '${docInc}')">
        </div>

        <div class="indicator-input">
          <label
            for="document-year_publication-${indicatorName}-${docInc}-${docRole}">Eletronic
            source</label>
          <input type="text"
            name="document-year_publication-${indicatorName}-${docInc}-${docRole}"
            id="document-year_publication-${indicatorName}-${docInc}-${docRole}"
            onblur="saveDocumentValue('document-year_publication-${indicatorName}-${docInc}-${docRole}', '${tableName}', '${docInc}')">
        </div>

        <div class="indicator-input">
          <label
            for="document-eletronic_source-${indicatorName}-${docInc}-${docRole}">Eletronic
            source</label>
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

  // $("#add-document").click(function() {
  //   let indicatorName = $(this).data("indicator-name")
  //   let tableName = $(this).data("table-name")
  //   let role = $(this).data("role")
  //   addDocumentToTable(indicatorName, tableName, role)
  // })

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
    for (let i = 1; i <= 12; i++) {
      // get all the divs with id that contains i and -contact
      contactLabels.push($(`p[id*="${i}-contact-label"]`))
      contactInputs.push($(`div[id*="${i}-contact"]`))
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
  </script>
</body>

</html>