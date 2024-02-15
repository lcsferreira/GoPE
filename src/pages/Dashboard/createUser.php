<!DOCTYPE html>
<html lang="en">

<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}
$query = "SELECT * FROM countries";
$result = mysqli_query($conn, $query);
$countries = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Countries List - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/pages/dashboard.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css" integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <h1 class="container__title">User <strong>Creation</strong> <span>Fill with the user information</span></h1>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2>User <strong>Information</strong></h2>
      </div>
      <form action="../../query/Dashboard/createUser.php" method="post" id="userForm">
        <div class="form-group">
          <label for="name">Name *</label>
          <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
          <label for="secondary-email">Secondary email</label>
          <input type="email" name="secondary-email" id="secondary-email">
        </div>
        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
          <label for="institution">Institution *</label>
          <input type="text" name="institution" id="institution" required>
        </div>
        <div class="form-group">
          <label for="type">Type *</label>
          <select name="type" id="type" required>
            <option value="admin">Admin</option>
            <option value="contact" selected>Contact</option>
          </select>
        </div>
        <div class="country-relation-container">
          <button id="add-country" type="button">Add Country <span><i class="fas fa-plus"></i></span></button>

          <div class="country-relation" id="country-relation-1">
            <select name="country" required id="country-1">
              <option value="" selected>Select a country</option>
              <?php
              foreach ($countries as $country) {
                echo "<option value='" . $country['id'] . "'>" . $country['name'] . "</option>";
              }
              ?>
            </select>
            <div class="switch-container">

              <label for="main-user">Main contact</label>
              <!-- Rounded switch -->
              <label class="switch">
                <input type="checkbox" name="main-user" id="main-user-1">
                <span class="slider round"></span>
              </label>
              <!-- Hidden input field to store checkbox value -->
              <input type="hidden" name="main-user-value" id="main-user-value-1" value="">
            </div>
            <button class="btn-delete" id="btn-delete-1" type="button">
              <span><i class="fas fa-trash"></i></span>
            </button>
          </div>
        </div>
        <button class="btn-submit" type="submit">
          Create
        </button>
      </form>
    </div>
  </div>
  <script>
    const form = document.getElementById('userForm');

    function deleteCountryRelation(id) {
      const countryRelation = document.getElementById("country-relation-" + id);
      countryRelation.remove();
    }

    function addCountryRelation() {
      const countryRelationList = document.querySelectorAll('.country-relation');

      const countryRelation = document.createElement('div');
      countryRelation.classList.add('country-relation');
      countryRelation.id = `country-relation-${countryRelationList.length + 1}`;

      const countrySelect = document.createElement('select');
      countrySelect.name = 'country';

      countrySelect.id = `country-${countryRelationList.length + 1}`;
      countrySelect.required = true;

      const countries = <?php echo json_encode($countries); ?>;
      countries.forEach(country => {
        const option = document.createElement('option');
        option.value = country.id;
        option.textContent = country.name;
        countrySelect.appendChild(option);
      });

      const toggleSwitch = document.createElement('div');
      toggleSwitch.classList.add('switch-container');

      const label = document.createElement('label');
      label.htmlFor = `main-user-${countryRelationList.length + 1}`;
      label.textContent = 'Main contact';

      const switchInput = document.createElement('input');
      switchInput.type = 'checkbox';
      switchInput.name = 'main-user';
      switchInput.id = `main-user-${countryRelationList.length + 1}`;

      const labelSlider = document.createElement('label');
      labelSlider.classList.add('switch');
      label.htmlFor = `main-user-${countryRelationList.length + 1}`;

      const slider = document.createElement('span');
      slider.classList.add('slider', 'round');

      const hiddenInput = document.createElement('input');
      hiddenInput.type = 'hidden';
      hiddenInput.name = 'main-user-value';
      hiddenInput.id = `main-user-value-${countryRelationList.length + 1}`;
      hiddenInput.value = '';

      labelSlider.appendChild(switchInput);
      labelSlider.appendChild(slider);
      toggleSwitch.appendChild(label);
      toggleSwitch.appendChild(labelSlider);
      toggleSwitch.appendChild(hiddenInput);

      const trashIcon = document.createElement('button');
      trashIcon.classList.add('btn-delete');
      trashIcon.id = `btn-delete-${countryRelationList.length + 1}`;
      trashIcon.type = 'button';
      trashIcon.innerHTML = '<span><i class="fas fa-trash"></i></span>';

      const countryRelationContainer = document.querySelector('.country-relation-container');
      countryRelationContainer.appendChild(countryRelation);
      countryRelation.appendChild(countrySelect);
      countryRelation.appendChild(toggleSwitch);
      countryRelation.appendChild(trashIcon);

      trashIcon.addEventListener('click', () => {
        deleteCountryRelation(countryRelationList.length + 1);
      });
    }
    document.getElementById('add-country').addEventListener('click', addCountryRelation);


    // Add event listener to all delete buttons
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
      button.addEventListener('click', () => {
        const id = button.id.split('-')[2];
        console.log(id);
        deleteCountryRelation(id);
      });
    });

    const submitButton = document.querySelector('.btn-submit');
    submitButton.addEventListener('click', () => {
      event.preventDefault();
      const countryRelations = document.querySelectorAll('.country-relation');
      countryRelations.forEach((relation, index) => {
        const mainUser = relation.querySelector(`#main-user-${index + 1}`);
        const hiddenInput = relation.querySelector(`#main-user-value-${index + 1}`);
        hiddenInput.value = mainUser.checked ? 'true' : 'false';
      });

      // console log all the values
      const form = document.getElementById('userForm');
      const formData = new FormData(form);

      for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
      }

      // countries = { countryId : id, mainUser: mainUserValue}

      const countries = Array.from(countryRelations).map((relation, index) => {
        const countryId = relation.querySelector(`#country-${index + 1}`).value;
        const mainUser = relation.querySelector(`#main-user-value-${index + 1}`).value;
        return {
          countryId,
          mainUser
        };
      });

      console.log(countries);

      formattedPayload = {
        name: formData.get('name'),
        email: formData.get('email'),
        secondaryEmail: formData.get('secondary-email'),
        institution: formData.get('institution'),
        type: formData.get('type'),
        countries: countries,
      };

      console.log(formattedPayload);

      fetch('../../query/Dashboard/createUser.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(formattedPayload),
        })
        .then((response) =>
          console.log(response))
        .then((data) => {
          console.log('Success:', data);
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    });
  </script>


  </script>
</body>

</html>