<?php
if (isset($_POST['id'])) {
  include '../../../config.php';
  $id = $_POST['id'];
  $sql = "DELETE FROM countries WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $error = mysqli_error($conn);
  if (mysqli_stmt_affected_rows($stmt) > 0) {
    header("Location: ../../pages/Dashboard/countriesList.php");
  } else {
    header("Location: ../../pages/Dashboard/countriesList.php?error=Unknown error occurred&$error");
  }
} else {
  header("Location: ../../pages/Dashboard/countriesList.php");
  exit();
}
