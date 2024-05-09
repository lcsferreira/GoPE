<?php
include '../../../config.php';
// get the token from the URL
$token = $_GET['tk'];

$id = $token;

// Prepare and execute the query
$sql = "SELECT * FROM users WHERE id = '$id' AND active = 1 AND password IS NOT NULL";
$result = mysqli_query($conn, $sql);

// Check if the user exists
if (mysqli_num_rows($result) > 0) {
  // The user exists, redirect to the login page
  header("Location: ../../pages/Login/login.php");
}
?>
<?php
if (isset($_GET['Success'])) {
  header("refresh:5;url=../../pages/Login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/pages/firstAccess.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
  <title>First Access - GoPE!</title>
</head>

<body>
  <div class="bg-filter"></div>
  <?php if (isset($_GET['Success'])) : ?>
  <div class="form-container">
    <div class="form-content">
      <div class="form__title">
        <img src="../../assets/gope-logo-desc.png" alt="GoPE logo">
        <h1>First Access</h1>
      </div>
      <p class="form__description">
        your <strong>password</strong> has been <strong>saved</strong>.
        <br>
        We will <strong>redirect</strong> you to the <strong>log in </strong> area.
      </p>
      <i class="fas fa-check-circle icon"></i>
    </div>
  </div>
  <?php else : ?>
  <div class="form-container">
    <form action="../../query/Signin/firstAccess.php" method="post">
      <div class="form__title">
        <h1>First Access</h1>
        <img src="../../assets/gope-logo-desc.png" alt="GoPE logo">
      </div>
      <p class="form__description">
        <strong>Create</strong> your account <strong>password</strong>.
        <br>
        <br>
        Must have at <strong>least 8
          characters</strong>, <strong>one number</strong> and <strong>one uppercase letter</strong>.
      </p>
      <input type="hidden" name="tk" value="<?php echo $_GET['tk'] ?>">
      <div class="form__input-container">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <p id="password-error" class="error"></p>
      </div>
      <div class="form__input-container">
        <label for="confirm-password">Confirm password</label>
        <input type="password" name="confirm-password" id="confirm-password">
      </div>
      <div>
        <button type="submit" class="btn-login">Send</button>
      </div>
    </form>
    <?php endif; ?>
  </div>

  <script>
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm-password');
  const submitButton = document.querySelector('.btn-login');

  function validateInputs() {
    const password = passwordInput.value.trim();
    const confirmPassword = confirmPasswordInput.value.trim();
    const passwordError = document.getElementById('password-error');
    const numberRegex = /[0-9]/;
    const uppercaseRegex = /[A-Z]/;

    if (password === '') {
      passwordError.textContent = 'Password is required';
      submitButton.disabled = true;
    } else if (password.length < 8) {
      passwordError.textContent = 'Password must have at least 8 characters';
      submitButton.disabled = true;
    } else if (!numberRegex.test(password)) {
      passwordError.textContent = 'Password must have at least one number';
      submitButton.disabled = true;
    } else if (!uppercaseRegex.test(password)) {
      passwordError.textContent = 'Password must have at least one uppercase letter';
      submitButton.disabled = true;
    } else if (password !== confirmPassword) {
      passwordError.textContent = 'Passwords do not match';
      submitButton.disabled = true;
    } else {
      passwordError.textContent = '';
      submitButton.disabled = false;
    }
  }

  passwordInput.addEventListener('input', validateInputs);
  confirmPasswordInput.addEventListener('input', validateInputs);
  </script>

</body>

</html>