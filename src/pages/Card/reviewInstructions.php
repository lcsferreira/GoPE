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
  <title>Review Guide - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/pages/dashboard.css">
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
      <h1><strong>Review</strong> the Country <strong>Card</strong></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2>Review <strong>Introduction</strong></h2>
      </div>
      <div class="instructions-container">
        <h1><strong>First Set of Country Cards</strong></h1>
        <h2><?php echo $year = date('Y'); ?></h2>
        <p>
          Dear Country Contact, the <strong>English version</strong> of the <strong>Country Cards, GoPE!’s</strong> will
          be <strong>displayed
            recent</strong> in this step.
        </p>
        <h3>
          You can
        </h3>
        <div class="cards-container">
          <div class="card">
            <h4>01</h4>
            <p>
              Approve it or request additional changes
            </p>
          </div>
          <div class="card">
            <h4>02</h4>
            <p>
              Upload a file to offer more information
            </p>
          </div>
          <div class="card">
            <h4>03</h4>
            <p>
              Leave a comment sharing your opinion
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  $(document).ready(function() {
    $(".btn-back").click(function() {
      window.location.href = "countriesList.php?id=<?php echo $_SESSION['id'] ?>";
    });
    $(".btn-next").click(function() {
      window.location.href = "cardUpload.php?id=<?php echo $_GET['id'] ?>";
    });
  });
  </script>
</body>

</html>