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

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$query = "SELECT id_country, is_main FROM user_country_relations WHERE id_user = '$id'";
$result = mysqli_query($conn, $query);
$countriesRelated = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push($countriesRelated, $row);
}

mysqli_free_result($result);
mysqli_close($conn);


?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Edit - GoPE!</title>
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
    <h1 class="container__title">User <strong>Edit</strong> <span>Review and edit the user information</span></h1>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2>User <strong>Information</strong></h2>
      </div>
      <form action="" method="post" id="userForm">
        <div class="form-group">
          <label for="name">Name *</label>
          <input type="text" name="name" id="name" required value="<?php echo $user['name']; ?>">
        </div>
        <div class="form-group">
          <label for="secondary-email">Secondary email</label>
          <input type="email" name="secondary-email" id="secondary-email" value="<?php echo $user['secondary_email'] ?>">
        </div>
        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" name="email" id="email" required value="<?php echo $user['email']; ?>">
        </div>
        <div class="form-group">
          <label for="institution">Institution *</label>
          <input type="text" name="institution" id="institution" required value="<?php echo $user['institution'] ?>">
        </div>
        <div class="form-group">
          <label for="type">Type *</label>
          <select name="type" id="type" required>
            <option value="admin" <?php if ($user['type'] === "admin") {
                                    echo "selected";
                                  } ?>>Admin</option>
            <option value="contact" <?php if ($user['type'] === "contact") {
                                      echo "selected";
                                    } ?>>Contact</option>
          </select>
        </div>
        <div class="form-group">
          <div class="switch-container">
            <label for="active">Active</label>
            <!-- Rounded switch -->
            <label class="switch">
              <input type="checkbox" name="active" id="active" <?php echo $user['active'] === '1' ? 'checked' : ''; ?>>
              <span class="slider round"></span>
            </label>
            <!-- Hidden input field to store checkbox value -->
            <input type="hidden" name="active-value" id="active-value" value="<?php echo $user['active'] === '1' ? 'true' : 'false'; ?>">
          </div>
        </div>
        <div class="country-relation-container">
          <button id="add-country" type="button">Add Country <span><i class="fas fa-plus"></i></span></button>
          <?php foreach ($countriesRelated as $index => $countryRelated) : ?>
            <div class="country-relation" id="country-relation-<?php echo $index + 1; ?>">
              <select name="country" id="country-<?php echo $index + 1; ?>">
                <option value="-1" selected>Select a country</option>
                <?php
                foreach ($countries as $country) {
                  echo "<option value='" . $country['id'] . "' " . ($country['id'] == $countryRelated['id_country'] ? 'selected' : '') . ">" . $country['name'] . "</option>";
                }
                ?>
              </select>
              <div class="switch-container">
                <label for="main-user">Main contact</label>
                <!-- Rounded switch -->
                <label class="switch">
                  <input type="checkbox" name="main-user" id="main-user-<?php echo $index + 1; ?>" <?php echo $countryRelated['is_main'] == '1' ? 'checked' : ''; ?>>
                  <span class="slider round"></span>
                </label>
                <!-- Hidden input field to store checkbox value -->
                <input type="hidden" name="main-user-value" id="main-user-value-<?php echo $index + 1; ?>" value="<?php echo $countryRelated['is_main'] === '1' ? 'true' : 'false'; ?>">
              </div>
              <button class="btn-delete" id="btn-delete-<?php echo $index + 1; ?>" type="button">
                <span><i class="fas fa-trash"></i></span>
              </button>
            </div>
          <?php endforeach; ?>
        </div>
        <button class="btn-submit" type="submit">
          Confirm
        </button>
      </form>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    const form = document.getElementById('userForm');

    function deleteCountryRelation(id) {
      const countryRelation = document.getElementById("country-relation-" + id);
      // get the value of the country selected
      const countrySelect = countryRelation.querySelector(`#country-${id}`);
      const countryId = countrySelect.value;
      // delete from the database
      fetch('../../query/Dashboard/deleteUserCountryRelation.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            userId: <?php echo $id; ?>,
            countryId: parseInt(countryId),
          }),
        })
        .then((response) => {
          if (response.status === 200) {
            // Code to execute if the response status is 200
            window.location.href = '../../pages/Dashboard/editUser.php?id=<?php echo $id; ?>'
          } else {
            console.log('Error:', response);
          }
        })

    }

    function addCountryRelation() {
      const countryRelationList = document.querySelectorAll('.country-relation');

      const countryRelation = document.createElement('div');
      countryRelation.classList.add('country-relation');
      countryRelation.id = `country-relation-${countryRelationList.length + 1}`;

      const countrySelect = document.createElement('select');
      countrySelect.name = 'country';

      countrySelect.id = `country-${countryRelationList.length + 1}`;
      countrySelect.required = false;
      countrySelect.innerHTML = '<option value="-1" selected>Select a country</option>';

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

    //prevent the form from submitting
    form.addEventListener('submit', (event) => {
      event.preventDefault();
    });

    // Add event listener to all delete buttons
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
      button.addEventListener('click', () => {
        const id = button.id.split('-')[2];
        // console.log(id);
        deleteCountryRelation(id);
      });
    });

    function validateForm() {
      const form = document.getElementById('userForm');
      const formData = new FormData(form);
      // get all the required fields

      const requiredFields = document.querySelectorAll('[required]');
      // console.log(requiredFields);
      for (input of requiredFields) {
        if (input.value === "") {
          return false;
        }
      }
      return true;
    }

    function editUser(payload) {
      console.log(payload);
      $.ajax({
        type: "POST",
        url: "../../query/Dashboard/editUser.php",
        data: {
          payload: payload
        },
        dataType: "text",
        contentType: "application/x-www-form-urlencoded",
      }).done(function(response) {
        console.log(response);
        if (response === "Success") {
          // console.log('User updated successfully');
          window.location.href = '../../pages/Dashboard/usersList.php'
        } else {
          window.location.href = '../../pages/Dashboard/editUser.php?id=<?php echo $id; ?>'
        }
      });
    }

    //get active input and set the value of the hidden input
    const activeInput = document.getElementById('active');
    const activeValue = document.getElementById('active-value');
    activeInput.addEventListener('change', () => {
      activeValue.value = activeInput.checked ? 'true' : 'false';
    });

    const submitButton = document.querySelector('.btn-submit');
    submitButton.addEventListener('click', () => {
      // event.preventDefault();
      const countryRelations = document.querySelectorAll('.country-relation');
      countryRelations.forEach((relation, index) => {
        const mainUser = relation.querySelector(`#main-user-${index + 1}`);
        const hiddenInput = relation.querySelector(`#main-user-value-${index + 1}`);
        hiddenInput.value = mainUser.checked ? 'true' : 'false';
      });

      // console log all the values
      const form = document.getElementById('userForm');
      const formData = new FormData(form);

      // countries = { countryId : id, mainUser: mainUserValue}

      const countries = Array.from(countryRelations).map((relation, index) => {
        const countryId = relation.querySelector(`#country-${index + 1}`).value;
        const mainUser = relation.querySelector(`#main-user-value-${index + 1}`).value;
        return {
          countryId,
          mainUser
        };
      });

      // if an country have id -1, remove it from the array
      const filteredCountries = countries.filter(country => country.countryId !== '-1');

      formattedPayload = {
        id: <?php echo $id; ?>,
        name: formData.get('name'),
        email: formData.get('email'),
        secondaryEmail: formData.get('secondary-email'),
        institution: formData.get('institution'),
        type: formData.get('type'),
        active: formData.get('active-value') === 'true' ? 1 : 0,
        countries: filteredCountries,
      };

      // console.log(formattedPayload)

      if (validateForm()) {
        // console.log('Form is valid');
        // console.log(formattedPayload);
        editUser(formattedPayload);
      } else {
        console.log('Please fill all the fields');
      }

    })
  </script>
</body>

</html>