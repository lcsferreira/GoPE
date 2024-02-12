<?php
include '../../../config.php';

// Get the token from the request
$emailCrypted = $_POST['tk'];

// Decrypt the token
// $email = md5($emailCrypted);
$email = $emailCrypted;

// Update the user with the posted password
$password = $_POST['password'];

$query = "UPDATE users SET password = '$password' WHERE email = '$email'";

$result = mysqli_query($conn, $query);

// echo mysqli_error($conn);

if (mysqli_affected_rows($conn) > 0) {
  // Password updated
  // echo "Password updated";
  header("Location: ../../pages/Login/firstAccess.php?Success");
} else {
  // Password not updated
  // echo "Password not updated";
  header("Location: ../../pages/Login/firstAccess.php?error=update");
}

// Redirect to the login page
// header("Location: ../../pages/Login/login.php");