<?php
include '../../../config.php';

$id = $_GET['id'];

//auitomaticos
$indicators = ["demographic_data", "pa_prevalence", "pe_monitoring", "pe_policy"];
$value_types = ["admin", "contact", "comments", "agreement"];

foreach ($indicators as $indicator) {
  foreach ($value_types as $value_type) {
    $sql = "INSERT INTO " . $indicator . "_" . $value_type . " (id_country) VALUES ($id)";
    $result = mysqli_query($conn, $sql);
  }
}

//especificos
$sql = "INSERT INTO research_pe_admin (id_country) VALUES ($id)";
$result = mysqli_query($conn, $sql);
$sql = "INSERT INTO research_pe_agreement (id_country) VALUES ($id)";
$result = mysqli_query($conn, $sql);
$sql = "INSERT INTO research_pe_comments (id_country) VALUES ($id)";
$result = mysqli_query($conn, $sql);

//documentos, monitoring systems e intervation studies se criam sozinhos, não precisando inserir as tabelas

if ($result) {
  $sql = "UPDATE countries SET indicators_step = 'waiting admin' WHERE id = " . $id;
  mysqli_query($conn, $sql);
  header("Location: ../../pages/Indicators/indicatorsProgress.php?id=" . $id);
} else {
  // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  header("Location: ../../pages/Indicators/indicatorsProgress.php?id=" . $id);
}