<?php
include '../../../config.php';

if (isset($_POST['name']) && isset($_POST['capital']) && isset($_POST['region']) && isset($_POST['need_translation_value'])) {
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

  if ($need_translation == 1) {
    $sql = "INSERT INTO countries(name, capital, region, need_translation) VALUES('$name', '$capital', '$region', '$need_translation')";
    $result = mysqli_query($conn, $sql);
    $error = mysqli_error($conn);
  } else {
    $sql = "INSERT INTO countries(name, capital, region, need_translation, translation_step, card_translated_step) VALUES('$name', '$capital', '$region', '$need_translation', NULL, NULL)";
    $result = mysqli_query($conn, $sql);
    $error = mysqli_error($conn);
  }


  if ($result) {
    header("Location: ../../pages/Dashboard/countriesList.php?success=Country was created successfully");
    exit();
  } else {
    header("Location: ../../pages/Dashboard/createCountry.php?error=Unknown error occurred&$error");
    exit();
  }
} else {
  header("Location: ../../pages/Dashboard/createCountry.php");
  exit();
}
