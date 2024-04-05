<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/pages/login.css">
  <title>Login - GoPE!</title>
</head>

<body>
  <div class="bg-filter"></div>
  <div class="form-container">
    <form action="../../query/Signin/login.php" method="post">
      <div class="form__title">
        <h1>Login</h1>
        <img src="../../assets/gope-logo-desc.png" alt="GoPE logo">
      </div>
      <p class="form__description">
        Enter your <strong>credentials</strong> to login with <strong>your account</strong>.
      </p>
      <div class="form__input-container">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <p id="email-error" class="error"></p>
      </div>
      <div class="form__input-container">
        <label for="password" class="forgot-password-container">Password <span><a href="./forgotPassword.php">Forgot
              password?</a></span></label>
        <input type="password" name="password" id="password">
      </div>
      <?php
      if (isset($_GET['error'])) {
        echo '<p class="error">Invalid email or password</p>';
      }
      ?>
      <div>
        <button type="submit" class="btn-login">Send</button>
      </div>
    </form>
  </div>

  <script>
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const submitButton = document.querySelector('.btn-login');

  function validateInputs() {
    const email = emailInput.value.trim();
    const emailError = document.getElementById('email-error');

    if (email === '') {
      emailError.textContent = 'Email is required';
      submitButton.disabled = true;
    } else if (!email.includes('@')) {
      emailError.textContent = 'Invalid email format';
      submitButton.disabled = true;
    } else {
      emailError.textContent = '';
      submitButton.disabled = false;
    }
  }

  emailInput.addEventListener('blur', validateInputs);
  </script>

</body>

</html>