<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}
$country_id = $_GET['id'];


// Processar o formulário quando o botão for clicado
if (isset($_POST["language"])) {
  $selected_language = $_POST["language"];

  // Cria a lista de colunas s1 a s44
  $columns = implode(', ', array_map(function ($i) {
      return "s" . ($i + 1);
  }, range(0, 43)));

  //if the country already has data, delete it
  $sql = "DELETE FROM translations WHERE id_country = ".$country_id;
  $result = $conn->query($sql);

  // Consulta para copiar dados
  $copy_sql = "INSERT INTO translations (id_country, id, $columns) 
                  SELECT $country_id, 0, $columns 
                  FROM language_translations 
                  WHERE language = '$selected_language' limit 1";

  $result = $conn->query($copy_sql);
}
// // Consulta para obter as opções do select
$sql = "SELECT DISTINCT language FROM language_translations order by language";
$result1 = $conn->query($sql);

$sql = "SELECT * FROM translations WHERE id_country = ".$country_id;
$result = $conn->query($sql);
$data = $result->fetch_assoc();
if ($result->num_rows > 0) {
  $has_data = true;
} else {
  $has_data = false;
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
  <link rel="stylesheet" href="../../css/pages/translation.css">
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
      $typeModal = "warning";
      $icon = "fas fa-exclamation-triangle";
      $buttonCloseText = "Close";
      include '../../components/modalInfo.php'; 
    ?>
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
      <!-- <form method="post" action="" style="margin: 2rem;">
        <label for="language">Language:</label>
        <select name="language" id="language" <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>>
          <?php
                      if ($result1->num_rows > 0) {
                          while ($row1 = $result1->fetch_assoc()) {
                              echo "<option value='" . $row1["language"] . "'>" . $row1["language"] . "</option>";
                          }
                      }
                      //default empty option
                      echo "<option value='' selected>Select</option>";
                      
                      ?>
        </select>
        <button class="btn-primary" type="submit" name="copy_data"
          <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>>Use as
          Default
          Language</button>
      </form> -->
      <form method="post" id="form" style="display: flex; flex-direction:column; gap:2rem;">
        <div style="display: flex; flex-direction: column; gap: 1rem;">

          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>01</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">Please tell us what is your country's name in the native country language?
              For example Brazil = name
              in English; Brasil = name in Portuguese.</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s1" maxlength="255"><?php if ($has_data) echo $data["s1"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>02</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "World region (Africa — AFRO; Eastern Mediterranean
              EMRO; Europe - EURO; The
              Americas and the Caribbean - PAHO; South—East Asia - SEARO; Western Pacific - WPRO)" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s2" maxlength="255"><?php if ($has_data) echo $data["s2"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>03</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "World region (South Asia; Europe & Central Asia;
              Middle East & North Africa; East Asia & Pacific; Sub-Saharan Africa; Latin America & Caribbean; North
              America)" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s3" maxlength="255"><?php if ($has_data) echo $data["s3"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>04</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Country and demographic data" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s4" maxlength="255"><?php if ($has_data) echo $data["s4"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>05</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate the word "Capital" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s5" maxlength="255"><?php if ($has_data) echo $data["s5"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>06</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Population (n)" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s6" maxlength="255"><?php if ($has_data) echo $data["s6"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>07</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Literacy: youth total (15-24 years)” into your
              country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s7" maxlength="255"><?php if ($has_data) echo $data["s7"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>08</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Government expenditure on education” into your
              country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s8" maxlength="255"><?php if ($has_data) echo $data["s8"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>09</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “primary education” into your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s9" maxlength="255"><?php if ($has_data) echo $data["s9"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>10</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “secondary education” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s10" maxlength="255"><?php if ($has_data) echo $data["s10"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>11</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “primary” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s11" maxlength="255"><?php if ($has_data) echo $data["s11"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>12</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “secondary” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s12" maxlength="255"><?php if ($has_data) echo $data["s12"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>13</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Official entrance age to each school level (years)”
              into your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s13" maxlength="255"><?php if ($has_data) echo $data["s13"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>14</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Duration by educational level (years)” into your
              country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s14" maxlength="255"><?php if ($has_data) echo $data["s14"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>15</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Duration of compulsory education (years)” into your
              country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s15" maxlength="255"><?php if ($has_data) echo $data["s15"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>16</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “School-age population by level of education” into your
              country’s
              language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s16" maxlength="255"><?php if ($has_data) echo $data["s16"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>17</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Word bank category (High income – Upper-middle income
              –
              Lower-middle income – Low income)” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s17" maxlength="255"><?php if ($has_data) echo $data["s17"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>18</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Physical activity participation” into your country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s18" maxlength="255"><?php if ($has_data) echo $data["s18"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>19</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Physical activity prevalence estimates for
              adolescents” into your
              country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s19" maxlength="255"><?php if ($has_data) echo $data["s19"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>20</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “total”
              into your
              country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s20" maxlength="255"><?php if ($has_data) echo $data["s20"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>21</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “boys”
              into your
              country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s21" maxlength="255"><?php if ($has_data) echo $data["s21"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>22</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “girls”
              into your
              country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s22" maxlength="255"><?php if ($has_data) echo $data["s22"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>23</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “National and official physical education curriculum”
              into your
              country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s23" maxlength="255"><?php if ($has_data) echo $data["s23"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>24</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “National policy requiring mandatory physical
              education” into your
              country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s24" maxlength="255"><?php if ($has_data) echo $data["s24"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>25</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “National policy requiring minimum physical education
              time” into
              your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s25" maxlength="255"><?php if ($has_data) echo $data["s25"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>26</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Yes, for all school years” into your country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s26" maxlength="255"><?php if ($has_data) echo $data["s26"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>27</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Yes, for some of the school years” into your country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s27" maxlength="255"><?php if ($has_data) echo $data["s27"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>28</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Only at a subnational level” into your country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s28" maxlength="255"><?php if ($has_data) echo $data["s28"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>29</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “No” into your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s29" maxlength="255"><?php if ($has_data) echo $data["s29"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>30</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Physical education monitoring” into your country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s30" maxlength="255"><?php if ($has_data) echo $data["s30"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>31</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “National monitoring system to evaluate physical
              education policy implementation” into your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s31" maxlength="255"><?php if ($has_data) echo $data["s31"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>32</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Yes” into your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s32" maxlength="255"><?php if ($has_data) echo $data["s32"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>33</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Physical education and school-based physical activity
              intervention research” into your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s33" maxlength="255"><?php if ($has_data) echo $data["s33"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>34</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Position in the ranking” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s34" maxlength="255"><?php if ($has_data) echo $data["s34"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>35</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “High” into your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s35" maxlength="255"><?php if ($has_data) echo $data["s35"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>36</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Low” into your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s36" maxlength="255"><?php if ($has_data) echo $data["s36"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>37</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “research articles quintiles (Q)” into your country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s37" maxlength="255"><?php if ($has_data) echo $data["s37"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>38</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Contribution to research worlwide” into your country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s38" maxlength="255"><?php if ($has_data) echo $data["s38"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>39</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Number of articles” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s39" maxlength="255"><?php if ($has_data) echo $data["s39"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>40</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "This country card is part of the 1 st Physical
              Education
              Almanac (free resource on the GoPE! website). For description of indicators and data
              sources visit:" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s40" maxlength="255"><?php if ($has_data) echo $data["s40"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>41</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Physical Education Country Card” into your country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s41" maxlength="255"><?php if ($has_data) echo $data["s41"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>42</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Contact information” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s42" maxlength="255"><?php if ($has_data) echo $data["s42"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>43</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Name” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s43" maxlength="255"><?php if ($has_data) echo $data["s43"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>44</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Institution” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "disabled";?>
                rows="5" cols="60" name="s44" maxlength="255"><?php if ($has_data) echo $data["s44"]?></textarea></div>
          </div>
        </div>

        <div class="buttons">
          <button class="btn-back" type="button">Back</button>
          <?php if($_SESSION['type'] != 'admin'): ?>
          <button class="btn-primary" type="button" name="confirmval" onclick="openConfirmationModal()">Submit</button>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  const btnBack = $('.btn-back');

  btnBack.on('click', () => {
    window.location.href =
      '../Dashboard/countriesList.php<?php if($_SESSION['type']=='contact') {echo "?id=".$_SESSION['id'];} ?>';
  });
  const modals = document.querySelectorAll('.modal');
  const modalInfo = modals[0];
  const modal = modals[1];

  const modalConfirm = document.querySelector('#modal-confirm');
  const modalsClose = document.querySelectorAll('#modal-close');

  const modalInfoClose = modalsClose[0];
  const modalClose = modalsClose[1];


  function openConfirmationModal() {
    //get all the inputs and verify if are filled
    const inputs = document.querySelectorAll('textarea');
    let filled = true;
    inputs.forEach(input => {
      if (input.value == '') {
        filled = false;
      }
    });
    if (!filled) {
      const modalInfoBody = modalInfo.querySelector('.modal-body');
      modalInfoBody.innerHTML = 'Please fill all the fields before submitting.';
      modalInfo.style.display = 'block';
      return;
    } else {
      modal.style.display = 'block';
    }
  }

  modalConfirm.addEventListener('click', () => {
    modal.style.display = 'none';
    sendTranslations();
  });

  modalClose.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  modalInfoClose.addEventListener('click', () => {
    modalInfo.style.display = 'none';
  });

  function sendTranslations() {
    //get all the values fro the #form
    const form = document.querySelector('#form');
    const formData = new FormData(form);
    const data = {};
    for (const [key, value] of formData.entries()) {
      data[key] = value;
    }

    //send the data to the server
    $.ajax({
      type: "POST",
      url: "../../query/Translation/sendTranslations.php?id=<?php echo $country_id; ?>",
      data: data,
      success: function(response) {
        console.log(response);
        if (response == "success") {
          window.location.href =
            '../Dashboard/countriesList.php<?php if($_SESSION['type']=='contact') {echo "?id=".$_SESSION['id'];} ?>';
        }
      }
    });
  }
  </script>
</body>

</html>