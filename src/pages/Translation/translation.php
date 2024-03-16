<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Translation - GoPE!</title>
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
      <h1><strong>Review</strong> the Country <strong>Card</strong></h1>
      <div>
        <p>Please translate the following sentences to your country’s native language.</p>
      </div>
    </div>
    <div class="indicators-container">
      <div style="display: flex; flex-direction:column; gap:2rem;">
        <div class="indicator-input-container">
          <div class="indicator-input-container__header">
            <h2><strong>01</strong></h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  const modal = document.querySelector('.modal');
  const modalConfirm = document.querySelector('#modal-confirm');
  const modalClose = document.querySelector('#modal-close');

  function openConfirmationModal() {
    modal.style.display = 'block';
  }

  modalConfirm.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  modalClose.addEventListener('click', () => {
    modal.style.display = 'none';
  });
  </script>
</body>

</html>