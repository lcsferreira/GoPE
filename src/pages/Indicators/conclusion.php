<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}
$enableSubmit = false;
$userType = $_SESSION['type'];
$userId = $_SESSION['id'];
$countryId = $_GET['id'];

// get country name
$sql = "SELECT name FROM countries WHERE id = $countryId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $countryName = $row['name'];
}

if($userType === 'contact') {
  // verify if is main contact
  $sql = "SELECT is_main FROM user_country_relations WHERE id_user = $userId AND id_country = $countryId";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row['is_main'] == '1'){
      $enableSubmit = true;
    }
    else{
      $enableSubmit = false;
    }
  }
}
// check if indicators_step is waiting admin
$sql = "SELECT indicators_step FROM countries WHERE id = $countryId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $indicatorsStep = $row['indicators_step'];
  if($row['indicators_step'] === 'waiting_admin') {
    $enableSubmit = false;
  }else{
    $enableSubmit = true;
  }
}

// check if all agreements are checked

function verifyAllAgreementsChecked($conn,$countryId)
{
  $indicators = array("demographic_data", "pa_prevalence", "pe_policy", "pe_monitoring");

  foreach ($indicators as $indicator){
    $sql = "SELECT * FROM " . $indicator . "_agreement WHERE id_country = $countryId";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    foreach($row as $key => $value){
      if($key != "id_country" && $value == 0){
        return false;
      }
    }
  }

  return true;
}

if($userType === "contact"){
  if(verifyAllAgreementsChecked($conn,$countryId)){
    $enableSubmit = true;
    $hasAllAgreementsChecked = true;
  }else{
    $enableSubmit = false;
    $hasAllAgreementsChecked = false;
  }
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
  <link rel="stylesheet" href="../../css/components/agreementGroup.css">
  <link rel="stylesheet" href="../../css/pages/indicators.css">
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
    $message = "Do you want to send the information? This action will disable the possibility of modifying the data.";
    $buttonConfirmText = "Confirm";
    $buttonCloseText = "Cancel";
    include '../../components/modalCard.php';
    ?>
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1>Country <strong>Progress</strong></h1>
      <div></div>
    </div>
    <div class="indicators-container">
      <?php include '../../components/sideNavBar.php'; ?>
      <div style="display: flex; flex-direction:column; gap:2rem; margin-left: 10rem;">
        <div class="dashboard-container">
          <div class="dashboard-container__header">
            <h2><strong>Indicators</strong></h2>
          </div>
          <div class="dashboard-container__description">
            <?php if($userType === 'contact'): ?>
            <p>If you are <strong>ready</strong> to provide <strong>your review</strong> of the indicators, click the
              <strong>submit</strong> button.
            </p>
            <?php if(!$hasAllAgreementsChecked): ?>
            <p><strong>Attention:</strong> You <strong>must</strong> agree with all the indicators to submit.</p>
            <?php endif; ?>

            <div class="dashboard-container__description__submit">
              <button class="btn-primary" <?php
                if(!$enableSubmit){
                  echo ' disabled';
                }
                ?> onclick="openConfirmationModal()">Submit</button>
            </div>
            <?php else: ?>
            <?php if($indicatorsStep === 'waiting contact'): ?>
            <p>The contact has <strong>not yet reviewed</strong> the indicators!</p>
            <?php else: ?>
            <p style="color: var(--text-dark)"><strong>Send</strong> for <?php echo $countryName; ?> contact's<strong>
                review</strong> or you can <strong>approve it</strong></p>
            <label for="approve" class="radio-option-no-description" style="width: 60%;">
              <div class="option-text">
                <h3>Approve indicators</h3>
              </div>
              <input type="checkbox" name="approve" id="approve" value="approve" />
              <span class="checkmark"></span>
            </label>
            <?php endif; ?>
            <div class="dashboard-container__description__submit">
              <button class="btn-primary" <?php
                  if(!$enableSubmit || $indicatorsStep !== 'waiting admin'){
                    echo ' disabled';
                  }
                  ?> onclick="sendToContactReview()">Submit</button>
            </div>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
      $(".btn-back").click(function() {
        window.location.href = "../Indicators/researchPe.php<?php echo "?id=" . $_GET['id'] ?>";
      });
    });

    const modal = document.querySelector('.modal');
    const modalConfirm = document.querySelector('#modal-confirm');
    const modalClose = document.querySelector('#modal-close');

    function openConfirmationModal() {
      modal.style.display = 'block';
    }

    modalConfirm.addEventListener('click', () => {
      modal.style.display = 'none';
      sendToAdminReview();
      // window.location.href = 'indicatorsProgress.php?id=<?php echo $_GET['id'] ?>';
    });

    modalClose.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    function sendToAdminReview() {
      $.ajax({
        url: '../../query/Indicators/sendToAdminReview.php',
        type: 'POST',
        data: {
          idCountry: <?php echo $_GET['id'] ?>
        },
        success: function(response) {
          if (response === 'success') {
            window.location.href = 'indicatorsProgress.php?id=<?php echo $_GET['id'] ?>';
          } else {
            alert('Error');
          }
        }
      });
    }

    function sendToContactReview() {
      //get the value of the checkbox approve
      var approve = document.getElementById('approve').checked;
      if (approve) {
        $.ajax({
          url: '../../query/Indicators/approveIndicators.php',
          type: 'POST',
          data: {
            idCountry: <?php echo $_GET['id'] ?>
          },
          success: function(response) {
            if (response === 'success') {
              window.location.href = 'indicatorsProgress.php?id=<?php echo $_GET['id'] ?>';
            } else {
              alert('Error');
            }
          }
        });
      } else {
        $.ajax({
          url: '../../query/Indicators/sendToContactReview.php',
          type: 'POST',
          data: {
            idCountry: <?php echo $_GET['id'] ?>
          },
          success: function(response) {
            if (response === 'success') {
              window.location.href = 'indicatorsProgress.php?id=<?php echo $_GET['id'] ?>';
            } else {
              alert('Error');
            }
          }
        });
      }
    }
    </script>
</body>

</html>