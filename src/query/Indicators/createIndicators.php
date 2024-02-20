<?php
include '../../../config.php';

$id = $_GET['id'];

$indicators = ["demographic_data"];
$value_types = ["admin", "contact", "comments_admin", "comments_contact", "agreement"];

foreach ($indicators as $indicator) {
  foreach ($value_types as $value_type) {
    $sql = "INSERT INTO " . $indicator . "_" . $value_type . " (id_country) VALUES ($id)";
    $result = mysqli_query($conn, $sql);
  }
}

if ($result) {
  $sql = "UPDATE countries SET indicators_step = 'waiting admin' WHERE id = " . $id;
  mysqli_query($conn, $sql);
  header("Location: ../../pages/Indicators/indicatorsProgress.php?id=" . $id);
} else {
  // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  header("Location: ../../pages/Indicators/indicatorsProgress.php?id=" . $id);
}
