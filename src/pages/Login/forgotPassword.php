<?php
if (isset($_GET['Success'])) {
  header("refresh:5; url=login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/pages/forgotPassword.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
  <title>Forgot Password - GoPE!</title>
</head>

<body>
  <div class="bg-filter"></div>
  <?php if (isset($_GET['Success'])) : ?>
  <div class="form-container">
    <div class="form-content">
      <div class="form__title">
        <img src="../../assets/gope-logo-desc.png" alt="GoPE logo">
        <h1>Forgot password</h1>
      </div>
      <p class="form__description">
        An <strong>email</strong> has been <strong>sent</strong> for you to <strong>reset</strong> your
        <strong>password</strong>.
      </p>
      <i class="fas fa-check-circle icon"></i>
    </div>
  </div>
  <?php else : ?>
  <div class="form-container">
    <form action="../../query/Signin/forgotPassword.php" method="post">
      <div class="form__title">
        <h1>Forgot password</h1>
        <img src="../../assets/gope-logo-desc.png" alt="GoPE logo">
      </div>
      <p class="form__description">
        Enter your <strong>email</strong> to <strong>reset</strong> your <strong>password</strong>.
      </p>
      <div class="form__input-container">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <p id="email-error" class="error"></p>
      </div>
      <?php
        if (isset($_GET['error'])) {
          echo '<p class="error">This email is not registered</p>';
        }
        ?>
      <div>
        <button type="submit" class="btn-send">Send</button>
      </div>
    </form>
    <?php endif; ?>
  </div>

  <script>
  const emailInput = document.getElementById('email');
  const submitButton = document.querySelector('.btn-send');

  function validateInputs() {
    const email = emailInput.value.trim();
    const emailError = document.getElementById('email-error');

    if (email === '') {
      emailError.textContent = 'Email is required';
      submitButton.disabled = true;
    } else if (!email.includes('@') || !email.includes('.com')) {
      emailError.textContent = 'Invalid email format';
      submitButton.disabled = true;
    } else {
      emailError.textContent = '';
      submitButton.disabled = false;
    }
  }

  function clearErrorMessage() {
    const errors = document.getElementsByClassName('error');
    for (let i = 0; i < errors.length; i++) {
      errors[i].textContent = '';
    }
    submitButton.disabled = false;
  }


  emailInput.addEventListener('blur', validateInputs);
  emailInput.addEventListener('focus', clearErrorMessage);
  </script>

</body>

</html>