<?php
include '../../../config.php';

// Get the token from the request
$id = $_POST['id'];

// Update the user with the posted password
$password = $_POST['password'];

$password = md5($password);

$query = "UPDATE users SET password = '$password' WHERE id = '$id'";

$result = mysqli_query($conn, $query);

// echo mysqli_error($conn);

if (mysqli_affected_rows($conn) > 0) {
  // Password updated
  // echo "Password updated";
  header("Location: ../../pages/Login/resetPassword.php?id=5&Success");
} else {
  // Password not updated
  // echo "Password not updated";
  header("Location: ../../pages/Login/resetPassword.php?id=5&error=update");
}
