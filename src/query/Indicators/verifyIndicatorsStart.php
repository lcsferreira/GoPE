<?php
include("../../../config.php");

$id = $_GET['id'];

$sql = "SELECT indicators_step FROM countries WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$indicators_step = $row['indicators_step'];

if ($indicators_step === "not started") {
}
