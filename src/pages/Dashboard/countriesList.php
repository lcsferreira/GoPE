<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}
// if (isset($_SESSION['message'])) {
//   echo "<script>alert('" . $_SESSION['message'] . "');</script>";
//   unset($_SESSION['message']); // Clear the session variable
// }
if ($_SESSION['type'] == "admin") {
  $query = "SELECT * FROM countries";
  // echo $query;
  $result = mysqli_query($conn, $query);
  $countries = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
  mysqli_close($conn);
} else {
  $query = "SELECT countries.* FROM countries INNER JOIN user_country_relations ON countries.id = user_country_relations.id_country WHERE user_country_relations.id_user = " . $_SESSION['id'];
  $result = mysqli_query($conn, $query);
  $countries = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
  mysqli_close($conn);
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
    <?php
    $icon = "fas fa-exclamation-triangle";
    $message = "Do you really want to delete this Country? This process cannot be undone.";
    $buttonConfirmText = "Yes";
    $buttonCloseText = "No";
    include '../../components/modalCard.php';
    ?>
    <h1 class="container__title">Countries <strong>Dashboard</strong></h1>
    <div class="cards-container">

    </div>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2>Country <strong>Details</strong></h2>
        <?php if ($_SESSION['type'] === 'admin') : ?>
        <button class="btn-add" onclick="window.location.href = 'createCountry.php';"><strong>Create</strong>
          Country</button>
        <?php endif; ?>
      </div>
      <table class="dashboard-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Indicators</th>
            <th>Country Card English Review</th>
            <th>Translation</th>
            <th>Country Card Translated Review</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($countries as $country) : ?>
          <!-- name	capital	region	need_translation	indicators_step	translation_step	card_english_step	card_translated_step -->
          <tr>
            <td><?php echo $country['name'] ?></td>
            <td>
              <?php
                if ($country['indicators_step'] === "not started") {
                  if ($_SESSION['type'] === 'admin') {
                    echo '<button class="btn-play" onclick="window.location.href = \'../../query/Indicators/createIndicators.php?id=' . $country['id'] . '\'"><i class="fas fa-play-circle"></i></button>';
                  } else {
                    echo '<button disabled class="btn-play"><i class="fas fa-play-circle"></i></button>';
                  }
                } elseif ($country['indicators_step'] === "waiting contact") {
                  if ($_SESSION['type'] === 'admin') {
                    echo '<button class="btn-clock"><i class="fas fa-clock"></i></button>';
                  } else {
                    echo '<button class="btn-exclamation"><i class="fas fa-exclamation-circle"></i></button>';
                  }
                } elseif ($country['indicators_step'] == "waiting admin") {
                  if ($_SESSION['type'] === 'admin') {
                    echo '<button class="btn-exclamation" onclick="window.location.href = \'../../pages/Indicators/indicatorsProgress.php?id=' . $country['id'] . '\'"><i class="fas fa-exclamation-circle"></i></button>';
                  } else {
                    echo '<button disabled class="btn-clock"><i class="fas fa-clock"></i></button>';
                  }
                } elseif ($country['indicators_step'] === "completed") {
                  if ($_SESSION['type'] === 'admin') {
                    echo '<button class="btn-check"><i class="fas fa-check-circle"></i></button>';
                  } else {
                    echo '<button disabled class="btn-check"><i class="fas fa-check-circle"></i></button>';
                  }
                } else {
                  echo '<button disabled class="btn-play"><i class="fas fa-play-circle"></i></button>';
                }
                ?>
            </td>
            <td>
              <?php
                if ($country['card_english_step'] == "not started") {
                  echo '<button disabled class="btn-play"><i class="fas fa-play-circle"></i></button>';
                } elseif ($country['card_english_step'] == "waiting contact") {
                  echo '<button disabled class="btn-clock"><i class="fas fa-clock"></i></button>';
                } elseif ($country['card_english_step'] == "waiting admin") {
                  echo '<button disabled class="btn-exclamation"><i class="fas fa-exclamation-circle"></i></button>';
                } elseif ($country['card_english_step'] == "completed") {
                  echo '<button disabled class="btn-check"><i class="fas fa-check-circle"></i></button>';
                } else {
                  echo '<button disabled class="btn-play"><i class="fas fa-play-circle"></i></button>';
                }
                ?>
            </td>
            <td>
              <?php
                if ($country['need_translation'] == 1) {
                  if ($country['translation_step'] == "not started") {
                    echo '<button disabled class="btn-play"><i class="fas fa-play-circle"></i></button>';
                  } elseif ($country['translation_step'] == "waiting contact") {
                    echo '<button disabled class="btn-clock"><i class="fas fa-clock"></i></button>';
                  } elseif ($country['translation_step'] == "waiting admin") {
                    echo '<button disabled class="btn-exclamation"><i class="fas fa-exclamation-circle"></i></button>';
                  } elseif ($country['translation_step'] == "completed") {
                    echo '<button disabled class="btn-check"><i class="fas fa-check-circle"></i></button>';
                  } else {
                    echo '<button disabled class="btn-play"><i class="fas fa-play-circle"></i></button>';
                  }
                } else {
                  echo '<button disabled class="btn-play" disabled><i class="fas fa-minus-circle"></i></button>';
                }
                ?>
            </td>
            <td>
              <?php
                if ($country['need_translation'] == 1) {
                  if ($country['card_translated_step'] == "not started") {
                    echo '<button disabled class="btn-play"><i class="fas fa-play-circle"></i></button>';
                  } elseif ($country['card_translated_step'] == "waiting contact") {
                    echo '<button disabled class="btn-clock"><i class="fas fa-clock"></i></button>';
                  } elseif ($country['card_translated_step'] == "waiting admin") {
                    echo '<button disabled class="btn-exclamation"><i class="fas fa-exclamation-circle"></i></button>';
                  } elseif ($country['card_translated_step'] == "completed") {
                    echo '<button disabled class="btn-check"><i class="fas fa-check-circle"></i></button>';
                  } else {
                    echo '<button disabled class="btn-play"><i class="fas fa-play-circle"></i></button>';
                  }
                } else {
                  echo '<button disabled class="btn-play" disabled><i class="fas fa-minus-circle"></i></button>';
                }
                ?>
            </td>
            <td>
              <button class="btn-edit"
                onclick="window.location.href = 'editCountry.php?id=<?php echo $country['id']; ?>'"><i
                  class="fas fa-edit"></i></button>
              <button class="btn-delete" id="btn-delete-<?php echo $country['id']; ?>"><i
                  class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
  const modal = document.querySelector('.modal');
  const modalConfirm = document.querySelector('#modal-confirm');
  const modalClose = document.querySelector('#modal-close');
  const btnDelete = document.querySelectorAll('.btn-delete');

  btnDelete.forEach(btn => {
    btn.addEventListener('click', () => {
      modal.style.display = 'flex';
      modalConfirm.setAttribute('id', btn.getAttribute('id').split('-')[2]);
    });
  });

  function deleteCountry(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../query/Dashboard/deleteCountry.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`id=${id}`);

    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        window.location.href = 'countriesList.php';
      }
    }

    xhr.onerror = function() {
      console.log('Error');
    }
  }

  modalClose.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  modalConfirm.addEventListener('click', () => {
    const id = modalConfirm.getAttribute('id');
    deleteCountry(id);
  });
  </script>
</body>

</html>