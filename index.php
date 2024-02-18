<?php
session_start();

if (!isset($_SESSION['loggedIn'])) {
    header("Location: src/pages/Login/login.php");
    exit;
} else {
    if ($_SESSION['type'] == "admin") {
        header("Location: src/pages/Dashboard/countriesList.php");
    } else {
        header("Location: src/pages/Dashboard/countriesList.php?id=" . $_SESSION['id']);
    }
    exit;
}
