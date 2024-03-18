<?php
include '../../../config.php';

$id = $_POST['idCountry'];

$sql = "UPDATE countries SET indicators_step = 'completed' WHERE id = $id";
$result = $conn->query($sql);

if ($result) {
  echo "success";
} else {
  echo "error";
}