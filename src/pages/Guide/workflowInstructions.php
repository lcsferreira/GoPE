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
  <title>Workflow Guide - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/pages/dashboard.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css" integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <div class="container__title-header">
      <button class="btn-back">Back</button>
      <h1>Workflow <strong>Guide</strong></h1>
      <button class="btn-next">Next</button>
    </div>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2>Workflow <strong>Introduction</strong></h2>
      </div>
      <div class="instructions-container">
        <h1><strong>First Set of Country Cards</strong></h1>
        <h2><?php echo $year = date('Y'); ?></h2>
        <p>
          Dear Country Contact, in the <strong>First</strong> set of <strong>Country Cards, GoPE!’s</strong> core
          indicators will be updated to the <strong>most
            recent</strong> and <strong>available information</strong>.
          <br />
          <br />

          We value very much your <strong>participation</strong> and <strong>great contributions</strong> to
          <strong>GoPE!</strong>. We kindly ask you to <strong>review</strong> the <strong>data</strong>
          collected for <strong>your country’s Country Card</strong>.
        </p>
        <h3>
          You will have to
        </h3>
        <div class="cards-container">
          <div class="card">
            <h4>01</h4>
            <p>
              Complete and review the indicators of the Country Card's Indicators.
            </p>
          </div>
          <div class="card">
            <h4>02</h4>
            <p>
              Review the English version of the Country Card
            </p>
          </div>
          <div class="card">
            <h4>03</h4>
            <p>
              Translate your country's Country Card (if applicable)
            </p>
          </div>
          <div class="card">
            <h4>04</h4>
            <p>
              Review the translated version of the Country Card (if applicable)
            </p>
          </div>
        </div>
        <p>Data is <strong>automatically stored</strong> by the system. You can <strong>log out</strong> and <strong>log
            back in</strong> as you need, and your <strong>progress</strong> won’t be lost. There is <strong>no
            limit</strong> to the number of times you may <strong>check</strong> the data before
          <strong>approving</strong> it, but once you do, you won't be able to make any more changes.
        </p>
      </div>
    </div>
  </div>
  </div>
  <script>
    const btnNext = document.querySelector('.btn-next');
    btnNext.addEventListener('click', () => {
      window.location.href = '../Dashboard/countriesList.php<?php if ($_SESSION['type'] === 'admin') {
                                                              echo "'";
                                                            } else {
                                                              echo "?id=" . $_SESSION['id'] . "'";
                                                            }
                                                            ?>;
    });
    const btnBack = document.querySelector('.btn-back');
    btnBack.addEventListener('click', () => {
      window.location.href = 'manualGuide.php';
    });
  </script>
</body>

</html>