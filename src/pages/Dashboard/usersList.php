<?php
include "../../../config.php";
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}
// if (isset($_SESSION['message'])) {
//   echo "<script>alert('" . $_SESSION['message'] . "');</script>";
//   unset($_SESSION['message']); // Clear the session variable
// }
$query = "SELECT * FROM users";
// echo $query;
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users List - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/modal.css">
  <link rel="stylesheet" href="../../css/pages/dashboard.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <?php
    $icon = "fas fa-exclamation-triangle";
    $message = "Do you really want to delete this User? This process cannot be undone.";
    $buttonConfirmText = "Yes";
    $buttonCloseText = "No";
    include '../../components/modalCard.php';
    ?>
    <h1 class="container__title">Users <strong>Dashboard</strong></h1>
    <div class="cards-container">

    </div>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2>User Details</h2>
        <button class="btn-add" onclick="window.location.href = 'createUser.php';"><strong>Create</strong>
          User</button>
      </div>
      <table class="dashboard-table users">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Institution</th>
            <th>Status</th>
            <th>Type</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user) : ?>
          <!-- id name email secondary_email password type active -->
          <tr>
            <td><?php echo $user['name'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo $user['institution'] ?></td>
            <td class="status-<?php echo $user['active'] == 1 ? 'active' : 'inactive' ?>">
              <?php echo $user['active'] == 1 ? 'Active' : 'Inactive' ?></td>
            <td><?php echo $user['type'] ?></td>
            <td>
              <button class="btn-edit" onclick="window.location.href = 'editUser.php?id=<?php echo $user['id'] ?>'"><i
                  class="fas fa-edit"></i></button>
              <button class="btn-delete" id="btn-delete-<?php echo $user['id'] ?>"><i
                  class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
  const modal = document.querySelector('.modal');
  const modalConfirm = document.querySelector('#modal-confirm');
  const modalClose = document.querySelector('#modal-close');
  const btnDelete = document.querySelectorAll('.btn-delete');

  btnDelete.forEach(btn => {
    btn.addEventListener('click', () => {
      modal.style.display = 'flex';
      modalConfirm.setAttribute('id', btn.getAttribute('id').split('-')[2]);
    });
  });

  function deleteCountry(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../query/Dashboard/deleteCountry.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`id=${id}`);

    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        window.location.href = 'countriesList.php';
      }
    }

    xhr.onerror = function() {
      console.log('Error');
    }
  }

  modalClose.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  modalConfirm.addEventListener('click', () => {
    const id = modalConfirm.getAttribute('id');
    deleteCountry(id);
  });
  </script>
</body>

</html>