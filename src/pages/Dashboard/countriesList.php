<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
  header("Location: ../../pages/Login/login.php");
  exit;
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Countries List - GoPE!</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/vars.css">
  <link rel="stylesheet" href="../../css/components/header.css">
  <link rel="stylesheet" href="../../css/pages/dashboard.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
    integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
    integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous" />
</head>

<body>
  <?php include '../../components/header.php'; ?>
  <div class="container">
    <h1 class="container__title">Countries <strong>Dashboard</strong></h1>
    <div class="cards-container">

    </div>
    <div class="dashboard-container">
      <div class="dashboard-container__header">
        <h2>Country Details</h2>
        <button class="btn-add"><strong>Create</strong> Country</button>
      </div>
      <table class="dashboard-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Indicators</th>
            <th>Country Card English Review</th>
            <th>Translation</th>
            <th>Country Card Translated Review</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Brasil</td>
            <td><button class="btn-play"><i class="fa fa-play"></i></button></td>
            <td><button class="btn-play"><i class="fa fa-play"></i></button></td>
            <td><button class="btn-play"><i class="fa fa-play"></i></button></td>
            <td><button class="btn-play"><i class="fa fa-play"></i></button></td>
            <td>
              <button class="btn-edit"><i class="fa fa-edit"></i></button>
              <button class="btn-delete"><i class="fa fa-trash"></i></button>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>