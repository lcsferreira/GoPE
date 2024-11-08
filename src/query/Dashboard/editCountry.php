<?php
include '../../../config.php';

if (isset($_POST['name']) && isset($_POST['capital']) && isset($_POST['region']) && isset($_POST['need_translation_value']) && isset($_POST['id'])) {
  function validate($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $name = validate($_POST['name']);
  $capital = validate($_POST['capital']);
  $region = validate($_POST['region']);
  $need_translation = validate($_POST['need_translation_value']);
  $need_translation = $need_translation == "true" ? 1 : 0;
  $card_english_step = validate($_POST['card_english_step']);
  $card_translated_step = validate($_POST['card_translated_step']);
  $translation_step = validate($_POST['translation_step']);
  $indicators_step = validate($_POST['indicators_step']);
  $id = $_POST['id'];

  if ($need_translation == 1) {
    // $sql = "UPDATE countries SET name = ?, capital = ?, region = ?, need_translation = ? WHERE id = '$id'";
    $sql = "UPDATE countries SET name = ?, capital = ?, region = ?, need_translation = ?, card_english_step = ?, card_translated_step = ?, translation_step = ?, indicators_step = ? WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    // $stmt->bind_param("sssi", $name, $capital, $region, $need_translation);
    $stmt->bind_param("sssissss", $name, $capital, $region, $need_translation, $card_english_step, $card_translated_step, $translation_step, $indicators_step);
    $stmt->execute();
    $result = $stmt->get_result();
    $error = mysqli_error($conn);
    if (mysqli_stmt_affected_rows($stmt) > 0) {
      // $message = "Country updated successfully";
      // $_SESSION['message'] = $message;
      header("Location: ../../pages/Dashboard/countriesList.php");
      exit();
    } else {
      header("Location: ../../pages/Dashboard/editCountry.php?id=$id&error=Unknown error occurred&$error");
      exit();
    }
  } else {
    // $sql = "UPDATE countries SET name = '$name', capital = '$capital', region = '$region', need_translation = '$need_translation', translation_step = NULL, card_translated_step = NULL WHERE id = '$id'";
    $sql = "UPDATE countries SET name = '$name', capital = '$capital', region = '$region', need_translation = '$need_translation', translation_step = NULL, card_translated_step = NULL, card_english_step = '$card_english_step', indicators_step = '$indicators_step' WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $error = mysqli_error($conn);
    if (mysqli_stmt_affected_rows($stmt) > 0) {
      header("Location: ../../pages/Dashboard/countriesList.php?");
      exit();
    } else {
      header("Location: ../../pages/Dashboard/editCountry.php?id=$id&error=Unknown error occurred&$error");
      exit();
    }
  }
} else {
  header("Location: ../../pages/Dashboard/editCountry.php?id=$id");
  exit();
}