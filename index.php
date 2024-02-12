<?php
session_start();

if (!isset($_SESSION['loggedIn'])) {
    header("Location: src/pages/Login/login.php");
    exit;
} else {
    header("Location: src/pages/Dashboard/dashboard.php");
    exit;
}
