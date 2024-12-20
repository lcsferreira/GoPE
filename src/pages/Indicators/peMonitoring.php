<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}

$sql = "SELECT * FROM pe_monitoring_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$adminValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pe_monitoring_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$contactValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pe_monitoring_comments WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$commentValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pe_monitoring_agreement WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$agreementValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pe_monitoring_monitoring_systems_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$monitoringSystemsAdmin = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_monitoring_monitoring_systems_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$monitoringSystemsContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_monitoring_monitoring_systems_documents_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$monitoringSystemsDocumentsAdmin = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM pe_monitoring_monitoring_systems_documents_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$monitoringSystemsDocumentsContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Physical education monitoring - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/sideNavBar.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/components/modalMethod.css">
  <link rel="stylesheet" href="../../css/components/inputYesNo.css">
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
    $cardLocationPath = "../../assets/card_pe_monitoring.png";
    include '../../components/cardLocation.php';
    ?>
    <?php include '../../components/modalMetodology.php'; ?>
    <!-- <div id="notification" class="notification">
      <div class="notification-content">
        <p id="notification-message">Error saving data. Please try again.</p>
        <button id="close-btn" class="close-btn">&times;</button>
        <div id="progress-bar" class="progress-bar"></div>
      </div>
    </div> -->
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1>Physical education monitoring<i class="fas fa-info-circle" id="cardLocationModal"></i></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="indicators-container">
      <?php include '../../components/sideNavBar.php'; ?>
      <div style="display: flex; flex-direction:column; gap:2rem; margin-left: 10rem;">
        <?php 
          $videoTitle = "Methodological approach for collecting Physical Education monitoring data";
          $videoUrl = "https://drive.google.com/file/d/15bxRedWtXpXlBZj7K1hhuX3bGfFvYCJO/preview";
          include '../../components/videoContainer.php'; ?>
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>01</strong></h2>
          </div>
          <div style="padding: 2rem 2rem 0 2rem;">
            <h3 style="color: var(--red)">The information regarding the existence of this indicator must be provided by
              the Country Contact. However, the GoPE! research working group could have collected data. In that case,
              please validate the information or provide new data. To provide a monitoring system, please consult the
              information box</h3>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorOrder = 1;
              $indicatorRole = "admin";
              $indicatorName = "exist_system_evaluate_pe_policy_implementation";
              $inputName = "exist_system_evaluate_pe_policy_implementation";
              $tableName = "pe_monitoring_admin";
              include "../../components/indicatorYesNoGroup.php"; ?>

              <div id="monitoringSystemsAdmin" <?php
                if($adminValues != null && $adminValues["exist_system_evaluate_pe_policy_implementation"] == 0){
                  echo "hidden";
                }
                ?>>

                <div class="monitoring-systems-admin" style="margin-bottom: 1rem;">
                  <?php
                  if($monitoringSystemsAdmin != null){
                    foreach ($monitoringSystemsAdmin as $monitoringSystem) {
                      $inc = $monitoringSystem["inc"];
                      $type = "admin";
                      include "../../components/monitoringSystemGroup.php";
                    }
                  }
                  ?>
                </div>
                <?php if($_SESSION['type'] == 'admin'): ?>
                <button id="addMonitoringSystemAdmin" class="btn-add"
                  style="width: 100%; margin-bottom: 2rem"><strong>Add</strong> monitoring
                  system
                </button>
                <?php endif; ?>
              </div>

              <p class="contact-label" id="1-contact-label">Provide new information here:</p>
              <?php
              $indicatorOrder = 1;
              $indicatorRole = "contact";
              $indicatorName = "exist_system_evaluate_pe_policy_implementation";
              $inputName = "exist_system_evaluate_pe_policy_implementation";
              $tableName = "pe_monitoring_contact";
              include "../../components/indicatorYesNoGroup.php"; ?>

              <div id="monitoringSystemsContact" <?php
                if($contactValues != null && $contactValues["exist_system_evaluate_pe_policy_implementation"] == 0){
                  echo "hidden";
                }
                ?>>
                <div class="monitoring-systems-contact" style="margin-bottom: 1rem;">
                  <?php
                  if($monitoringSystemsContact != null){
                    foreach ($monitoringSystemsContact as $monitoringSystem) {
                      $inc = $monitoringSystem["inc"];
                      $type = "contact";
                      include "../../components/monitoringSystemGroup.php";
                    }
                  }
                  ?>
                </div>
                <?php if($_SESSION['type'] == 'contact'): ?>
                <button id="addMonitoringSystemContact" class="btn-add"
                  style="width: 100%; margin-bottom: 2rem"><strong>Add</strong> monitoring
                  system
                </button>
                <?php endif; ?>
              </div>
              <?php
              $indicatorName = "exist_system_evaluate_pe_policy_implementation";
              $indicatorOrder = 1;
              $tableName = "pe_monitoring_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 1;
            $indicatorName = "exist_system_evaluate_pe_policy_implementation";
            $tableName = "pe_monitoring_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./methods/pe_monitoring.js"></script>
    <script>
    $(document).ready(function() {
      $(".btn-back").click(function() {
        window.location.href = "../Indicators/pePolicy.php<?php echo "?id=" . $_GET['id'] ?>";
      });
      $(".btn-next").click(function() {
        window.location.href = "../Indicators/researchPe.php<?php echo "?id=" . $_GET['id'] ?>";
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
        $("#card-location-modal-close").click(function() {
          closeCardLocationModal()
        })
      })
    }

    function closeCardLocationModal() {
      $("#cardLocation").css("display", "none")
    }

    function verifyAgreementInput() {
      let contactInputs = []
      let contactLabels = []
      let agreementGroups = []
      for (let i = 1; i <= 1; i++) {
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
      let value = $(`input[name=${inputName}-admin]:checked`).val()
      let idCountry = <?php echo $_GET['id'] ?>;

      //transform "yes" and "no" to 1 and 0
      if (value == "yes") {
        value = 1
        $(`#monitoringSystemsAdmin`).show()
      } else {
        value = 0
        $(`#monitoringSystemsAdmin`).hide()
      }

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
          //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
          //   5000)
          console.log(error)
        }
      });
    }

    function saveContactValue(inputName, tableName) {
      let value = $(`input[name=${inputName}-contact]:checked`).val()
      let idCountry = <?php echo $_GET['id'] ?>;

      //transform "yes" and "no" to 1 and 0
      if (value == "yes") {
        value = 1
        $(`#monitoringSystemsContact`).show()
      } else {
        value = 0
        $(`#monitoringSystemsContact`).hide()
      }
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
          //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
          //   5000)
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
          //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
          //   5000)
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

    function addMonitoringSystem(type) {
      const monitoringSystems = $(`.monitoring-systems-${type}`)
      const lastMonitoringSystem = monitoringSystems.children().last().attr('id')

      const inc = lastMonitoringSystem == undefined ? 1 : parseInt(lastMonitoringSystem.split("-")[2]) + 1

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/addMonitoringSystem.php?id=<?php echo $_GET['id'] ?>",
        data: {
          idCountry: <?php echo $_GET['id'] ?>,
          inc: inc,
          type: type
        },
        success: function(response) {
          if (response == "Success") {
            showAddMonitoringSystem(type)
          }
        },
        error: function(error) {
          // showErrorNotification(
          //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
          //   5000)
          console.log(error)
        }
      });
    }

    function showAddMonitoringSystem(type) {
      let monitoringSystems = $(".monitoring-systems-" + type)
      const lastMonitoringSystem = monitoringSystems.children().last().attr('id')

      const inc = lastMonitoringSystem == undefined ? 1 : parseInt(lastMonitoringSystem.split("-")[2]) + 1
      const monitoringSystem = `
      <div class="agreement-group" id="monitoring-system-${inc}-${type}">
        <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Monitoring system ${inc} <span><button class="btn-delete" onclick="deleteMonitoringSystem(${inc}, '${type}')"><i
          class="fas fa-trash-alt"></i></button></span></h3>
        <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
          <label for="reach-group-${inc}-${type}">
            Reach
          </label>
          <div class="agreement-group" id="reach-group-${inc}-${type}" style="margin: 0 !important">
            <label for="reach-pe-${inc}-${type}" class="radio-option-no-description">
              <div class="option-text">
                <h3>Specifically for physical education</h3>
              </div>
              <input type="radio" name="radio-group-reach-monitoring-system-${inc}-${type}"
                id="reach-pe-${inc}-${type}" value="1" onclick="saveMonitoringSystemValues(${inc}, '${type}')"/>
              <span class="checkmark"></span>
            </label>
            <label for="reach-school-${inc}-${type}" class="radio-option-no-description">
              <div class="option-text">
                <h3>General for school (inclusive of PE)</h3>
              </div>
              <input type="radio" name="radio-group-reach-monitoring-system-${inc}-${type}"
                id="reach-school-${inc}-${type}" value="2" onclick="saveMonitoringSystemValues(${inc}, '${type}')" />
              <span class="checkmark"></span>
            </label>
          </div>
        </div>

        <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
          <label for="monitoring-purpose-${inc}-${type}">
            Monitoring purpose
            <br><span style="font-weight: 400; font-size:1rem; margin: 0">(More than 1 option can be selected)</span>
            <span method="monitoring_purpose"><i class="fas fa-info-circle"></i></span>
          </label>
          <div class="agreement-group" id="monitoring-purpose-${inc}-${type}" style="margin: 0 !important">
            <label for="curriculum_implementation-${inc}-${type}" class="radio-option-no-description">
              <div class="option-text">
                <h3>Curriculum implementation</h3>
              </div>
              <input type="checkbox" name="radio-group-monitoring-purpose" id="curriculum_implementation-${inc}-${type}"
                value="curriculum_implementation" onclick="saveMonitoringSystemValues(${inc}, '${type}')" />
              <span class="checkmark"></span>
            </label>
            <label for="pe_general_school-${inc}-${type}" class="radio-option-no-description">
              <div class="option-text">
                <h3>Mandatory Physical Education Delivery</h3>
              </div>
              <input type="checkbox" name="radio-group-monitoring-purpose" id="pe_general_school-${inc}-${type}"
                value="pe_general_school" onclick="saveMonitoringSystemValues(${inc}, '${type}')"/>
              <span class="checkmark"></span>
            </label>
            <label for="min_time-${inc}-${type}" class="radio-option-no-description">
              <div class="option-text">
                <h3>Minimum time accomplished</h3>
              </div>
              <input type="checkbox" name="radio-group-monitoring-purpose" id="min_time-${inc}-${type}" value="min_time"
                onclick="saveMonitoringSystemValues(${inc}, '${type}')" />
              <span class="checkmark"></span>
            </label>
            <label for="other-${inc}-${type}" class="radio-option-no-description">
              <div class="option-text">
                <h3>Other</h3>
              </div>
              <input type="checkbox" name="radio-group-monitoring-purpose" id="other-${inc}-${type}" value="other" onclick="saveMonitoringSystemValues(${inc}, '${type}')"/>
              <span class="checkmark"></span>
            </label>
           <input type='text' name='other_purposes' id='other_purposes-${inc}-${type}' placeholder='which purpose(s)' onblur='saveMonitoringSystemValues(${inc}, '${type}')'/>
          </div>
        </div>

        <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
          <label for="${inc}-${type}">
            Education level to which is applied
          </label>
          <div class="agreement-group" id="education_level-${inc}-${type}" style="margin: 0 !important">
            <label for="education_level-primary-${inc}-${type}" class="radio-option-no-description">
              <div class="option-text">
                <h3>Primary education</h3>
              </div>
              <input type="radio" name="radio-group-education-level-monitoring-system-${inc}-${type}"
                id="education_level-primary-${inc}-${type}" value="1"
                onclick="saveMonitoringSystemValues(${inc}, '${type}')" />
              <span class="checkmark"></span>
            </label>
            <label for="education_level-secondary-${inc}-${type}" class="radio-option-no-description">
              <div class="option-text">
                <h3>Secondary education</h3>
              </div>
              <input type="radio" name="radio-group-education-level-monitoring-system-${inc}-${type}"
                id="education_level-secondary-${inc}-${type}" value="2"
                onclick="saveMonitoringSystemValues(${inc}, '${type}')" />
              <span class="checkmark"></span>
            </label>
            <label for="education_level-both-${inc}-${type}" class="radio-option-no-description">
              <div class="option-text">
                <h3>Primary and Secondary education</h3>
              </div>
              <input type="radio" name="radio-group-education-level-monitoring-system-${inc}-${type}"
                id="education_level-both-${inc}-${type}" value="3"
                onclick="saveMonitoringSystemValues(${inc}, '${type}')" />
              <span class="checkmark"></span>
            </label>
          </div>
        </div>

        <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
          <label for="years_applied-${inc}-${type}">
            School years to which is applied (e.g., 1st to 12th grades; 5th and 8th grades)
          </label>
          <input type="text" name="years_applied" id="years_applied-${inc}-${type}">
        </div>

        <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
          <label for="years_application-${inc}-${type}">
            Years of application
          </label>
          <input type="text" name="years_application" id="years_application-${inc}-${type}"
            onblur="saveMonitoringSystemValues(${inc}, '${type}')">
        </div>

        <div class=" indicator-input" style="margin: 1rem 0 0 0 !important">
          <label for="voluntary_comments-${inc}-${type}">
            Voluntary comments
          </label>
          <textarea name="voluntary_comments" id="voluntary_comments-${inc}-${type}"
            onblur="saveMonitoringSystemValues(${inc}, '${type}')"></textarea>
        </div>

        <div id="monitoring-system-documents-${inc}-${type}">
        </div>
        <button id="addDocument-${inc}-${type}" class="btn-primary" style="width: 100% !important"
        onclick="addDocumentToMonitoringSystem(${inc}, '${type}')"><strong>Add</strong> Document to
        Monitoring
        system</button>
      </div>
      `
      $(".monitoring-systems-" + type).append(monitoringSystem)

      $(`#other_purposes-${inc}-${type}`).hide()

      let methodSpans = document.querySelectorAll("[method]");
      methodSpans.forEach(methodSpan => {
        methodSpan.addEventListener("click", function() {
          openModalMethod(methodSpan.getAttribute("method"))
        })
      })

    }

    function showAddDocumentToMonitoringSystem(inc, type) {
      const documents = $(`#monitoring-system-documents-${inc}-${type}`)
      //get the last inc of the documents and add 1
      const lastDoc = documents.children().last().attr('id')
      let docInc = 1
      if (lastDoc != undefined) {
        docInc = parseInt(lastDoc.split("-")[1]) + 1
      }
      const tableName = `pe_monitoring_monitoring_systems_documents_${type}`

      const document = `
      <div id="document-${docInc}-${type}">
        <h3 style='margin-top: 2rem; display: flex; justify-content: space-between; align-items: center'>Document
          ${docInc}
          <span><button class="btn-delete"
              onclick="deleteDocumentFromMonitoringSystem(${docInc}, '${type}', ${inc})"><i
                class="fas fa-trash-alt"></i></button></span>
        </h3>
        <div class="indicator-input">
          <label for="document-title-${docInc}-${type}">Document title</label>
          <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
          <textarea name="document-title-${docInc}-${type}"
            id="document-title-${docInc}-${type}"
            onblur="saveDocumentValue('document-title-${docInc}-${type}', '${tableName}', '${inc}')"></textarea>
        </div>

        <div class="indicator-input">
          <label for="document-eletronic_source-${docInc}-${type}">Eletronic source</label>
          <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
          <textarea name="document-eletronic_source-${docInc}-${type}"
            id="document-eletronic_source-${docInc}-${type}"
            onblur="saveDocumentValue('document-eletronic_source-${docInc}-${type}', '${tableName}', '${inc}')"></textarea>
        </div>

        <div class="indicator-input">
          <label for="document-year_publication-${docInc}-${type}">Year of Publication</label>
          <p style="font-size:smaller">Write ‘NA’ (non-applicable) if you either lack knowledge or do not have access to that
      information.</p>
          <input type="number" name="document-year_publication-${docInc}-${type}"
            id="document-year_publication-${docInc}-${type}"
            onblur="saveDocumentValue('document-year_publication-${docInc}-${type}', '${tableName}', '${inc}')"></input>
        </div>
      </div>
      `

      documents.append(document)
    }

    function addDocumentToMonitoringSystem(inc, type) {
      const documents = $(`#monitoring-system-documents-${inc}-${type}`)
      const lastDoc = documents.children().last().attr('id')
      let docInc = 1
      if (lastDoc != undefined) {
        docInc = parseInt(lastDoc.split("-")[1]) + 1
      }
      const idCountry = <?php echo $_GET['id'] ?>;

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/addDocumentToMonitoringSystem.php?id=<?php echo $_GET['id'] ?>",
        data: {
          idCountry: idCountry,
          inc: inc,
          docInc: docInc,
          type: type
        },
        success: function(response) {
          if (response == "Success") {
            showAddDocumentToMonitoringSystem(inc, type)
          } else {
            // showErrorNotification(
            //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
            //   5000)
            console.log(response)
          }
        },
        error: function(error) {
          // showErrorNotification(
          //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
          //   5000)
          console.log(error)
        }

      });
    }

    function deleteDocumentFromMonitoringSystem(docInc, type, inc) {
      $.ajax({
        url: "../../query/Indicators/deleteDocumentFromMonitoringSystem.php?id=<?php echo $_GET['id']; ?>",
        type: "POST",
        data: {
          docInc: docInc,
          inc: inc,
          type: type
        },
        success: function(data) {
          if (data == "Success") {
            removeDocumentFromMonitoringSystem(docInc, type);
          } else {
            // showErrorNotification(
            //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
            //   5000)
            console.log(data)
          }
        },
        error: function(error) {
          // showErrorNotification(
          //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
          //   5000)
          console.log(error)
        }
      });

      function removeDocumentFromMonitoringSystem(docInc, type) {
        const monitoringSystem = $(`#monitoring-system-documents-${inc}-${type}`)

        monitoringSystem.find(`#document-${docInc}-${type}`).remove()
      }
    }

    $("#addMonitoringSystemAdmin").click(function() {
      const type = "admin"
      addMonitoringSystem(type)
    });

    $("#addMonitoringSystemContact").click(function() {
      const type = "contact"
      addMonitoringSystem(type)
    });

    function saveDocumentValue(inputName, tableName, inc) {
      const docInc = inputName.split("-")[2]
      const type = inputName.split("-")[3]
      const input = inputName.split("-")[1]
      const monitoringSystem = $(`#monitoring-system-documents-${inc}-${type}`)
      //get the value of the input of the monitoringSystem
      const value = monitoringSystem.find(`#${inputName}`).val()

      const payload = {
        tableName: tableName,
        inputName: input,
        value: value,
        inc: inc,
        docInc: docInc,
        type: type
      }

      // console.log(payload)

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/updateDocumentValue.php?id=<?php echo $_GET['id']; ?>",
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

    function saveMonitoringSystemValues(inc, type) {
      const idCountry = <?php echo $_GET['id'] ?>;
      let reach = $(`input[name='radio-group-reach-monitoring-system-${inc}-${type}']:checked`).val()

      //if reach is undefined, set it to null
      if (reach == undefined) {
        reach = ""
      }

      const curriculumImplementation = $(`#curriculum_implementation-${inc}-${type}`).is(":checked")
      const peGeneralSchool = $(`#pe_general_school-${inc}-${type}`).is(":checked")
      const minTime = $(`#min_time-${inc}-${type}`).is(":checked")
      const other = $(`#other-${inc}-${type}`).is(":checked")

      //if the value of 'other' is in monitoringPurpose show the input

      console.log(other)

      if (other) {
        $(`#other_purposes-${inc}-${type}`).show()
      } else {
        $(`#other_purposes-${inc}-${type}`).hide()
      }

      const otherPurposes = $(`#other_purposes-${inc}-${type}`).val()
      let educationLevel = $(`input[name='radio-group-education-level-monitoring-system-${inc}-${type}']:checked`).val()

      //if educationLevel is undefined, set it to null
      if (educationLevel == undefined) {
        educationLevel = ""
      }

      const yearsApplied = $(`#years_applied-${inc}-${type}`).val()
      const yearPublication = $(`#year_publication-${inc}-${type}`).val()
      const yearsApplication = $(`#years_application-${inc}-${type}`).val()
      const voluntaryComments = $(`#voluntary_comments-${inc}-${type}`).val()

      const payload = {
        idCountry: idCountry,
        type: type,
        inc: inc,
        reach: reach,
        curriculumImplementation: curriculumImplementation,
        peGeneralSchool: peGeneralSchool,
        minTime: minTime,
        other: other,
        otherPurposes: otherPurposes,
        educationLevel: educationLevel,
        yearsApplied: yearsApplied,
        yearPublication: yearPublication,
        yearsApplication: yearsApplication,
        voluntaryComments: voluntaryComments
      }

      console.log(payload)

      $.ajax({
        type: "POST",
        url: "../../query/Indicators/updateMonitoringSystemValues.php?id=<?php echo $_GET["id"]; ?>",
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

    function deleteMonitoringSystem(inc, type) {
      $.ajax({
        url: "../../query/Indicators/deleteMonitoringSystem.php?id=<?php echo $_GET["id"]; ?>",
        type: "POST",
        data: {
          inc: inc,
          type: type
        },
        success: function(data) {
          if (data == "Success") {
            removeMonitoringSystem(inc, type);
          } else {
            // showErrorNotification(
            //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
            //   5000)
            console.log(data)
          }
        },
        error: function(error) {
          // showErrorNotification(
          //   "An error occurred while saving the agreement value due to internet instability. Please try again.",
          //   5000)
          console.log(error)
        }
      });

      function removeMonitoringSystem(inc, type) {
        $(`#monitoring-system-${inc}-${type}`).remove();
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