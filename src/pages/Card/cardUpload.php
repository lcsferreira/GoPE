<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}

function getThumbnail($path, $country) {
  if (is_dir($path)) {
    $files = scandir($path);
    
    foreach ($files as $file) {
      if ($file != "." && $file != ".." && strpos($file, $country) === 0 && pathinfo($file, PATHINFO_EXTENSION) === "png") {
          return $file; // Retorna o primeiro arquivo encontrado
      }
  }
  }
  
  return null; // Retorna null se nenhum arquivo for encontrado
}

$country_id = $_GET['id'];
$sql = "SELECT card_english_step FROM countries WHERE id = $country_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$stepStatus = $row['card_english_step'];

if($row['card_english_step'] == "not started"){
  $sql = "INSERT INTO cards_en (id_country) VALUES ($country_id)";
  mysqli_query($conn, $sql);
  $sql = "UPDATE countries SET card_english_step = 'waiting admin' WHERE id = $country_id";
  mysqli_query($conn, $sql);
}

$sql = "SELECT * FROM cards_en WHERE id_country = $country_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// $commentValues = $row['comment'];
$commentValues = array();
$commentValues['comment'] = $row['comment'];

function getLastUpdatedDate($country_id){
  $date = getThumbnail("../../uploads/cards_en/", $country_id);
  // $imagick->writeImage($thumbnailFile."-". date("Y-m-d-H-i-s") . '.png');
  date_default_timezone_set('UTC');

  //separte the date from the file name
  $date = explode("-", $date);

  $formattedDate = $date[1] . "/" . $date[2] . "/" . $date[3] . " " . $date[4] . ":" . $date[5] . ":" . $date[6];

  $formattedDate = explode(".", $formattedDate);
  $formattedDate = $formattedDate[0];

  $formattedDate = date("F j, Y, g:i a", strtotime($formattedDate));
  return "Last updated: " . $formattedDate . " (UTC)";
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coutry Card English Review - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/pages/indicators.css">
  <link rel="stylesheet" href="../../css/components/commentGroup.css">
  <link rel="stylesheet" href="../../css/components/agreementGroup.css">
  <link rel="stylesheet" href="../../css/pages/cardUpload.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <?php
      $icon = "fas fa-exclamation-circle";
      $message = "Do you want to approve this step? This action will disable the possibility of modifying the data.";
      $buttonConfirmText = "Confirm";
      $buttonCloseText = "Cancel";
      include '../../components/modalCard.php';
    ?>
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1><strong>Review</strong> the <strong>English</strong> version of the Country <strong>Card</strong></h1>
      <div></div>
    </div>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2><strong>English version</strong></h2>
      </div>

      <div style="display: flex">
        <div class="card-container">
          <h3>
            <?php 
              if($row['has_card'] == 0){
                echo "No card uploaded";
              }else{
                echo getLastUpdatedDate($country_id);
              }
            ?>
          </h3>
          <div style="display: flex; flex-direction: column; gap: 0.75rem; align-items: flex-end;">
            <?php if($row['has_card'] == 1): ?>
            <img src="<?php echo "../../uploads/cards_en/".getThumbnail("../../uploads/cards_en/", $country_id); ?>"
              alt="Country card">
            <a href="<?php echo "../../uploads/cards_en/$country_id.pdf "?>"
              class="btn-primary  <?php if(!$row['has_card']){echo " disabled-link ";} ?>" download>Download Card <i
                class="fas fa-download"></i></a>
            <?php endif; ?>
          </div>
          <?php if($_SESSION['type'] == "admin"):?>
          <div class="upload-container">
            <input type="file" name="cardUpload" id="cardUpload">
            <button class="btn-primary" id="uploadBtn">Upload card</button>
          </div>
          <?php endif; ?>
        </div>
        <div class="card-options">
          <p>
            To ensure efficient review and identification of adjustments, please use a different color (e.g., red,
            yellow highlight) when requesting changes for the Country Card.
          </p>
          <?php
            $indicatorName = "comment";
            $indicatorOrder = 1;
            $tableName = "cards_en";
            include '../../components/commentGroup.php';
          ?>
          <?php if($_SESSION['type'] == "admin"):?>
          <a href="<?php echo "../../uploads/files/".$country_id.".pdf"?>"
            class="btn-primary  <?php if(!$row['has_contact_file']){echo " disabled-link ";} ?>" style="width: 95%;"
            download>Download
            file <i class="fas fa-download"></i></a>
          <?php else: ?>
          <div id="file-container" style="width: 100%;">
            <?php if($row['has_contact_file'] == 1): ?>
            <a href="<?php echo "../../uploads/files/".$country_id.".pdf"?>"
              class="btn-primary  <?php if(!$row['has_contact_file']){echo " disabled-link ";} ?>"
              style="display: block; width: 95%;" download>Download
              file <i class="fas fa-download"></i></a>
            <?php endif; ?>
          </div>
          <input type="file" name="fileUpload" id="fileUpload">
          <button class="btn-primary" id="uploadFileBtn">Upload file</button>
          <p style="margin-top: 1rem;">(.pdf, .pwp, .docx)</p>
          <?php endif; ?>
          <?php if($_SESSION['type'] == "admin"):?>
          <label for="send-contact-review" class="radio-option-no-description" style="width: 97%;">
            <div class="option-text">
              <h3>Send for Country Contact's review</h3>
            </div>
            <input type="checkbox" name="send-contact-review" id="send-contact-review" value="send-for-review" />
            <span class="checkmark"></span>
          </label>
          <button class="btn-primary" style="width: 100%;" onclick="sendContactReview()"
            <?php if($stepStatus == "waiting contact"){echo " disabled ";} ?>>Submit</button>
          <?php else: ?>
          <label for="send-adjustment" class="radio-option-no-description" style="width: 97%;">
            <div class="option-text">
              <h3>Request further adjustments</h3>
            </div>
            <input type="radio" name="send-admin" id="send-adjustment" value="adjust" />
            <span class="checkmark"></span>
          </label>
          <label for="send-approve" class="radio-option-no-description" style="width: 97%;">
            <div class="option-text">
              <h3>Approve the Country Card</h3>
            </div>
            <input type="radio" name="send-admin" id="send-approve" value="approve" />
            <span class="checkmark"></span>
          </label>
          <button class="btn-primary" style="width: 100%;" onclick="sendResponse()">Submit</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  $(document).ready(function() {
    $(".btn-back").click(function() {
      window.location.href = "reviewInstructions.php?id=<?php echo $_GET['id'] ?>";
    });
  });

  $("#uploadBtn").click(function() {

    let formData = new FormData();
    let file = $("#cardUpload")[0].files[0];
    formData.append('cardUpload', file);
    formData.append('idCountry', <?php echo $_GET['id'] ?>);

    let loading = `
      <span class="loader"></span>
    `;
    $(".card-container").html(loading);

    $.ajax({
      url: '../../query/Cards/uploadCard.php',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        location.reload();
      }
    });
  });

  $("#uploadFileBtn").click(function() {

    let formData = new FormData();
    let file = $("#fileUpload")[0].files[0];
    formData.append('fileUpload', file);
    formData.append('idCountry', <?php echo $_GET['id'] ?>);

    let loading = `
      <span class="loader"></span>
    `;
    $("#file-container").append(loading);

    $.ajax({
      url: '../../query/Cards/uploadFile.php',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        location.reload();
      }
    });
  });


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

  function sendContactReview() {
    let idCountry = <?php echo $_GET['id'] ?>;
    let sendForReview = $("#send-contact-review").is(":checked");

    if (sendForReview) {
      $.ajax({
        type: "POST",
        url: "../../query/Cards/sendForReview.php",
        data: {
          idCountry: idCountry,
        },
        success: function(response) {
          console.log(response)
          window.location.href = "../Dashboard/countriesList.php?id=<?php echo $_GET['id'] ?>";
        }
      });
    } else {
      window.location.href = "reviewInstructions.php?id=<?php echo $_GET['id'] ?>";
    }
  }

  const modal = document.querySelector('.modal');
  const modalConfirm = document.querySelector('#modal-confirm');
  const modalClose = document.querySelector('#modal-close');

  function openConfirmationModal() {
    modal.style.display = 'block';
  }

  modalConfirm.addEventListener('click', () => {
    modal.style.display = 'none';
    let idCountry = <?php echo $_GET['id'] ?>;
    let sendResponse = $("input[name='send-admin']:checked").val();
    $.ajax({
      type: "POST",
      url: "../../query/Cards/sendResponse.php",
      data: {
        idCountry: idCountry,
        sendResponse: sendResponse
      },
      success: function(response) {
        if (response == "approved") {
          window.location.href = "CardSuccess.php?id=<?php echo $_GET['id'] ?>&cardStep=en";
        } else {
          window.location.href = "../Dashboard/countriesList.php?id=<?php echo $_GET['id'] ?>";
        }
      }
    });
  });

  modalClose.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  function sendResponse() {
    let idCountry = <?php echo $_GET['id'] ?>;
    let sendResponse = $("input[name='send-admin']:checked").val();

    if (sendResponse == "approve") {
      openConfirmationModal();
    } else {
      $.ajax({
        type: "POST",
        url: "../../query/Cards/sendResponse.php",
        data: {
          idCountry: idCountry,
          sendResponse: sendResponse
        },
        success: function(response) {
          window.location.href = "../Dashboard/countriesList.php?id=<?php echo $_GET['id'] ?>";
        }
      });
    }
  }
  </script>
</body>

</html>