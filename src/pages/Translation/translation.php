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

  // Cria a lista de colunas s1 a s57
  $columns = implode(', ', array_map(function ($i) {
      return "s" . ($i + 1);
  }, range(0, 29)));

  //if the country already has data, delete it
  $sql = "DELETE FROM translations WHERE id_country = ".$country_id;
  $result = $conn->query($sql);

  // Consulta para copiar dados
  $copy_sql = "INSERT INTO translations (id_country, id, $columns) 
                  SELECT $country_id, 0, $columns 
                  FROM language_translations 
                  WHERE language = '$selected_language' limit 1";

  $result = $conn->query($copy_sql);

  // if ($conn->query($copy_sql) === TRUE) {
  //     echo "<p>Dados copiados com sucesso!</p>";
  // } else {
  //     echo "<p>Erro ao copiar dados</p>";
  // }
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
      <form method="post" action="" style="margin: 2rem;">
        <label for="language">Language:</label>
        <select name="language" id="language" <?php if ($_SESSION['type'] != 'admin') echo "disabled";?>>
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
          <?php if ($_SESSION['type'] != 'admin') echo "disabled";?>>Use as
          Default
          Language</button>
      </form>
      <form method="post" id="form" style="display: flex; flex-direction:column; gap:2rem;">
        <div style="display: flex; flex-direction: column; gap: 1rem;">
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>01</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">Please tell us what is your country's name in the native country language?
              For example Brazil = name
              in English; Brasil = name in Portuguese.</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s1" maxlength="255"><?php if ($has_data) echo $data["s1"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>02</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "World region (Africa — AFRO; Eastern Mediterranean
              EMRO; Europe - EURO; The
              Americas and the Caribbean - PAHO; South—East Asia - SEARO; Western Pacific - WPRO)" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s2" maxlength="255"><?php if ($has_data) echo $data["s2"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>03</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Demographic Data" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s3" maxlength="255"><?php if ($has_data) echo $data["s3"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>04</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate the word "Capital" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s4" maxlength="255"><?php if ($has_data) echo $data["s4"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>05</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Population" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s5" maxlength="255"><?php if ($has_data) echo $data["s5"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>06</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Urban Population" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s6" maxlength="255"><?php if ($has_data) echo $data["s6"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>07</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Life expectancy" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s7" maxlength="255"><?php if ($has_data) echo $data["s7"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>08</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Gini index for income inequality" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s8" maxlength="255"><?php if ($has_data) echo $data["s8"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>09</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Human Development Index" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s9" maxlength="255"><?php if ($has_data) echo $data["s9"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>10</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Literacy Rate" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s10" maxlength="255"><?php if ($has_data) echo $data["s10"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>11</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Deaths from non—communicable diseases" into your
              country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s11" maxlength="255"><?php if ($has_data) echo $data["s11"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>12</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Risk of premature non-communicable diseases
              mortality” into your country’s
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s12" maxlength="255"><?php if ($has_data) echo $data["s12"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>13</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Human Capital Index” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s13" maxlength="255"><?php if ($has_data) echo $data["s13"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>14</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Democracy Index” into your country’s language?
            </div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s14" maxlength="255"><?php if ($has_data) echo $data["s14"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>15</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate “Tax Burden” into your country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s15" maxlength="255"><?php if ($has_data) echo $data["s15"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>16</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "World Bank Income Category (High income - Upper
              middle income — Lower middle
              income - Low income)" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s16" maxlength="255"><?php if ($has_data) echo $data["s16"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>17</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Physical Activity Participation" into your
              country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s17" maxlength="255"><?php if ($has_data) echo $data["s17"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>18</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Physical Activity Prevalence estimates for adults"
              into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s18" maxlength="255"><?php if ($has_data) echo $data["s18"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>19</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Adults" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s19" maxlength="255"><?php if ($has_data) echo $data["s19"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>20</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Gender Inequalities in Physical Activity
              Prevalence" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s20" maxlength="255"><?php if ($has_data) echo $data["s20"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>21</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Women" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s21" maxlength="255"><?php if ($has_data) echo $data["s21"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>22</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Men" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s22" maxlength="255"><?php if ($has_data) echo $data["s22"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>23</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Worldwide" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s23" maxlength="255"><?php if ($has_data) echo $data["s23"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>24</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "World region" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s24" maxlength="255"><?php if ($has_data) echo $data["s24"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>25</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "This country card is part of the 3rd Physical
              Activity Almanac (free resource
              on the GoPA! website) For description of indicators and data sources visit: " into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s25" maxlength="255"><?php if ($has_data) echo $data["s25"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>26</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Policy and Surveillance Status" into your
              country’s language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s26" maxlength="255"><?php if ($has_data) echo $data["s26"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>27</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "National physical activity policy/plan" into your
              country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s27" maxlength="255"><?php if ($has_data) echo $data["s27"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>28</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "National recommendations" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s28" maxlength="255"><?php if ($has_data) echo $data["s28"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>29</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "National survey(s) including physical activity
              questions" into your country's
              language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s29" maxlength="255"><?php if ($has_data) echo $data["s29"]?></textarea></div>
          </div>
          <div class="indicator-input-container">
            <div class="indicator-input-container__header">
              <h2><strong>30</strong></h2>
            </div>
            <div style="margin: 1rem 2rem;">How do you translate "Most recent" into your country's language?</div>
            <div style="margin: 1rem 2rem;"><textarea <?php if ($_SESSION['type'] == 'admin') echo "";?> rows="5"
                cols="60" name="s30" maxlength="255"><?php if ($has_data) echo $data["s30"]?></textarea></div>
          </div>
        </div>

        <div class="buttons">
          <?php if($_SESSION['type'] == 'admin'): ?>
          <button class="btn-back" type="button"
            onclick="document.location = `../countriesList/countriesListAdmin.php`">Back</button>
          <?php endif; ?>
          <?php if($_SESSION['type'] == 'admin'): ?>
          <button class="btn-primary" type="button" name="confirmval" onclick="openConfirmationModal()">Send to
            GoPE!</button>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  const btnBack = document.querySelector('.btn-back');
  btnBack.addEventListener('click', () => {
    window.location.href =
      '../Dashboard/countriesList.php<?php if($_SESSION['type']=='contact') {echo "?id=".$_SESSION['id'];} ?>';
  });
  const modal = document.querySelector('.modal');
  const modalConfirm = document.querySelector('#modal-confirm');
  const modalClose = document.querySelector('#modal-close');

  function openConfirmationModal() {
    modal.style.display = 'block';
  }

  modalConfirm.addEventListener('click', () => {
    modal.style.display = 'none';
    sendTranslations();
  });

  modalClose.addEventListener('click', () => {
    modal.style.display = 'none';
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
      }
    });
  }
  </script>
</body>

</html>