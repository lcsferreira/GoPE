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
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Demographic data - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/sideNavBar.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/components/agreementGroup.css">
  <link rel="stylesheet" href="../../css/components/commentGroup.css">
  <link rel="stylesheet" href="../../css/pages/indicators.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css" integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1>Country <strong>Indicators</strong></h1>
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
              $inputs = [
                (object) [
                  "name" => "world_region",
                  "title" => "World region",
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
                  "name" => "world_region",
                  "title" => "World region",
                  "type" => "text",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "world_region";
              $indicatorOrder = 1;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 1;
            $indicatorName = "world_region";
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
                  "name" => "income_classification",
                  "title" => "Income classification ",
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
                  "name" => "income_classification",
                  "title" => "Income classification",
                  "type" => "text",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "income_classification";
              $indicatorOrder = 2;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 2;
            $indicatorName = "income_classification";
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
                  "title" => "Total population",
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
                  "title" => "Total population",
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
                  "title" => "Official entrance age to primary education",
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
                  "title" => "Official entrance age to primary education",
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
                  "title" => "Official entrance age to secondary education",
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
                  "title" => "Official entrance age to secondary education",
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
                  "title" => "Duration of primary education",
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
                  "title" => "Duration of primary education",
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
                  "title" => "Duration of secondary education",
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
                  "title" => "Duration of secondary education",
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
                  "title" => "Duration of compulsory education",
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
                  "title" => "Duration of compulsory education",
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
                  "name" => "school_age_pe",
                  "title" => "School-age population at primary education",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="11-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 11;
              $inputs = [
                (object) [
                  "name" => "school_age_pe",
                  "title" => "School-age population at primary education",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "school_age_pe";
              $indicatorOrder = 11;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 11;
            $indicatorName = "school_age_pe";
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
                  "name" => "school_age_se",
                  "title" => "School-age population at secondary education",
                  "type" => "number",
                  "tableName" => "demographic_data_admin"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <p class="contact-label" id="12-contact-label">Provide new information here:</p>
              <?php
              $indicatorRole = "contact";
              $indicatorOrder = 12;
              $inputs = [
                (object) [
                  "name" => "school_age_se",
                  "title" => "School-age population at secondary education",
                  "type" => "number",
                  "tableName" => "demographic_data_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "school_age_se";
              $indicatorOrder = 12;
              $tableName = "demographic_data_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 12;
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
    <script>
      $(document).ready(function() {
        $(".btn-back").click(function() {
          window.location.href = "../Indicators/indicatorsProgress.php<?php echo "?id=" . $_GET['id'] ?>";
        });
        $(".btn-next").click(function() {
          window.location.href = "../Indicators/paPrevalence.php<?php echo "?id=" . $_GET['id'] ?>";
        });
        verifyAgreementInput()
      });

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