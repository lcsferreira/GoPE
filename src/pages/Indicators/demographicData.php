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
			  $inputOrder = 1;
			  $inputName = "world_region";
			  $inputTitle = "World region";
			  $inputType = "text";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "world_region";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 1;
			$inputName = "world_region";
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
			  $inputName = "income_classification";
			  $inputTitle = "Income classification";
			  $inputType = "text";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "income_classification";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 2;
			$inputName = "income_classification";
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
			  $inputName = "total_population";
			  $inputTitle = "Total population";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "total_population";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 3;
			$inputName = "total_population";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>04</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 4;
			  $inputName = "literacy_youth_total";
			  $inputTitle = "Literacy youth total 15-24 years (%)";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "literacy_youth_total";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 4;
			$inputName = "literacy_youth_total";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>05</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 5;
			  $inputName = "gov_expenditure";
			  $inputTitle = "Government expenditure on education (%)";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "gov_expenditure";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 5;
			$inputName = "gov_expenditure";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>06</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 6;
			  $inputName = "entrance_age_pe";
			  $inputTitle = "Official entrance age to primary education";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "entrance_age_pe";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 6;
			$inputName = "entrance_age_pe";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>

        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>07</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 7;
			  $inputName = "entrance_age_se";
			  $inputTitle = "Official entrance age to secondary education";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "entrance_age_se";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 7;
			$inputName = "entrance_age_se";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>

        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>08</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 8;
			  $inputName = "duration_pe";
			  $inputTitle = "Duration of primary education";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "duration_pe";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 8;
			$inputName = "duration_pe";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>

        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>09</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 9;
			  $inputName = "duration_se";
			  $inputTitle = "Duration of secondary education";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "duration_se";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 9;
			$inputName = "duration_se";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>

        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>10</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 10;
			  $inputName = "duration_ce";
			  $inputTitle = "Duration of compulsory education";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "duration_ce";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 10;
			$inputName = "duration_ce";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>

        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>11</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 11;
			  $inputName = "school_age_pe";
			  $inputTitle = "School-age population at primary education";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "school_age_pe";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 11;
			$inputName = "school_age_pe";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
        </div>

        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>12</strong></h2>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php 
			  $inputOrder = 12;
			  $inputName = "school_age_se";
			  $inputTitle = "School-age population at secondary education";
			  $inputType = "number";
			  include '../../components/valueGroup.php';
			  ?>
              <?php
			  $inputName = "school_age_se";
			  include '../../components/commentGroup.php';
			  ?>
            </div>
            <?php
			$agreementOrder = 12;
			$inputName = "school_age_se";
			$tableName = "demographic_data_agreement";
			include '../../components/agreementGroup.php';
			?>
          </div>
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

        //verifyAgreementInput();
      });

      function verifyAgreementInput() {
        let contactInputs = []
        let agreementGroups = []
        for (let i = 1; i <= 3; i++) {
          // get all the divs with id that contains i and -contact
          contactInputs.push($(`div[id*="${i}-contact"]`))
          agreementGroups.push($(`div[id*="agreement-group-${i}"]`))
        }

        agreementGroups.forEach((agreementGroup, index) => {
          // on load verify the value of the radio input inside of the agreementGroup
          verifyRadioValue(agreementGroup, contactInputs[index])
        })
      }

      function verifyRadioValue(agreementGroup, contactInput) {
        //get all the radio inputs inside of the agreementGroup
        let radioInputs = agreementGroup.find("input[type='radio']")
        radioInputs.each(function() {
          //on change verify the value of the radio input inside of the agreementGroup
          $(this).change(function() {
            if ($(this).val() == 1) {
              contactInput.hide()
            } else {
              contactInput.show()
            }
          })

          //on load verify the value of the radio input inside of the agreementGroup
          if ($(this).is(":checked")) {
            if ($(this).val() == 1) {
              contactInput.hide()
            } else {
              contactInput.show()
            }
          }
        })
      }

      function saveAgreementValue(agreementOrder, inputName, tableName, value) {
        $.ajax({
          type: "POST",
          url: "../../query/Indicators/saveAgreementValue.php",
          data: {
            agreementOrder: agreementOrder,
            inputName: inputName,
            tableName: tableName,
            value: value,
            idCountry: <?php echo $_GET['id']; ?>
          },
          success: function(response) {
            console.log(response)
          }
        });
      }

      function saveDocumentValue(inputName, tableName) {

        let value = $(`#${inputName}`).val()
        let id = inputName.split("-")[0];
        let inputNameValue = inputName.split("-")[1];

        $.ajax({
          type: "POST",
          url: "../../query/Indicators/saveDocumentValue.php",
          data: {
            inputName: inputNameValue,
            tableName: tableName,
            value: value,
            idCountry: <?php echo $_GET['id']; ?>,
            idDocument: id
          },
          success: function(response) {
            console.log(response)
          }
        });
      }
      </script>
</body>

</html>