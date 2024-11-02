<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}
$id = $_GET['id'];

$query = "SELECT * FROM countries WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$country = mysqli_fetch_assoc($result);
mysqli_free_result($result);
mysqli_close($conn);

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
    <h1 class="container__title">Country <strong>Edit</strong> <span>Review and edit the country information</span></h1>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2>Country <strong>Information</strong></h2>
      </div>
      <form action="../../query/Dashboard/editCountry.php" method="post" id="countryForm">
        <div class="form-group">
          <label for="name">Name *</label>
          <input type="text" name="name" id="name" required value="<?php echo $country['name']; ?>">
        </div>
        <div class="form-group">
          <label for="capital">Capital *</label>
          <input type="text" name="capital" id="capital" required value="<?php echo $country['capital']; ?>">
        </div>
        <div class="form-group">
          <label for="region">Region *</label>
          <input type="text" name="region" id="region" required value="<?php echo $country['region']; ?>">
        </div>
        <div class="form-group">
          <label for="need_translation">Need Translation</label>
          <!-- Rounded switch -->
          <label class="switch">
            <input type="checkbox" name="need_translation" id="need_translation"
              <?php if ($country['need_translation'] == 1) echo "checked"; ?>>
            <span class="slider round"></span>
          </label>
          <!-- Hidden input field to store checkbox value -->
          <input type="hidden" name="need_translation_value" id="need_translation_value" value="">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
        </div>

        <!-- Etapas -->
        <div style="display:flex; flex-direction: column;width: 100%; gap: 1rem; margin-top: 2rem;">
          <h3>Country Workflow Steps</h3>
          <p>Note: NO EMAIL will be SENT regarding the status update</p>
          <!-- indicators_step -->
          <div class="form-group">
            <label for="indicators_step">Indicators Step Status</label>
            <select name="indicators_step" id="indicators_step" style="width: 100%;">
              <option value="not started" <?php if ($country['indicators_step'] == 'not started') echo 'selected'; ?>>
                Not
                Started</option>
              <option value="waiting contact"
                <?php if ($country['indicators_step'] == 'waiting contact') echo 'selected'; ?>>Waiting Contact</option>
              <option value="waiting admin"
                <?php if ($country['indicators_step'] == 'waiting admin') echo 'selected'; ?>>
                Waiting Admin</option>
              <option value="completed" <?php if ($country['indicators_step'] == 'completed') echo 'selected'; ?>>
                Completed</option>
            </select>
          </div>

          <!-- card_english_step -->
          <div class="form-group">
            <label for="card_english_step">Card English Step Status</label>
            <select name="card_english_step" id="card_english_step" style="width: 100%;">
              <option value="not started" <?php if ($country['card_english_step'] == 'not started') echo 'selected'; ?>>
                Not Started</option>
              <option value="waiting contact"
                <?php if ($country['card_english_step'] == 'waiting contact') echo 'selected'; ?>>Waiting Contact
              </option>
              <option value="waiting admin"
                <?php if ($country['card_english_step'] == 'waiting admin') echo 'selected'; ?>>Waiting Admin</option>
              <option value="completed" <?php if ($country['card_english_step'] == 'completed') echo 'selected'; ?>>
                Completed</option>
            </select>
          </div>

          <!-- translation_step (se aplicável) -->
          <?php if ($country['need_translation'] == 1): ?>
          <div class="form-group">
            <label for="translation_step">Translation Step Status</label>
            <select name="translation_step" id="translation_step" style="width: 100%;">
              <option value="not started" <?php if ($country['translation_step'] == 'not started') echo 'selected'; ?>>
                Not
                Started</option>
              <option value="waiting contact"
                <?php if ($country['translation_step'] == 'waiting contact') echo 'selected'; ?>>Waiting Contact
              </option>
              <option value="waiting admin"
                <?php if ($country['translation_step'] == 'waiting admin') echo 'selected'; ?>>Waiting Admin</option>
              <option value="completed" <?php if ($country['translation_step'] == 'completed') echo 'selected'; ?>>
                Completed</option>
            </select>
          </div>

          <div class="form-group">
            <label for="card_translated_step">Card Translated Step Status</label>
            <select name="card_translated_step" id="card_translated_step" style="width: 100%;">
              <option value="not started"
                <?php if ($country['card_translated_step'] == 'not started') echo 'selected'; ?>>Not Started</option>
              <option value="waiting contact"
                <?php if ($country['card_translated_step'] == 'waiting contact') echo 'selected'; ?>>Waiting Contact
              </option>
              <option value="waiting admin"
                <?php if ($country['card_translated_step'] == 'waiting admin') echo 'selected'; ?>>Waiting Admin
              </option>
              <option value="completed" <?php if ($country['card_translated_step'] == 'completed') echo 'selected'; ?>>
                Completed</option>
            </select>
          </div>
          <?php endif; ?>


        </div>
        <button class="btn-submit" type="submit">
          Confirm
        </button>
      </form>
    </div>
  </div>
  <script>
  document.getElementById("countryForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission

    // Get input values
    let name = document.getElementById("name").value;
    let capital = document.getElementById("capital").value;
    let region = document.getElementById("region").value;
    let needTranslation = document.getElementById("need_translation").checked;

    // Set the value of the hidden input field based on checkbox state
    document.getElementById("need_translation_value").value = needTranslation;

    if (needTranslation) {
      let indicators_step = document.getElementById("indicators_step").value;
      let translation_step = document.getElementById("translation_step").value;
      let card_translated_step = document.getElementById("card_translated_step").value;
      let card_english_step = document.getElementById("card_english_step").value;
    } else {
      let indicators_step = document.getElementById("indicators_step").value;
      let translation_step = null;
      let card_translated_step = null;
      let card_english_step = document.getElementById("card_english_step").value;
    }

    // Log the values (you can modify this part as per your requirement)
    // console.log("Name: " + name);
    // console.log("Capital: " + capital);
    // console.log("Region: " + region);
    // console.log("Need Translation: " + needTranslation);
    // console.log("Indicators Step: " + indicators_step);
    // console.log("Translation Step: " + translation_step);
    // console.log("Card Translated Step: " + card_translated_step);
    // console.log("Card English Step: " + card_english_step);

    // Submit the form
    this.submit();
  });
  </script>


  </script>
</body>

</html>