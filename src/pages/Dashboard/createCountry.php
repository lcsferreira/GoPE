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
  <title>Countries List - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/pages/dashboard.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <h1 class="container__title">Country <strong>Creation</strong> <span>Fill with the country information</span></h1>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2>Country <strong>Information</strong></h2>
      </div>
      <form action="../../query/Dashboard/createCountry.php" method="post" id="countryForm">
        <div class="form-group">
          <label for="name">Name *</label>
          <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
          <label for="capital">Capital *</label>
          <input type="text" name="capital" id="capital" required>
        </div>
        <div class="form-group">
          <label for="region">Region *</label>
          <input type="text" name="region" id="region" required>
        </div>
        <div class="form-group">
          <label for="need_translation">Need Translation</label>
          <!-- Rounded switch -->
          <label class="switch">
            <input type="checkbox" name="need_translation" id="need_translation">
            <span class="slider round"></span>
          </label>
          <!-- Hidden input field to store checkbox value -->
          <input type="hidden" name="need_translation_value" id="need_translation_value" value="">
        </div>
        <button class="btn-submit" type="submit">
          Create
        </button>
      </form>
    </div>
  </div>
  <script>
  document.getElementById("countryForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission

    // Get input values
    var name = document.getElementById("name").value;
    var capital = document.getElementById("capital").value;
    var region = document.getElementById("region").value;
    var needTranslation = document.getElementById("need_translation").checked;

    // Set the value of the hidden input field based on checkbox state
    document.getElementById("need_translation_value").value = needTranslation;

    // Submit the form
    this.submit();
  });
  </script>


  </script>
</body>

</html>