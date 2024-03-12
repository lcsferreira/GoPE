<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}
$enableSubmit = false;
$userType = $_SESSION['type'];
$userId = $_SESSION['userId'];
$countryId = $_SESSION['countryId'];

// get country name
$sql = "SELECT name FROM countries WHERE id = $countryId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $countryName = $row['name'];
}

if($userType === 'contact') {
  // verify if is main contact
  $sql = "SELECT * FROM users WHERE id = $userId";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row['is_main'] == '1') {
      $enableSubmit = true;
    }else {
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
  $indicators = array("demographic_data", "pa_pravelance", "pe_policy", "pe_monitoring", "research_pe");

  foreach ($indicators as $indicator){
    $sql = "SELECT * FROM " . $indicator . "_agreement WHERE id = $countryId";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row['agreement'] === 0 || $row['agreement'] === null){
      return false;
    }
  }
}

if(verifyAllAgreementsChecked($conn,$countryId)){
  $enableSubmit = true;
  $hasAllAgreementsChecked = true;
}else{
  $enableSubmit = false;
  $hasAllAgreementsChecked = false;
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
            <button class="btn-submit
              <?php
              if(!$enableSubmit){
                echo ' disabled';
              }
              ?>
              ">Submit</button>
          </div>
          <?php else: ?>
          <?php if($indicatorsStep === 'waiting contact'): ?>
          <p>The contact has <strong>not yet reviewed</strong> the indicators!</p>
          <?php else: ?>
          <?php if($hasEdited): ?>
          <p><strong>Send</strong> for <?php echo $countryName; ?> contact's<strong>review.</strong></p>
          <?php else: ?>
          <p>You <strong>didn't</strong> made any <strong>adjustment</strong> for the contact to review.</p>
          <?php endif; ?>
          <?php endif; ?>
          <div class="dashboard-container__description__submit">
            <button class="btn-submit
                <?php
                if(!$enableSubmit || $indicatorsStep === 'waiting_contact'){
                  echo ' disabled';
                }
                ?>
                ">Submit</button>
          </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    </script>
</body>

</html>