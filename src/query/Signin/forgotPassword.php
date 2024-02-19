<?php
include '../../../config.php';
// Get the email from the request
$email = $_POST['email'];

// Check if the email exists in the users table
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) > 0) {
  // Email exists, generate a unique token for password reset
  // $token = bin2hex(random_bytes(32));

  // // Save the token in the database for the user
  // $query = "UPDATE users SET reset_token = '$token' WHERE email = '$email'";
  // mysqli_query($connection, $query);

  // // Send the password reset email
  // $resetLink = "https://example.com/reset-password.php?tk=$token";
  // $to = $email;
  // $subject = "Password Reset";
  // $message = "Click the link below to reset your password:\n\n$resetLink";
  // $headers = "From: noreply@example.com\r\n";
  // mail($to, $subject, $message, $headers);
  // echo "Password reset email sent";

  header("Location: ../../pages/Login/forgotPasswordSuccess.php");
} else {
  // Email does not exist
  // echo "Email does not exist";
  header("Location: ../../pages/Login/forgotPassword.php?error=email not registered");
}
