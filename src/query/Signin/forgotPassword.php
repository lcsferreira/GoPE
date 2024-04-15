<?php
include '../../../config.php';
// Get the email from the request
$email = $_POST['email'];

// Check if the email exists in the users table
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];

if (mysqli_num_rows($result) > 0) {
  $to = $email;
  $subject = "Reset Password - GoPE!";
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: prferreiraj@loudoun.dreamhost.com' . "\r\n";
  $headers .= 'Reply-To: info@globalphysicaleducationobservatory.com' . "\r\n";
  $headers .= "X-Priority: 1\r\n";
  $headers .= 'X-Mailer: PHP/' . phpversion();

  $message = "
  <br>
  Did you forgot your password?
  <br><br>
  Please click in the <strong>link below</strong> to reset your password.
  <br><br>
  <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Login/resetPassword.php?id=$id'>Reset Password</a>
  <br><br>
    If you have any questions, please contact us at <a href='mailto: main.admin@email.com'>main.admin@email.com</a>
  ";

  mail($to, $subject, $message, $headers);

  header("Location: ../../pages/Login/login.php");
} else {
  // Email does not exist
  // echo "Email does not exist";
  header("Location: ../../pages/Login/forgotPassword.php?error=email not registered");
}