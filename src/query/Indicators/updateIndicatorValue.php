<?php
include "../../../config.php";

$payload = $_POST['payload'];

$tableName = $payload['tableName'];
$inputName = $payload['inputName'];
$value = $payload['value'];
$idCountry = $payload['idCountry'];

// $sql = "UPDATE $tableName SET $inputName = '$value' WHERE id_country = $idCountry";
// $result = $conn->query($sql);


// if ($result) {
//   // if(isset($_SESSION['hasEdited']) && $_SESSION['hasEdited'] === false) {
//   //   $_SESSION['hasEdited'] = true;
//   // }
//   echo "success";
// } else {
//   echo "error";
// }

// Verifica se os parâmetros necessários estão presentes
if (isset($tableName, $inputName, $value, $idCountry)) {
  // Prepara a consulta para evitar SQL Injection
  $stmt = $conn->prepare("UPDATE $tableName SET $inputName = ? WHERE id_country = ?");
  if ($stmt) {
      $stmt->bind_param('si', $value, $idCountry); // 'si' indica string e integer
      $stmt->execute();
      
      // Verifica se a atualização foi bem-sucedida
      if ($stmt->affected_rows > 0) {
          echo "success";
      } else {
          echo "Nenhuma linha foi atualizada.";
      }

      $stmt->close();
  } else {
      echo "Erro na preparação da consulta: " . $conn->error;
  }
} else {
  echo "Dados insuficientes para realizar a atualização.";
}