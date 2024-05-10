<?php
include '../../../config.php';
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}

$id = $_GET['id'];
$year = date('Y') +1 ;
$cardStep = $_GET['cardStep'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/pages/cardSuccess.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
  <title>Forgot Password - GoPE!</title>
</head>

<body>
  <div class="bg-filter"></div>
  <div class="form-container">
    <div class="form-content">
      <div class="form__title">
        <div style="display: flex; justify-content: space-between; width: 90%;">
          <img src="../../assets/gope-logo-desc.png" alt="GoPE logo">
          <button class="btn-advance"><i class="fas fa-arrow-right"></i></button>
        </div>
        <h1>Congratulations on your new Country Card!</h1>
      </div>
      <p class="form__description">
        <?php if($cardStep == "en") : ?>
        Dear Country Contact. Thank you for completing the <strong>GoPE!</strong> <?php echo $year ?> Country Card
        <strong>english version</strong> review
        process. Now the process of <strong>translating the Country Card</strong> will follow.
        <?php else : ?>
        Dear Country Contact. Thank you for completing the <strong>GoPE!</strong> <?php echo $year ?> Country Cards
        review process. We will contact you shortly with <strong>further instructions</strong> about the <strong>final
          set of Country Cards</strong> and the <strong>Third Physical Education Almanac.</strong>
        <?php endif; ?>
      </p>
      <i class="fas fa-check-circle icon"></i>
    </div>
  </div>
  </div>
  <script>
  const btnAdvance = document.querySelector('.btn-advance');
  btnAdvance.addEventListener('click', () => {
    window.location.href =
      '../Dashboard/countriesList.php<?php if($_SESSION['type']=='contact') {echo "?id=".$_SESSION['id'];} ?>';
  });
  </script>
</body>

</html>