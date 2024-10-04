<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}

// id_country	exist_pe_curriculum_pe	exist_pe_curriculum_se	exist_policy_mandatory_pe	exist_policy_mandatory_se	exist_policy_min_time_pe	exist_policy_min_time_se	

$sql = "SELECT * FROM pa_prevalence_admin WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$adminValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pa_prevalence_contact WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$contactValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pa_prevalence_comments WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$commentValues = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM pa_prevalence_agreement WHERE id_country = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$agreementValues = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Physical activity participation - GoPE!</title>
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
    $cardLocationPath = "../../assets/card_pa_participation.png";
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
      <h1>Physical Activity participation <i class="fas fa-info-circle" id="cardLocationModal"></i></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="indicators-container">
      <?php include '../../components/sideNavBar.php'; ?>
      <div style="display: flex; flex-direction:column; gap:2rem; margin-left: 10rem;">
        <?php 
          $videoTitle = "Methodological approach for collecting physical activity participation data";
          $videoUrl = "https://drive.google.com/file/d/1YTK7IsJXtEKFuWUO-MKCc8U6tgMyYXss/preview";
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
              $inputs = [
                (object) [
                  "name" => "children_age_percent",
                  "title" => "Physical activity prevalence in adolescents (total) aged 11-17 years (%)",
                  "type" => "number",
                  "tableName" => "pa_prevalence_admin"
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
                  "name" => "children_age_percent",
                  "title" => "Physical activity prevalence in adolescents (total) aged 11-17 years (%)",
                  "type" => "number",
                  "tableName" => "pa_prevalence_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "children_age_percent";
              $indicatorOrder = 1;
              $tableName = "pa_prevalence_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 1;
            $indicatorName = "children_age_percent";
            $tableName = "pa_prevalence_agreement";
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
                  "name" => "boys_age_percent",
                  "title" => "Physical activity prevalence in boys aged 11-17 years (%)",
                  "type" => "number",
                  "tableName" => "pa_prevalence_admin"
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
                  "name" => "boys_age_percent",
                  "title" => "Physical activity prevalence in boys aged 11-17 years (%)",
                  "type" => "number",
                  "tableName" => "pa_prevalence_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "boys_age_percent";
              $indicatorOrder = 2;
              $tableName = "pa_prevalence_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 2;
            $indicatorName = "boys_age_percent";
            $tableName = "pa_prevalence_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>03</strong></h3>
          </div>
          <div class="indicator-input-container-values">
            <div class="indicator-input-container-values-group">
              <?php
              $indicatorRole = "admin";
              $indicatorOrder = 3;
              $inputs = [
                (object) [
                  "name" => "girls_age_percent",
                  "title" => "Physical activity prevalence in girls aged 11-17 years (%)",
                  "type" => "number",
                  "tableName" => "pa_prevalence_admin"
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
                  "name" => "girls_age_percent",
                  "title" => "Physical activity prevalence in girls aged 11-17 years (%)",
                  "type" => "number",
                  "tableName" => "pa_prevalence_contact"
                ]
              ];
              include '../../components/indicatorInputGroup.php';
              ?>
              <?php
              $indicatorName = "girls_age_percent";
              $indicatorOrder = 3;
              $tableName = "pa_prevalence_comments";
              include '../../components/commentGroup.php';
              ?>
            </div>
            <?php
            $agreementOrder = 3;
            $indicatorName = "girls_age_percent";
            $tableName = "pa_prevalence_agreement";
            include '../../components/agreementGroup.php';
            ?>
          </div>
        </div>
        <!-- -------------------- -->

      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./methods/paParticipation.js"></script>
    <script>
    $(document).ready(function() {
      $(".btn-back").click(function() {
        window.location.href = "../Indicators/demographicData.php<?php echo "?id=" . $_GET['id'] ?>";
      });
      $(".btn-next").click(function() {
        window.location.href = "../Indicators/pePolicy.php<?php echo "?id=" . $_GET['id'] ?>";
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

      console.log(payload)
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

      console.log(payload)
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